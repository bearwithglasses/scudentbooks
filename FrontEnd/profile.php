<?php

ini_set('display_errors','On');
error_reporting(E_ALL);
$db_host = "dbserver.engr.scu.edu/db11g";
$db_user = "wchang";
$db_pass = "winstonchang";
$db_name = "STUDENTBOOKS";
$con = oci_connect($db_user, $db_pass, '//dbserver.engr.scu.edu/db11g');

$username = $_GET["username"];

$sql="SELECT * FROM USERINFO WHERE USERNAME = '$username'";
$stid = oci_parse($con, $sql);
oci_execute($stid);

while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
    $userid = $row['USERID'];
};

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
                <a href="/" class="advancedsearch">Advanced</a>
            </form>

            <nav>
            <ul class="navlinks" id="mainNav">
                <li><a href="#" class="web_link">Home</a></li>
                <li><a href="#" class="web_link">Sell</a></li>
                <li><a href="#" class="web_link">Inbox</a></li>
                <li><a href="#" class="web_link"><?php echo $username ?></a></li>
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
        <h2>Send a Message to <b><?php echo $username ?></b></h2>
        <textarea id="messagebox" name="message" placeholder="Write your message here"></textarea>
        <input type="button" class="button" id="sendmessage" value="Send Message">
        <input type="button" class="button" id="closemessage" value="Close Message">
    </form>
    </div>
</div>


<!-- Container that holds Main and Side divs -->
<div id="container">

<div id="profile">
    <div class="profileimage">
        <div class="listpic pic"><img src="images/500px.png"></div>
    </div>

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

    while($row = oci_fetch_array($stid2, OCI_ASSOC+OCI_RETURN_NULLS)){

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


        echo "<li>";            
            echo "<div class='listpic pic'><a href='listing.php?id=".$row['BOOKID']."'><img src='images/500px.png'></a></div>";
            echo "<div class='listtitle'><a href='listing.php?id=".$row['BOOKID']."'>" . $row['TITLE'] . "</a></div>";
            echo "<div class='bookinfo'>Author: ". $row['AUTHOR']->load()."<br>Posted 1/23/16";
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