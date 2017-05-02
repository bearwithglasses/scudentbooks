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

$username = $_GET["username"];

//Select the User from the USERINFO table
$sql="SELECT * FROM USERINFO WHERE USERNAME = '$username'";
$stid = oci_parse($con, $sql);
oci_execute($stid);

while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
    $userid = $row['USERID']; //Set the User's USERID as userid to be used to find books
};

//Select all the books where the USERID is the same as the User's
$sql2="SELECT * FROM BOOKPOST WHERE USERID = '$userid'";
$stid2 = oci_parse($con, $sql2);
oci_execute($stid2);

$stid = oci_parse($con, $sql);
oci_execute($stid);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCUdent Books User Profile Demo</title>
    <script src="main.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="main.css" />
    <link rel="stylesheet" type="text/css" href="booksusers.css" />
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
</head>

<body>

<!-- Navigation -->
    <div id="web_nav">
        <header id="logo">
            <div id="logo"><a href="homepage.php"><img alt="eCampus logo" src="images/eCampusLogo.png"></a></div>
        </header>

        <div id="links">
            <form class="searchbar">
                <span class="searchicon"><i></i></span>
                <input type="text" name="search" placeholder="Search...">
                <input type="button" class="button" value="Search">
                <a href="searchpageColumn.php" class="advancedsearch">Advanced</a>
            </form>

            <nav>
            <ul class="navlinks" id="mainNav">
                <!-- Shows user navigation if logged in. Otherwise, shows a 'log in' button -->
                <?php
                if($_SESSION["user"] == true){
                echo '<li><a href="homepage.php" class="web_link">Home</a></li>';
                echo '<li><a href="addbook.php" class="web_link">Sell</a></li>';
                echo '<li><a href="#" class="web_link">Inbox</a></li>';
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

<!-- Popup Message Demo -->
<div id="popupbox" class="popup">
    <div class="popupmessage">
    <form action="#" id="messageform" method="post" name="form">
        <div id="closemessage" value="Close Message"><img src="images/close.png"></div>
        <h2>Send a Message to <b><?php echo $username ?></b></h2>
        <label></label><input type="text" name="book_title" placeholder="Message Title">
        <textarea id="messagebox" name="message" placeholder="Write your message here"></textarea>
        <input type="button" class="button" id="sendmessage" value="Send Message">
    </form>
    </div>
</div>


<!-- Container that holds Main and Side divs -->
<div id="container">

<div id="profile">
    <div class="profileimage">
        <div class="listpic pic"><img src="images/500px.png"></div>
    </div>

    <!--Display the User information-->
    <div class="profileinfo">
        <h1><?php echo $username ?></h1>
        <div class="profileinfotext">

        <?php
        while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
			echo "<p><b>Major:</b> " . $row['MAJOR1'] . "</p>";
			echo "<p><b>Year:</b> " . $row['YEAR'] . "</p>";
			echo "<p><b>Location:</b> " . $row['LOCATION'] . "</p>";
			echo "</tr>";
			}
        ?>

        </div>
    </div>

        <div class="sendmessage"><button id="messagebutton">Send Message</button></p></div>
</div>


    <div class="booklist">
    <h1>Book List</h1>
    <ul>



    <?php

    //Display the list of books of that User
    while($row = oci_fetch_array($stid2, OCI_ASSOC+OCI_RETURN_NULLS)){

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
                if($row['STATUS'] == "sale-pending"){
                    $bookstatus = "pending";
                    $bookstatusText = "Sale Pending";
                    $booklink = "";
                    $booklinkend = "";
                }

        $date = $row['POSTDATE'];
        $bookid = $row['BOOKID'];
        $author = $row['AUTHOR']->load();

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

        //Display the book listing with the date, author, and book status button
        echo "<li>";        
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