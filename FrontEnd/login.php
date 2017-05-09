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
                $_SESSION['user'] = true; //Sets user login session as true
                $_SESSION['username'] = $username;   //Added by CC... important for ADD BOOK to get userid from userinfo
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
        header('Location: login.php');
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
    <div id="login_nav">
         <header id="logo">
            <div id="logo"><a href="homepage.php"><img alt="SCUdentBooks logo" src="images/logo.png"></a></div>
        </header>
    </div>

<!-- Container that holds Main and Side divs -->
<div id="container">
    <div class="form loginForm">
        <h1>Welcome back!</h1>
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
        <p><a href="join.php">Don't have an account? Register here!</a></p>
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
