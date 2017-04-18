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
    /*
    $usernameError = $passwordError = $confirmPasswordError = $firstNameError = $middleNameError = $lastNameError = $emailAddressError = $phoneNumberError = $major1Error = $major2Error = $major3Error = $minor2Error = $minor3Error = "";
    $username = $password = $confirmPassword = $firstName = $middleName = $lastName = $emailAddress = $phoneNumber = $major1 = $major2 = $major3 = $minor1 = $minor2 = $minor3 = $year = $location = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //Username
        if (empty($_POST["username"]))
        {
            $usernameError = "Username is required";
        }
        else
        {
            $username = test_input($_POST["username"]);
            if (!preg_match("/^[-\w\.\$@\*\!]{1,30}$/", $username))
            {
                $usernameError = "Invalid entry";
            }
        }

        //Password
        if (empty($_POST["password"]))
        {
            $passwordError = "Password is required";
        }
        else
        {
            $password = test_input($_POST["password"]);
        }
        
        //Confirm Password
        if (empty($_POST["confirmPassword"]))
        {
            $confirmPasswordError = "Confirm password is required";
        }
        else
        {
            $confirmPassword = test_input($POST["confirmPassword"]);
            if ($_POST["confirmPassword"] != $_POST["password"])
            {
                $confirmPasswordError = "Passwords do not match";
            }
        }

        //First name
        if (empty($_POST["firstName"]))
        {
            $firstNameError = "First name is required";
        }
        else
        {
            $firstName = test_input($_POST["firstName"]);
            if (!preg_match("/^[a-zA-Z]'?[- a-zA-Z]+$/", $firstName))
            {
                $firstNameError = "Invalid entry";
            }
        }

        //Middle name
        if (empty($_POST["middleName"]))
        {
            $middleName = "";
        }
        else
        {
            $middleName = test_input($_POST["middleName"]);
            if (!preg_match("/^[a-zA-Z]'?[- a-zA-Z]+$/", $middleName))
            {
                $middleNameError = "Invalid entry";
            }    
        }
        
        //Last name
        if (empty($_POST["lastName"]))
        {
            $lastNameError = "Last name is required";
        }
        else
        {
            $lastName = test_input($_POST["lastName"]);
            if (!preg_match("/^[a-zA-Z]'?[- a-zA-Z]+$/", $lastName))
            {
                $lastNameError = "Invalid entry";
            }
        }

        //Email address
        if (empty($_POST["emailAddress"]))
        {
            $emailAddressError = "Email is required";
        }
        else
        {
            $emailAddress = test_input($_POST["emailAddress"]);
            if (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL))
            {
                $emailAddressError = "Invalid entry";
            }
        }

        //Phone number
        if (empty($_POST["phoneNumber"]))
        {
            $phoneNumber = "";
        }
        else
        {
            $phoneNumber = test_input($_POST["phoneNumber"]);
            if (!preg_match("/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/", $phoneNumber))
            {
                $phoneNumberError = "Invalid entry";
            }   
        }
        
        //Major 1
        if (!isset($_POST["major1"]))
        {
            $major1Error = "Major is required";
        }
        else
        {
            $major1 = test_input($_POST["major1"]);
            if ($_POST["major1"] = "selectMajor1")
            {
                $major1Error = "Major is required";   
            }
        }

        //Major 2
        if (!isset($_POST["major2"]))
        {
            $major2 = "";
        }
        else
        {
            $major2 = test_input($_POST["major2"]);
            if ($_POST["major2"] = "selectMajor2")
            {
                $major2 = "selectMajor2";
            }
            else if ($_POST["major2"] == $_POST['major1'] || $_POST["major2"] == $_POST["major3"])
            {
                $major2Error = "Cannot have more than one of the same major";
            }   
        }

        //Major 3
        if (!isset($_POST["major3"]))
        {
            $major3 = "";
        }
        else
        {
            $major3 = test_input($_POST["major3"]);
            if ($_POST["major3"] = "selectMajor3")
            {
                $major3 = "selectMajor3";
            }
            else if ($_POST["major3"] == $_POST['major1'] || $_POST["major3"] == $_POST["major2"])
            {
                $major3Error = "Cannot have more than one of the same major";
            }
            else if ($_POST["major3"] != "selectMajor3" && $_POST["major2"] == "selectMajor2")
            {
                $major3Error = "Cannot select a third major before selecting a second major";
            }   
        }

        //Minor 1
        if (!isset($_POST["minor1"]))
        {
            $minor1 = "";
        }
        else
        {
            $minor1 = test_input($POST["minor1"]);
            if ($_POST["minor1"] = "selectMinor1")
            {
                $minor1 = "selectMinor1";
            }
        }

        //Minor 2
        if (!isset($_POST["minor2"]))
        {
            $minor2 = "";
        }
        else
        {
            $minor2 = test_input($_POST["minor2"]);
            if ($_POST["minor2"] = "selectMinor2")
            {
                $minor2 = "selectMinor2";
            }
            else if ($_POST["minor2"] == $_POST['minor1'] || $_POST["minor2"] == $_POST["minor3"])
            {
                $minor2Error = "Cannot have more than one of the same minor";
            }
            else if ($_POST["minor2"] != "selectMinor2" && $_POST["minor1"] == "selectMinor1")
            {
                $minor2Error = "Cannot select a second minor before selecting a first minor";
            }   
        }

        //Minor 3
        if (!isset($_POST["minor3"]))
        {
            $minor3 = "";
        }
        else
        {
            $minor3 = test_input($_POST["minor3"]);
            if ($_POST["minor3"] = "selectMinor3")
            {
                $minor3 = "selectMinor3";
            }
            else if ($_POST["minor3"] == $_POST['minor1'] || $_POST["minor3"] == $_POST["minor2"])
            {
                $minor3Error = "Cannot have more than one of the same minor";
            }
            else if ($_POST["minor3"] != "selectMinor3" && $_POST["minor2"] == "selectMinor2")
            {
                $minor3Error = "Cannot select a third minor before selecting a second minor";
            }   
        }

        //Year
        if (!isset($_POST["year"]))
        {
            $year = "";
        }
        else
        {
            $year = test_input($_POST["year"]);
        }

        //Location
        if (!isset($_POST["location"]))
        {
            $location = "";
        }
        else
        {
            $location = test_input($_POST["location"]);
        }
    }
    */
