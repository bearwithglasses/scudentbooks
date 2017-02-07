<?php
include ("RegBooksFnc.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	//$input_comment = $_POST['mComment'];
	$input_deptName = $_POST['book_deptName'];
	$input_classNo = $_POST['book_classNo'];
	$input_title = $_POST['book_title'];
	$input_author = $_POST['book_author'];
	$input_edition = $_POST['book_edition'];
	$input_condition = $_POST['book_condition'];
	$input_price = $_POST['book_price'];
	$input_sellerName = $_POST['seller_name'];
	$input_email = $_POST['seller_email'];
	$input_phone = $_POST['seller_phone'];
	
	echo "I'm here " . $input_title . " </br>";
	//$mDate = date("m/d/y - H:i");
	//$mcode = getBookCount()+1;
	//echo $mcode;
	insertFormValues($input_deptName,$input_classNo,$input_title,$input_author,$input_edition,
	$input_condition,$input_price,$input_sellerName,$input_email,$input_phone);
	
	header('Location: thanks.php');
}
?>