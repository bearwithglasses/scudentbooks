<?php

session_start();
ini_set('display_errors','On');
error_reporting(E_ALL);
$db_host = "dbserver.engr.scu.edu/db11g";
$db_user = "wchang";
$db_pass = "winstonchang";
$db_name = "STUDENTBOOKS";
$con = oci_connect($db_user, $db_pass, '//dbserver.engr.scu.edu/db11g');


if($_SESSION["user"]){
    $username = $_SESSION['username'];
}else{
    header('Location: login.php');
    die();
}

$bookid = $_GET["id"]; //Get the bookid from the URL

//Select the Book that is the same as the Book's bookid
$sql="SELECT * FROM BOOKPOST WHERE BOOKID = '$bookid'";
$stid = oci_parse($con, $sql);
oci_execute($stid);

//Set the userid and the booktitle from the BOOKPOST table
while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
    $userid = $row['USERID'];
    $booktitle = $row['TITLE'];
};

//Gets the book's description
$sql3="SELECT * FROM BOOKDESCRIPTION WHERE BOOKID = '$bookid'";
$stid3 = oci_parse($con, $sql3);
oci_execute($stid3);

//Set up the sql statement to be used in later code to checking the price/status
$sql="SELECT * FROM BOOKPOST WHERE BOOKID = '$bookid'";
$stid = oci_parse($con, $sql);
oci_execute($stid);

//Set up the sql statement to be used later in the code to get the book pictures
$sqlPic="SELECT * FROM BOOKPICTURE WHERE BOOKID = '$bookid'";
$stidPic = oci_parse($con, $sqlPic);
oci_execute($stidPic);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCUdent Books Book Edit Success</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
    <link rel="stylesheet" type="text/css" href="booksusers.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
</head>

<body>

<!-- Navigation -->
    <div id="web_nav">
         <header id="logo">
            <div id="logo"><a href="homepage.php"><img alt="SCUdentBooks logo" src="images/logo.png"></a></div>
        </header>

        <div id="links">
            <form class="searchbar">
                <a href="searchpageColumn.php" class="advancedsearch">Search for Books</a>
            </form>

            <nav>
            <ul class="navlinks" id="mainNav">
                <!-- Shows user navigation if logged in. Otherwise, shows a 'log in' button -->
                <?php
                if($_SESSION["user"] == true){
                echo '<li><a href="homepage.php" class="web_link">Home</a></li>';
                echo '<li><a href="addbook.php" class="web_link">Sell</a></li>';
                echo "<li><a href='inbox.php?username=".$_SESSION['username']."' class='web_link'>Inbox</a></li>";
                echo '<li>';
                    echo '<span id="usernav">';
                    echo '    <button onclick="myFunction()" id="userdropdown">You</button>';
                    echo '      <div id="userlinks" class="dropdownnav">';
                    echo "        <a href='profile.php?username=".$_SESSION['username']."'>Your Profile</a>";
                    echo '        <a href="yourbooks.php">Manage Books</a>';
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

<!-- Popup Image Demo -->

<div id="popupimage" class="popup">
    <div id="closemessage" value="Close Message"><img src="images/close.png"></div>
  <img class="popupmessage" id="mainimagepopup">
</div>

<!-- Container that holds Main and Side divs -->
<div id="container">

<?php

    //Get and set book data from the BOOKPOST table
    //Remember that $bookid = $_GET["id"];
    while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
        $current_userid = $row['USERID'];
        $current_booktitle = $row['TITLE'];
        $current_author = $row['AUTHOR']->load();
        $current_purpose = $row['PURPOSE'];
        $current_price = $row['PRICE'];


        if (!EMPTY($row['EDITION'])){$current_edition = $row['EDITION'];}
            else{$current_edition = "";};

        if (!EMPTY($row['ISBN'])){$current_isbn = $row['ISBN'];}
            else{$current_isbn = "";};

        if (!EMPTY($row['MAJOR'])){$current_major = $row['MAJOR'];}
            else{$current_major = "";};

        if (!EMPTY($row['COURSENUMBER'])){$current_coursenumber = $row['COURSENUMBER'];}
            else{$current_coursenumber = "";};

        if (!EMPTY($row['PROFESSOR'])){$current_professor = $row['PROFESSOR']->load();}
            else{$current_professor = "";};

        if (!EMPTY($row['CONDITION'])){$current_condition = $row['CONDITION'];}
            else{$current_condition = "";}

        //Depending on the purpose, set the text to 'checked'-- will be used when printing the purpose in the form
        if ($current_purpose == "sell"){
            $purpose_check_sell = "checked";
            $purpose_check_swap = "";
        }
        if ($current_purpose == "swap"){
            $purpose_check_sell = "";
            $purpose_check_swap = "checked";
        }

        //Depending on the condition, set the text to 'checked'-- will be used when printing the purpose in the form
        if ($current_condition == "new"){
            $purpose_condition_new = "checked";
            $purpose_check_used_good = "";
            $purpose_check_used_acc = "";
        }
        elseif ($current_condition == "used - good"){
            $purpose_condition_new = "";
            $purpose_check_used_good = "checked";
            $purpose_check_used_acc = "";
        }
        elseif ($current_condition == "used - acceptable"){
            $purpose_condition_new = "";
            $purpose_check_used_good = "";
            $purpose_check_used_acc = "checked";
        }
        else{
            $purpose_condition_new = "";
            $purpose_check_used_good = "";
            $purpose_check_used_acc = "";
        }
    };

    //Get and set up book pictures
    $sqlPic="SELECT * FROM BOOKPICTURE WHERE BOOKID = '$bookid'";
    $stidPic = oci_parse($con, $sqlPic);
    oci_execute($stidPic);

    $pic1 = "nopic.jpg";
    $pic2 = "nopic.jpg";
    $pic3 = "nopic.jpg";
    $current_description = "";

    //Get and save all book pictures to variables
    while($row = oci_fetch_array($stidPic, OCI_ASSOC+OCI_RETURN_NULLS)){
        if ($row['PIC1'] != NULL){
            $pic1 = $row['PIC1'];
        }
        if ($row['PIC2'] != NULL){
            $pic2 = $row['PIC2'];
        }
        if ($row['PIC3'] != NULL){
            $pic3 = $row['PIC3'];
        }
    }

    //Get the book description
    $sql3="SELECT * FROM BOOKDESCRIPTION WHERE BOOKID = '$bookid'";
    $stid3 = oci_parse($con, $sql3);
    oci_execute($stid3);

    while($row = oci_fetch_array($stid3, OCI_ASSOC+OCI_RETURN_NULLS)){
        if ($row['DESCRIPTION'] != NULL){
            $current_description = $row['DESCRIPTION']->load();
        }
     }

