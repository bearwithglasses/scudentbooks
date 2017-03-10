<?php
ini_set('display_errors','On');
error_reporting(E_ALL);
$db_host = "dbserver.engr.scu.edu";
$db_user = "wchang";
$db_pass = "00000955018";
$db_name = "sdb_wchang";
$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
/* Check connection */
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$userid = mt_rand();

$sql="INSERT INTO UserInfo VALUES($userid, '$_POST[username]', '$_POST[password]', '$_POST[firstName]', 
                                  '$_POST[middleName]', '$_POST[lastName]', '$_POST[emailAddress]', 
                                  $_POST[phoneNumber], '$_POST[major1]', '$_POST[major2]', '$_POST[major3]',
                                  '$_POST[minor1]', '$_POST[minor2]', '$_POST[minor3]', '$_POST[year]', '$_POST[location]'
                                  )";

$result = $con->query($sql);
if (!$result)
{
    die('Error: ' . mysqli_error($con));
}
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCUdent Books User Registration Complete</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
    <link rel="stylesheet" type="text/css" href="booksusers.css" />
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
</head>

<body>
<!-- Navigation -->
    <div class="web_nav">
        <header class="logo">
            <div id="logo"><a href="homepage.html"><img alt="eCampus logo" src="images/eCampusLogo.png"></a></div>
        </header>

        <form class="searchbar">
            <span class="searchicon"><i></i></span>
            <input type="text" name="search" placeholder="Search...">
            <input type="button" class="button" value="Search">
            <a href="/" class="advancedsearch">Advanced</a>
        </form>

        <nav>
        <ul class="navlinks">
            <li><a href="/" class="web_link">Home</a></li>
            <li><a href="#" class="web_link">Sell</a></li>
            <li><a href="#" class="web_link">Inbox</a></li>
            <li><!--<div class="username_dropdown">
                <button onclick="userNameMenu()" class="usernamebutton">You</button></div>-->
            <a href="#" class="web_link">You</a>
            </li>
        </nav>
    </div>

<!-- Container that holds Main and Side divs -->
<div id="container">
    <div class="returnHome">
        <h1>Thank you for registering!</h1>
        <form>
            <input type="button" id="returnHomeButton" onclick="window.location.href='homepage.html';" value="Back to Home Page">
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