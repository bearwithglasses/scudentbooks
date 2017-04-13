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

if(!isset($_SESSION["user"])){
    //header('Location: login.php');
    //die();
    $_SESSION["user"] = false;
}

//Referenced code for generating random 5 digit alphanumeric string: http://stackoverflow.com/questions/48124/generating-pseudorandom-alpha-numeric-strings
$available = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
$userid = '';
$max = strlen($available) - 1;
for ($i = 0; $i < 5; $i++)
{
    $userid .= $available[mt_rand(0, $max)];
}

//Referenced code for inserting values into sql table and sanitizing them to prevent sql injections:
//http://stackoverflow.com/questions/2119145/inserting-data-in-oracle-database-using-php
$username = $_POST['username'];
$password = $_POST['password'];
$firstName = $_POST['firstName'];
$middleName = $_POST['middleName'];
$lastName = $_POST['lastName'];
$emailAddress = $_POST['emailAddress'];
$phoneNumber = $_POST['phoneNumber'];
$major1 = $_POST['major1'];
$major2 = $_POST['major2'];
$major3 = $_POST['major3'];
$minor1 = $_POST['minor1'];
$minor2 = $_POST['minor2'];
$minor3 = $_POST['minor3'];
$year = $_POST['year'];
$location = $_POST['location'];

//If the form submitted, run the SQL statement
if(isset($_REQUEST["submitted"])) {

$sql = "INSERT INTO UserInfo (userid, username, password, firstName, middleName, lastName, emailAddress, phoneNumber, major1, major2, major3, minor1, minor2, minor3, year, location) VALUES('$userid', :username, :password, :firstName, :middleName, :lastName, :emailAddress, :phoneNumber, :major1, :major2, :major3, :minor1, :minor2, :minor3, :year, :location)";

$sql_statement = oci_parse($conn, $sql);

//Sanitizing them to prevent sql injections
oci_bind_by_name($sql_statement, 'username', $username);
oci_bind_by_name($sql_statement, 'password', $password);
oci_bind_by_name($sql_statement, 'firstName', $firstName);
oci_bind_by_name($sql_statement, 'middleName', $middleName);
oci_bind_by_name($sql_statement, 'lastName', $lastName);
oci_bind_by_name($sql_statement, 'emailAddress', $emailAddress);
oci_bind_by_name($sql_statement, 'phoneNumber', $phoneNumber);
oci_bind_by_name($sql_statement, 'major1', $major1);
oci_bind_by_name($sql_statement, 'major2', $major2);
oci_bind_by_name($sql_statement, 'major3', $major3);
oci_bind_by_name($sql_statement, 'minor1', $minor1);
oci_bind_by_name($sql_statement, 'minor2', $minor2);
oci_bind_by_name($sql_statement, 'minor3', $minor3);
oci_bind_by_name($sql_statement, 'year', $year);
oci_bind_by_name($sql_statement, 'location', $location);

oci_execute($sql_statement);
oci_close($conn);

}

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
                <li>
                <!-- Shows user navigation if logged in. Otherwise, shows a 'log in' button -->
                <?php
                if($_SESSION["user"] == true){

                    echo '<span id="usernav">';
                    echo '    <button onclick="myFunction()" id="userdropdown">You</button>';
                    echo '      <div id="userlinks" class="dropdownnav">';
                    echo '        <a href="#">Your Profile</a>';
                    echo '        <a href="#">Manage Books</a>';
                    echo '        <a href="#">Settings</a>';
                    echo '        <a href="logout.php">Log Out</a>';
                    echo '</span>';
                }
                else{
                    echo '<li><a href="join.php" class="web_link registerlink">Register</a></li>';
                    echo '<li><a href="login.php" class="web_link loginlink">Log In</a></li>';
                }
                ?>
                </li>
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
        <h1>Thank you for registering!</h1>
        <p><a href="login.php" class="advancedsearch">Login Now</a></p>
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