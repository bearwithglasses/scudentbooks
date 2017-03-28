<?php
/*function randomMemberId(){
	$memId = rand(1,1000);
	$mstring = 'M'. $memId;
	return $mstring;
}*/    
function makeConnection(){
	$password = "";
	$servername = "localhost";
	$username = "root";
	$dbname = "registerBook";
	// Create connection
	$conn = new mysqli($servername, $username, $password ,$dbname);
	// Check connection
	if (!$conn) {
    		die("Connection failed: " . mysqli_connect_error());
	} 
	//echo "Connection made here.<br>";
	return $conn;
}
function closeConnection($conn){
	if (!$conn)
		mysqli_close($conn);
}
/*function getBookCount(){
	$tsize = count(BookForm);
}*/
function insertFormValues($mDeptName,$mClassNo,$mTitle,$mAuthor,$mEdition,$mCondition,$mPrice,$mSellerName,$mEmail,$mPhone){
	echo "making connection<br>";
	$conn = makeConnection();
	//$sql = "Insert into BookForm(mDeptName,mClassNo,mTitle,mAuthor,mEdition,mCondition,mPrice,mSellerName,mEmail,mPhone) 
	//values('$mDeptName','$mClassNo','$mTitle','$mAuthor','$mEdition','$mCondition','$mPrice','$mSellerName','$mEmail','$mPhone')";
	$sql = "insert into BookForm values('$mDeptName','$mClassNo','$mTitle','$mAuthor','$mEdition','$mCondition','$mPrice','$mSellerName','$mEmail','$mPhone')";
	$result = mysqli_query($conn,$sql) or die (mysql_error());
	echo "<br/>Entered data successfully<br/>";
	closeConnection($conn);
}
function showBookData(){
	$conn = makeConnection();
	$sql = "SELECT *  FROM BOOKPOST";
	$result = mysqli_query($conn,$sql) or die (mysql_error());
	if (mysqli_num_rows($result) > 0) {
    	// output data of each row
    	echo mysqli_num_rows($result) . " results found. </br>";
		echo "</br>";
    	echo "<table><tr><th><b>Department Name</b></th><th><b>Class Number</b></th><th><b>Book Title</b></th>
    	<th><b>Author</b></th><th><b>Edition</b></th><th><b>Condition</b></th><th><b>Price</b></th>
    	<th><b>Seller Name</b></th><th><b>Email</b></th><th><b>Phone</b></th></tr>";
    	while($row = mysqli_fetch_assoc($result)) {
        	echo "<tr><td>". $row["mDeptName"]. "</td><td>" . $row["mClassNo"]. "</td>";
        	echo "<td>". $row["mTitle"]. " </td><td> " . $row["mAuthor"] . "</td><td> ".$row["mEdition"]. " </td>"; 
        	echo "<td>".$row["mCondition"]. "</td><td>$" . $row["mPrice"]. "</td><td>". $row["mSellerName"]. "</td>";
        	echo "<td>". $row["mEmail"]. " </td><td>".$row["mPhone"]. "</td></tr>";
    	}
    	echo "</table>";
	}
	else {
    	echo "0 results found.";
	}
	closeConnection($conn);
}
function showSearchResults($results){
	//$result = mysqli_query($conn,$sql) or die (mysql_error());
	if (mysqli_num_rows($results) > 0) {
    	// output data of each row
    	if(mysqli_num_rows($results)==1){
    		echo "1 result found. </br>";
    	}
    	else {
    		echo mysqli_num_rows($results) . " results found. </br>";
    	}
		echo "</br>";
    	echo "<table><tr><th><b>Department Name</b></th><th><b>Class Number</b></th><th><b>Book Title</b></th>
    	<th><b>Author</b></th><th><b>Edition</b></th><th><b>Condition</b></th><th><b>Price</b></th>
    	<th><b>Seller Name</b></th><th><b>Email</b></th><th><b>Phone</b></th></tr>";
    	while($row = mysqli_fetch_assoc($results)) {
        	echo "<tr><td>". $row["mDeptName"]. "</td><td>" . $row["mClassNo"]. "</td>";
        	echo "<td>". $row["mTitle"]. " </td><td> " . $row["mAuthor"] . "</td><td> ".$row["mEdition"]. " </td>"; 
        	echo "<td>".$row["mCondition"]. "</td><td>$" . $row["mPrice"]. "</td><td>". $row["mSellerName"]. "</td>";
        	echo "<td>". $row["mEmail"]. " </td><td>".$row["mPhone"]. "</td></tr>";
    	}
    	echo "</table>";
	}
	else {
    	echo "0 results found.";
	}
}
/*function deleteUserData($mno){
	$conn = makeConnection();
	$sql = "delete from UserForm where mID='$mno'";
	$result = mysqli_query($conn,$sql) or die (mysql_error());
	//echo "<br>Deleted data successfully<br/>";
	closeConnection($conn);
}*/
function searchForBooks($title,$author,$edition,$isbn,$major,$courseno,$condition,$price) {		//missing location and purpose, and is isbn really necessary?
	//echo "from searchForBooks... deptName: " . $deptName . " and title: " . $title . "\n";
	$conn = makeConnection();
	$sql =  $sql="SELECT  book_title,book_author,book_edition,book_isbn,book_major,book_courseno,book_condition,book_price
	FROM BOOKPOST WHERE book_title LIKE '%" . $title .  "%' AND book_author LIKE '%" . $author . 
	"%' AND book_edition LIKE '%" . $edition . "%' AND book_isbn LIKE '%" . $isbn .
	"%' AND book_major LIKE '%" . $major . "%' AND book_courseno LIKE '%" . $courseno .
	"%' AND book_condition LIKE '%" . $condition . "%' AND book_price LIKE '%" . $price . "%'"; 
	$result = mysqli_query($conn,$sql) or die (mysql_error());
	$count = mysqli_num_rows($result);
	//echo $count . "</br>";
	if ($count > 0){
		showSearchResults($result);		//update to use format on searchpage.html
	}
	else
		echo "No results found.\n";
	closeConnection($conn);
	return $count;
}
/*function searchForMemberID($mid) {
	$conn = makeConnection();
	$sql = "select mFname, mLname from BookForm where mID='$mid'";
	$result = mysqli_query($conn,$sql) or die (mysql_error());
	$count = mysqli_num_rows($result);
	*/
	/*if ($count > 0) {
		echo "Member code found. ". $count . "</br>";
	}
	else {
		echo "Member code not found. </br>";
	}*/
	/*
	closeConnection($conn);
	return $count;
}
function getMemberInfo($mid,$item) {
	$conn = makeConnection();
	$sql = "select $item from BookForm where mID='$mid'";
	$result = mysqli_query($conn,$sql) or die (mysql_error());
	$count = mysqli_num_rows($result);
	closeConnection($conn);
	$name = "";
	if($count>0){
		$row = mysqli_fetch_assoc($result);
		$name = $row[$item];
	}
	return $name;
}*/

?>