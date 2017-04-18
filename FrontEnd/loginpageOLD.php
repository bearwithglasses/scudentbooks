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

$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (!empty($_POST['username']) && !empty($_POST['password'])){

        $username = $_POST['username']; //Retrieves username from form
        $password = $_POST['password']; //Retrieves password from form

        //Search for the USERID that matches username and password
        $sql = "SELECT USERID FROM USERINFO WHERE USERNAME = '$username' AND PASSWORD = '$password'";
        $sql_statement = oci_parse($conn, $sql);
        oci_execute($sql_statement);
        $row = oci_fetch_array($sql_statement, OCI_ASSOC+OCI_RETURN_NULLS);

        //Count the number of rows in the SQL statment
        //If the password and username match, then there will be 1 row
        //If they both don't match, then there will be 0 row
        $count = oci_num_rows($sql_statement);
        if ($count == 1)
            {
                $_SESSION['user'] = true;
                //$errorMessage = "Correct Login.";
                header('Location: homepage.php');
                //$errorMessage = "Login Success<br>Username ".$username."<br>Password: ".$password.$id;

            }
            else
            {
                //$errorMessage = "Login Fail<br>Username ".$username."<br>Password: ".$password."<br>".$count;
                $errorMessage = "Incorrect Login.";
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
    <div class="loginForm form">
        <h1>Welcome to SCUdent Books!</h1>
    <form id="login" method="post">
            <ul>
            <li>
                <label for="inputUsername">Username</label>
                <input type="text" id="inputUsername" placeholder="Username" name="username" required autofocus>
            </li>
            <li>
                <label for="inputPassword">Password</label>
                <input type="password" id="inputPassword" placeholder="Password" name="password" required>
            </li>
            <li>
                <p id="loginError">
                    <?php 
                        echo $errorMessage; //Prints error message if login incorrect
                    ?>
                </p>
            </li>
            </ul>
            <button type="submit" id="loginButton" name="submit">Login</button>
        </form>
        <p><a href="userregistrationpage.php">Don't have an account? Register here</a></p>
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
