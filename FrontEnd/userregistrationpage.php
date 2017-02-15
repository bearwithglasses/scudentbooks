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
        <form id="registration" method="post">
            <h1>Sign Up to Become a Member here</h1>
            <p>* Required Field</p>
            <div id="formRegister">
                <ul>
                    <li>
                        <label for="username">*Username:</label>
                        <input type="text" id="username" name="username" placeholder="Username">
                    </li>
                    <li>
                        <label for="password">*Password:</label>
                        <input type="password" id="password" name="password" placeholder="Password">
                    </li>
                    <li>
                        <label for="confirmPassword">*Confirm Password:</label>
                        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password">
                    </li>
                    <li>
                        <label for="firstName">*First Name:</label>
                        <input type="text" id="firstName" name="firstName" placeholder="First Name">
                    </li>
                    <li>
                        <label for="middleName">Middle Name:</label>
                        <input type="text" id="middleName" name="middleName" placeholder="Middle Name">
                    </li>
                    <li>
                        <label for="lastName">*Last Name:</label>
                        <input type="text" id="lastName" name="lastName" placeholder="Last Name">
                    </li>
                    <li>
                        <label for="emailAddress">*Email Address:</label>
                        <input type="email" id="emailAddress" name="emailAddress" placeholder="Email Address">
                    </li>
                    <li>
                        <label for="phoneNumber">Phone Number:</label>
                        <input type="text" id="phoneNumber" name="phoneNumber" placeholder="Phone Number">
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
                <button type="submit" id="submitButton">Submit</button>
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