?>

<!-- Navigation -->
    <div class="web_nav">
        <header class="logo">
            <div id="logo"><a href="homepage.html"><img alt="eCampus logo" src="images/eCampusLogo.png"></a></div>
        </header>

        <form class="searchbar">
            <span class="searchicon"><i></i></span>
            <input type="text" name="search" placeholder="Search...">
            <input type="button" class="button" value="Search">
            <a href="/" class="advancedsearch">Advanced</a>
        </form>

        <nav>
        <ul class="navlinks">
            <li><a href="/" class="web_link">Home</a></li>
            <li><a href="#" class="web_link">Sell</a></li>
            <li><a href="#" class="web_link">Inbox</a></li>
            <li><!--<div class="username_dropdown">
                <button onclick="userNameMenu()" class="usernamebutton">You</button></div>-->
            <a href="#" class="web_link">You</a>
            </li>
        </nav>
    </div>

<!-- Container that holds Main and Side divs -->
<div id="container">
    <div class="registrationForm">
        <form id="registration" action="userregistrationsubmitpage.php" method="post">
            <h1>Sign Up to Become a Member here</h1>
            <p>* Required Field</p>
            <div id="formRegister">
                <ul>
                    <li>
                        <label for="username">*Username:</label>
                        <input type="text" id="username" name="username" placeholder="Username">
                        <span id="usernameError"><?php //echo $usernameError; ?></span> <!-- Username error will be inserted here -->
                    </li>
                    <li>
                        <label for="password">*Password:</label>
                        <input type="password" id="password" name="password" placeholder="Password">
                        <span id="passwordError"><?php //echo $passwordError; ?></span> <!-- Password error will be inserted here -->
                    </li>
                    <li>
                        <label for="confirmPassword">*Confirm Password:</label>
                        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password">
                        <span id="confirmPasswordError"><?php //echo $confirmPasswordError; ?></span> <!-- Confirm password error will be inserted here -->
                    </li>
                    <li>
                        <label for="firstName">*First Name:</label>
                        <input type="text" id="firstName" name="firstName" placeholder="First Name">
                        <span id="firstNameError"><?php //echo $firstNameError; ?></span> <!-- First name error will be inserted here -->
                    </li>
                    <li>
                        <label for="middleName">Middle Name:</label>
                        <input type="text" id="middleName" name="middleName" placeholder="Middle Name">
                        <span id="middleNameError"><?php //echo $middleNameError; ?></span> <!-- Middle name error will be inserted here -->
                    </li>
                    <li>
                        <label for="lastName">*Last Name:</label>
                        <input type="text" id="lastName" name="lastName" placeholder="Last Name">
                        <span id="lastNameError"><?php //echo $lastNameError; ?></span> <!-- Last name error will be inserted here -->
                    </li>
                    <li>
                        <label for="emailAddress">*Email Address:</label>
                        <input type="email" id="emailAddress" name="emailAddress" placeholder="Email Address">
                        <span id="emailAddressError"><?php //echo $emailAddressError; ?></span> <!-- Email address error will be inserted here -->
                    </li>
                    <li>
                        <label for="phoneNumber">Phone Number:</label>
                        <input type="text" id="phoneNumber" name="phoneNumber" placeholder="Phone Number">
                        <span id="phoneNumberError"><?php //echo $phoneNumberError; ?></span> <!-- Phone number error will be inserted here -->
                    </li>
                    <li>
                        <label for="major1">*Major:</label>
                        <select name="major1" id="major1">
                            <option selected="selected" value="selectMajor1">Select a major</option>
                            <option value="Computer Engineering">Computer Engineering</option>
                            <option value="Electrical Engineering">Electrical Engineering</option>
                            <option value="Web Design and Engineering">Web Design and Engineering</option>
                            <option value="Biology">Biology</option>
                            <option value="Marketing">Marketing</option>
                        </select>
                        <span id="major1Error"><?php //echo $major1Error; ?></span> <!-- Major 1 error will be inserted here -->
                    </li>
                    <li>
                        <label for="major2">Major:</label>
                        <select name="major2" id="major2">
                            <option selected="selected" value="selectMajor2">Select a major</option>
                            <option value="Computer Engineering">Computer Engineering</option>
                            <option value="Electrical Engineering">Electrical Engineering</option>
                            <option value="Web Design and Engineering">Web Design and Engineering</option>
                            <option value="Biology">Biology</option>
                            <option value="Marketing">Marketing</option>
                        </select>
                        <span id="major2Error"><?php //echo $major2Error; ?></span> <!-- Major 2 error will be inserted here -->
                    </li>
                    <li>
                        <label for="major3">Major:</label>
                        <select name="major3" id="major3">
                            <option selected="selected" value="selectMajor3">Select a major</option>
                            <option value="Computer Engineering">Computer Engineering</option>
                            <option value="Electrical Engineering">Electrical Engineering</option>
                            <option value="Web Design and Engineering">Web Design and Engineering</option>
                            <option value="Biology">Biology</option>
                            <option value="Marketing">Marketing</option>
                        </select>
                        <span id="major3Error"><?php //echo $major3Error; ?></span> <!-- Major 3 error will be inserted here -->
                    </li>
                    <li>
                        <label for="minor1">Minor:</label>
                        <select name="minor1" id="minor1">
                            <option selected="selected" value="selectMinor1">Select a minor</option>
                            <option value="Computer Engineering">Computer Engineering</option>
                            <option value="Electrical Engineering">Electrical Engineering</option>
                            <option value="Web Design and Engineering">Web Design and Engineering</option>
                            <option value="Biology">Biology</option>
                            <option value="Marketing">Marketing</option>
                        </select>
                    </li>
                    <li>
                        <label for="minor2">Minor:</label>
                        <select name="minor2" id="minor2">
                            <option selected="selected" value="selectMinor2">Select a minor</option>
                            <option value="Computer Engineering">Computer Engineering</option>
                            <option value="Electrical Engineering">Electrical Engineering</option>
                            <option value="Web Design and Engineering">Web Design and Engineering</option>
                            <option value="Biology">Biology</option>
                            <option value="Marketing">Marketing</option>
                        </select>
                        <span id="minor2Error"><?php //echo $minor2Error; ?></span> <!-- Minor 2 error will be inserted here -->
                    </li>
                    <li>
                        <label for="minor3">Minor:</label>
                        <select name="minor3" id="minor3">
                            <option selected="selected" value="selectMinor3">Select a minor</option>
                            <option value="Computer Engineering">Computer Engineering</option>
                            <option value="Electrical Engineering">Electrical Engineering</option>
                            <option value="Web Design and Engineering">Web Design and Engineering</option>
                            <option value="Biology">Biology</option>
                            <option value="Marketing">Marketing</option>
                        </select>
                        <span id="minor3Error"><?php //echo $minor3Error; ?></span> <!-- Minor 3 error will be inserted here -->
                    </li>
                    <li>
                        <label for="year">Year:</label>
                        <select name="year" id="year">
                            <option selected="selected" value="selectYear">Select a year</option>
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
                            <option selected="selected" value="selectLocation">Select a location</option>
                            <option value="University Villas">University Villas</option>
                            <option value="Sobrato">Sobrato</option>
                            <option value="Casa Italiana">Casa Italiana</option>
                            <option value="Swig">Swig</option>
                            <option value="Graham">Graham</option>
                        </select>
                    </li>
                </ul>
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
