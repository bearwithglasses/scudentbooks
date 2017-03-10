<?php

ini_set('display_errors','On');
error_reporting(E_ALL);
$db_host = "dbserver.engr.scu.edu/db11g";
$db_user = "wchang";
$db_pass = "winstonchang";
$db_name = "STUDENTBOOKS";
$con = oci_connect($db_user, $db_pass, '//dbserver.engr.scu.edu/db11g');

$bookid = $_GET["id"];

$sql="SELECT * FROM BOOKPOST WHERE BOOKID = '$bookid'";
$stid = oci_parse($con, $sql);
oci_execute($stid);

while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
    $userid = $row['USERID'];
    $booktitle = $row['TITLE'];
};

$sql2="SELECT * FROM USERINFO WHERE USERID = '$userid'";
$stid2 = oci_parse($con, $sql2);
oci_execute($stid2);

while($row2 = oci_fetch_array($stid2, OCI_ASSOC+OCI_RETURN_NULLS)){
    $username = $row2['USERNAME'];
};

$sql3="SELECT * FROM BOOKDESCRIPTION WHERE BOOKID = '$bookid'";
$stid3 = oci_parse($con, $sql3);
oci_execute($stid3);


$sql="SELECT * FROM BOOKPOST WHERE BOOKID = '$bookid'";
$stid = oci_parse($con, $sql);
oci_execute($stid);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCUdent Books Book Listing Demo</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
    <link rel="stylesheet" type="text/css" href="booksusers.css" />
    <script src="popups-photos.js"></script>
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

<!-- Popup Message Demo -->
<div id="popupbox" class="popup">
    <div class="popupmessage">
    <form action="#" id="messageform" method="post" name="form">
        <h2>Send a Message to <b><?php echo $username ?></b> about <b><?php echo $booktitle ?></b></h2>
        <textarea id="messagebox" name="message" placeholder="Write your message here"></textarea>
        <input type="button" class="button" id="sendmessage" value="Send Message">
        <input type="button" class="button" id="closemessage" value="Close Message">
    </form>
    </div>
</div>

<!-- Popup Image Demo -->

<div id="popupimage" class="popup">
  <img class="popupmessage" id="mainimagepopup">
</div>

<!-- Container that holds Main and Side divs -->
<div id="container">

<div id="listing">
    <div class="listingimage">
    <div id="mainimage">
        <div class="listpic pic bookpic" id="img1"><img src="images/500px.png" onclick="openImage(this)"></div>
        <div class="listpic pic bookpic" id="img2"><img src="images/500-2.png" onclick="openImage(this)"></div>
        <div class="listpic pic bookpic" id="img3"><img src="images/500-3.png" onclick="openImage(this)"></div>
    </div>

        <div class="bookphotonav">
            <div class="bookthumbnail">
              <img class="opacity opacity-off" src="images/500px.png" style="width:100%" onclick="currentDiv(1)">
            </div>
            <div class="bookthumbnail">
              <img class="opacity opacity-off" src="images/500-2.png" style="width:100%" onclick="currentDiv(2)">
            </div>
            <div class="bookthumbnail">
              <img class="opacity opacity-off" src="images/500-3.png" style="width:100%" onclick="currentDiv(3)">
            </div>
          </div>
    </div>


    <div class="listinginfo">

    <?php

        while($row = oci_fetch_array($stid3, OCI_ASSOC+OCI_RETURN_NULLS)){
            $description = $row['DESCRIPTION']->load();
         }

        while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){

        $bookedition = $row['PRICE'];
        if ($bookedition == ""){
            $bookedition = "N/A";
        };

        if($row['STATUS'] == "available" && $row['PURPOSE'] == "buy"){
            $bookstatus = "buy";
            $bookstatusText = "$".$row['PRICE'];
        }
        if($row['STATUS'] == "available" && $row['PURPOSE'] == "swap"){
            $bookstatus = "swap";
            $bookstatusText = "For Swap";
        }
        if($row['STATUS'] == "sale pending"){
            $bookstatus = "pending2";
            $bookstatusText = "Sale Pending";
        }

        echo "<h1>".$row['TITLE']."</h1>";
        echo "<div class='listingstatus ".$bookstatus."'>".$bookstatusText."</div>";
        echo "<div class='listinginfotext'>";
        echo "    <p><b>Seller: </b> <a href='profile.php?username=".$username."'>".$username."</a></p>";
        echo "    <p><b>Edition: </b>".$bookedition."</p>";
        echo "    <p><b>Author: </b>".$row['AUTHOR']->load()."</p>";
        echo "    <p><b>ISBN: </b>".$row['ISBN']."</p>";
        echo "    <p><b>Course Number: </b>".$row['COURSENUMBER']."</p>";
        echo "    <p><b>Condition: </b>".$row['CONDITION']."</p>";
        echo "    <p><b>Posted: </b>".$row['POSTDATE']."</p>";
        echo "</div>";

        echo "<div class='listingdescription'>";
        echo $description;
        echo "</div>";
    }

    ?>

        <div class="sendmessage"><button id="messagebutton">Send Message</button></p></div>
</div>


<!-- Footer  -->
    <footer>
        <a href="/" class="footer_info">Help</a>
        <a href="/" class="footer_info">Contact Us</a>
        <a href="/" class="footer_info">FAQ</a>
    </footer>
</body>
    <script src="popups-photos.js"></script>
    <script src="main.js"></script>
</html>