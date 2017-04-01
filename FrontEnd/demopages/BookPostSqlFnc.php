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


function GetMaxBookid()
{
		$con = makeConnection();
		//
		// look for the highest existing bookid in BOOKPOST
		//
		//$sql2 = "SELECT MAX(BOOKID) FROM BOOKPOST";
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
//
function BookPost_insertValues($m_userid,$m_title,$m_author,$m_edition,$m_purpose,$m_price,$m_isbn,$m_major,$m_courseNumber,$m_professor,
                               $m_condition,$m_status,$m_description)
	{
		
	
		$m_bookid = GetMaxBookid();		//GetMaxBookid will return the hightest existing bookid value in BookPost table
		// inc $m_bookid by 1 .. this is the value to create the next book entry!!!
		$m_bookid = $m_bookid + 1;
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
			oci_bind_by_name($sql,'mybookid',$m_bookid,-1, SQLT_INT);
			oci_bind_by_name($sql,'myuserid',$m_userid,-1, SQLT_INT);
			oci_bind_by_name($sql,'mytitle',$m_title,100,SQLT_CHR);
			oci_bind_by_name($sql,'myauthor',$m_author,-1,SQLT_CHR);
			oci_bind_by_name($sql,'myedition',$m_edition,-1, SQLT_INT);
			oci_bind_by_name($sql,'mypurpose',$m_purpose,4,SQLT_CHR);
		  //  echo ("purpose:" . $m_purpose . "<br>");
			oci_bind_by_name($sql,'myprice',$m_price);
			oci_bind_by_name($sql,'myisbn',$m_isbn,-1, SQLT_INT);
			
			oci_bind_by_name($sql,'mymajor',$m_major,50,SQLT_CHR);
			oci_bind_by_name($sql,'mycourseNumber',$m_courseNumber,-1,SQLT_INT);
			oci_bind_by_name($sql,'myprofessor',$m_professor,50,SQLT_CHR);
			$m_postDate = date("d-M-y");
			oci_bind_by_name($sql,'mypostDate',$m_postDate,24);
		//    echo ("date:" . $m_postDate . "<br>");
			oci_bind_by_name($sql,'mycondition',$m_condition,5,SQLT_CHR);
		 //	echo ("condition:" . $m_condition . "<br>");
			oci_bind_by_name($sql,'mystatus',$m_status,20,SQLT_CHR);
		 //	echo ("status:" . $m_status . "<br>");
			oci_execute($sql);
		//	print $m_bookid;
		   oci_close($con);
		// 
		//  NOW add the description to the BookDescription Table
		//
		$con = makeConnection();
		
		$sql = oci_parse($con, "INSERT INTO BookDescription (bookid,description) VALUES ( :mybookid,:mydescrption)");
		oci_bind_by_name($sql,'mybookid',$m_bookid,-1, SQLT_INT);     //same bookid from INSERT
		oci_bind_by_name($sql,'mydescrption',$m_description,-1,SQLT_CHR);
		oci_execute($sql);
		oci_close($con);
	}	

?>