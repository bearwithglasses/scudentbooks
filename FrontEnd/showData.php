<?php
ini_set('display_errors','On');
error_reporting(E_ALL);
$db_host = "dbserver.engr.scu.edu/db11g";
$db_user = "wchang";
$db_pass = "winstonchang";
$db_name = "STUDENTBOOKS";
$con = oci_connect($db_user, $db_pass, '//dbserver.engr.scu.edu/db11g');
// Check connection
//UserInfo
$sql="SELECT * FROM USERINFO ORDER BY USERID";
$stid = oci_parse($con, $sql);
oci_execute($stid);

//BookPost
$sql2="SELECT * FROM BOOKPOST ORDER BY BOOKID";
$stid2 = oci_parse($con, $sql2);
oci_execute($stid2);

//BookDescription
$sql3="SELECT * FROM BOOKDESCRIPTION ORDER BY BOOKID";
$stid3 = oci_parse($con, $sql3);
oci_execute($stid3);

//BookPicture
$sql4="SELECT * FROM BOOKPICTURE ORDER BY BOOKID";
$stid4 = oci_parse($con, $sql4);
oci_execute($stid4);

//Subject
$sql5 = "SELECT * FROM SUBJECT ORDER BY SUBJECTID";
$stid5 = oci_parse($con, $sql5);
oci_execute($stid5);

//Message
$sql6 = "SELECT * FROM MESSAGE ORDER BY MESSAGEID";
$stid6 = oci_parse($con, $sql6);
oci_execute($stid6);

//Inbox
$sql7 = "SELECT * FROM INBOX ORDER BY SUBJECTID";
$stid7 = oci_parse($con, $sql7);
oci_execute($stid7);

//Sent
$sql8 = "SELECT * FROM SENT ORDER BY SUBJECTID";
$stid8 = oci_parse($con, $sql8);
oci_execute($stid8);

//Trash
$sql9 = "SELECT * FROM TRASH ORDER BY SUBJECTID";
$stid9 = oci_parse($con, $sql9);
oci_execute($stid9);
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCUdent Books Show Data</title>
    <link rel="stylesheet" type="text/css" href="data.css" />
    <script src="https://use.fontawesome.com/29dce5faae.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
</head>

<div id="container">

<?php

	//UserInfo
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

	//BookPost
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
	if (!EMPTY($row['PROFESSOR']))
	 echo "<td>" . $row['PROFESSOR']->load(). "</td>";
    else
	 echo "<td>"."  "."</td>";
	echo "<td>" . $row['POSTDATE'] . "</td>";
	echo "<td>" . $row['CONDITION'] . "</td>";
	echo "<td>" . $row['STATUS'] . "</td>";
	echo "</tr>";
	}
	echo "</table>";

	//BookDescription
	echo "<h1>BOOKDESCRIPTION table</h1><p><table border='1'>
	<tr>
	<th>BOOKID</th>
	<th>DESCRIPTION</th>
	</tr>";

	while($row = oci_fetch_array($stid3, OCI_ASSOC+OCI_RETURN_NULLS))
	{
	if (!EMPTY($row['DESCRIPTION'])) //Avoid crashing on empty description
	{
	 echo "<tr>";
	 echo "<td>" . $row['BOOKID'] . "</td>";
	 echo "<td>" . $row['DESCRIPTION']->load() . "</td>";
	 echo "</tr>";
	}
	}
	echo "</table>";
	
	//BookPicture
	echo "<h1>BOOK PICTURE table</h1><p><table border='1'>
	<tr>
	<th>BOOKID</th>
	<th>PIC1</th>
	<th>PIC2</th>
	<th>PIC3</th>
	</tr>";

	while($row = oci_fetch_array($stid4, OCI_ASSOC+OCI_RETURN_NULLS))
	{
	
	 echo "<tr>";
	 echo "<td>" . $row['BOOKID'] . "</td>";
	 echo "<td>" . $row['PIC1'] . "</td>";
	 echo "<td>" . $row['PIC2'] . "</td>";
	 echo "<td>" . $row['PIC3'] . "</td>";
	 echo "</tr>";
	}
	echo "</table>";

	//Subject
	echo "<h1>SUBJECT table</h1><p><table border='1'>
	<tr>
	<th>SUBJECTID</th>
	<th>SUBJECT</th>
	<th>SUBJECTDATE</th>
	<th>USERID1</th>
	<th>USERID2</th>
	</tr>";

	while($row = oci_fetch_array($stid5, OCI_ASSOC+OCI_RETURN_NULLS))
	{
		echo "<tr>";
		echo "<td>" . $row['SUBJECTID'] . "</td>";
		echo "<td id='theclob'>" . $row['SUBJECT']->load(). "</td>";
		echo "<td>" . $row['SUBJECTDATE'] . "</td>";
		echo "<td>" . $row['USERID1'] . "</td>";
		echo "<td>" . $row['USERID2'] . "</td>";
		echo "</tr>";
	}
	echo "</table>";

	//Message
	echo "<h1>MESSAGE table</h1><p><table border='1'>
	<tr>
	<th>MESSAGEID</th>
	<th>SUBJECTID</th>
	<th>USERID</th>
	<th>MESSAGEDATE</th>
	<th>BODY</th>
	</tr>";

	while($row = oci_fetch_array($stid6, OCI_ASSOC+OCI_RETURN_NULLS))
	{
		if (!EMPTY($row['BODY'])) //Avoid crashing on empty body
		{
	 		echo "<tr>";
	 		echo "<td>" . $row['MESSAGEID'] . "</td>";
			echo "<td>" . $row['SUBJECTID'] . "</td>";
			echo "<td>" . $row['USERID'] . "</td>";
			echo "<td>" . $row['MESSAGEDATE'] . "</td>";
	 		echo "<td>" . $row['BODY']->load() . "</td>";
	 		echo "</tr>";
		}
	}
	echo "</table>";

	//Inbox
	echo "<h1>INBOX table</h1><p><table border='1'>
	<tr>
	<th>SUBJECTID</th>
	</tr>";

	while($row = oci_fetch_array($stid7, OCI_ASSOC+OCI_RETURN_NULLS))
	{
		echo "<tr>";
		echo "<td>" . $row['SUBJECTID'] . "</td>";
		echo "</tr>";
	}
	echo "</table>";

	//Sent
	echo "<h1>SENT table</h1><p><table border='1'>
	<tr>
	<th>SUBJECTID</th>
	</tr>";

	while($row = oci_fetch_array($stid8, OCI_ASSOC+OCI_RETURN_NULLS))
	{
		echo "<tr>";
		echo "<td>" . $row['SUBJECTID'] . "</td>";
		echo "</tr>";
	}
	echo "</table>";

	//Trash
	echo "<h1>TRASH table</h1><p><table border='1'>
	<tr>
	<th>SUBJECTID</th>
	</tr>";

	while($row = oci_fetch_array($stid9, OCI_ASSOC+OCI_RETURN_NULLS))
	{
		echo "<tr>";
		echo "<td>" . $row['SUBJECTID'] . "</td>";
		echo "</tr>";
	}
	echo "</table>";
?>

</div>