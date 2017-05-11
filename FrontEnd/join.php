<?php

session_start();
if(!isset($_SESSION["user"])){
    //header('Location: login.php');
    //die();
    $_SESSION["user"] = false;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCUdent Books User Registration</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
    <link rel="stylesheet" type="text/css" href="booksusers.css" />
    <script src="userregistrationpage.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
</head>

<body>

<?php

?>

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
                    echo "    <button onclick='myFunction()' id='userdropdown'>".$_SESSION['username']."</button>";
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

<!-- Container that holds Main and Side divs -->
<div id="container">
    <div class="registrationForm form">
        <form id="registration" action="joinsuccess.php" method="post">
            <h1>Become a SCUdent Member!</h1>
            <p><img style='margin-left:5px;' src="images/asterisk.png" alt="*"> Required Field</p>
            <div id="formRegister">
                <ul>
                    <li>
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" placeholder="Username" required>
                        <span id="usernameError"><?php //echo $usernameError; ?></span> <!-- Username error will be inserted here -->
                    </li>
                    <li>
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" placeholder="Password" required>
                        <span id="passwordError"><?php //echo $passwordError; ?></span> <!-- Password error will be inserted here -->
                    </li>
                    <li>
                        <label for="confirmPassword">Confirm Password:</label>
                        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>
                        <span id="confirmPasswordError"><?php //echo $confirmPasswordError; ?></span> <!-- Confirm password error will be inserted here -->
                    </li>
                    <li>
                        <label for="firstName">First Name:</label>
                        <input type="text" id="firstName" name="firstName" placeholder="First Name" required>
                        <span id="firstNameError"><?php //echo $firstNameError; ?></span> <!-- First name error will be inserted here -->
                    </li>
                    <li>
                        <label for="middleName">Middle Name:</label>
                        <input type="text" id="middleName" name="middleName" placeholder="Middle Name">
                        <span id="middleNameError"><?php //echo $middleNameError; ?></span> <!-- Middle name error will be inserted here -->
                    </li>
                    <li>
                        <label for="lastName">Last Name:</label>
                        <input type="text" id="lastName" name="lastName" placeholder="Last Name" required>
                        <span id="lastNameError"><?php //echo $lastNameError; ?></span> <!-- Last name error will be inserted here -->
                    </li>
                    <li>
                        <label for="emailAddress">Email Address:</label>
                        <input type="email" id="emailAddress" name="emailAddress" placeholder="Email Address">
                        <span id="emailAddressError" required><?php //echo $emailAddressError; ?></span> <!-- Email address error will be inserted here -->
                    </li>
                    <li>
                        <label for="phoneNumber">Phone Number:</label>
                        <input type="text" id="phoneNumber" name="phoneNumber" placeholder="Phone Number">
                        <span id="phoneNumberError"><?php //echo $phoneNumberError; ?></span> <!-- Phone number error will be inserted here -->
                    </li>
                    <li>
                        <label for="major1">Major:</label>
                        <select name="major1" id="major1" size="11" required>
                            <option selected="selected" value="">Select a major</option>
                            <option value="Accounting">Accounting</option>
                            <option value="Accounting and Information Systems">Accounting and Information Systems</option>
                            <option value="Ancient Studies">Ancient Studies</option>
                            <option value="Anthropology">Anthropology</option>
                            <option value="Arabic">Arabic</option>
                            <option value="Art History">Art History</option>
                            <option value="Biochemistry">Biochemistry</option>
                            <option value="Bioengineering">Bioengineering</option>
                            <option value="Biology">Biology</option>
                            <option value="Chemistry">Chemistry</option>
                            <option value="Chinese">Chinese</option>
                            <option value="Civil Engineering">Civil Engineering</option>
                            <option value="Classical Studies">Classical Studies</option>
                            <option value="Communication">Communication</option>
                            <option value="Computer Science">Computer Science</option>
                            <option value="Computer Science and Engineering">Computer Science and Engineering</option>
                            <option value="Economics (College of Arts and Sciences)">Economics (College of Arts and Sciences)</option>
                            <option value="Economics (Leavey School of Business)">Economics (Leavey School of Business)</option>
                            <option value="Electrical Engineering">Electrical Engineering</option>
                            <option value="Engineering Physics">Engineering Physics</option>
                            <option value="English">English</option>
                            <option value="Environmental Science">Environmental Science</option>
                            <option value="Environmental Studies">Environmental Studies</option>
                            <option value="Ethnic Studies">Ethnic Studies</option>
                            <option value="Finance">Finance</option>
                            <option value="French">French</option>
                            <option value="General Engineering">General Engineering</option>
                            <option value="German">German</option>
                            <option value="Greek Language and Literature">Greek Language and Literature</option>
                            <option value="History">History</option>
                            <option value="Individual Studies (College of Arts and Sciences)">Individual Studies (College of Arts and Sciences)</option>
                            <option value="Individual Studies (Leavey School of Business)">Individual Studies (Leavey School of Business)</option>
                            <option value="Italian">Italian</option>
                            <option value="Japanese">Japanese</option>
                            <option value="Latin and Greek">Latin and Greek</option>
                            <option value="Latin Language and Literature">Latin Language and Literature</option>
                            <option value="Liberal Studies">Liberal Studies</option>
                            <option value="Management">Management</option>
                            <option value="Management Information Systems (OMIS)">Management Information Systems (OMIS)</option>
                            <option value="Marketing">Marketing</option>
                            <option value="Mathematics">Mathematics</option>
                            <option value="Mechanical Engineering">Mechanical Engineering</option>
                            <option value="Military Science">Military Science</option>
                            <option value="Music">Music</option>
                            <option value="Neuroscience">Neuroscience</option>
                            <option value="Philosophy">Philosophy</option>
                            <option value="Physics">Physics</option>
                            <option value="Political Science">Political Science</option>
                            <option value="Psychology">Psychology</option>
                            <option value="Public Health Science">Public Health Science</option>
                            <option value="Religious Studies">Religious Studies</option>
                            <option value="Sociology">Sociology</option>
                            <option value="Spanish">Spanish</option>
                            <option value="Theatre and Dance">Theatre and Dance</option>
                            <option value="Web Design and Engineering">Web Design and Engineering</option>
                            <option value="Women's and Gender Studies">Women's and Gender Studies</option>
                        </select><img style='margin-left:5px;' alt="*" src="images/asterisk.png">
                        <span id="major1Error"><?php //echo $major1Error; ?></span> <!-- Major 1 error will be inserted here -->
                    </li>
                    <li>
                        <label for="major2">Major:</label>
                        <select name="major2" id="major2" size="11">
                            <option selected="selected" value="">Select a major</option>
                            <option value="Accounting">Accounting</option>
                            <option value="Accounting and Information Systems">Accounting and Information Systems</option>
                            <option value="Ancient Studies">Ancient Studies</option>
                            <option value="Anthropology">Anthropology</option>
                            <option value="Arabic">Arabic</option>
                            <option value="Art History">Art History</option>
                            <option value="Biochemistry">Biochemistry</option>
                            <option value="Bioengineering">Bioengineering</option>
                            <option value="Biology">Biology</option>
                            <option value="Chemistry">Chemistry</option>
                            <option value="Chinese">Chinese</option>
                            <option value="Civil Engineering">Civil Engineering</option>
                            <option value="Classical Studies">Classical Studies</option>
                            <option value="Communication">Communication</option>
                            <option value="Computer Science">Computer Science</option>
                            <option value="Computer Science and Engineering">Computer Science and Engineering</option>
                            <option value="Economics (College of Arts and Sciences)">Economics (College of Arts and Sciences)</option>
                            <option value="Economics (Leavey School of Business)">Economics (Leavey School of Business)</option>
                            <option value="Electrical Engineering">Electrical Engineering</option>
                            <option value="Engineering Physics">Engineering Physics</option>
                            <option value="English">English</option>
                            <option value="Environmental Science">Environmental Science</option>
                            <option value="Environmental Studies">Environmental Studies</option>
                            <option value="Ethnic Studies">Ethnic Studies</option>
                            <option value="Finance">Finance</option>
                            <option value="French">French</option>
                            <option value="General Engineering">General Engineering</option>
                            <option value="German">German</option>
                            <option value="Greek Language and Literature">Greek Language and Literature</option>
                            <option value="History">History</option>
                            <option value="Individual Studies (College of Arts and Sciences)">Individual Studies (College of Arts and Sciences)</option>
                            <option value="Individual Studies (Leavey School of Business)">Individual Studies (Leavey School of Business)</option>
                            <option value="Italian">Italian</option>
                            <option value="Japanese">Japanese</option>
                            <option value="Latin and Greek">Latin and Greek</option>
                            <option value="Latin Language and Literature">Latin Language and Literature</option>
                            <option value="Liberal Studies">Liberal Studies</option>
                            <option value="Management">Management</option>
                            <option value="Management Information Systems (OMIS)">Management Information Systems (OMIS)</option>
                            <option value="Marketing">Marketing</option>
                            <option value="Mathematics">Mathematics</option>
                            <option value="Mechanical Engineering">Mechanical Engineering</option>
                            <option value="Military Science">Military Science</option>
                            <option value="Music">Music</option>
                            <option value="Neuroscience">Neuroscience</option>
                            <option value="Philosophy">Philosophy</option>
                            <option value="Physics">Physics</option>
                            <option value="Political Science">Political Science</option>
                            <option value="Psychology">Psychology</option>
                            <option value="Public Health Science">Public Health Science</option>
                            <option value="Religious Studies">Religious Studies</option>
                            <option value="Sociology">Sociology</option>
                            <option value="Spanish">Spanish</option>
                            <option value="Theatre and Dance">Theatre and Dance</option>
                            <option value="Web Design and Engineering">Web Design and Engineering</option>
                            <option value="Women's and Gender Studies">Women's and Gender Studies</option>
                        </select>
                        <span id="major2Error"><?php //echo $major2Error; ?></span> <!-- Major 2 error will be inserted here -->
                    </li>
                    <li>
                        <label for="major3">Major:</label>
                        <select name="major3" id="major3" size="11">
                            <option selected="selected" value="">Select a major</option>
                            <option value="Accounting">Accounting</option>
                            <option value="Accounting and Information Systems">Accounting and Information Systems</option>
                            <option value="Ancient Studies">Ancient Studies</option>
                            <option value="Anthropology">Anthropology</option>
                            <option value="Arabic">Arabic</option>
                            <option value="Art History">Art History</option>
                            <option value="Biochemistry">Biochemistry</option>
                            <option value="Bioengineering">Bioengineering</option>
                            <option value="Biology">Biology</option>
                            <option value="Chemistry">Chemistry</option>
                            <option value="Chinese">Chinese</option>
                            <option value="Civil Engineering">Civil Engineering</option>
                            <option value="Classical Studies">Classical Studies</option>
                            <option value="Communication">Communication</option>
                            <option value="Computer Science">Computer Science</option>
                            <option value="Computer Science and Engineering">Computer Science and Engineering</option>
                            <option value="Economics (College of Arts and Sciences)">Economics (College of Arts and Sciences)</option>
                            <option value="Economics (Leavey School of Business)">Economics (Leavey School of Business)</option>
                            <option value="Electrical Engineering">Electrical Engineering</option>
                            <option value="Engineering Physics">Engineering Physics</option>
                            <option value="English">English</option>
                            <option value="Environmental Science">Environmental Science</option>
                            <option value="Environmental Studies">Environmental Studies</option>
                            <option value="Ethnic Studies">Ethnic Studies</option>
                            <option value="Finance">Finance</option>
                            <option value="French">French</option>
                            <option value="General Engineering">General Engineering</option>
                            <option value="German">German</option>
                            <option value="Greek Language and Literature">Greek Language and Literature</option>
                            <option value="History">History</option>
                            <option value="Individual Studies (College of Arts and Sciences)">Individual Studies (College of Arts and Sciences)</option>
                            <option value="Individual Studies (Leavey School of Business)">Individual Studies (Leavey School of Business)</option>
                            <option value="Italian">Italian</option>
                            <option value="Japanese">Japanese</option>
                            <option value="Latin and Greek">Latin and Greek</option>
                            <option value="Latin Language and Literature">Latin Language and Literature</option>
                            <option value="Liberal Studies">Liberal Studies</option>
                            <option value="Management">Management</option>
                            <option value="Management Information Systems (OMIS)">Management Information Systems (OMIS)</option>
                            <option value="Marketing">Marketing</option>
                            <option value="Mathematics">Mathematics</option>
                            <option value="Mechanical Engineering">Mechanical Engineering</option>
                            <option value="Military Science">Military Science</option>
                            <option value="Music">Music</option>
                            <option value="Neuroscience">Neuroscience</option>
                            <option value="Philosophy">Philosophy</option>
                            <option value="Physics">Physics</option>
                            <option value="Political Science">Political Science</option>
                            <option value="Psychology">Psychology</option>
                            <option value="Public Health Science">Public Health Science</option>
                            <option value="Religious Studies">Religious Studies</option>
                            <option value="Sociology">Sociology</option>
                            <option value="Spanish">Spanish</option>
                            <option value="Theatre and Dance">Theatre and Dance</option>
                            <option value="Web Design and Engineering">Web Design and Engineering</option>
                            <option value="Women's and Gender Studies">Women's and Gender Studies</option>
                        </select>
                        <span id="major3Error"><?php //echo $major3Error; ?></span> <!-- Major 3 error will be inserted here -->
                    </li>
                    <li>
                        <label for="minor1">Minor:</label>
                        <select name="minor1" id="minor1" size="11">
                            <option selected="selected" value="">Select a minor</option>
                            <option value="Aerospace Engineering">Aerospace Engineering</option>
                            <option value="Ancient Studies">Ancient Studies</option>
                            <option value="Anthropology">Anthropology</option>
                            <option value="Arabic, Islamic, and Middle Eastern Studies">Arabic, Islamic, and Middle Eastern Studies</option>
                            <option value="Art History">Art History</option>
                            <option value="Asian Studies">Asian Studies</option>
                            <option value="Bioengineering">Bioengineering</option>
                            <option value="Biology">Biology</option>
                            <option value="Biotechnology">Biotechnology</option>
                            <option value="Catholic Studies">Catholic Studies</option>
                            <option value="Chemistry">Chemistry</option>
                            <option value="Classical Studies">Classical Studies</option>
                            <option value="Communication">Communication</option>
                            <option value="Computer Engineering">Computer Engineering</option>
                            <option value="Computer Science">Computer Science</option>
                            <option value="Creative Writing">Creative Writing</option>
                            <option value="Dance">Dance</option>
                            <option value="Economics">Economics</option>
                            <option value="Electrical Engineering">Electrical Engineering</option>
                            <option value="English">English</option>
                            <option value="Entrepreneurship">Entrepreneurship</option>
                            <option value="Environmental Studies">Environmental Studies</option>
                            <option value="Ethnic Studies">Ethnic Studies</option>
                            <option value="French">French</option>
                            <option value="General Engineering">General Engineering</option>
                            <option value="German">German</option>
                            <option value="Greek Language and Literature">Greek Language and Literature</option>
                            <option value="History">History</option>
                            <option value="International Business">International Business</option>
                            <option value="Italian">Italian</option>
                            <option value="Japanese">Japanese</option>
                            <option value="Latin American Studies">Latin American Studies</option>
                            <option value="Latin Language and Literature">Latin Language and Literature</option>
                            <option value="Management Information Systems (MIS)">Management Information Systems (MIS)</option>
                            <option value="Mathematics">Mathematics</option>
                            <option value="Mechanical Engineering">Mechanical Engineering</option>
                            <option value="Medieval and Renaissance Studies">Medieval and Renaissance Studies</option>
                            <option value="Music">Music</option>
                            <option value="Musical Theatre">Musical Theatre</option>
                            <option value="Philosophy">Philosophy</option>
                            <option value="Physics">Physics</option>
                            <option value="Political Science">Political Science</option>
                            <option value="Public Health">Public Health</option>
                            <option value="Religious Studies">Religious Studies</option>
                            <option value="Retail Studies">Retail Studies</option>
                            <option value="Sociology">Sociology</option>
                            <option value="Spanish">Spanish</option>
                            <option value="Studio Art">Studio Art</option>
                            <option value="Sustainability">Sustainability</option>
                            <option value="Theatre">Theatre</option>
                            <option value="Urban Education">Urban Education</option>
                            <option value="Women's and Gender Studies">Women's and Gender Studies</option>
                        </select>
                    </li>
                    <li>
                        <label for="minor2">Minor:</label>
                        <select name="minor2" id="minor2" size="11">
                            <option selected="selected" value="">Select a minor</option>
                            <option value="Aerospace Engineering">Aerospace Engineering</option>
                            <option value="Ancient Studies">Ancient Studies</option>
                            <option value="Anthropology">Anthropology</option>
                            <option value="Arabic, Islamic, and Middle Eastern Studies">Arabic, Islamic, and Middle Eastern Studies</option>
                            <option value="Art History">Art History</option>
                            <option value="Asian Studies">Asian Studies</option>
                            <option value="Bioengineering">Bioengineering</option>
                            <option value="Biology">Biology</option>
                            <option value="Biotechnology">Biotechnology</option>
                            <option value="Catholic Studies">Catholic Studies</option>
                            <option value="Chemistry">Chemistry</option>
                            <option value="Classical Studies">Classical Studies</option>
                            <option value="Communication">Communication</option>
                            <option value="Computer Engineering">Computer Engineering</option>
                            <option value="Computer Science">Computer Science</option>
                            <option value="Creative Writing">Creative Writing</option>
                            <option value="Dance">Dance</option>
                            <option value="Economics">Economics</option>
                            <option value="Electrical Engineering">Electrical Engineering</option>
                            <option value="English">English</option>
                            <option value="Entrepreneurship">Entrepreneurship</option>
                            <option value="Environmental Studies">Environmental Studies</option>
                            <option value="Ethnic Studies">Ethnic Studies</option>
                            <option value="French">French</option>
                            <option value="General Engineering">General Engineering</option>
                            <option value="German">German</option>
                            <option value="Greek Language and Literature">Greek Language and Literature</option>
                            <option value="History">History</option>
                            <option value="International Business">International Business</option>
                            <option value="Italian">Italian</option>
                            <option value="Japanese">Japanese</option>
                            <option value="Latin American Studies">Latin American Studies</option>
                            <option value="Latin Language and Literature">Latin Language and Literature</option>
                            <option value="Management Information Systems (MIS)">Management Information Systems (MIS)</option>
                            <option value="Mathematics">Mathematics</option>
                            <option value="Mechanical Engineering">Mechanical Engineering</option>
                            <option value="Medieval and Renaissance Studies">Medieval and Renaissance Studies</option>
                            <option value="Music">Music</option>
                            <option value="Musical Theatre">Musical Theatre</option>
                            <option value="Philosophy">Philosophy</option>
                            <option value="Physics">Physics</option>
                            <option value="Political Science">Political Science</option>
                            <option value="Public Health">Public Health</option>
                            <option value="Religious Studies">Religious Studies</option>
                            <option value="Retail Studies">Retail Studies</option>
                            <option value="Sociology">Sociology</option>
                            <option value="Spanish">Spanish</option>
                            <option value="Studio Art">Studio Art</option>
                            <option value="Sustainability">Sustainability</option>
                            <option value="Theatre">Theatre</option>
                            <option value="Urban Education">Urban Education</option>
                            <option value="Women's and Gender Studies">Women's and Gender Studies</option>
                        </select>
                        <span id="minor2Error"><?php //echo $minor2Error; ?></span> <!-- Minor 2 error will be inserted here -->
                    </li>
                    <li>
                        <label for="minor3">Minor:</label>
                        <select name="minor3" id="minor3" size="11">
                            <option selected="selected" value="">Select a minor</option>
                            <option value="Aerospace Engineering">Aerospace Engineering</option>
                            <option value="Ancient Studies">Ancient Studies</option>
                            <option value="Anthropology">Anthropology</option>
                            <option value="Arabic, Islamic, and Middle Eastern Studies">Arabic, Islamic, and Middle Eastern Studies</option>
                            <option value="Art History">Art History</option>
                            <option value="Asian Studies">Asian Studies</option>
                            <option value="Bioengineering">Bioengineering</option>
                            <option value="Biology">Biology</option>
                            <option value="Biotechnology">Biotechnology</option>
                            <option value="Catholic Studies">Catholic Studies</option>
                            <option value="Chemistry">Chemistry</option>
                            <option value="Classical Studies">Classical Studies</option>
                            <option value="Communication">Communication</option>
                            <option value="Computer Engineering">Computer Engineering</option>
                            <option value="Computer Science">Computer Science</option>
                            <option value="Creative Writing">Creative Writing</option>
                            <option value="Dance">Dance</option>
                            <option value="Economics">Economics</option>
                            <option value="Electrical Engineering">Electrical Engineering</option>
                            <option value="English">English</option>
                            <option value="Entrepreneurship">Entrepreneurship</option>
                            <option value="Environmental Studies">Environmental Studies</option>
                            <option value="Ethnic Studies">Ethnic Studies</option>
                            <option value="French">French</option>
                            <option value="General Engineering">General Engineering</option>
                            <option value="German">German</option>
                            <option value="Greek Language and Literature">Greek Language and Literature</option>
                            <option value="History">History</option>
                            <option value="International Business">International Business</option>
                            <option value="Italian">Italian</option>
                            <option value="Japanese">Japanese</option>
                            <option value="Latin American Studies">Latin American Studies</option>
                            <option value="Latin Language and Literature">Latin Language and Literature</option>
                            <option value="Management Information Systems (MIS)">Management Information Systems (MIS)</option>
                            <option value="Mathematics">Mathematics</option>
                            <option value="Mechanical Engineering">Mechanical Engineering</option>
                            <option value="Medieval and Renaissance Studies">Medieval and Renaissance Studies</option>
                            <option value="Music">Music</option>
                            <option value="Musical Theatre">Musical Theatre</option>
                            <option value="Philosophy">Philosophy</option>
                            <option value="Physics">Physics</option>
                            <option value="Political Science">Political Science</option>
                            <option value="Public Health">Public Health</option>
                            <option value="Religious Studies">Religious Studies</option>
                            <option value="Retail Studies">Retail Studies</option>
                            <option value="Sociology">Sociology</option>
                            <option value="Spanish">Spanish</option>
                            <option value="Studio Art">Studio Art</option>
                            <option value="Sustainability">Sustainability</option>
                            <option value="Theatre">Theatre</option>
                            <option value="Urban Education">Urban Education</option>
                            <option value="Women's and Gender Studies">Women's and Gender Studies</option>
                        </select>
                        <span id="minor3Error"><?php //echo $minor3Error; ?></span> <!-- Minor 3 error will be inserted here -->
                    </li>
                    <li>
                        <label for="year">Year:</label>
                        <select name="year" id="year">
                            <option selected="selected" value="">Select a year</option>
                            <option value="Freshman">Freshman</option>
                            <option value="Sophomore">Sophomore</option>
                            <option value="Junior">Junior</option>
                            <option value="Senior">Senior</option>
                            <option value="Graduate">Graduate</option>
                        </select>
                    </li>
                    <li>
                        <label for="location">Location:</label>
                        <select name="location" id="location">
                            <option selected="selected" value="">Select a location</option>
                            <option value="Graham Hall">Graham Hall</option>
                            <option value="Campisi Hall">Campisi Hall</option>
                            <option value="Swig Hall">Swig Hall</option>
                            <option value="Casa Italiana">Casa Italiana</option>
                            <option value="Dunne Hall">Dunne Hall</option>
                            <option value="Sobrato Hall">Sobrato Hall</option>
                            <option value="Sanfilippo Hall">Sanfilippo Hall</option>
                            <option value="McLaughlin-Walsh Hall">MchLaughlin-Walsh Hall</option>
                            <option value="Nobili Hall">Nobili Hall</option>
                            <option value="University Villas">University Villas</option>
                            <option value="Neighborhood Units">Neighborhood Units</option>
                            <option value="Off Campus">Off Campus</option>
                        </select>
                    </li>
                </ul>
                <input type="hidden" name="submitted" value="true"/>
                <input type="submit" id="joinButton" value="Create Account" onclick="submission()">
            </div>
        </form>
    </div>
</div>

<!-- Footer  -->
    <footer>
        <a href="/" class="footer_info">Help</a>
        <a href="/" class="footer_info">Contact Us</a>
        <a href="/" class="footer_info">FAQ</a>
    </footer>
</body>
</html>