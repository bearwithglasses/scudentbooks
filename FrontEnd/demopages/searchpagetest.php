<?php
include ("BookPostSqlFnc.php");
session_start();
ini_set('display_errors','on');
error_reporting(E_ALL);
?>

<?php

function ShowSearchResults()
 {
    $con = makeConnection();
	$sql="SELECT * FROM BOOKPOST ORDER BY BOOKID";
	$stid = oci_parse($con, $sql);
	oci_execute($stid);
	
	
	
     while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS))
	{
		// BOOKID info is embedded here for bookselect.php
		//
			
		   $hrefMessage = "href=\"BookSelect.php?selected=" . $row['BOOKID'] . "\">";
		   $BookTitle = $row['TITLE'];
		   $BookAuthor = $row['AUTHOR']->load();		//clob type
		   $DatePosted = $row['POSTDATE'];
		   $BookStatus = $row['STATUS'];
		   echo "<li>";
		   echo "<div class='listpic pic'><a href='/'><img src='images/500px.png'></a></div>";
		   echo "<div class='listtitle1'><a ".$hrefMessage.$BookTitle."</a></div>";
		   echo "<div class='bookinfo'>";
				echo $BookAuthor;
				echo "<br>".$DatePosted;
				echo "</div>";
		   echo  "<div class='buybutton pending'>".$BookStatus."</div>";
		   echo "</li>";
		}

	
		
	oci_close($con);
}
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
                <option value="ARTS" selected="selected">ARTS</option>
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
                <input type="radio" name="book_purpose" value="any" checked>Any
                <input type="radio" name="book_purpose" value="sell">Sell
                <input type="radio" name="book_purpose" value="swap">Swap
        </li>
        <li>
            <label>Price: </label>
            <select id="condIdx" name="book_price">
                <option value="Any" selected="selected">Any Price</option>
                <option value="Low">Under $25</option>
                <option value="Med">$25 to $50</option>
                <option value="High">$50 to $100</option>
                <option value="RICHAF">Over $100</option>
            </select>
        </li>
        <li>
            <label>Condition: </label>
            <select id="condIdx" name="book_condition">
                    <option value="New" selected="selected">New</option>
                    <option value="Good">Good</option>
                    <option value="Poor">Poor</option>
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