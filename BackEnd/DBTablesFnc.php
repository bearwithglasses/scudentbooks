<?php
//
// 
//   
function makeConnection(){
	$db_host = "dbserver.engr.scu.edu/db11g";
	$db_user = "wchang";
	$db_pass = "winstonchang";
	$db_name = "STUDENTBOOKS";
	//Create connection
	$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

	// Check connection
	if (!$con) {
    		die("Connection failed: " . mysqli_connect_error());
	} 
	//echo "Connection made here.<br>";
	return $con;
}
//
//
function CreateDataBase()
{  
	$db_host = "dbserver.engr.scu.edu.db11g";
	$db_user = "wchang";
	$db_pass = "winstonchang";
	$db_name = "STUDENTBOOKS";
	$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
	
	// Check connection
	if ($con->connect_error) {
     die("Connection failed: " . $con->connect_error."<br>");
	} 
	
	// Create database scudentBooks
	$sql = "CREATE DATABASE ".$dbname;
	 if ($con->query($sql) === TRUE) {
      echo "scudentBooks Database created successfully <br>";
    } else {
       echo "Error creating scudentBooks database: " . $conn->error."<br>";
   }
	$con->close();			// CLOSE THE CONNECTION...
}
//
function closeConnection($con){
	if (!$con)
		mysqli_close($con);
}
//
//
//
	// 15 input variables for UserInfo_insertValues
	//
   function UserInfo_insertValues($m_username,$m_password,$m_firstName,$m_middleName,$m_lastName,$m_emailAddress,$m_phoneNumber,$m_major1,$m_major2,$m_major3,$m_minor1,$m_minor2,$m_minor3,$m_year,$m_location)
	{
			
	$conn = makeConnection();
	// REMEMBER .. 13 fields for BookEntry
	$sql = "INSERT INTO UserInfo (username,password,firstName,middleName,lastName,emailAddress,phoneNumber,major1,major2,major3,minor1,minor2,minor3,year,location)
		    VALUES ('$m_username','$m_password','$m_firstName','$m_middleName','$m_lastName','$m_emailAddress','$m_phoneNumber','$m_major1','$m_major2','$m_major3','$m_minor1','$m_minor2','$m_minor3','$m_year','$m_location')";
	
	
	if (mysqli_query($conn, $sql)) {
    echo "New record  for UserInfo table created successfully";
	} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

	closeConnection($con);
	}


	//
	// 13 input variables for BookPost_insertValues
	//
	function BookPost_insertValues($book_id,$book_userid,$book_title,$book_author,$book_edition,$book_purpose,$book_price,$book_isbn,$book_major,$book_courseNo,$book_prof,$book_date,$book_condition,$book_status)
	//$m_userid,$m_title,$m_author,$m_edition,$m_purpose,$m_price,$m_isbn,$m_major,$m_courseNumber,$m_professor,$m_postDate,$m_conditions,$m_status)
	{
			
		$con = makeConnection();
		/*$sql = "INSERT INTO BookPost (userid,title,author,edition,purpose,price,isbn,major,courseNumber,professor,postDate,conditions,status)
		    VALUES ('$m_userid','$m_title','$m_author','$m_edition','$m_purpose','$m_price','$m_isbn','$m_major','$m_courseNumber','$m_professor','$m_postDate','$m_conditions','$m_status')";
		    */
	
		if (mysqli_query($con, $sql)) {
		echo "New record  for BookPost table created successfully<br>";
		} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($con);
		}

		closeConnection($con);
	}	



?>