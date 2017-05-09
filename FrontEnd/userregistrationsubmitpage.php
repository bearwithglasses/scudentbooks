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
    print "Connection successful<br>";
}
else
{
    print "Connection failed<br>";
    exit;
}

//Referenced code for generating random 5 digit alphanumeric string: http://stackoverflow.com/questions/48124/generating-pseudorandom-alpha-numeric-strings
$available = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
$userid = '';
$max = strlen($available) - 1;
for ($i = 0; $i < 5; $i++)
{
    $userid .= $available[mt_rand(0, $max)];
}

//Referenced code for inserting values into sql table and sanitizing them to prevent sql injections: http://stackoverflow.com/questions/2119145/inserting-data-in-oracle-database-using-php
// $username = $_POST['username'];
// $password = $_POST['password'];
// $firstName = $_POST['firstName'];
// $middleName = $_POST['middleName'];
// $lastName = $_POST['lastName'];
// $emailAddress = $_POST['emailAddress'];
// $phoneNumber = $_POST['phoneNumber'];
// $major1 = $_POST['major1'];
// $major2 = $_POST['major2'];
// $major3 = $_POST['major3'];
// $minor1 = $_POST['minor1'];
// $minor2 = $_POST['minor2'];
// $minor3 = $_POST['minor3'];
// $year = $_POST['year'];
// $location = $_POST['location'];

$sql = "INSERT INTO UserInfo VALUES($userid, '$_POST[username]', '$_POST[password]', '$_POST[firstName]', '$_POST[middleName]', '$_POST[lastName]', '$_POST[emailAddress]', $_POST[phoneNumber], '$_POST[major1]', '$_POST[major2]', '$_POST[major3]', '$_POST[minor1]', '$_POST[minor2]', '$_POST[minor3]', '$_POST[year]', '$_POST[location]')";

//$sql = 'INSERT INTO UserInfo (userid, username, password, firstName, middleName, lastName, emailAddress, phoneNumber, major1, major2, major3, minor1, minor2, minor3, year, location) VALUES($userid, :username, :password, :firstName, :middleName, :lastName, :emailAddress, :phoneNumber, :major1, :major2, :major3, :minor1, :minor2, :minor3, :year, :location)';

$sql_statement = oci_parse($conn, $sql);

//Sanitizes user input values
// oci_bind_by_name($sql_statement, ':username', $username);
// oci_bind_by_name($sql_statement, ':password', $password);
// oci_bind_by_name($sql_statement, ':firstName', $firstName);
// oci_bind_by_name($sql_statement, ':middleName', $middleName);
// oci_bind_by_name($sql_statement, ':lastName', $lastName);
// oci_bind_by_name($sql_statement, ':emailAddress', $emailAddress);
// oci_bind_by_name($sql_statement, ':phoneNumber', $phoneNumber);
// oci_bind_by_name($sql_statement, ':major1', $major1);
// oci_bind_by_name($sql_statement, ':major2', $major2);
// oci_bind_by_name($sql_statement, ':major3', $major3);
// oci_bind_by_name($sql_statement, ':minor1', $minor1);
// oci_bind_by_name($sql_statement, ':minor2', $minor2);
// oci_bind_by_name($sql_statement, ':minor3', $minor3);
// oci_bind_by_name($sql_statement, ':year', $year);
// oci_bind_by_name($sql_statement, ':location', $location);

oci_execute($sql_statement);
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
        <header id="logo">
            <div id="logo"><a href="homepage.php"><img alt="SCUdentBooks logo" src="images/logo.png"></a></div>
        </header>

        <div id="links">
            <form class="searchbar">
                <a href="searchpageColumn.php" class="advancedsearch">Search for Books</a>
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
            <input type="button" id="returnHomeButton" onclick="window.location.href='homepage.php';" value="Back to Home Page">
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
