<?php
//
// 
//   
function makeConnection(){
	$db_host = "dbserver.engr.scu.edu/db11g";
	$db_user = "wchang";
	$db_pass = "winstonchang";
	$db_name = "STUDENTBOOKS";
	$con = oci_connect($db_user, $db_pass, '//dbserver.engr.scu.edu/db11g');

	// Check connection
	if (!$con) {
	 $e = oci_error();
     trigger_error(htmlentities($e['message'].ENT_QUOTES),E_USER_ERROR);
	} 
//	echo "Connection made here.<br>";
	return $con;
}
//
function GetMaxBookidOLD()
{
		$con = makeConnection();
		//
		// look for the highest existing bookid in BOOKPOST
		//
		$sql2 = "SELECT Max(bookid) As MAXNUM FROM BOOKPOST";
		$stid = oci_parse($con,$sql2);
		oci_execute($stid);
		oci_fetch($stid);
		$m_bookid = oci_result($stid, "MAXNUM");
		oci_free_statement($stid);
        oci_close($con);
		return ($m_bookid);
		//
}	
//

function GetMaxBookid()
{
		$con = makeConnection();
		//
		// look for the highest existing bookid in BOOKPOST
		//
		//$sql2 = "SELECT MAX('bookid') FROM BOOKPOST";
		$sql2 = "SELECT * FROM BOOKPOST";
		$stid = oci_parse($con,$sql2);
		oci_execute($stid);
	
	    $max_bookid = 0;
		//
		// LOOP around to find the highest bookid
		// CANNOT get  "SELECT MAX(BOOKID) FROM BOOKPOST" to work 
		//
		while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS))
		{
		   $m_bookidNew = $row['BOOKID'];
		   if ($max_bookid < $m_bookidNew)
		    $max_bookid = $m_bookidNew;
        }
		 //  NOW $m_booid  has the highest bookid value
		 oci_free_statement($stid);
         oci_close($con);
		 return ($max_bookid);
		 //
}	

function GetUserID($username)
{
	     $con = makeConnection();
	
		$sql2 = "SELECT * FROM USERINFO";
		$stid = oci_parse($con,$sql2);
		oci_execute($stid);
	
		//
		// loop around USERINFO to find a match for username (unique)??? 
		//
		while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS))
		{
		   $m_userid = $row['USERID'];
		   $m_username = $row['USERNAME'];
		   if ($m_username ==  $username)
		     break;	   
		}
		 //  
		 oci_free_statement($stid);
         oci_close($con);
		 return ($m_userid);
	
	
}

//

//
/*				4-7-17  definition
CREATE TABLE BookPost(
	bookid varchar(5) NOT NULL,
	userid varchar(5) NOT NULL,
	title nvarchar2(100) NOT NULL,
	author clob NOT NULL,
	edition int,
	purpose varchar(4) NOT NULL,
	price decimal(5,2),
	isbn int,
	major varchar(50),
	courseNumber varchar(20),
	professor clob,
	postDate date DEFAULT NULL,
	condition nvarchar2(20),
	status varchar(20) DEFAULT 'available' NOT NULL,
	CHECK (purpose in ('sell','swap')),
	CHECK (condition in ('new','used - good','used - acceptable')),
	CHECK (status in ('available','sale pending','unavailable')),
	PRIMARY KEY(bookid),
	FOREIGN KEY(userid) REFERENCES UserInfo
) TABLESPACE STUDENTBOOKS;

--Book post description
CREATE TABLE BookDescription(
	bookid varchar(5) NOT NULL,
	description clob,
	FOREIGN KEY(bookid) REFERENCES BookPost
) TABLESPACE STUDENTBOOKS;
*/

