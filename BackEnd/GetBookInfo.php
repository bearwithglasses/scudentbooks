<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registerBook";

// Create connection
$conn = new mysqli($servername, $username, $password);
 // Check connection
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error."<br>");
} 

// Create database
 $sql = "CREATE DATABASE ".$dbname;
 if ($conn->query($sql) === TRUE) {
    echo "Database created successfully <br>";
 } else {
    echo "Error creating database: " . $conn->error."<br>";
 }
	$conn->close();			// CLOSE THE CONNECTION...

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

 // Check connection
 if ($conn->connect_error) {
     die("Connection to database file failed: " . $conn->connect_error."<br>");
} 
 //
 //  seller name, book title, book author, edition, condition, price, department name, class number, email, phone, availability
   $sql = "CREATE TABLE BookForm ( 
           mDeptName VARCHAR(20),
           mClassNo NUMERIC(10), 
		   mTitle VARCHAR(100),
		   mAuthor VARCHAR(50),
		   mEdition NUMERIC(3),
		   mCondition VARCHAR(150),
		   mPrice NUMERIC(5),
		   mSellerName VARCHAR(50),
		   mEmail VARCHAR(50),
		   mPhone NUMERIC(10))";
   

	if ($conn->query($sql) === TRUE) {
		echo "BookForm Table created successfully<br>";
	} else {
		echo "Error creating table: " . $conn->error."<br>";
		}

$conn->close();

?> 