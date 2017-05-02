<?php
session_start();			//need this otherwise you cannot access $_SESSION array..
ini_set('display_errors','On');
error_reporting(E_ALL);
$db_host = "dbserver.engr.scu.edu/db11g";
$db_user = "wchang";
$db_pass = "winstonchang";
$db_name = "STUDENTBOOKS";
$con = oci_connect($db_user, $db_pass, '//dbserver.engr.scu.edu/db11g');

//$bookid = $_GET["id"];
$bookid = $_GET['selected'];

$sql="SELECT * FROM BOOKPOST WHERE BOOKID = '$bookid'";
$stid = oci_parse($con, $sql);
oci_execute($stid);

while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
    $userid = $row['USERID'];
    $booktitle = $row['TITLE'];
};
//
//

$sql4="SELECT * FROM BOOKPICTURE WHERE BOOKID = '$bookid'";
$stid4= oci_parse($con, $sql4);
oci_execute($stid4);
$found = 0;
while($row = oci_fetch_array($stid4, OCI_ASSOC+OCI_RETURN_NULLS)){
    $bookimage1 = $row['PIC1'];
	$bookimage2 = $row['PIC2'];
	$bookimage3 = $row['PIC3'];
	$found = 1;
};

if ($found == 1)
{	
	$bookimage1 = "src=\"bookimages/".$bookimage1."\"";
	$bookimage2 = "src=\"bookimages/".$bookimage2."\"";
	$bookimage3 = "src=\"bookimages/".$bookimage3."\"";
}
else
{		
	$bookimage1 = "src=\"bookimages/blank1.png\"";
	$bookimage2 = "src=\"bookimages/blank2.png\"";
	$bookimage3 = "src=\"bookimages/blank3.png\"";
}
//echo "bookimage: ".$bookimage1."<br>";
//echo "bookimage: ".$bookimage2."<br>";
//echo "bookimage: ".$bookimage3."<br>";


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
        <div class="listpic pic bookpic" id="img1"><img <?php echo $bookimage1 ?> onclick="openImage(this)"></div>
        <div class="listpic pic bookpic" id="img2"><img <?php echo $bookimage2 ?> onclick="openImage(this)"></div>
        <div class="listpic pic bookpic" id="img3"><img <?php echo $bookimage3 ?> onclick="openImage(this)"></div>
    </div>

        <div class="bookphotonav">
            <div class="bookthumbnail">
              <img class="opacity opacity-off" <?php echo $bookimage1 ?> style="width:100%" onclick="currentDiv(1)">
            </div>
            <div class="bookthumbnail">
              <img class="opacity opacity-off" <?php echo $bookimage2 ?> style="width:100%" onclick="currentDiv(2)">
            </div>
            <div class="bookthumbnail">
              <img class="opacity opacity-off" <?php echo $bookimage3 ?> style="width:100%" onclick="currentDiv(3)">
            </div>
          </div>
    </div>


    <div class="listinginfo">

    <?php
        $description = " ";
        while($row = oci_fetch_array($stid3, OCI_ASSOC+OCI_RETURN_NULLS)){
			 $description = $row['DESCRIPTION']->load();
		     
         }

        while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){

        $bookedition = $row['PRICE'];
        if ($bookedition == ""){
            $bookedition = "N/A";
        };

        if($row['STATUS'] == "available" && $row['PURPOSE'] == "sell"){
            $bookstatus = "buy";
            $bookstatusText = "$".$row['PRICE'];
            $disable = "";
            $bstyle = "messagebutton";
        }
        if($row['STATUS'] == "available" && $row['PURPOSE'] == "swap"){
            $bookstatus = "swap";
            $bookstatusText = "For Swap";
            $disable = "";
            $bstyle = "messagebutton";
        }
        if($row['STATUS'] == "sale pending"){
            $bookstatus = "pending2";
            $bookstatusText = "Sale Pending";
            $disable = "disabled";
            $bstyle = "messagebutton";
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


        echo "<div class='sendmessage'><button id='$bstyle' $disable>Send Message</button></p></div>";

    }

    ?>
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