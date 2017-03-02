<?php
session_start(); //Start the session before you write your HTML page 
ini_set('display_errors','On');
error_reporting(E_ALL);
$db_host = "dbserver.engr.scu.edu";
$db_user = "wchang";
$db_pass = "00000955018";
$db_name = "sdb_wchang";
$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

//Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql = "SELECT * FROM UserInfo";

$result = $con->query($sql);
if (!$result)
{
    die('Error: ' . mysqli_error($con));
}

$errorMessage = ""; //Initialize error message variable as empty value

$username = $_POST['username']; //Get username from UserInfo
$password = $_POST['password']; //Get password from UserInfo                 
$sqll = "SELECT * FROM UserInfo 
         WHERE username = '$username'
         AND password = '$password'"; //Select values from UserInfo  
$result = $con->query($sqll);

if (!$result)
{
    die('Error: ' . mysqli_error($con));
}
//Fetch the information from UserInfo
$row = mysqli_fetch_assoc($result);

//No match for username or password
if (!$row)
{
    echo "<span class='nomember'>There is no member with that member code.</span>";
}
?> 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCUdent Books Login</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
    <link rel="stylesheet" type="text/css" href="booksusers.css" />
    <script src="loginpage.js"></script>
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
    <div class="loginForm">
        <h1>Welcome to SCUdent Books!</h1>
        <form id="login" method="post">
            <label for="inputUsername">Username</label>
            <input type="text" id="inputUsername" placeholder="Username" required autofocus>
            <label for="inputPassword">Password</label>
            <input type="password" id="inputPassword" placeholder="Password" required>
            <button type="submit" id="loginButton">Login</button>
            <p id="loginError">
                <?php 
                    echo $errorMessage; //Prints error message
                ?>
            </p>
        </form>
        <a href="userregistrationpage.php">Don't have an account? Register here</a>
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