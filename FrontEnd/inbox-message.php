<?php
session_start();
error_reporting(0);
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

$subjectid = $_GET['id']; //Get the subjectid from the URL

//Get user id of logged in user
$sqlUseridCreator = "SELECT * FROM UserInfo WHERE username = '$usernameCreator'";
$stidUseridCreator = oci_parse($con, $sqlUseridCreator);
oci_execute($stidUseridCreator);

while ($rowUseridCreator = oci_fetch_array($stidUseridCreator, OCI_ASSOC+OCI_RETURN_NULLS))
{
    $useridCreator = $rowUseridCreator['USERID'];
} 

//Select messages of subject
$sql = "SELECT * FROM Message WHERE subjectid = '$subjectid'";
$stid = oci_parse($con, $sql);
oci_execute($stid);

//Get subject
$sql2 = "SELECT * FROM Subject WHERE subjectid = '$subjectid'";
$stid2 = oci_parse($con, $sql2);
oci_execute($stid2);

while ($row2 = oci_fetch_array($stid2, OCI_ASSOC+OCI_RETURN_NULLS))
{
    $subject = $row2['SUBJECT']->load();
    $subjectDate = $row2['SUBJECTDATE'];
    $userid1 = $row2['USERID1'];
    $userid2 = $row2['USERID2'];
}

//Get username of user 1
$sqlUser1 = "SELECT * FROM UserInfo WHERE userid = '$userid1'";
$stidUser1 = oci_parse($con, $sqlUser1);
oci_execute($stidUser1);
while ($rowUser1 = oci_fetch_array($stidUser1, OCI_ASSOC+OCI_RETURN_NULLS))
{
    $user1 = $rowUser1['USERNAME'];
}

//Get username of user 2
$sqlUser2 = "SELECT * FROM UserInfo WHERE userid = '$userid2'";
$stidUser2 = oci_parse($con, $sqlUser2);
oci_execute($stidUser2);
while ($rowUser2 = oci_fetch_array($stidUser2, OCI_ASSOC+OCI_RETURN_NULLS))
{
    $user2 = $rowUser2['USERNAME'];
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCUdent Books Inbox Message</title>
    <script src="main.js"></script>
    <script src="replywarning.js"></script>
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
                    echo "    <button onclick='myFunction()' id='userdropdown'>".$_SESSION['username']."</button>";
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
    <h1>Inbox</h1>
<div id="profile">
    <a href="inbox.php?username=<?php echo $_SESSION['username'] ?>">Back to Inbox</a>

    <?php
        if ($usernameCreator == $user1)
        {
            $messageUser = $user2;
        }
        else
        {
            $messageUser = $user1;
        }

        echo "<div class='messageheader'>";
            echo "<h1>".$subject."</h1>";
            echo "<div class='messagedate'>".$subjectDate."</div>";
            echo "<div class='messagepageinfo'><a href='profile.php?username=".$messageUser."'>".$messageUser."</a></div>";
        echo "</div>";

        //Get messages
        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS))
        {
            //Message date
            $messageDate = $row['MESSAGEDATE'];

            //Body
            if (!EMPTY($row['BODY'])) //Avoid crashing on empty body
            {
                $body = $row['BODY']->load();
            }

            //User of most recent message in subject
            $userid = $row['USERID'];
            $sqlUser = "SELECT * FROM UserInfo WHERE userid = '$userid'";
            $stidUser = oci_parse($con, $sqlUser);
            oci_execute($stidUser);
            while ($rowUser = oci_fetch_array($stidUser, OCI_ASSOC+OCI_RETURN_NULLS))
            {
                $user = $rowUser['USERNAME'];
            }

            echo "<div class='messagecontent'>";
                echo "<div class='messagedate'>".$messageDate."</div>";
                echo "<div class='messageuser'>".$user."</div>";
                if (!EMPTY($row['BODY'])) //Avoid crashing on empty body
                {
                    echo "<div class='messagebody'>";
                    echo "<pre>".$body."</pre>";
                    echo "</div>";
                }
            echo "</div>";
        }
    ?>

    <div class="sendreply">
        <form action="sendinboxmessage.php" id="messageform" method="post" name="form">
            <textarea id="messagebox" name="message" placeholder="Type your reply here"></textarea>
            <input type="hidden" name="submitted" value="true"/>
            <input type="hidden" id="subjectid" name="subjectid" value="<?php echo $subjectid ?>">
            <input type="hidden" id="useridCreator" name="useridCreator" value="<?php echo $useridCreator ?>">
            <input type="hidden" id="username" name="username" value="<?php echo $messageUser ?>">
            <input type="hidden" id="subject" name="subject" value="<?php echo $subject ?>">
            <input type="hidden" id="subjectDate" name="subjectDate" value="<?php echo $subjectDate ?>">
            <input type="submit" class="button" id="messagebutton" value="Send Message" onclick="return sendInboxMessage();">
        </form>
    </div>


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