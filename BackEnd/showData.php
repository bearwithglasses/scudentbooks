<?php
ini_set('display_errors','On');
error_reporting(E_ALL);
$db_host = "dbserver.engr.scu.edu/db11g";
$db_user = "wchang";
$db_pass = "winstonchang";
$db_name = "STUDENTBOOKS";
$con = oci_connect($db_user, $db_pass, '//dbserver.engr.scu.edu/db11g');
// Check connection
$sql="SELECT * FROM USERINFO ORDER BY USERID";
$stid = oci_parse($con, $sql);
oci_execute($stid);

$sql2="SELECT * FROM BOOKPOST ORDER BY BOOKID";
$stid2 = oci_parse($con, $sql2);
oci_execute($stid2);

$sql3="SELECT * FROM BOOKDESCRIPTION ORDER BY BOOKID";
$stid3 = oci_parse($con, $sql3);
oci_execute($stid3);

$sql4="SELECT * FROM BOOKPICTURE ORDER BY BOOKID";
$stid4 = oci_parse($con, $sql4);
oci_execute($stid4);

?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCUdent Books Home Demo</title>
    <link rel="stylesheet" type="text/css" href="data.css" />
    <script src="https://use.fontawesome.com/29dce5faae.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
</head>

<div id="container">

<?php

	echo "<h1>USERINFO table</h1><p><table border='1'>
	<tr>
	<th>USERID</th>
	<th>USERNAME</th>
	<th>PASSWORD</th>
	<th>FIRSTNAME</th>
	<th>MIDDLENAME</th>
	<th>LASTNAME</th>
	<th>EMAILADDRESS</th>
	<th>PHONENUMBER</th>
	<th>MAJOR1</th>
	<th>MAJOR2</th>
	<th>MAJOR3</th>
	<th>MINOR1</th>
	<th>MINOR2</th>
	<th>MINOR3</th>
	<th>YEAR</th>
	<th>LOCATION</th>
	</tr>";

	while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS))
	{
	echo "<tr>";
	echo "<td>" . $row['USERID'] . "</td>";
	echo "<td>" . $row['USERNAME'] . "</td>";
	echo "<td>" . $row['PASSWORD'] . "</td>";
	echo "<td>" . $row['FIRSTNAME'] . "</td>";
	echo "<td>" . $row['MIDDLENAME'] . "</td>";
	echo "<td>" . $row['LASTNAME'] . "</td>";
	echo "<td>" . $row['EMAILADDRESS'] . "</td>";
	echo "<td>" . $row['PHONENUMBER'] . "</td>";
	echo "<td>" . $row['MAJOR1'] . "</td>";
	echo "<td>" . $row['MAJOR2'] . "</td>";
	echo "<td>" . $row['MAJOR3'] . "</td>";
	echo "<td>" . $row['MINOR1'] . "</td>";
	echo "<td>" . $row['MINOR2'] . "</td>";
	echo "<td>" . $row['MINOR3'] . "</td>";
	echo "<td>" . $row['YEAR'] . "</td>";
	echo "<td>" . $row['LOCATION'] . "</td>";
	echo "</tr>";
	}
	echo "</table>";


	echo "<h1>BOOKPOST table</h1><p><table border='1'>
	<tr>
	<th>BOOKID</th>
	<th>USERID</th>
	<th>TITLE</th>
	<th>AUTHOR</th>
	<th>EDITION</th>
	<th>PURPOSE</th>
	<th>PRICE</th>
	<th>ISBN</th>
	<th>MAJOR</th>
	<th>COURSENUMBER</th>
	<th>PROFESSOR</th>
	<th>POSTDATE</th>
	<th>CONDITION</th>
	<th>STATUS</th>
	</tr>";

	while($row = oci_fetch_array($stid2, OCI_ASSOC+OCI_RETURN_NULLS))
	{
	echo "<tr>";
	echo "<td>" . $row['BOOKID'] . "</td>";
	echo "<td>" . $row['USERID'] . "</td>";
	echo "<td>" . $row['TITLE'] . "</td>";
	echo "<td id='theclob'>" . $row['AUTHOR']->load(). "</td>";
	echo "<td>" . $row['EDITION'] . "</td>";
	echo "<td>" . $row['PURPOSE'] . "</td>";
	echo "<td>" . $row['PRICE'] . "</td>";
	echo "<td>" . $row['ISBN'] . "</td>";
	echo "<td>" . $row['MAJOR'] . "</td>";
	echo "<td>" . $row['COURSENUMBER'] . "</td>";
	echo "<td>" . $row['PROFESSOR'] . "</td>";
	echo "<td>" . $row['POSTDATE'] . "</td>";
	echo "<td>" . $row['CONDITION'] . "</td>";
	echo "<td>" . $row['STATUS'] . "</td>";
	echo "</tr>";
	}
	echo "</table>";


	echo "<h1>BOOKDESCRIPTION table</h1><p><table border='1'>
	<tr>
	<th>BOOKID</th>
	<th>DESCRIPTION</th>
	</tr>";

	while($row = oci_fetch_array($stid3, OCI_ASSOC+OCI_RETURN_NULLS))
	{

		if ($row['DESCRIPTION'] != NULL){
			$bookdesc = $row['DESCRIPTION']->load();
		}
		else{
			$bookdesc = "<i>NULL</i>";
		}

	echo "<tr>";
	echo "<td>" . $row['BOOKID'] . "</td>";
	echo "<td>" . $bookdesc ."</td>";
	echo "</tr>";
	}
	echo "</table>";

	echo "<h1>BOOKPICTURE table</h1><p><table border='1'>
	<tr>
	<th>BOOKID</th>
	<th>PIC1</th>
	<th>PIC2</th>
	<th>PIC3</th>
	</tr>";

	while($row = oci_fetch_array($stid4, OCI_ASSOC+OCI_RETURN_NULLS))
	{
		if ($row['PIC1'] != NULL){
			$pic1 = $row['PIC1']->load();
		}
		else{
			$pic1 = "<i>NULL</i>";
		}

		if ($row['PIC2'] != NULL){
			$pic2 = $row['PIC2']->load();
		}
		else{
			$pic2 = "<i>NULL</i>";
		}

		if ($row['PIC3'] != NULL){
			$pic3 = $row['PIC3']->load();
		}
		else{
			$pic3 = "<i>NULL</i>";
		}
		
	echo "<tr>";
	echo "<td>" . $row['BOOKID'] . "</td>";
	echo "<td>" . $pic1 . "</td>";
	echo "<td>" . $pic2 . "</td>";
	echo "<td>" . $pic3 . "</td>";
	echo "</tr>";
	}
	echo "</table>";

?>

</div>