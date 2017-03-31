<?php
include ("BookPostSqlFnc.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //
	//$input_userid = $_POST['book_userid'];
	// input_userid is hardcoded for testing
	//remember to ask winston to set the userid info in the GLOBAL $_SESSION after a valid login 
	//  For example"
    //	
	// if (isset( $_SESSION['user_id']))
	//    $input_userid = $_SESSION['user_id'];
	//   else
	//    echo "problem.. UserAcct is empty </br>";
    //	
	//
	
	$input_userid = 3;		//hardcoded for testing
	$input_title = $_POST['book_title'];
	//echo ("title: " . $input_title . "<br>");
	$input_author = $_POST['book_author'];
	//echo ("author: " . $input_author . "<br>");
	$input_edition = $_POST['book_edition'];
	//echo ("edition: " . $input_edition . "<br>");
	$input_purpose = $_POST['book_purpose'];
	//echo ("purpose: " . $input_purpose . "<br>");
	$input_price = $_POST['book_price'];
	// echo ("price: " . $input_price . "<br>");
	$input_isbn = $_POST['book_isbn'];
	//echo ("isbn: " . $input_isbn . "<br>");
	$input_major = $_POST['book_major'];
	//echo ("deptname: " . $input_major . "<br>");
	$input_courseNo = $_POST['book_courseNo'];
	//echo ("courseNo: " . $input_courseNo . "<br>");
	$input_professor = $_POST['book_prof'];
	//echo ("professor: " . $input_professor . "<br>");
	//
	//  input_postDate is not needed here.. 
	//  BookPost_insertValues call will set the date
	//
	//$input_postDate = date("m/d/y - H:i");
	//echo ("postDate: " . $input_postDate . "<br>");
	$input_condition = $_POST['book_condition'];
	//echo ("condition: " . $input_condition . "<br>");
	$input_status = "available";
	//echo ("status: " . $input_status . "<br>");
	$input_desc = $_POST['book_message'];

	BookPost_insertValues($input_userid,$input_title,$input_author,$input_edition,
	$input_purpose,$input_price,$input_isbn,$input_major,$input_courseNo,$input_professor,
	$input_condition,$input_status,$input_desc);
	
	header('Location: thanks.php');
}
?>