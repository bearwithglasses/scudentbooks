<?php

function showSearchResults()
{
	$con = makeConnection();
	$sql="SELECT * FROM BOOKPOST ORDER BY BOOKID";
	$stid = oci_parse($con, $sql);
	oci_execute($stid);
	
		//got rid of <th>BOOKID</th>
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
				$hrefMessage = "href=\"contactSearch.php?selected=" . $row['BOOKID'] . "\">" . $row['TITLE'];
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
			}
		}	
		echo "</table>";

	oci_close($con);
}

?>