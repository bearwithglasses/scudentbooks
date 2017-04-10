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

$errorMessage = ""; //Initialize error message variable as empty value
//$username = $_GET["username"]; //Retrieves username from database
//$password = $_GET["password"]; //Retrieves password from database

// if ($_SERVER['REQUEST_METHOD'] == 'POST')
// {
//     if (!empty($_POST['username']) && !empty($_POST['password']))
//     {
//         $sql = "SELECT * FROM USERINFO WHERE USERNAME = '$username' AND PASSWORD = '$password'";
//         $sql_statement = oci_parse($conn, $sql);
//         oci_execute($sql_statement);
//         if (!empty($row['username'] && !empty($row['password'])))
//         {
//             $_SESSION['username'] = $row['PASSWORD'];
//             header('Location: homepage.php');
//         }
//         else
//         {
//             $errorMessage = "Login failed";
//         }
//     }
//     else
//     {
//         header('Location: loginpage.php');
//     }
// }

/*
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (!empty($_POST["username"]) AND !empty($_POST["password"]))
    {
        if ($_POST["username"] == "john123" AND $_POST["password"] == "apple456")
        {
            $_SESSION["user"] = true;
            header('Location: homepage.php');
        }
        else
        {
            $errorMessage = "Login failed";
        }
    }
    else
    {
        header('Location: loginpage.php');
    }
}
*/

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (!empty($_POST['username']) && !empty($_POST['password']))
    {
	$username = $_POST['username']; //Retrieves username from database
    	$password = $_POST['password']; //Retrieves password from database
	$sql = "SELECT * FROM USERINFO WHERE USERNAME = '$username' AND PASSWORD = '$password'";
        //$sql_statement = oci_parse($conn, $sql);
        //oci_execute($sql_statement);

	if ($sql_statement = oci_parse($conn, $sql))
	{
	    oci_execute($sql_statement);
	    if (oci_num_rows($sql_statement) == 1)
            {
                $_SESSION['user'] = true;
                header('Location: homepage.php');
            }
            else
            {
                $errorMessage = "Login failed";
            }
        }
	else
	{
	    $errorMessage = "Login incorrect";
	}
    }
    else
    {
        header('Location: loginpage.php');
    }
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
            <input type="text" id="inputUsername" placeholder="Username" name="username" required autofocus>
            <label for="inputPassword">Password</label>
            <input type="password" id="inputPassword" placeholder="Password" name="password" required>
            <button type="submit" id="loginButton" name="submit">Login</button>
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
