<?php
session_start();
ini_set('display_errors','On');
error_reporting(E_ALL);
$db_host = "dbserver.engr.scu.edu/db11g";
$db_user = "wchang";
$db_pass = "winstonchang";
$db_name = "STUDENTBOOKS";
$con = oci_connect($db_user, $db_pass, '//dbserver.engr.scu.edu/db11g');

if ($_SESSION["user"])
{
    $usernameCreator = $_SESSION['username'];
}
else
{
    header('Location: login.php');
    die();
    //$_SESSION["user"] = false;
}

// if(!isset($_SESSION["user"])){
//     //header('Location: login.php');
//     //die();
//     $_SESSION["user"] = false;
// }

//Selects user id from UserInfo
// $sql = "SELECT userid FROM UserInfo WHERE username = '$username'";
// $stid = oci_parse($con, $sql);
// oci_execute($stid);

// while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS))
// {
//     $useridCreator = $row['userid'];
// }

//Get user id of logged in user
$sql = "SELECT * FROM UserInfo WHERE username = '$usernameCreator'";
$stid = oci_parse($con, $sql);
oci_execute($stid);

while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS))
{
    $useridCreator = $row['USERID'];
}

//Select all subjects for logged in user
$sql2 = "SELECT * FROM Subject WHERE userid1 = '$useridCreator' OR userid2 = '$useridCreator' ORDER BY userid1, userid2";
$stid2 = oci_parse($con, $sql2);
oci_execute($stid2);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCUdent Books Inbox</title>
    <script src="main.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="main.css" />
    <link rel="stylesheet" type="text/css" href="booksusers.css" />
    <link rel="stylesheet" type="text/css" href="inbox.css" />
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
        <div id="closemessage" value="Close Message"><img src="images/close.png"></div>
        <h2>Send a Message to <b><?php echo $username ?></b></h2>
        <textarea id="messagebox" name="message" placeholder="Write your message here"></textarea>
        <input type="button" class="button" id="sendmessage" value="Send Message">
    </form>
    </div>
</div>


<!-- Container that holds Main and Side divs -->
<div id="container">

<div id="profile">
    <h1>Inbox</h1>

    <div class="backtoinbox">
        <a href="/"><- Back to Inbox</a>
    </div>
<div class="inboxfilters">
    <form action="inbox-search.php?username=<?php echo $_SESSION['username'] ?>" class="searchbar" method="post" name="form">
        <span class="searchicon"><i></i></span>
        <input type="text" id="search" name="search" placeholder="Search...">
        <input type="submit" class="button" value="Search">
    </form>
    <label>Sort by Date</label>
    <!-- <select id="condIdx" name="book_condition">
        <option value="New" selected="selected">Newest to Oldest</option>
        <option value="Used">Oldest to Newest</option>
    </select> -->
    <a href="inbox.php?username=<?php echo $_SESSION['username'] ?>" class="minorbutton inboxfilterbutton">Newest to Oldest</a>
    <a href="inbox-old-to-new.php?username=<?php echo $_SESSION['username'] ?>" class="minorbutton inboxfilterbutton">Oldest to Newest</a>
    <a href="inbox-user.php?username=<?php echo $_SESSION['username'] ?>" class="minorbutton inboxfilterbutton">Group by User</a>
 </div>
    <?php
        //Get subjects
        while ($row2 = oci_fetch_array($stid2, OCI_ASSOC+OCI_RETURN_NULLS))
        {
            //Date tab
            $subjectDate = $row2['SUBJECTDATE'];

            //Most recent message date and body in subject
            $subjectid = $row2['SUBJECTID'];
            $sql3 = "SELECT * FROM Message WHERE subjectid = '$subjectid'";
            $stid3 = oci_parse($con, $sql3);
            oci_execute($stid3);
            while ($rowMessage = oci_fetch_array($stid3, OCI_ASSOC+OCI_RETURN_NULLS))
            {
                if (!EMPTY($row['BODY'])) //Avoid crashing on empty body
                {
                    $messageDate = $rowMessage['MESSAGEDATE'];
                    $body = $rowMessage['BODY'];
                }
            }

            //From tab: user 1
            $userid1 = $row2['USERID1'];
            $sqlUser1 = "SELECT * FROM UserInfo WHERE userid = '$userid1'";
            $stidUser1 = oci_parse($con, $sqlUser1);
            oci_execute($stidUser1);
            while ($rowUser1 = oci_fetch_array($stidUser1, OCI_ASSOC+OCI_RETURN_NULLS))
            {
                $user1 = $rowUser1['USERNAME'];
            }

            //From tab: user 2
            $userid2 = $row2['USERID2'];
            $sqlUser2 = "SELECT * FROM UserInfo WHERE userid = '$userid2'";
            $stidUser2 = oci_parse($con, $sqlUser2);
            oci_execute($stidUser2);
            while ($rowUser2 = oci_fetch_array($stidUser2, OCI_ASSOC+OCI_RETURN_NULLS))
            {
                $user2 = $rowUser2['USERNAME'];
            }

            //Message title
            $subject = $row2['SUBJECT']->load();

            if ($usernameCreator == $user1)
            {
                $messageUser = $user2;
            }
            else
            {
                $messageUser = $user1;
            }
        
            echo "<div class='messagelisting'>";
                echo "<div class='datetab'>".$subjectDate."</div>";
                echo "<div class='fromtab'><a href='profile.php?username=".$messageUser."'>".$messageUser."</a></div>";
                echo "<div class='messagetitle'><a href='inbox-message.php?id=".$subjectid."'>".$subject."</a></div>";
            echo "</div>";
        }
    ?>
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