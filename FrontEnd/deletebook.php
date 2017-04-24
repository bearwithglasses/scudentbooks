<?php
ini_set('display_errors','On');
error_reporting(E_ALL);
$db_host = "dbserver.engr.scu.edu/db11g";
$db_user = "wchang";
$db_pass = "winstonchang";
$db_name = "STUDENTBOOKS";
//
$con = oci_connect($db_user, $db_pass, '//dbserver.engr.scu.edu/db11g');
//
$bookid = $_GET['id'];
// delete entry from BOOKPICTURE FIRST
//
$sql="DELETE FROM BOOKPICTURE WHERE BOOKID=$bookid";
$stid = oci_parse($con, $sql);
oci_execute($stid);
oci_free_statement($stid);
oci_close($con);
//
//  delete entry from BOOKDESCRIPTION SECOND
//
$con = oci_connect($db_user, $db_pass, '//dbserver.engr.scu.edu/db11g');
$sql="DELETE FROM BookDescription WHERE BOOKID=$bookid";
$stid = oci_parse($con, $sql);
oci_execute($stid);
oci_free_statement($stid);
oci_close($con);
//
//  delete entry from BOOKPOST LAST
//  NOTE .. you will get ORA-02292: integrity constraint (WCHANG.SYS_C00444989) violated - child record 
//  error if you do not delete in this order
//
$con = oci_connect($db_user, $db_pass, '//dbserver.engr.scu.edu/db11g');
$sql="DELETE FROM BookPost WHERE BOOKID=$bookid";
$stid = oci_parse($con, $sql);
oci_execute($stid);
oci_free_statement($stid);
oci_close($con);
//echo "Delete book entry ".$bookid."   ShowData to show new table"."br>";


header("Location: yourbooks.php");

?>