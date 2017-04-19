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
            <div id="logo"><a href="homepage.php"><img alt="eCampus logo" src="images/eCampusLogo.png"></a></div>
        </header>

        <div id="links">
            <form class="searchbar">
                <span class="searchicon"><i></i></span>
                <input type="text" name="search" placeholder="Search...">
                <input type="button" class="button" value="Search">
                <a href="searchpageColumn.php" class="advancedsearch">Advanced</a>
            </form>

            <nav>
            <ul class="navlinks" id="mainNav">
                <li><a href="#" class="web_link">Home</a></li>
                <li><a href="addbook.html" class="web_link">Sell</a></li>
                <li><a href="#" class="web_link">Inbox</a></li>
                <li>
                <!-- Shows user navigation if logged in. Otherwise, shows a 'log in' button -->
                <?php
                if($_SESSION["user"] == true){

                    echo '<span id="usernav">';
                    echo '    <button onclick="myFunction()" id="userdropdown">You</button>';
                    echo '      <div id="userlinks" class="dropdownnav">';
                    echo '        <a href="#">Your Profile</a>';
                    echo '        <a href="#">Manage Books</a>';
                    echo '        <a href="#">Settings</a>';
                    echo '        <a href="logout.php">Log Out</a>';
                    echo '</span>';
                }
                else{
                    echo '<li><a href="join.php" class="web_link registerlink">Register</a></li>';
                    echo '<li><a href="login.php" class="web_link loginlink">Log In</a></li>';
                }
                ?>
                </li>
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
            <h1>Sign Up to Become a Member here</h1>
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
                        <select name="major1" id="major1" required>
                            <option selected="selected" value="">Select a major</option>
                            <option value="COEN">Computer and Web Engineering</option>
                            <option value="BOIE">Bioengineering</option>
                            <option value="ELEN">Electrical Engineering</option>
                            <option value="MECH">Mechanical Engineering</option>
                            <option value="CENG">Civil Engineering</option>
                            <option value="ANTH">Anthropology</option>
                            <option value="ARTH">Art History</option>
                            <option value="ARTS">Studio Art</option>
                            <option value="BIOL">Biology</option>
                            <option value="CHEM">Chemistry</option>
                        </select><img style='margin-left:5px;' alt="*" src="images/asterisk.png">
                        <span id="major1Error"><?php //echo $major1Error; ?></span> <!-- Major 1 error will be inserted here -->
                    </li>
                    <li>
                        <label for="major2">Major:</label>
                        <select name="major2" id="major2">
                            <option selected="selected" value="">Select a major</option>
                            <option value="COEN">Computer and Web Engineering</option>
                            <option value="BOIE">Bioengineering</option>
                            <option value="ELEN">Electrical Engineering</option>
                            <option value="MECH">Mechanical Engineering</option>
                            <option value="CENG">Civil Engineering</option>
                            <option value="ANTH">Anthropology</option>
                            <option value="ARTH">Art History</option>
                            <option value="ARTS">Studio Art</option>
                            <option value="BIOL">Biology</option>
                            <option value="CHEM">Chemistry</option>
                        </select>
                        <span id="major2Error"><?php //echo $major2Error; ?></span> <!-- Major 2 error will be inserted here -->
                    </li>
                    <li>
                        <label for="major3">Major:</label>
                        <select name="major3" id="major3">
                            <option selected="selected" value="">Select a major</option>
                            <option value="COEN">Computer and Web Engineering</option>
                            <option value="BOIE">Bioengineering</option>
                            <option value="ELEN">Electrical Engineering</option>
                            <option value="MECH">Mechanical Engineering</option>
                            <option value="CENG">Civil Engineering</option>
                            <option value="ANTH">Anthropology</option>
                            <option value="ARTH">Art History</option>
                            <option value="ARTS">Studio Art</option>
                            <option value="BIOL">Biology</option>
                            <option value="CHEM">Chemistry</option>
                        </select>
                        <span id="major3Error"><?php //echo $major3Error; ?></span> <!-- Major 3 error will be inserted here -->
                    </li>
                    <li>
                        <label for="minor1">Minor:</label>
                        <select name="minor1" id="minor1">
                            <option selected="selected" value="">Select a minor</option>
                            <option value="COEN">Computer and Web Engineering</option>
                            <option value="BOIE">Bioengineering</option>
                            <option value="ELEN">Electrical Engineering</option>
                            <option value="MECH">Mechanical Engineering</option>
                            <option value="CENG">Civil Engineering</option>
                            <option value="ANTH">Anthropology</option>
                            <option value="ARTH">Art History</option>
                            <option value="ARTS">Studio Art</option>
                            <option value="BIOL">Biology</option>
                            <option value="CHEM">Chemistry</option>
                        </select>
                    </li>
                    <li>
                        <label for="minor2">Minor:</label>
                        <select name="minor2" id="minor2">
                            <option selected="selected" value="">Select a minor</option>
                            <option value="COEN">Computer and Web Engineering</option>
                            <option value="BOIE">Bioengineering</option>
                            <option value="ELEN">Electrical Engineering</option>
                            <option value="MECH">Mechanical Engineering</option>
                            <option value="CENG">Civil Engineering</option>
                            <option value="ANTH">Anthropology</option>
                            <option value="ARTH">Art History</option>
                            <option value="ARTS">Studio Art</option>
                            <option value="BIOL">Biology</option>
                            <option value="CHEM">Chemistry</option>
                        </select>
                        <span id="minor2Error"><?php //echo $minor2Error; ?></span> <!-- Minor 2 error will be inserted here -->
                    </li>
                    <li>
                        <label for="minor3">Minor:</label>
                        <select name="minor3" id="minor3">
                            <option selected="selected" value="">Select a minor</option>
                            <option value="COEN">Computer and Web Engineering</option>
                            <option value="BOIE">Bioengineering</option>
                            <option value="ELEN">Electrical Engineering</option>
                            <option value="MECH">Mechanical Engineering</option>
                            <option value="CENG">Civil Engineering</option>
                            <option value="ANTH">Anthropology</option>
                            <option value="ARTH">Art History</option>
                            <option value="ARTS">Studio Art</option>
                            <option value="BIOL">Biology</option>
                            <option value="CHEM">Chemistry</option>
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
                            <option value="University Villas">University Villas</option>
                            <option value="Sobrato">Sobrato</option>
                            <option value="Casa Italiana">Casa Italiana</option>
                            <option value="Swig">Swig</option>
                            <option value="Graham">Graham</option>
                        </select>
                    </li>
                </ul>
                <input type="hidden" name="submitted" value="true"/>
                <input type="submit" id="submitButton" value="Submit" onclick="submission()">
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