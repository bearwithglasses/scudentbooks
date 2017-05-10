<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCUdent Books - Add Books</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
    <link rel="stylesheet" type="text/css" href="booksusers.css" />
    <script src="sendmessage.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
	<meta content="text/javascript" http-equiv="Content-Script-Type" />
	<meta content="text/css" http-equiv="Content-Style-Type" />
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

<!--

NEW DEFINITION-- 4/6/17

CREATE TABLE BookPost(
	bookid varchar(5) NOT NULL,
	userid varchar(5) NOT NULL,
	title nvarchar2(100) NOT NULL,
	author clob NOT NULL,
	edition int,
	purpose varchar(4) NOT NULL,
	price decimal(5,2),
	isbn int,
	major varchar(50),
	courseNumber varchar(20),
	professor clob,
	postDate date DEFAULT NULL,
	condition nvarchar2(20),
	status varchar(20) DEFAULT 'available' NOT NULL,
	CHECK (purpose in ('sell','swap')),
	CHECK (condition in ('new','used - good','used - acceptable')),
	CHECK (status in ('available','sale pending','unavailable')),
	PRIMARY KEY(bookid),
	FOREIGN KEY(userid) REFERENCES UserInfo
) TABLESPACE STUDENTBOOKS;

--Book post description
CREATE TABLE BookDescription(
	bookid varchar(5) NOT NULL,
	description clob,
	FOREIGN KEY(bookid) REFERENCES BookPost
) TABLESPACE STUDENTBOOKS;

-->
<h1>Add a Book</h1>
<div id="regBox">
<fieldset>
<legend>Book Form</legend>
<p id="directions">Enter your book information in the fields marked with an asterisk (*) below.</br>
<form id="edit_info" action="ProcessBook.php" method="post" enctype="multipart/form-data" onsubmit="return checkform(this);">
    <div class="form">    
        <h3>Book Information</h3>     
        <br>
        <ul>
            <li><label>Title*: </label><input type="text" name="book_title"></li>
            <li><label>Author*: </label><input type="text" name="book_author"></li>
            <li><label>Edition: </label><input type="text" name="book_edition"></li>
            <li><label>Purpose*: </label>
 				<div id="radio">
 				<input type="radio" name="book_purpose" value="sell" checked>sell<br>
 				<input type="radio" name="book_purpose" value="swap">swap<br>
 				</div>
 			</li>
 			<li><label>Price*: </label><input type="text" name="book_price"></li>
            <li><label>ISBN: </label><input type="text" name="book_isbn"></li>
            <li><label>Department Name: </label>
                <select id="deptNameIdx" name="book_major" size="11">
                    <option value="ACTG" class="sc-BUS" selected="selected">Accounting (ACTG)</option>
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
            <li><label>Course Number: </label><input type="text" name="book_courseNo"></li>
            <li><label>Professor: </label><input type="text" name="book_prof"></li>
            <li><label>Condition: </label>
            	<div id="radio">
  					<input type="radio" name="book_condition" value="new" checked>new<br>
  					<input type="radio" name="book_condition" value="used - good">used - good<br>
  					<input type="radio" name="book_condition" value="used - acceptable">used - acceptable<br>
  				</div>
  			</li>
            <li><label>Description: </label><textarea id="messagebox" name="book_message" placeholder="Write additional notes about the book here."></textarea></li>
        </ul>
        <h4>Book Images</h4>
        <ul>
            <li><input type="file" name="fileToUpload1" id="fileToUpload"></li>
			<li><input type="file" name="fileToUpload2" id="fileToUpload"></li>
			<li><input type="file" name="fileToUpload3" id="fileToUpload"></li>
        </ul>
        <br>
        <div>
        <button id="addButton" input type="submit" value="Add" />Add</button>
        </div>
		<div id="divError"></div>

	</form>
</fieldset>
</div>
</br>
   </body>
</html>

<script language="javascript" type="text/javascript">
function checkform(pform1){
	//alert ("checkform is called 1");
	var title = pform1.book_title.value;
	var author = pform1.book_author.value;
	var purpose = pform1.book_purpose.value;
	var price = pform1.book_price.value;
	var condition = pform1.book_condition.value;
	//optional entries
	var edition = pform1.book_edition.value;
	var isbn = pform1.book_isbn.value;
	var deptName = pform1.book_major.value;
	var courseNo = pform1.book_courseNo.value;
	var professor = pform1.book_prof.value;
	var description = pform1.book_message.value;
	
	var err={}; 
	var errorFlag=0;
	//alert ("checkform is called 2 " + deptName);
	//check required fields
	//check department name
	//var e = document.getElementById(deptNameIdx);
	/*var e = pform1.book_deptName;
	var deptName = e.options[e.selectedIndex].text;
	if (deptName.length <= 0){
		err.message="Please fill in a Department Name.\n"; 
		err.field=pform1.book_deptName; 
		errorFlag=1;
	}*/
	
	//check title
	if ((title.length<=0) && (errorFlag==0)){
		//alert ("at title" + title);
		err.message="Title not given.\n"
		err.field=pform1.book_title;
		errorFlag=1;
	}
	
	//check author
	if ((author.length<=0) && (errorFlag==0)){
		err.message="Author not entered.\n"
		err.field=pform1.book_author;
		errorFlag=1;
	}
	
	//check price
	if ((price.length<=0) && (errorFlag==0)){
		err.message="Asking Price not given.\n"
		err.field=pform1.book_price;
		errorFlag=1;
	}
	
	//check edition
	/*if ((edition.length<=0) && (errorFlag==0)){
		err.message="Edition not entered.\n"
		err.field=pform1.book_edition;
		errorFlag=1;
	}
	*/

	//alert ("alert3 " + errorFlag + " " + err.message);
	if(err.message) 
	{ 
		//alert ("alert for error" + err.message);
    	document.getElementById('divError').innerHTML = err.message;
    	err.field.focus();
    	return false;        
	} 
	//alert("no error value"); 
	return true;
}
</script>

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
