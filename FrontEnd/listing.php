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

$bookid = $_GET["id"]; //Get the bookid from the URL

//Select the Book that is the same as the Book's bookid
$sql="SELECT * FROM BOOKPOST WHERE BOOKID = '$bookid'";
$stid = oci_parse($con, $sql);
oci_execute($stid);

//Set the userid and the booktitle from the BOOKPOST table
while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
    $userid = $row['USERID'];
    $booktitle = $row['TITLE'];
};

//Select the User from the USERINFO table using the userid
$sql2="SELECT * FROM USERINFO WHERE USERID = '$userid'";
$stid2 = oci_parse($con, $sql2);
oci_execute($stid2);

while($row2 = oci_fetch_array($stid2, OCI_ASSOC+OCI_RETURN_NULLS)){
    $username = $row2['USERNAME'];
};

//Gets the book's description
$sql3="SELECT * FROM BOOKDESCRIPTION WHERE BOOKID = '$bookid'";
$stid3 = oci_parse($con, $sql3);
oci_execute($stid3);

//Set up the sql statement to be used in later code to checking the price/status
$sql="SELECT * FROM BOOKPOST WHERE BOOKID = '$bookid'";
$stid = oci_parse($con, $sql);
oci_execute($stid);

//Set up the sql statement to be used later in the code to get the book pictures
$sqlPic="SELECT * FROM BOOKPICTURE WHERE BOOKID = '$bookid'";
$stidPic = oci_parse($con, $sqlPic);
oci_execute($stidPic);
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
                <!-- Shows user navigation if logged in. Otherwise, shows a 'log in' button -->
                <?php
                if($_SESSION["user"] == true){
                echo '<li><a href="homepage.php" class="web_link">Home</a></li>';
                echo '<li><a href="addbook.html" class="web_link">Sell</a></li>';
                echo '<li><a href="#" class="web_link">Inbox</a></li>';
                echo '<li>';
                    echo '<span id="usernav">';
                    echo '    <button onclick="myFunction()" id="userdropdown">You</button>';
                    echo '      <div id="userlinks" class="dropdownnav">';
                    echo "        <a href='profile.php?username=".$_SESSION['username']."'>Your Profile</a>";
                    echo '        <a href="yourbooks.php">Manage Books</a>';
                    echo '        <a href="#">Settings</a>';
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
        <h2>Send a Message to <b><?php echo $username ?></b> about <b><?php echo $booktitle ?></b></h2>
        <textarea id="messagebox" name="message" placeholder="Write your message here"></textarea>
        <input type="button" class="button" id="sendmessage" value="Send Message">
    </form>
    </div>
</div>

<!-- Popup Image Demo -->

<div id="popupimage" class="popup">
  <img class="popupmessage" id="mainimagepopup">
</div>

<!-- Container that holds Main and Side divs -->
<div id="container">

<?php

    $pic1 = "nopic.jpg";
    $pic2 = "nopic.jpg";
    $pic3 = "nopic.jpg";
    $description = "No description.";


    // Get and save all book pictures to variables
    while($row = oci_fetch_array($stidPic, OCI_ASSOC+OCI_RETURN_NULLS)){
        if ($row['PIC1'] != NULL){
            $pic1 = $row['PIC1'];
        }

        if ($row['PIC2'] != NULL){
            $pic2 = $row['PIC2'];
        }

        if ($row['PIC3'] != NULL){
            $pic3 = $row['PIC3'];
        }
    }

?>

<div id="listing">
    <div class="listingimage">
    <div id="mainimage">
        <div class="listpic pic bookpic" id="img1"><img src="bookimages/<?php echo $pic1 ?>" onclick="openImage(this)"></div>
        <div class="listpic pic bookpic" id="img2"><img src="bookimages/<?php echo $pic2 ?>" onclick="openImage(this)"></div>
        <div class="listpic pic bookpic" id="img3"><img src="bookimages/<?php echo $pic3 ?>" onclick="openImage(this)"></div>
    </div>

        <div class="bookphotonav">
            <div class="bookthumbnail">
              <img class="opacity opacity-off" src="bookimages/<?php echo $pic1 ?>" style="width:100%" onclick="currentDiv(1)">
            </div>
            <div class="bookthumbnail">
              <img class="opacity opacity-off" src="bookimages/<?php echo $pic2 ?>" style="width:100%" onclick="currentDiv(2)">
            </div>
            <div class="bookthumbnail">
              <img class="opacity opacity-off" src="bookimages/<?php echo $pic3 ?>" style="width:100%" onclick="currentDiv(3)">
            </div>
          </div>
    </div>


    <div class="listinginfo">

    <?php

        //Get the book description
        while($row = oci_fetch_array($stid3, OCI_ASSOC+OCI_RETURN_NULLS)){
            if ($row['DESCRIPTION'] != NULL){
                $description = $row['DESCRIPTION']->load();
            }
         }

        //Go through the previous sql statement to get the status/price
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

        //Display the book information
        echo "<h1>".$row['TITLE']."</h1>";
        echo "<div class='listingstatus ".$bookstatus."'>".$bookstatusText."</div>";
        echo "<div class='listinginfotext'><table>";
        echo "    <tr><td style='width:30%'><b>Seller:</b></td><td><a href='profile.php?username=".$username."'>".$username."</a></td></tr>";
        echo "    <tr><td style='width:30%'><b>Edition:</b></td><td>".$bookedition."</td></tr>";
        echo "    <tr><td style='width:30%'><b>Author:</b></td><td>".$row['AUTHOR']->load()."</td></tr>";
        echo "    <tr><td style='width:30%'><b>ISBN:</b></td><td>".$row['ISBN']."</td></tr>";
        echo "    <tr><td style='width:30%'><b>Course Number:</b></td><td>".$row['COURSENUMBER']."</td></tr>";
        echo "    <tr><td style='width:30%'><b>Condition:</b></td><td>".$row['CONDITION']."</td></tr>";
        echo "    <tr><td style='width:30%'><b>Posted:</b></td><td>".$row['POSTDATE']."</td></tr>";
        echo "</table></div>";

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