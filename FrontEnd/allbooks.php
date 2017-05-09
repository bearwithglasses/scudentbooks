<?php
session_start();
ini_set('display_errors','On');
error_reporting(E_ALL);
$db_host = "dbserver.engr.scu.edu/db11g";
$db_user = "wchang";
$db_pass = "winstonchang";
$db_name = "STUDENTBOOKS";
$con = oci_connect($db_user, $db_pass, '//dbserver.engr.scu.edu/db11g');

if(!isset($_SESSION["user"])){
    //header('Location: login.php');
    //die();
    $_SESSION["user"] = false;
}

$sql="SELECT * FROM BOOKPOST ORDER BY POSTDATE DESC";
$stid = oci_parse($con, $sql);
oci_execute($stid);



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCUdent Books Home</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
    <script src="https://use.fontawesome.com/29dce5faae.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
</head>

<body>

<!-- Navigation -->
    <div id="web_nav">
        <header id="logo">
            <div id="logo"><a href="homepage.php"><img alt="SCUdentBooks logo" src="images/logo.png"></a></div>
        </header>

        <div id="links">
            <form class="searchbar">
                <a href="searchpageColumn.php" class="advancedsearch">Search for Books</a>
            </form>

            <nav>
            <ul class="navlinks" id="mainNav">
                <!-- Shows user navigation if logged in. Otherwise, shows a 'log in' button -->
                <?php
                if($_SESSION["user"] == true){
                echo '<li><a href="homepage.php" class="web_link">Home</a></li>';
                echo '<li><a href="addbook.php" class="web_link">Sell</a></li>';
                echo "<li><a href='inbox.php?username=".$_SESSION['username']."' class='web_link'>Inbox</a></li>";
                echo '<li>';
                    echo '<span id="usernav">';
                    echo '    <button onclick="myFunction()" id="userdropdown">You</button>';
                    echo '      <div id="userlinks" class="dropdownnav">';
                    echo "        <a href='profile.php?username=".$_SESSION['username']."'>Your Profile</a>";
                    echo '        <a href="yourbooks.php">Manage Books</a>';
                    echo '        <a href="logout.php">Log Out</a>';
                    echo '</span>';
                }
                else{
                    echo '<li><a href="join.php" class="web_link registerlink">Register</a></li>';
                    echo '<li><a href="login.php" class="web_link loginlink">Log In</a></li>';
                }
                ?>
            </ul>
            </nav>
        </div>

        <div class="icon">
            <a href="javascript:void(0);" style="font-size:15px;" onclick="myFunction()">☰</a>
        </div>
    </div>

<!-- Container that holds Main and Side divs -->
<div id="container">

    <div class="booklist">
    <h1>Newest Books</h1>
        <ul>
            <?php

            
            // Choose the correct display text/links for the book
            while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){

                if($row['STATUS'] == "available" && $row['PURPOSE'] == "sell"){
                    $bookstatus = "buy";
                    $bookstatusText = "$".$row['PRICE'];
                    $booklink = "<a href='listing.php?id=".$row['BOOKID']."'>";
                    $booklinkend = "</a>";
                }
                if($row['STATUS'] == "available" && $row['PURPOSE'] == "swap"){
                    $bookstatus = "swap";
                    $bookstatusText = "For Swap";
                    $booklink = "<a href='listing.php?id=".$row['BOOKID']."'>";
                    $booklinkend = "</a>";
                }
                if($row['STATUS'] == "sale pending"){
                    $bookstatus = "pending";
                    $bookstatusText = "Sale Pending";
                    $booklink = "";
                    $booklinkend = "";
                }

                // Get user info based off of the userid from the books
                $userid = $row['USERID'];
                $sql2="SELECT * FROM USERINFO WHERE USERID = '$userid'";
                $stid2 = oci_parse($con, $sql2);
                oci_execute($stid2);

                // Save user data to variables
                while($row2 = oci_fetch_array($stid2, OCI_ASSOC+OCI_RETURN_NULLS)){
                    $username = $row2['USERNAME'];
                    $location = $row2['LOCATION'];
                    $date = $row['POSTDATE'];
                    $bookid = $row['BOOKID'];
                    $author = $row['AUTHOR']->load();
                }

                $pic1 = "nopic.jpg";
                //Set up the sql statement to be used later in the code to get the book pictures
                $sql3="SELECT * FROM BOOKPICTURE WHERE BOOKID = '$bookid'";
                $stid3 = oci_parse($con, $sql3);
                oci_execute($stid3);

                //Save the picture text to a variable
                while($row3 = oci_fetch_array($stid3, OCI_ASSOC+OCI_RETURN_NULLS)){
                    if ($row3['PIC1'] != NULL){
                        $pic1 = $row3['PIC1'];
                    }
                    else{
                        $pic1 = "nopic.jpg";
                    }
                }

                //Display the book listing with the location, user, date, author, and book status button
                echo "<li>";        
                    echo "<div class='listusername'><a href='profile.php?username=".$username."'>".$username."</a></div>";
                    echo "<div class='location'>".$location."</div>";    
                    echo "<div class='listpic pic'><a href='listing.php?id=".$bookid."'><img src='bookimages/".$pic1."'></a></div>";
                    echo "<div class='listtitle'><a href='listing.php?id=".$bookid."'>".$row['TITLE']."</a></div>";
                    echo "<div class='bookinfo'>Author: ".$author."<br>".$date;
                    echo "</div>";
                    echo "<div class='buybutton ".$bookstatus."'>".$booklink.$bookstatusText.$booklinkend."</div>";
                echo "</li>";
            
            }


            ?>
            
        </ul>
    </div>
</div>

<!-- Footer  -->
    <footer>
        <a href="/" class="footer_info">Help</a>
        <a href="/" class="footer_info">Contact Us</a>
        <a href="/" class="footer_info">FAQ</a>
    </footer>
</body>
    <script src="main.js"></script>
    <script src="popups-photos.js"></script>
</html>