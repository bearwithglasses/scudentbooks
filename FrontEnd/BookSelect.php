
<?php 
include ("BookPostSqlFnc.php"); 
?>
<?php
      if (isset($_GET['selected']))
	  {
	    $SelBookid = $_GET['selected'];
	    //
	    $con = makeConnection();
		
	   //
	  	$sql = 'SELECT * FROM BOOKPOST WHERE bookid in (:mybookid)';
		$stid = oci_parse($con,$sql);
		oci_bind_by_name($stid, ':mybookid', $SelBookid);
		
		
		
		oci_execute($stid);
	    //
		//  THERE SHOULD BE ONLY ONE SELECTED ROW B/C BOOKID IS UNIQUE
		//
		while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS))
		{
		    $SellerID = $row['USERID'];
		    $BookTitle = $row['TITLE'];
			$BookAuthor = $row['AUTHOR'];
			$BookPrice = $row['PRICE'];
			$BookVersion = $row['EDITION'];
			$BookStatus = $row['STATUS'];
		}
		 // 
		 oci_free_statement($stid);
         oci_close($con);
		 //
		 //   Now get the book description...
		 //
		  $con = makeConnection();
		  $sql = 'SELECT * FROM BOOKDESCRIPTION WHERE bookid in (:mybookid)';
		  $stid = oci_parse($con,$sql);
		  oci_bind_by_name($stid, ':mybookid', $SelBookid);
		  oci_execute($stid);
	    //
		//  THERE SHOULD BE ONLY ONE SELECTED ROW B/C BOOKID IS UNIQUE 
		//
		while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS))
		{
		    $BookDescription = $row['DESCRIPTION'];
		}
		 // 
		 oci_free_statement($stid);
         oci_close($con);
		 //
		//
		//  now look for seller information
		//
		 $con = makeConnection();
		 $sql = 'SELECT * FROM USERINFO WHERE  userid in (:myuserid)';
	    //
	    
		$stid = oci_parse($con,$sql);
		oci_bind_by_name($stid, ':myuserid', $SellerID);
		oci_execute($stid);
	    //
		//  THERE SHOULD BE ONLY ONE SELECTED ROW B/C SELLERID IS UNIQUE in USERINFO Table
		//
		while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS))
		{
		    $SellerUsername = $row['USERNAME'];
			$SellerEmailAddress = $row['EMAILADDRESS'];
			$SellerLocation = $row['LOCATION'];
		}
		 //  
		 oci_free_statement($stid);
         oci_close($con);
		//$row['AUTHOR']->load()
		//
		echo ("Thank you for visiting our site"."<br>");
		echo ("<br>");
		echo ("Your have selected ".$BookTitle." by ".$BookAuthor->load(). "  Edition ".$BookVersion."<br>");
		echo ("Book price is ".$BookPrice."<br>");
		echo ("Book status is ".$BookStatus."<br>");
		if (!EMPTY($BookDescription))
		 echo ($BookDescription->load()."<br>"); 
		echo ("<br>");
		echo ($SellerUsername." is your book seller"."<br>");
		echo ("Send a message to  ".$SellerEmailAddress." to notify the seller "."<br>");
		echo ("Seller Location is  ".$SellerLocation."<br>");
	}
	?>
	
<!DOCTYPE html>
<html lang="en">
<head>
	<meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
	<meta content="text/javascript" http-equiv="Content-Script-Type" />
	<meta content="text/css" http-equiv="Content-Style-Type" />
	<title>Seller Contact Page </title>
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
<p class="refLink"><a href="searchpagetest.html">Return to Search Page</a></p>
</body>
</html>


	
	

