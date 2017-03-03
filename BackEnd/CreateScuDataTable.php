<?php

include ("DBTablesFnc.php");

//  create scudentBooks database 
//  call CreateDataBase in DBTablesFnc.php file
   CreateDataBase();			
//
//
//
// makeConnection is in DBTablesFnc.php file	
//call makeConnection to access scudentBooks databas.
//	
  $con = makeConnection();					
 //
 // User Info
   $sql = "CREATE TABLE UserInfo(
			userid int NOT NULL AUTO_INCREMENT,
			username varchar(50) NOT NULL UNIQUE,
			password varchar(50) NOT NULL,
			firstName varchar(50) NOT NULL,
			middleName varchar(50),
			lastName varchar(50) NOT NULL,
			emailAddress varchar(254) NOT NULL,
			phoneNumber int,
			major1 varchar(50) NOT NULL,
			major2 varchar(50),
			major3 varchar(50),
			minor1 varchar(50),
			minor2 varchar(50),
			minor3 varchar(50),
			year varchar(10),
			location varchar(50),
			CHECK (year in ('freshman','sophomore','junior','senior','graduate')),
			PRIMARY KEY(userid)
		);";
   

	if ($con->query($sql) == TRUE) {
		echo "UserInfo Table created successfully<br>";
	} else {
		echo "Error creating table: " . $con->error."<br>";
	}
	
	//
	// Book Post
	$sql = "CREATE TABLE BookPost(
			bookid int NOT NULL AUTO_INCREMENT,
			userid int NOT NULL,
			title varchar(100) NOT NULL,
			author text NOT NULL,
			edition smallint,
			purpose varchar(4) NOT NULL,
			price decimal(5,2),
			isbn int,
			major varchar(50),
			courseNumber smallint,
			professor varchar(50),
			postDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
			conditions varchar(5),
			status varchar(20) DEFAULT 'available' NOT NULL,
			CHECK (purpose in ('buy','swap')),
			CHECK (conditions in ('new','good','bad')),
			CHECK (status in ('available','sale pending','unavailable')),
			PRIMARY KEY(bookid),
			FOREIGN KEY(userid) REFERENCES UserInfo(userid)
		);";
		   
	 if ($con->query($sql) == TRUE) {
	    echo "BookPost Table created successfully<br>";
	 } else {
		echo "Error creating BookPost table: " . $con->error."<br>";
	}	   
   
   	//Book Description
   	$sql = "CREATE TABLE BookDescription(
			bookid int NOT NULL AUTO_INCREMENT,
			description text,
			FOREIGN KEY(bookid) REFERENCES BookPost(bookid)
		);";
		   
	 if ($con->query($sql) == TRUE) {
	    echo "BookDescription Table created successfully<br>";
	 } else {
		echo "Error creating table: " . $con->error."<br>";
	}
	
   	//Book Photo
 //  	$sql = "CREATE TABLE BookPhoto(
//			bookid int NOT NULL AUTO_INCREMENT,
//			photo1 image NOT NULL,
//			photo2 image,
//			photo3 image,
//			FOREIGN KEY(bookid) REFERENCES BookPost(bookid)
//		);";
		   
//	 if ($conn->query($sql) == TRUE) {
//	    echo "BookPhoto Table created successfully<br>";
//	 } else {
//		echo "Error creating BookPhoto table: " . $conn->error."<br>";
//	}
	
	//Email Message
	$sql = "CREATE TABLE Message(
			messageid int NOT NULL AUTO_INCREMENT,	
			creator int NOT NULL,
			recipient int NOT NULL,	
			subject varchar(100),
			body text,
		    postDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY(messageid),
			FOREIGN KEY(creator) REFERENCES UserInfo(userid),
			FOREIGN KEY(recipient) REFERENCES UserInfo(userid)
		);";
		   
	 if ($con->query($sql) == TRUE) {
	    echo "Message Table created successfully<br>";
	 } else {
		echo "Error creating Message table: " . $conn->error."<br>";
	}
	
	//Email Reply
	$sql = "CREATE TABLE MessageReply(
			replyid int NOT NULL AUTO_INCREMENT,
			replyUserid int NOT NULL,
			replyMessageid int NOT NULL,
			reply text,
			postDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY(replyid),
			FOREIGN KEY(replyUserid) REFERENCES UserInfo(userid),
			FOREIGN KEY(replyMessageid) REFERENCES Message(messageid)
		);";
		   
	 if ($con->query($sql) == TRUE) {
	    echo "MessageReply Table created successfully<br>";
	 } else {
		echo "Error creating MessageReply table: " . $conn->error."<br>";
	}
	
	closeConnection($con);			// closeConnection function in DBTablesFnc.php file


?> 