//
function BookPost_insertValues($m_userid,$m_title,$m_author,$m_edition,$m_purpose,$m_price,$m_isbn,$m_major,$m_courseNumber,$m_professor,
                               $m_condition,$m_status,$m_description)
	{
		
	
		$m_bookid = GetMaxBookid();		//GetMaxBookid will return the hightest existing bookid value in BookPost table
		// inc $m_bookid by 1 .. this is the value to create the next book entry!!!
		//echo("after GetMaxBookid()....".$m_bookid."<br>");
		$m_bookid = $m_bookid + 1;
	    settype($m_bookid, 'string');			//convert to string
		//settype($m_userid, 'string');			//convert to string
		//
		$con = makeConnection();
		
		// REMEMBER .. 14 fields for BOOKPOST
		$sql = oci_parse($con, "INSERT INTO BOOKPOST (bookid,userid,title,author,edition,purpose,price,isbn,major,courseNumber,professor,postDate,condition,status)
		    VALUES ( :mybookid,
					 :myuserid,
			         :mytitle,
					 :myauthor,
					 :myedition,
					 :mypurpose,
					 :myprice,
					 :myisbn,
					 :mymajor,
					 :mycourseNumber,
					 :myprofessor,
					 :mypostDate,
					 :mycondition,
					 :mystatus)");
		//	RETURN bookid INTO :mybookid");
		//	$m_bookid = 13;		 
			//oci_bind_by_name($sql,'mybookid',$m_bookid,-1, SQLT_INT);
			//oci_bind_by_name($sql,'myuserid',$m_userid,-1, SQLT_INT);
						
			
			//var_dump($m_bookid); 
			//var_dump($m_userid); 
			oci_bind_by_name($sql,'mybookid',$m_bookid,5, SQLT_CHR);
			oci_bind_by_name($sql,'myuserid',$m_userid,5, SQLT_CHR);
			
			oci_bind_by_name($sql,'mytitle',$m_title,100,SQLT_CHR);
			//echo ("mytitle:" . $m_title . "<br>");
			
			oci_bind_by_name($sql,'myauthor',$m_author,100,SQLT_CHR);
			//echo ("myauthor:" . $m_author . "<br>");
									
			oci_bind_by_name($sql,'myedition',$m_edition,-1, SQLT_INT);
			//echo ("myedition:" . $m_edition . "<br>");
			
			oci_bind_by_name($sql,'mypurpose',$m_purpose,4,SQLT_CHR);
			//echo ("mypurpose:" . $m_purpose . "<br>");
			
			oci_bind_by_name($sql,'myprice',$m_price);
			//echo ("myprice:" . $m_price . "<br>");
					
			oci_bind_by_name($sql,'myisbn',$m_isbn,-1, SQLT_INT);
			//echo ("myisbn:" . $m_isbn . "<br>");
			
			oci_bind_by_name($sql,'mymajor',$m_major,50,SQLT_CHR);
			//echo ("mymajor:" . $m_major . "<br>");
			
			oci_bind_by_name($sql,'mycourseNumber',$m_courseNumber,20,SQLT_CHR);
			//echo ("mycourseNumber:" . $m_courseNumber . "<br>");
			
			oci_bind_by_name($sql,'myprofessor',$m_professor,50,SQLT_CHR);
			//echo ("myprofessor:" . $m_professor . "<br>");
			
			$m_postDate = date("d-M-y");
			oci_bind_by_name($sql,'mypostDate',$m_postDate,24);
		    //echo ("date:" . $m_postDate . "<br>");
			
			oci_bind_by_name($sql,'mycondition',$m_condition,20,SQLT_CHR);
		 	//echo ("condition:" . $m_condition ."<br>");
		 
			oci_bind_by_name($sql,'mystatus',$m_status,20,SQLT_CHR);
		    //echo ("status:" . $m_status . "<br>");
			
			oci_execute($sql);
			
		    oci_close($con);
		// 
		//  NOW add the description to the BookDescription Table
		//  if m_description is NOT AN EMPTY STRING
		//s
		if (!EMPTY($m_description))
		{
		$con = makeConnection();
		
		$sql = oci_parse($con, "INSERT INTO BookDescription (bookid,description) VALUES ( :mybookid,:mydescrption)");
		oci_bind_by_name($sql,'mybookid',$m_bookid,5, SQLT_CHR);     //same bookid from INSERT
		oci_bind_by_name($sql,'mydescrption',$m_description,-1,SQLT_CHR);
		oci_execute($sql);
		oci_close($con);
		}
		return ($m_bookid);
		 
	}	
	
	function BookPost_insertPictureNames($m_bookid,$m_ImageFileName1,$m_ImageFileName2,$m_ImageFileName3)
	{
		
		 $con = makeConnection();
		 $sql = oci_parse($con, "INSERT INTO BookPicture (bookid,pic1,pic2,pic3) VALUES ( :mybookid,:mypic1,:mypic2,:mypic3)");
		 oci_bind_by_name($sql,'mybookid',$m_bookid,5, SQLT_CHR);     //same bookid from INSERT
		 oci_bind_by_name($sql,'mypic1',$m_ImageFileName1,-1,SQLT_CHR);
		 oci_bind_by_name($sql,'mypic2',$m_ImageFileName2,-1,SQLT_CHR);
		 oci_bind_by_name($sql,'mypic3',$m_ImageFileName3,-1,SQLT_CHR);
		 oci_execute($sql);
		 oci_close($con);
		
	}

?>