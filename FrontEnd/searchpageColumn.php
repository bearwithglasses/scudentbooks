<?php
session_start();
ini_set('display_errors','on');
error_reporting(E_ALL);
include ("BookPostSqlFnc.php");
include ("showSearch.php");
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCUdent Books - Search</title>
    <script src="main.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="main.css" />
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
</head>

<body>

<!-- Navigation -->
    <div id="web_nav">
        <header id="logo">
            <div id="logo"><a href="homepage.html"><img alt="eCampus logo" src="images/eCampusLogo.png"></a></div>
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
                <!-- Shows user navigation if logged in. Otherwise, shows a 'log in' button -->
                <?php
                if($_SESSION["user"] == true){
                echo '<li><a href="homepage.php" class="web_link">Home</a></li>';
                echo '<li><a href="addbook.php" class="web_link">Sell</a></li>';
                echo "<li><a href='inbox.php?username=".$_SESSION['username']."' class='web_link'>Inbox</a></li>";
                echo '<li>';
                    echo '<span id="usernav">';
                    echo '    <button onclick="myFunction()" id="userdropdown">You</button>';
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

<div id="searchpage" class="form">
<h1>Search</h1>
<!--
<form id="edit_info" action="searchfunctions.php" method="post"> -->
<form id="edit_info" action="<?php echo ($_SERVER["PHP_SELF"]);?>" method="post">
    <ul>
        <li>
             <label>Title: </label><input type="text" name="book_title">
        </li>
        <li>
            <label>Author: </label><input type="text" name="book_author">
        </li>
        <li>
            <label>Edition: </label><input type="text" name="book_edition">
        </li>
        <li>
            <label>Department: </label>
            <select id="deptNameIdx" name="book_major">
            	<option value="any" selected="selected">Any</option>
                <option value="ARTS">ARTS</option>
                <option value="CHIN">CHIN</option>
                <option value="COEN">COEN</option>
                <option value="CORN">CORN</option>
                <option value="ENGL">ENGL</option>
                <option value="HIST">HIST</option>
                <option value="ITAL">ITAL</option>
                <option value="JAPN">JAPN</option>
                <option value="PKMN">PKMN</option>
                <option value="Other">Other</option>
            </select>
        </li>
        <li>
            <label>Course Number: </label><input type="text" name="book_courseno">
        </li>
    </ul>
    <ul>
    <!--
        <li>
                <label>Location: </label>
                -->
                <!--location isn't part of the table yet/is part of a different table-->
    <!--
            <select id="deptNameIdx" name="book_location">
                <option value="OnC" selected="selected">On-Campus</option>
                <option value="RLC">Residential Learning Communities</option>
                <option value="UV">University Villas</option><option value="NU">Neighborhood Units</option>
                <option value="OffC">Off-Campus</option>
            </select>
        </li>
        <li>
            <label>Date Posted: </label>
            <select id="condIdx" name="book_condition">
                <option value="New" selected="selected">Newest to Oldest</option>
                <option value="Used">Oldest to Newest</option>
            </select>
        </li>
    -->
        <li>
        <label>Purpose: </label>
                <input type="radio" name="book_purpose" value="any" checked>Any</input>
                <input type="radio" name="book_purpose" value="sell">Sell</input>
                <input type="radio" name="book_purpose" value="swap">Swap</input>
        </li>
        <li>
            <label>Price: </label>
            <select id="condIdx" name="book_price">
                <option value="any" selected="selected">Any Price</option>
                <option value="0">Under $25</option>
                <option value="1">$25 to $50</option>
                <option value="2">$50 to $100</option>
                <option value="3">Over $100</option>
            </select>
        </li>
        <li>
            <label>Condition: </label>
            <select id="condIdx" name="book_condition">
            		<option value="any" selected="selected">Any</option>
                    <option value="new">New</option>
                    <option value="used - good">Used - Good</option>
                    <option value="used - acceptable">Used - Acceptable</option>
            </select>
        </li>
    </ul>

<button id="searchButton" input type="submit" value="Search" />Search</button>

</form>
</div>
<div class="booklist searchlist">
<h1>Results</h1>
<ul>
<?php 
    ShowSearchResults();
?>
</ul>
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