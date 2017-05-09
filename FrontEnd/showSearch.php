<?php

function showSearchResults()
{
	$con = makeConnection();
	$sql="SELECT * FROM BOOKPOST ORDER BY BOOKID";
	$stid = oci_parse($con, $sql);
	oci_execute($stid);
	
		//got rid of <th>BOOKID</th>
    	/*
    	echo "<h1>BOOKPOST table</h1><p><table border='1'>
			<tr>
			<th>TITLE</th>
			<th>AUTHOR</th>
			<th>EDITION</th>
			<th>PURPOSE</th>
			<th>PRICE</th>
			<th>MAJOR</th>
			<th>COURSENUMBER</th>
			<th>CONDITION</th>
			</tr>";
		*/

		while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS))
		{
			$bfound = true;
			if ($_SERVER["REQUEST_METHOD"] == "POST")
			{
			if (!empty($_POST["book_title"])) {
				$str1 = strtolower($row['TITLE']);
				$str2 = strtolower($_POST['book_title']);
				$similarity = 0;
				similar_text($str1,$str2,$similarity);
				if ($similarity <= 25.0)
					$bfound = false;
			}
			if ($bfound && (!empty($_POST["book_author"]))) {
				$str1 = ($row['AUTHOR'] -> load());
				$str1 = strtolower($str1);
				//$str2 = ($_POST['book_author']);
				//settype($str2, "string");
				//$str2 = strtolower($str2);
				$str2 = strtolower($_POST['book_author']);
				$similarity = 0;
				similar_text($str1,$str2,$similarity);
				if ($similarity <= 25.0)
					$bfound = false;
			}
			if ($bfound && (!empty($_POST["book_edition"]))) {
				if ($row['EDITION'] != $_POST['book_edition'])
					$bfound = false;
			}
			if ($bfound && (($_POST["book_purpose"]) != "any")) {
				if ($row['PURPOSE'] != $_POST['book_purpose'])
					$bfound = false;
			}
			
			if ($bfound && (($_POST["book_price"])!= "any")) {
				if (($_POST['book_price'] == '0') && ($row['PRICE'] >= 25.00)) {
					$bfound = false;
				}
				else if ($_POST['book_price'] == '1') {
					if (($row['PRICE'] < 25.00) || ($row['PRICE'] >= 50.00))
						$bfound = false;
				}
				else if ($_POST['book_price'] == '2') {
					if (($row['PRICE'] < 50.00) || ($row['PRICE'] >= 100.00))
						$bfound = false;
				}
				else if (($_POST['book_price'] == '3') && ($row['PRICE'] <= 100.00)) {
					$bfound = false;
				}
			}
			
			if ($bfound && (($_POST["book_major"])!= "any")) {
				if ($row['MAJOR'] != $_POST['book_major'])
					$bfound = false;
			}
			if ($bfound && (!empty($_POST["book_courseno"]))) {
				if ($row['COURSENUMBER'] != $_POST['book_courseno'])
					$bfound = false;
			}
			if ($bfound && (($_POST["book_condition"])!= "any")) {
				if ($row['CONDITION'] != $_POST['book_condition'])
					$bfound = false;
			}
			}
			if ($bfound) {
			
				if($row['STATUS'] == "available" && $row['PURPOSE'] == "sell"){
                    $bookstatus = "buy";
                    $bookstatusText = "$".$row['PRICE'];
                    $booklink = "<a href='listing.php?id=".$row['BOOKID']."'>";
                    $booklinkend = "</a>";
                }
                if($row['STATUS'] == "available" && $row['PURPOSE'] == "swap"){
                    $bookstatus = "swap";
                    $bookstatusText = "For Swap";
                    $booklink = "<a href='listing.php?id=".$row['BOOKID']."'>";
                    $booklinkend = "</a>";
                }
                if($row['STATUS'] == "sale pending"){
                    $bookstatus = "pending";
                    $bookstatusText = "Sale Pending";
                    $booklink = "";
                    $booklinkend = "";
                }
			
				// Get user info based on the userid from the books
                $userid = $row['USERID'];
                $sql2 = "SELECT * FROM USERINFO WHERE USERID = '$userid'";
                $stid2 = oci_parse($con, $sql2);
                oci_execute($stid2);

                // Save user data to variables
                while($row2 = oci_fetch_array($stid2, OCI_ASSOC+OCI_RETURN_NULLS)){
                    $username = $row2['USERNAME'];
                    $location = $row2['LOCATION'];
                    $date = $row['POSTDATE'];
                    $bookid = $row['BOOKID'];
                    $author = $row['AUTHOR']->load();
                }

				//$bookid = $row['BOOKID'];
				$pic1 = "blank1.png";
                //Set up the sql statement to be used later in the code to get the book pictures
                $sql3 = "SELECT * FROM BOOKPICTURE WHERE BOOKID = '$bookid'";
                $stid3 = oci_parse($con, $sql3);
                oci_execute($stid3);

                //Save the picture text to a variable
                while($row3 = oci_fetch_array($stid3, OCI_ASSOC+OCI_RETURN_NULLS)) {
                    if ($row3['PIC1'] != NULL){
                        $pic1 = $row3['PIC1'];
                    }
                    else{
                        $pic1 = "blank1.png";
                    }
                }
			 	echo "<li>";        
                    echo "<div class='listusername'><a href='profile.php?username=".$username."'>".$username."</a></div>";
                    echo "<div class='location'>".$location."</div>";    
                    echo "<div class='listpic pic'><a href='listing.php?id=".$bookid."'><img src='bookimages/".$pic1."'></a></div>";
                    echo "<div class='listtitle'><a href='listing.php?id=".$bookid."'>".$row['TITLE']."</a></div>";
                    echo "<div class='bookinfo'>Author: ". $author ."<br>".$date;
                    echo "</div>";
                    echo "<div class='buybutton ".$bookstatus."'>".$booklink.$bookstatusText.$booklinkend."</div>";
                echo "</li>";
                
				/*$hrefMessage = "href=\"contactSearch.php?selected=" . $row['BOOKID'] . "\">" . $row['TITLE'];
				echo "<tr>";
				//echo "<td>" . $row['BOOKID'] . "</td>";
				echo "<td><a " . $hrefMessage . "</a></td>";
				//echo "<td>" . $row['TITLE'] . "</td>";
				echo "<td id='theclob'>" . $row['AUTHOR']->load(). "</td>";
				echo "<td>" . $row['EDITION'] . "</td>";
				echo "<td>" . $row['PURPOSE'] . "</td>";
				echo "<td>" . $row['PRICE'] . "</td>";
				echo "<td>" . $row['MAJOR'] . "</td>";
				echo "<td>" . $row['COURSENUMBER'] . "</td>";
				echo "<td>" . $row['CONDITION'] . "</td>";
				echo "</tr>";
				*/
			}
		}	
		echo "</table>";

	oci_close($con);
}

?>