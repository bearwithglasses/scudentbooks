<?php
include ("DBTablesFnc.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$input_bookid = $_POST['book_id'];
	$input_userid = $_POST['book_userid'];
	$input_title = $_POST['book_title'];
	$input_author = $_POST['book_author'];
	$input_edition = $_POST['book_edition'];
	$input_purpose = $_POST['book_purpose'];
	$input_price = $_POST['book_price'];
	$input_isbn = $_POST['book_isbn'];
	$input_major = $_POST['book_major'];
	$input_courseNo = $_POST['book_courseno'];
	$input_professor = $_POST['book_prof'];
	$input_postDate = $_POST['book_date'];
	$input_condition = $_POST['book_condition'];
	$input_status = $_POST['book_status'];
	
	//echo "I'm here " . $input_title . " </br>";
	//$mDate = date("m/d/y - H:i");
	//$mcode = getBookCount()+1;
	//echo $mcode;
	insertFormValues($input_bookid,$input_userid,$input_title,$input_author,$input_edition,
	$input_purpose,$input_price,$input_isbn,$input_major,$input_courseNo,$input_professor,
	$input_postDate,$input_condition,$input_status);
	
	header('Location: thanks.php');
}
?>