?>

<h1>Edit Book</h1>
<div id="regBox">
<fieldset>
<legend>Book Form</legend>
<p id="directions">Make sure you fill out all fields marked with an asterisk (*) when editing books.</br>
<form id="edit_info" action="EditProcessBook.php" method="post" enctype="multipart/form-data" onsubmit="return checkform(this);">
    <div class="form">    
        <h3>Book Information</h3>     
        <br>
        <ul>
            <?php
            echo '<li><label>Title: </label><input type="text" name="book_title" value="'.$current_booktitle.'" required></li>';
            echo '<li><label>Author: </label><input type="text" name="book_author" value="'.$current_author.'" required></li>';
            echo '<li><label>Edition: </label><input type="text" name="book_edition" value="'.$current_edition.'"></li>';
            echo '<li><label>Purpose: <img src="images/asterisk.png"></label>
                <div id="radio">
                <input type="radio" name="book_purpose" value="sell" '.$purpose_check_sell.'>sell<br>
                <input type="radio" name="book_purpose" value="swap" '.$purpose_check_swap.'>swap<br>
                </div>
            </li>';
            
            echo '<li><label>Price*: </label><input type="text" name="book_price" value="'.$current_price.'" required></li>';
            echo '<li><label>ISBN: </label><input type="text" name="book_isbn" value="'.$current_isbn.'"></li>';

            // Go through list of MAJORS and print the dropdown menu
            $majorlist = ['ARTS','CHIN','COEN','CORN','ENGL','HIST','ITAL','JAPN','PKMN','Other'];

            echo '<li><label>Department Name: </label>
                <select id="deptNameIdx" name="book_major">';
            for ($i = 0; $i < sizeof($majorlist); $i++){
                //If the current major in the array matches the current major, print the option with the 'selected' tag
                if($majorlist[$i] == $current_major){
                    echo '<option value="'.$majorlist[$i].'" selected="selected">'.$majorlist[$i].'</option>';
                }
                else{
                    echo '<option value="'.$majorlist[$i].'">'.$majorlist[$i].'</option>';
                }
            };
            echo '</select></li>';

            echo '<li><label>Course Number: </label><input type="text" name="book_courseNo" value="'.$current_coursenumber.'"></li>';
            echo '<li><label>Professor: </label><input type="text" name="book_prof" value="'.$current_professor.'"></li>';

            echo '<li><label>Condition: </label>
                <div id="radio">
                    <input type="radio" name="book_condition" value="new" '.$purpose_condition_new.'>new<br>
                    <input type="radio" name="book_condition" value="used - good" '.$purpose_check_used_good.'>used - good<br>
                    <input type="radio" name="book_condition" value="used - acceptable" '.$purpose_check_used_acc.'>used - acceptable<br>
                </div>
            </li>';

            echo '<li><label>Description: </label><textarea id="messagebox" name="book_message">'.$current_description.'</textarea></li>';

            echo '<input type="hidden" name="bookid" value="'.$bookid.'"/>';

            echo '<input type="hidden" name="originalpic1" value="'.$pic1.'"/>';
            echo '<input type="hidden" name="originalpic2" value="'.$pic2.'"/>';
            echo '<input type="hidden" name="originalpic3" value="'.$pic3.'"/>';

            ?>
        </ul>
        <h4>Book Images</h4>
        <ul>
            <li><img src="bookimages/<?php echo $pic1 ?>" width="200px" height="200px"><p><input type="file" name="fileToUpload1" id="fileToUpload"></li>
            <li><img src="bookimages/<?php echo $pic2 ?>" width="200px" height="200px"><p><input type="file" name="fileToUpload2" id="fileToUpload"></li>
            <li><img src="bookimages/<?php echo $pic3 ?>" width="200px" height="200px"><p><input type="file" name="fileToUpload3" id="fileToUpload"></li>
        </ul>
        <br>
        <div>
        <button id="addButton" input type="submit" value="Add" />Add</button>
        </div>
        <div id="divError"></div>

    </form>
