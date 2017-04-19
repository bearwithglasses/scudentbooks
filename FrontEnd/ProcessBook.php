<?php

session_start();			//need this otherwise you cannot access $_SESSION array..
ini_set('display_errors','On');
include ("BookPostSqlFnc.php");

function UploadImageFile1()
{
 $target_dir = "bookimages/";
 $target_file = $target_dir . basename($_FILES["fileToUpload1"]["name"]);
 $uploadOk = 1;
 $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    if (move_uploaded_file($_FILES["fileToUpload1"]["tmp_name"], $target_file)) 
	 {
		    $uploadOk = 1;
//          echo "The file ".$target_file."has been uploaded"."<br>";
      }else {
//			echo "Sorry, an error uploading your file"."<br>";
			$uploadOk = 0;
	 }

     return ($uploadOk);
}
//
function UploadImageFile2()
{
 $target_dir = "bookimages/";
 $target_file = $target_dir . basename($_FILES["fileToUpload2"]["name"]);
 $uploadOk = 1;
 $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
//echo "target_dir:  ".$target_dir."<br>";
//echo "target_file: ".$target_file."<br>";
//echo "imageFileType:  ".$imageFileType."<br>";
//echo "source_file: ".$_FILES["fileToUpload2"]["tmp_name"]."<br>";
    if (move_uploaded_file($_FILES["fileToUpload2"]["tmp_name"], $target_file)) 
	 {
		    $uploadOk = 1;
//          echo "The file ".$target_file."has been uploaded"."<br>";
      }else {
//			echo "Sorry, an error uploading your file"."<br>";
			$uploadOk = 0;
	 }

     return ($uploadOk);
}
//
function UploadImageFile3()
{
 $target_dir = "bookimages/";
 $target_file = $target_dir . basename($_FILES["fileToUpload3"]["name"]);
 $uploadOk = 1;
 $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
//echo "target_dir:  ".$target_dir."<br>";
//echo "target_file: ".$target_file."<br>";
//echo "imageFileType:  ".$imageFileType."<br>";
//echo "source_file: ".$_FILES["fileToUpload3"]["tmp_name"]."<br>";
    if (move_uploaded_file($_FILES["fileToUpload3"]["tmp_name"], $target_file)) 
	 {
		    $uploadOk = 1;
//          echo "The file ".$target_file."has been uploaded"."<br>";
      }else {
//			echo "Sorry, an error uploading your file"."<br>";
			$uploadOk = 0;
	 }

     return ($uploadOk);
}
//
//


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //
	//$input_userid = $_POST['book_userid'];
	// input_userid is hardcoded for testing
	//remember to ask winston to set the userid info in the GLOBAL $_SESSION after a valid login 
	//  For example"
    //	
	// if (isset( $_SESSION['user_id']))
	//    $input_userid = $_SESSION['user_id'];
	//   else
	//    echo "problem.. UserAcct is empty </br>";
    //	
	//
	$bValid = false;
	
	if ($_SESSION['user'])
	{
		$myUserName = $_SESSION['username'];
		
		$input_userid = GetUserID($myUserName);			// this function is in BookPostSqlFnc.php
		//echo ("username is ".$_SESSION['username']." userid is ".$input_userid."<br>");
	    //$input_userid = $_SESSION['userid'];
		$bValid = true;
	}
	else
	{
      echo ("failed to get input_userid"."<br>");
    }

 
 if ($bValid )
	 {		
	//$input_userid = 3;		//hardcoded for testing
	$input_title = $_POST['book_title'];
	//echo ("title: " . $input_title . "<br>");
	$input_author = $_POST['book_author'];
	//echo ("author: " . $input_author . "<br>");
	$input_edition = $_POST['book_edition'];
	//echo ("edition: " . $input_edition . "<br>");
	$input_purpose = $_POST['book_purpose'];
	//echo ("purpose: " . $input_purpose . "<br>");
	$input_price = $_POST['book_price'];
	// echo ("price: " . $input_price . "<br>");
	$input_isbn = $_POST['book_isbn'];
	//echo ("isbn: " . $input_isbn . "<br>");
	$input_major = $_POST['book_major'];
	//echo ("deptname: " . $input_major . "<br>");
	$input_courseNo = $_POST['book_courseNo'];
	//echo ("courseNo: " . $input_courseNo . "<br>");
	$input_professor = $_POST['book_prof'];
	//echo ("professor: " . $input_professor . "<br>");
	//
	//  input_postDate is not needed here.. 
	//  BookPost_insertValues call will set the date
	//
	//$input_postDate = date("m/d/y - H:i");
	//echo ("postDate: " . $input_postDate . "<br>");
	$input_condition = $_POST['book_condition'];
	//echo ("condition: " . $input_condition . "<br>");
	$input_status = "available";
	//echo ("status: " . $input_status . "<br>");
	$input_desc = $_POST['book_message'];
	//
	$ImageName1 = basename($_FILES["fileToUpload1"]["name"]);
	
	//echo "image name is: ".$ImageName1."<br>";
	$uploadFlag= 0;
    if (!empty($ImageName1))
	{	
     $uploadFlag = UploadImageFile1();
	}
	if ($uploadFlag == 0)
	  $ImageName1 = "blank1.png";  
	//
	$ImageName2 = basename($_FILES["fileToUpload2"]["name"]);
	
	//echo "image name is: ".$ImageName2."<br>";
	$uploadFlag = 0;
    if (!empty($ImageName2))
	{	
     $uploadFlag = UploadImageFile2();
	}
	if ($uploadFlag == 0)
	  $ImageName2 = "blank2.png";
  
	$ImageName3 = basename($_FILES["fileToUpload3"]["name"]);
	
	//echo "image name is: ".$ImageName3."<br>";
	$uploadFlag3 = 0;
    if (!empty($ImageName2))
	{	
     $uploadFlag3 = UploadImageFile3();
	}
	if ($uploadFlag == 0)
	  $ImageName3 = "blank3.png";
	//
	BookPost_insertValues($input_userid,$input_title,$input_author,$input_edition,
	$input_purpose,$input_price,$input_isbn,$input_major,$input_courseNo,$input_professor,
	$input_condition,$input_status,$input_desc,
	$ImageName1,$ImageName2,$ImageName3);
	//
	
	
    $bookimage1 = "src=\"bookimages/".$ImageName1."\"";
	$bookimage2 = "src=\"bookimages/".$ImageName2."\"";
	$bookimage3 = "src=\"bookimages/".$ImageName3."\"";	
	
   }
	//header('Location: thanks.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCUdent Books Book Listing Demo</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
    <link rel="stylesheet" type="text/css" href="booksusers.css" />
    <script src="popups-photos.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
