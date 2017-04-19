<?php
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

//Referenced code for generating random 5 digit alphanumeric string: http://stackoverflow.com/questions/48124/generating-pseudorandom-alpha-numeric-strings
$available = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
$conversationid = '';
$subjectid = '';
$messageid = '';
$max = strlen($available) - 1;
for ($i = 0; $i < 5; $i++)
{
    $subjectid .= $available[mt_rand(0, $max)];
    $messageid .= $available[mt_rand(0, $max)];
}

//Referenced code for inserting values into sql table and sanitizing them to prevent sql injections:
//http://stackoverflow.com/questions/2119145/inserting-data-in-oracle-database-using-php
$book_title = $_POST['book_title'];
$message = $_POST['message'];

//If the form submitted, run the SQL statement
if(isset($_REQUEST["submitted"]))
{
    
    $sql2 = "INSERT INTO Subject (subjectid, conversationid, subject, subjectDate) VALUES ('$subjectid', '$conversationid', :book_title, SYSDATE)";
    $sql3 = "INSERT INTO Message (messageid, conversationid, subjectid, userid, messageDate, body) VALUES ('$messageid', '$conversationid', '$subjectid', '$userid', SYSDATE, :message)";
    
    $sql_statement1 = oci_parse($conn, $sql1);
    $sql_statement2 = oci_parse($conn, $sql2);
    $sql_statement3 = oci_parse($conn, $sql3);
    
    //Sanitizing them to prevent sql injections
    oci_bind_by_name($sql_statement2, 'book_title', $book_title);
    oci_bind_by_name($sql_statement3, 'message', $message);

    oci_execute($sql_statement1);
    oci_execute($sql_statement2);
    oci_execute($sql_statement3);
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
            <input type="button" id="returnProfileButton" onclick="window.location.href='profile.php';" value="Back to Profile">
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