</fieldset>
</div>

<script language="javascript" type="text/javascript">
function checkform(pform1){
    //alert ("checkform is called 1");
    var title = pform1.book_title.value;
    var author = pform1.book_author.value;
    var purpose = pform1.book_purpose.value;
    var price = pform1.book_price.value;
    var condition = pform1.book_condition.value;
    //optional entries
    var edition = pform1.book_edition.value;
    var isbn = pform1.book_isbn.value;
    var deptName = pform1.book_major.value;
    var courseNo = pform1.book_courseNo.value;
    var professor = pform1.book_prof.value;
    var description = pform1.book_message.value;
    
    var err={}; 
    var errorFlag=0;
    //alert ("checkform is called 2 " + deptName);
    //check required fields
    //check department name
    //var e = document.getElementById(deptNameIdx);
    /*var e = pform1.book_deptName;
    var deptName = e.options[e.selectedIndex].text;
    if (deptName.length <= 0){
        err.message="Please fill in a Department Name.\n"; 
        err.field=pform1.book_deptName; 
        errorFlag=1;
    }*/
    
    //check title
    if ((title.length<=0) && (errorFlag==0)){
        //alert ("at title" + title);
        err.message="Title not given.\n"
        err.field=pform1.book_title;
        errorFlag=1;
    }
    
    //check author
    if ((author.length<=0) && (errorFlag==0)){
        err.message="Author not entered.\n"
        err.field=pform1.book_author;
        errorFlag=1;
    }
    
    //check price
    if ((price.length<=0) && (errorFlag==0)){
        err.message="Asking Price not given.\n"
        err.field=pform1.book_price;
        errorFlag=1;
    }
    
    //check edition
    /*if ((edition.length<=0) && (errorFlag==0)){
        err.message="Edition not entered.\n"
        err.field=pform1.book_edition;
        errorFlag=1;
    }
    */

    //alert ("alert3 " + errorFlag + " " + err.message);
    if(err.message) 
    { 
        //alert ("alert for error" + err.message);
        document.getElementById('divError').innerHTML = err.message;
        err.field.focus();
        return false;        
    } 
    //alert("no error value"); 
    return true;
}
</script>

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