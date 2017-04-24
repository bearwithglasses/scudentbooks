<?php

session_start();			//need this otherwise you cannot access $_SESSION array..
ini_set('display_errors','On');
include ("BookPostSqlFnc.php");

function UploadImageFile($fileToUpload,$bookid)
{
 $target_dir = "bookimages/";
 $target_file = $target_dir . basename($_FILES[$fileToUpload]["name"]);
 $uploadOk = 1;
 $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
 
 // Check file size
if ($_FILES[$fileToUpload]["size"] > 500000) {
	echo "Sorry, your file is too large.";
	$uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
	//echo "Sorry, only JPEG, PNG, JPG, GIF files are allowed"."<br>";
	$uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an errorup
if ($uploadOk = 1) {

//
//
//$path = "/home/httpd/html/index.php";
//$file = basename($path);         // $file is set to "index.php"
//$file = basename($path, ".php"); // $file is set to "index"//	
	// 
	// what we want to do here is to append bookid to the image name so we always have a unique image name
	// change  /temp/wallet.jpg to /temp/wallet100.jpg
	//
	 $imageFileType = ".".$imageFileType;					//append a . infront of image type like (.jpg, .png etc)
	 $file = basename ($target_file,$imageFileType);			//this will return wallet
	// echo "file name is ".$file."<br>";
	 $target_file = $target_dir.$file.$bookid.$imageFileType;			//append bookid to the image name
	// echo "final target_file name is ...".$target_file."<br>";
	 
	 if (move_uploaded_file($_FILES[$fileToUpload]["tmp_name"], $target_file)) 
	 {
	   $file = basename($target_file);		//remove the folder name
	   return ($file);
      }else {
	    $file='';		//empty string
	   return ($file);	//upload file not successful....
	 } 
}
else
{
	$file = '';
	return ($file);
}

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
	//   BookPost_insert will return the unique bookid
	//
	$bookid = BookPost_insertValues($input_userid,$input_title,$input_author,$input_edition,
	$input_purpose,$input_price,$input_isbn,$input_major,$input_courseNo,$input_professor,
	$input_condition,$input_status,$input_desc);
	
	//
	$ImageName1 = basename($_FILES["fileToUpload1"]["name"]);
	
	//echo "image name is: ".$ImageName1."<br>";
	
    if (!empty($ImageName1))
	{	
     $ImageName1 = UploadImageFile("fileToUpload1",$bookid);
	// echo "ImageName1 is ...".$ImageName1."<br>";
	}
	if (empty($ImageName1))
	  $ImageName1 = "blank1.png";  
	//
	$ImageName2 = basename($_FILES["fileToUpload2"]["name"]);
	//
	if (!empty($ImageName2))
	{	
     $ImageName2 = UploadImageFile("fileToUpload2",$bookid);
	// echo "ImageName2 is ...".$ImageName2."<br>";
	}
	if (empty($ImageName2))
	  $ImageName2 = "blank2.png";  
	//
	  
	$ImageName3 = basename($_FILES["fileToUpload3"]["name"]);
	
	if (!empty($ImageName3))
	{	
     $ImageName3 = UploadImageFile("fileToUpload3",$bookid);
	// echo "ImageName3 is ...".$ImageName3."<br>";
	}
	if (empty($ImageName3))
	  $ImageName3 = "blank3.png";
	
    BookPost_insertPictureNames($bookid,$ImageName1,$ImageName2,$ImageName3);
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
                <!-- Shows user navigation if logged in. Otherwise, shows a 'log in' button -->
                <?php
                if($_SESSION["user"] == true){
                echo '<li><a href="homepage.php" class="web_link">Home</a></li>';
                echo '<li><a href="addbook.html" class="web_link">Sell</a></li>';
                echo '<li><a href="#" class="web_link">Inbox</a></li>';
                echo '<li>';
                    echo '<span id="usernav">';
                    echo '    <button onclick="myFunction()" id="userdropdown">You</button>';
                    echo '      <div id="userlinks" class="dropdownnav">';
                    echo "        <a href='profile.php?username=".$_SESSION['username']."'>Your Profile</a>";
                    echo '        <a href="yourbooks.php">Manage Books</a>';
                    echo '        <a href="#">Settings</a>';
                    echo '        <a href="logout.php">Log Out</a>';
                    echo '</span>';
                }
                else{
                    echo '<li><a href="join.php" class="web_link registerlink">Register</a></li>';
                    echo '<li><a href="login.php" class="web_link loginlink">Log In</a></li>';
                }
                ?>
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