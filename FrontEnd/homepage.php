<?php
session_start();
ini_set('display_errors','On');
error_reporting(E_ALL);
$db_host = "dbserver.engr.scu.edu/db11g";
$db_user = "wchang";
$db_pass = "winstonchang";
$db_name = "STUDENTBOOKS";
$con = oci_connect($db_user, $db_pass, '//dbserver.engr.scu.edu/db11g');

// if (!isset($_SESSION['USERNAME']) && !isset($_SESSION['PASSWORD']))
// {
//     header('Location: loginpage.php');
//     die();
// }

if (!isset($_SESSION["user"]))
{
    header('Location: loginpage.php');
    die();
}

$sql="SELECT * FROM BOOKPOST";
$stid = oci_parse($con, $sql);
oci_execute($stid);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCUdent Books Home Demo</title>
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
            <div id="logo"><a href="homepage.php"><img alt="eCampus logo" src="images/eCampusLogo.png"></a></div>
        </header>

        <div id="links">
            <form class="searchbar">
                <span class="searchicon"><i></i></span>
                <input type="text" name="search" placeholder="Search...">
                <input type="button" class="button" value="Search">
                <a href="/" class="advancedsearch">Advanced</a>
            </form>

            <nav>
            <ul class="navlinks" id="mainNav">
                <li><a href="#" class="web_link">Home</a></li>
                <li><a href="#" class="web_link">Sell</a></li>
                <li><a href="#" class="web_link">Inbox</a></li>
                <li><a href="#" class="web_link">You</a></li>
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

            while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){

                if($row['STATUS'] == "available" && $row['PURPOSE'] == "buy"){
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

                $userid = $row['USERID'];
                $sql2="SELECT * FROM USERINFO WHERE USERID = '$userid'";
                $stid2 = oci_parse($con, $sql2);
                oci_execute($stid2);

                while($row2 = oci_fetch_array($stid2, OCI_ASSOC+OCI_RETURN_NULLS)){
                    $username = $row2['USERNAME'];
                    $location = $row2['LOCATION'];
                }



                echo "<li>";        
                    echo "<div class='listusername'><a href='profile.php?username=".$username."'>".$username."</a></div>";
                    echo "<div class='location'>".$location."</div>";    
                    echo "<div class='listpic pic'><a href='listing.php?id=".$row['BOOKID']."'><img src='images/500px.png'></a></div>";
                    echo "<div class='listtitle'><a href='listing.php?id=".$row['BOOKID']."'>".$row['TITLE']."</a></div>";
                    echo "<div class='bookinfo'>Author: ".$row['AUTHOR']->load()."<br>Posted 1/23/16";
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