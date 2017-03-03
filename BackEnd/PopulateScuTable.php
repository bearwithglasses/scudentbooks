

<?php
include ("DBTablesFnc.php");
	
	
	function PopulateBookPost()
	{
	 echo "PopulateBookPost is called ... </br>";
	  $m_userid = 1;				//addbook entry is from stinerbeaner(m_userid = 1)
	  $m_title = "ORAS";
	  $m_author = "OmegaRuby AlphaSapphire";
	  $m_edition = "1";
	  $m_purpose = "buy";
	  $m_price = "85.73";
	  $m_isbn ="0851310419";
	  $m_major = "PKMN";
	  $m_courseNumber = "3";
	  $m_professor = "Birch";
	  $m_postDate = date("Y-m-d H:i:s");
	  echo "m_postDate = ".$m_postDate."<br>";
	  $m_conditions = "good";
	  $m_status = "available";
	  BookPost_insertValues($m_userid,$m_title,$m_author,$m_edition,$m_purpose,$m_price,$m_isbn,$m_major,$m_courseNumber,$m_professor,$m_postDate,$m_conditions,$m_status); 
	  $m_userid = 1;				//addbook entry is from stinerbeaner(m_userid = 1)
	  $m_title = "Intro to Chinese";
	  $m_author = "WBR";
	  $m_edition = "2";
	  $m_purpose = "buy";
	  $m_price = "78.90";
	  $m_isbn ="0851310418";
	  $m_major = "CHIN";
	  $m_courseNumber = "1";
	  $m_professor = "Qian";
	  $m_postDate = date("Y-m-d H:i:s"); 
	  $m_conditions = "good";
	  $m_status = "available";
	  BookPost_insertValues($m_userid,$m_title,$m_author,$m_edition,$m_purpose,$m_price,$m_isbn,$m_major,$m_courseNumber,$m_professor,$m_postDate,$m_conditions,$m_status); 
	  $m_userid = 2;				//addbook entry is from bears(m_userid = 2)
	  $m_title = "Sun and Moon";
	  $m_author = "SuMo";
	  $m_edition = "7";
	  $m_purpose = "buy";
	  $m_price = "70.00";
	  $m_isbn ="0851310410";
	  $m_major = "PKMN";
	  $m_courseNumber = "7";
	  $m_professor = "Kukui";
	  $m_postDate = date("Y-m-d H:i:s"); 
	  $m_conditions = "good";
	  $m_status = "available";
	  BookPost_insertValues($m_userid,$m_title,$m_author,$m_edition,$m_purpose,$m_price,$m_isbn,$m_major,$m_courseNumber,$m_professor,$m_postDate,$m_conditions,$m_status); 
	  $m_userid = 3;			//addbook entry is from  bees(m_userid = 3)
	  $m_title = "Bee Movie Script";
	  $m_author = "idkwhatthenameis";
	  $m_edition = "1";
	  $m_purpose = "buy";
	  $m_price = "600.00";
	  $m_isbn ="0851310410";
	  $m_major = "HIST";
	  $m_courseNumber = "14";
	  $m_professor = "Dr. Chang";
	  $m_postDate = date("Y-m-d H:i:s"); 
	  $m_conditions = "good";
	  $m_status = "available";
	  BookPost_insertValues($m_userid,$m_title,$m_author,$m_edition,$m_purpose,$m_price,$m_isbn,$m_major,$m_courseNumber,$m_professor,$m_postDate,$m_conditions,$m_status); 
	  $m_userid = 3;			//addbook entry is from bees(m_userid = 3)
	  $m_title = "Abstract Data Structures and Stuff";
	  $m_author = "";
	  $m_edition = "2";
	  $m_purpose = "buy";
	  $m_price = "5.00";
	  $m_isbn ="0851310410";
	  $m_major = "COEN";
	  $m_courseNumber = "12";
	  $m_professor = "Atkikitkson";
	  $m_postDate = date("Y-m-d H:i:s"); 
	  $m_conditions = "good";
	  $m_status = "available";
	  BookPost_insertValues($m_userid,$m_title,$m_author,$m_edition,$m_purpose,$m_price,$m_isbn,$m_major,$m_courseNumber,$m_professor,$m_postDate,$m_conditions,$m_status); 
	}
	
	
	function PopulateUserAcct()
	{
	$blank ="";
	$m_username = "stinerbeaner";
	$m_password = "beans";
	$m_firstName = "Christina";
	$m_middleName = "";
	$m_lastName = "Ciardella";
	$m_emailAddress = "email@email.com";
	$m_phoneNumber = "6192221234";
	$m_major1 = "Web Design";
	$m_major2 = "";
	$m_major3 = "";
	$m_minor1 = "";
	$m_minor2 = "";
	$m_minor3 = "";
	$m_year = "Senior";
	$m_location = "On Campus";
	UserInfo_insertValues($m_username,$m_password,$m_firstName,$m_middleName,$m_lastName,$m_emailAddress,$m_phoneNumber,$m_major1,$m_major2,$m_major3,$m_minor1,$m_minor2,$m_minor3,$m_year,$m_location);
	$m_username = "bears";
	$m_password = "omg";
	$m_firstName = "Renee";
	$m_middleName = "";
	$m_lastName = "Prescilla";
	$m_emailAddress = "email@email.com";
	$m_phoneNumber = "6194441234";
	$m_major1 = "Web Design";
	$m_major2 = $blank;
	$m_year = "Senior";
	$m_location = "Off Campus";
	UserInfo_insertValues($m_username,$m_password,$m_firstName,$m_middleName,$m_lastName,$m_emailAddress,$m_phoneNumber,$m_major1,$m_major2,$m_major3,$m_minor1,$m_minor2,$m_minor3,$m_year,$m_location);
    $m_username = "bees";
	$m_password = "buzz";
	$m_firstName = "Winston";
	$m_middleName = "";
	$m_lastName = "Chang";
	$m_emailAddress = "email@email.com";
	$m_phoneNumber = "6195551234";
	$m_major1 = "COEN";
	$m_major2 = $blank;
	$m_year = "Senior";
	$m_location = "Off Campus";
	UserInfo_insertValues($m_username,$m_password,$m_firstName,$m_middleName,$m_lastName,$m_emailAddress,$m_phoneNumber,$m_major1,$m_major2,$m_major3,$m_minor1,$m_minor2,$m_minor3,$m_year,$m_location);
	}	
?>

<?php
   echo "Populate UserInfo TABLE in scudatabase </br>";
   PopulateUserAcct();
   echo "Populate BookPost TABLE in  scudatabase </br>";
   PopulateBookPost();
?> 
