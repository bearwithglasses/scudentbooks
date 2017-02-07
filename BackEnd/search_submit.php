<?php
	include ("RegBooksFnc.php");
	//if(isset($_POST['submit']))
	{
		$title = $_POST['book_title'];
		$deptName = $_POST['book_deptName'];
		searchForBooks($title,$deptName);
	}
	//else
	//echo "<p>Please enter at least one keyword.\n</p>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
	<meta content="text/javascript" http-equiv="Content-Script-Type" />
	<meta content="text/css" http-equiv="Content-Style-Type" />
	<title>Search Results</title>
    <style>
    	body {
			background-color: #f5eee0;
			font-family: Verdana, sans-serif;
		}
    	h1 {
    		text-align: center;
    		font-family: Verdana, sans-serif;
    		color: #748566;
    	}
    	table, th, tr, td {
    		border: 1px solid black;
    		border-collapse: collapse;
    	}
    	th, tr, td {
    		padding: 5px;
    		text-align: center;
    		font: .9em, Arial;
    	}
    	table tr:nth-child(even) {
    		background-color: #e0f5ee;
		}
		table tr:nth-child(odd) {
 		  	background-color:#fff;
		}
		table th {
    		background-color: black;
    		color: white;
		}
		.refLink {
    		text-align: center;
    	}
    </style>
</head>
<body>
<p class="refLink"><a href="searchBooks.html">Return to Search Page</a></p>
</body>
</html>

