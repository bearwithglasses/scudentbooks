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
            <div id="logo"><a href="homepage.php"><img alt="SCUdentBooks logo" src="images/logo.png"></a></div>
        </header>

        <div id="links">
            <form class="searchbar">
                <a href="searchpageColumn.php" class="advancedsearch">Search for Books</a>
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
                    echo "    <button onclick='myFunction()' id='userdropdown'>".$_SESSION['username']."</button>";
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
            <select id="deptNameIdx" name="book_major" size="11">
            	<option value="any" selected="selected">Any</option>
                <option value="ACTG" class="sc-BUS">Accounting (ACTG)</option>
                <option value="AERO" class="sc-UNV">Aerospace Studies (AERO)</option>
                <option value="AMTH" class="sc-EGR">Applied Mathematics (AMTH)</option>
                <option value="ANTH" class="sc-AS">Anthropology (ANTH)</option>
                <option value="ARAB" class="sc-AS">Arabic (ARAB)</option>
                <option value="ARTH" class="sc-AS">Art History (ARTH)</option>
                <option value="ARTS" class="sc-AS">Studio Art (ARTS)</option>
                <option value="ASCI" class="sc-AS">Arts &amp; Sciences (ASCI)</option>
                <option value="BIOE" class="sc-EGR">Bioengineering (BIOE)</option>
                <option value="BIOL" class="sc-AS">Biology (BIOL)</option>
                <option value="BUSN" class="sc-BUS">Business (BUSN)</option>
                <option value="CATE" class="sc-AS">Catechetics (CATE)</option>
                <option value="CENG" class="sc-EGR">Civil Engineering (CENG)</option>
                <option value="CHEM" class="sc-AS">Chemistry (CHEM)</option>
                <option value="CHIN" class="sc-AS">Chinese (CHIN)</option>
                <option value="CHST" class="sc-AS">Child Studies (CHST)</option>
                <option value="CLAS" class="sc-AS">Classics (CLAS)</option>
                <option value="COEN" class="sc-EGR">Computer Engineering (COEN)</option>
                <option value="COMM" class="sc-AS sc-UNV">Communication (COMM)</option>
                <option value="CPSY" class="sc-CPE">Counseling Psychology (CPSY)</option>
                <option value="CSCI" class="sc-AS">Computer Science (CSCI)</option>
                <option value="DANC" class="sc-AS">Dance (DANC)</option>
                <option value="ECON" class="sc-AS sc-BUS">Economics (ECON)</option>
                <option value="EDUC" class="sc-CPE">Education (EDUC)</option>
                <option value="ELEN" class="sc-EGR">Electrical Engineering (ELEN)</option>
                <option value="ELSJ" class="sc-UNV">Exp Lrn Social Justice (ELSJ)</option>
                <option value="EMBA" class="sc-BUS">Executive MBA (EMBA)</option>
                <option value="EMGT" class="sc-EGR">Engineering Management (EMGT)</option>
                <option value="ENGL" class="sc-AS">English (ENGL)</option>
                <option value="ENGR" class="sc-AS sc-EGR">Engineering (ENGR)</option>
                <option value="ENVS" class="sc-AS">Environ Studies &amp; Sciences (ENVS)</option>
                <option value="ETHN" class="sc-AS sc-UNV">Ethnic Studies (ETHN)</option>
                <option value="FNCE" class="sc-BUS">Finance (FNCE)</option>
                <option value="FREN" class="sc-AS">French &amp; Francophone Studies (FREN)</option>
                <option value="GERM" class="sc-AS">German Studies (GERM)</option>
                <option value="HIST" class="sc-AS">History (HIST)</option>
                <option value="HNRS" class="sc-UNV">Honors Program (HNRS)</option>
                <option value="IDIS" class="sc-BUS">Interdisciplinary (IDIS)</option>
                <option value="INTL" class="sc-UNV">International Programs (INTL)</option>
                <option value="ITAL" class="sc-AS">Italian Studies (ITAL)</option>
                <option value="JAPN" class="sc-AS">Japanese Studies (JAPN)</option>
                <option value="LANG" class="sc-AS">Language (LANG)</option>
                <option value="LAW" class="sc-LAW">Law (LAW)</option>
                <option value="LBST" class="sc-AS">Liberal Studies (LBST)</option>
                <option value="LEAD" class="sc-UNV">Lead Scholars Program (LEAD)</option>
                <option value="MATH" class="sc-AS">Mathematics (MATH)</option>
                <option value="MECH" class="sc-EGR">Mechanical Engineering (MECH)</option>
                <option value="MGMT" class="sc-BUS">Management (MGMT)</option>
                <option value="MILS" class="sc-UNV">Military Science (MILS)</option>
                <option value="MKTG" class="sc-AS sc-BUS sc-UNV">Marketing (MKTG)</option>
                <option value="MSIS" class="sc-BUS">MS Information Systems (MSIS)</option>
                <option value="MUSC" class="sc-AS">Music (MUSC)</option>
                <option value="NEUR" class="sc-AS">Neuroscience (NEUR)</option>
                <option value="OMIS" class="sc-BUS">Operations Mgmt &amp; Info Sys (OMIS)</option>
                <option value="PHIL" class="sc-AS">Philosophy (PHIL)</option>
                <option value="PHSC" class="sc-AS">Public Health Science (PHSC)</option>
                <option value="PHYS" class="sc-AS">Physics (PHYS)</option>
                <option value="PLIT" class="sc-AS">Pastoral Liturgy (PLIT)</option>
                <option value="PMIN" class="sc-AS">Pastoral Ministries (PMIN)</option>
                <option value="POLI" class="sc-AS">Political Science (POLI)</option>
                <option value="PSYC" class="sc-AS">Psychology (PSYC)</option>
                <option value="RELS" class="sc-AS">Religious Studies (RELS)</option>
                <option value="RSOC" class="sc-AS">Religion &amp; Society (RSOC)</option>
                <option value="SCTR" class="sc-AS">Scripture &amp; Tradition (SCTR)</option>
                <option value="SOCI" class="sc-AS">Sociology (SOCI)</option>
                <option value="SPAN" class="sc-AS">Spanish Studies (SPAN)</option>
                <option value="SPIR" class="sc-AS">Spirituality (SPIR)</option>
                <option value="TESP" class="sc-AS">Theology Ethics &amp; Spirituality (TESP)</option>
                <option value="THTR" class="sc-AS">Theatre (THTR)</option>
                <option value="UNIV" class="sc-UNV">University Programs (UNIV)</option>
                <option value="WGST" class="sc-AS">Women's and Gender Studies (WGST)</option>
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