</head>

<body>

<!-- Navigation -->
    <div id="web_nav">
        <header id="logo">
            <div id="logo"><a href="homepage.php"><img alt="eCampus logo" src="images/eCampusLogo.png"></a></div>
        </header>

        <div id="links">
            <form class="searchbar">
                <span class="searchicon"><i></i></span>
                <input type="text" name="search" placeholder="Search...">
                <input type="button" class="button" value="Search">
                <a href="/" class="advancedsearch">Advanced</a>
            </form>

            <nav>
            <ul class="navlinks" id="mainNav">
                <li><a href="#" class="web_link">Home</a></li>
                <li><a href="#" class="web_link">Sell</a></li>
                <li><a href="#" class="web_link">Inbox</a></li>
                <li><a href="#" class="web_link">You</a></li>
            </ul>
            </nav>
        </div>

        <div class="icon">
            <a href="javascript:void(0);" style="font-size:15px;" onclick="myFunction()">☰</a>
        </div>
    </div>


<!-- Container that holds Main and Side divs -->
<div id="container">

<div id="listing">
    <div class="listingimage">
    <div id="mainimage">
        <div class="listpic pic bookpic" id="img1"><img <?php echo $bookimage1 ?> onclick="openImage(this)"></div>
        <div class="listpic pic bookpic" id="img2"><img <?php echo $bookimage2 ?> onclick="openImage(this)"></div>
        <div class="listpic pic bookpic" id="img3"><img <?php echo $bookimage3 ?> onclick="openImage(this)"></div>
    </div>

        <div class="bookphotonav">
            <div class="bookthumbnail">
              <img class="opacity opacity-off" <?php echo $bookimage1 ?> style="width:100%" onclick="currentDiv(1)">
            </div>
            <div class="bookthumbnail">
              <img class="opacity opacity-off" <?php echo $bookimage2 ?> style="width:100%" onclick="currentDiv(2)">
            </div>
            <div class="bookthumbnail">
              <img class="opacity opacity-off" <?php echo $bookimage3 ?> style="width:100%" onclick="currentDiv(3)">
            </div>
          </div>
    </div>


    <div class="listinginfo">
	<?php
	    $description = $_POST['book_message'];
		$bookedition = $_POST['book_edition'];
        if ($bookedition == ""){
            $bookedition = "N/A";
        };
		$bookstatus = "available";
		$purpose = $_POST['book_purpose'];
        if($bookstatus == "available" && $purpose == "sell"){
            $bookstatus = "buy";
            $bookstatusText = "$".$_POST['book_price'];
            $disable = "";
            $bstyle = "messagebutton";
        }
        if($bookstatus== "available" && $purpose == "swap"){
            $bookstatus = "swap";
            $bookstatusText = "For Swap";
            $disable = "";
            $bstyle = "messagebutton";
        }
         $username = $_SESSION['username'];

        echo "<h1>".$_POST['book_title']."</h1>";
        echo "<div class='listingstatus ".$bookstatus."'>".$bookstatusText."</div>";
        echo "<div class='listinginfotext'>";
        echo "    <p><b>Seller: </b> <a href='profile.php?username=".$username."'>".$username."</a></p>";
        echo "    <p><b>Edition: </b>".$bookedition."</p>";
		echo "    <p><b>Author: </b>".$_POST['book_author']."</p>";
        echo "    <p><b>ISBN: </b>".$_POST['book_isbn']."</p>";
        echo "    <p><b>Course Number: </b>".$_POST['book_courseNo']."</p>";
        echo "    <p><b>Condition: </b>".$_POST['book_condition']."</p>";
		$postDate = date("d-M-y");
        echo "    <p><b>Posted: </b>".$postDate."</p>";
        echo "</div>";

        echo "<div class='listingdescription'>";
        echo $description;
        echo "</div>";
        

    ?>
</div>


<!-- Footer  -->
    <footer>
        <a href="/" class="footer_info">Help</a>
        <a href="/" class="footer_info">Contact Us</a>
        <a href="/" class="footer_info">FAQ</a>
    </footer>
</body>
    <script src="popups-photos.js"></script>
    <script src="main.js"></script>
</html>