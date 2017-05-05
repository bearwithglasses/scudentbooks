<?php
//include 'header.php';
session_start();
ini_set('display_errors','On');
error_reporting(E_ALL);
$db_host = "dbserver.engr.scu.edu/db11g";
$db_user = "wchang";
$db_pass = "winstonchang";
$db_name = "STUDENTBOOKS";
$conn = oci_connect($db_user, $db_pass, '//dbserver.engr.scu.edu/db11g');
if ($conn)
{
    //print "Connection successful<br>";
}
else
{
    //print "Connection failed<br>";
    exit;
}

if(!isset($_SESSION["user"])){
    //header('Location: login.php');
    //die();
    $_SESSION["user"] = false;
}

//Referenced code for generating random 5 digit alphanumeric string: http://stackoverflow.com/questions/48124/generating-pseudorandom-alpha-numeric-strings
$available = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
$messageid = '';
$max = strlen($available) - 1;
for ($i = 0; $i < 5; $i++)
{
    $messageid .= $available[mt_rand(0, $max)];
}

//Referenced code for inserting values into sql table and sanitizing them to prevent sql injections:
//http://stackoverflow.com/questions/2119145/inserting-data-in-oracle-database-using-php
$message = $_POST['message'];
$subjectid = $_POST['subjectid'];
$useridCreator = $_POST['useridCreator'];
$username = $_POST['username'];

//If the form submitted, run the SQL statement
if (isset($_REQUEST["submitted"]))
{           
    $sql1 = "INSERT INTO Message (messageid, subjectid, userid, messageDate, body) VALUES ('$messageid', :subjectid, :useridCreator, SYSDATE, :message)";
    
    $sql_statement1 = oci_parse($conn, $sql1);

    //Sanitizing them to prevent sql injections
    oci_bind_by_name($sql_statement1, 'subjectid', $subjectid);
    oci_bind_by_name($sql_statement1, 'useridCreator', $useridCreator);
    oci_bind_by_name($sql_statement1, 'message', $message);

    oci_execute($sql_statement1);
    oci_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCUdent Books Message Sent</title>
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
    <div class="returnHome">
        <h1>Message Sent to <b><?php echo $username ?></b>!</h1>
        <form>
           <a href="inbox.php?username=<?php echo $_SESSION['username'] ?>" class="web_link">Back to Inbox</a>
        </form>
    </div>
</div>

<!-- Footer  -->
    <footer>
        <a href="/" class="footer_info">Help</a>
        <a href="/" class="footer_info">Contact Us</a>
        <a href="/" class="footer_info">FAQ</a>
    </footer>
</body>
</html>