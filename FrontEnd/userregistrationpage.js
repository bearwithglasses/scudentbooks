/************************ Form validation **************************************/
function validation() {
    /********* Username **********/
    var username = document.getElementById("username").value; //Retrieves the value entered for username
    /* If username is empty, print a message and return false */
    if (username == "") 
    {
        return "usernameError1";
    }
    /* Checks if username entered is valid. Regex doesn't support spaces or commas and it can only be up to 30 characters
    Referenced source for regex code: http://stackoverflow.com/questions/15933727/javascript-regular-expression-for-usernames-no-spaces */
    else if (username.match(/^[-\w\.\$@\*\!]{1,30}$/) == null)
    {
        return "usernameError2";
    }
    /* Error is fixed, error message dissappears */
    else
    {
        document.getElementById("usernameError").innerHTML = ""; //Error is fixed, error message dissappears
    }

    /********* Password **********/
    var password = document.getElementById("password").value; //Retrieves the value entered for password
    /* If password is empty, print a message and return false */
    if (password == "") 
    {
        return "passwordError";
    }
    /* Error is fixed, error message dissappears */
    else 
    {
        document.getElementById("passwordError").innerHTML = "";
    }

    /********* Confirm password **********/
    var confirmPassword = document.getElementById("confirmPassword").value; //Retrieves the value entered for confirm password
    /* If confirm password is empty, print a message and return false */
    if (confirmPassword == "") 
    {
        return "confirmPasswordError1";
    }
    /* Confirm password doesn't match password */
    else if (confirmPassword != password)
    {
        return "confirmPasswordError2";
    }
    /* Error is fixed, error message dissappears */
    else 
    {
        document.getElementById("confirmPasswordError").innerHTML = "";
    }

    /********* First name **********/
    var firstName = document.getElementById("firstName").value; //Retrieves the value entered for first name
    /* If first name is empty, print a message and return false */
    if (firstName == "") 
    {
        return "firstNameError1";
    }
    /* Checks if first name entered is valid. Regex doesn't support numbers
    Referenced source for regex code: http://stackoverflow.com/questions/275160/regex-for-names */
    else if (firstName.match(/^[a-zA-Z]'?[- a-zA-Z]+$/) == null)
    {
        return "firstNameError2";
    }
    /* Error is fixed, error message dissappears */
    else 
    {
        document.getElementById("firstNameError").innerHTML = "";
    }

    /********* Middle name **********/
    var middleName = document.getElementById("middleName").value; //Retrieves the value entered for middle name
    /* If middle name is empty, do nothing */
    if (middleName == "")
    {
        document.getElementById("middleNameError").innerHTML = "";
    }
    /* Checks if middle name entered is valid. Regex doesn't support numbers 
    Referenced source for regex code: http://stackoverflow.com/questions/14715133/regular-expression-for-no-white-space-at-start-or-end-but-allow-white-space-in */
    else if (middleName.match(/^[-_a-zA-Z]+(\s+[-_a-zA-Z]+)*$/) == null)
    {
        return "middleNameError";
    }
    /* Error is fixed, error message dissappears */
    else 
    {
        document.getElementById("middleNameError").innerHTML = "";
    }

    /********* Last name **********/
    var lastName = document.getElementById("lastName").value; //Retrieves the value entered for last name
    /* If last name is empty, print a message and return false */
    if (lastName == "") 
    {
        return "lastNameError1";
    }
    /* Checks if last name entered is valid. Regex doesn't support numbers
    Referenced source for regex code: http://stackoverflow.com/questions/275160/regex-for-names */
    else if (lastName.match(/^[a-zA-Z]'?[- a-zA-Z]+$/) == null)
    {
        return "lastNameError2";
    }
    /* Error is fixed, error message dissappears */
    else 
    {
        document.getElementById("lastNameError").innerHTML = "";
    }

    /********* Email address **********/
    var emailAddress = document.getElementById("emailAddress").value; //Retrieves the value entered for email
    /* If email is empty, print a message and return false */
    if (emailAddress == "") 
    {
        return "emailAddressError1";
    }
    /* Checks if email entered is valid
    Referenced source for regex code: http://stackoverflow.com/questions/46155/validate-email-address-in-javascript */
    else if (emailAddress.match(/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/) == null)
    {
        return "emailAddressError2";
    }
    /* Error is fixed, error message dissappears */
    else 
    {
        document.getElementById("emailAddressError").innerHTML = "";
    }

    /********* Phone number **********/
    var phoneNumber = document.getElementById("phoneNumber").value; //Retrieves the value entered for phone number
    /* If phone number is empty, do nothing */
    if (phoneNumber == "")
    {
        document.getElementById("phoneNumberError").innerHTML = "";   
    }
    /* Checks if phone number entered is valid.
    Referenced source for regex code: http://www.authorcode.com/how-to-validate-phone-number-in-javascript/ */
    else if (phoneNumber.match(/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/) == null)
    {
        return "phoneNumberError";
    }
    /* Error is fixed, error message dissappears */
    else 
    {
        document.getElementById("phoneNumberError").innerHTML = "";
    }

    /********* Major 1 **********/
    var major1 = document.getElementById("major1").value; //Retrieves the value entered for major 1
    /* If major 1 hasn't been selected, print a message and return false */
    if (major1 == "" || major1 == "selectMajor1") 
    {
        return "major1Error";
    }
    /* Error is fixed, error message dissappears */
    else 
    {
        document.getElementById("major1Error").innerHTML = "";
    }

    /********* Major 2 **********/
    var major2 = document.getElementById("major2").value; //Retrieves the value entered for major 2
    /* Prints error message if major 2 is the same as 1 or 3 */
    if (major2 == major1 || major2 == major3) 
    {
        return "major2Error";
    }
    /* Error is fixed, error message dissappears */
    else 
    {
        document.getElementById("major2Error").innerHTML = "";
    }

    /********* Major 3 **********/
    var major3 = document.getElementById("major3").value; //Retrieves the value entered for major 3
    /* Prints error message if major 3 is the same as 1 or 2 */
    if (major3 == major1 || major3 == major2) 
    {
        return "major3Error1";
    }
    /* Prints error message if major 3 is selected before 2 */
    else if (major3 != "selectMajor3" && major2 == "selectMajor2")
    {
        return "major3Error2";
    }
    /* Error is fixed, error message dissappears */
    else 
    {
        document.getElementById("major3Error").innerHTML = "";
    }

    /********* Minor 1 **********/
    var minor1 = document.getElementById("minor1").value; //Retrieves the value entered for minor 1

    /********* Minor 2 **********/
    var minor2 = document.getElementById("minor2").value; //Retrieves the value entered for minor 2
    /* Prints error message if minor 2 is the same as 1 or 3 */
    if (minor2 == minor1 || minor2 == minor3) 
    {
        return "minor2Error1";
    }
    /* Prints error message if minor 2 is selected before 1 */
    else if (minor2 != "selectMinor2" && minor1 == "selectMinor1")
    {
        return "minor2Error2";
    }
    /* Error is fixed, error message dissappears */
    else 
    {
        document.getElementById("minor2Error").innerHTML = "";
    }

    /********* Minor 3 **********/
    var minor3 = document.getElementById("minor3").value; //Retrieves the value entered for minor 3
    /* Prints error message if minor 3 is the same as 1 or 2 */
    if (minor3 == minor1 || minor3 == minor2) 
    {
        return "minor3Error1";
    }
    /* Prints error message if minor 3 is selected before 2 */
    else if (minor3 != "selectMinor3" && minor2 == "selectMinor2")
    {
        return "minor3Error2";
    }
    /* Error is fixed, error message dissappears */
    else 
    {
        document.getElementById("minor3Error").innerHTML = "";
    }
}

/************************ Form submission **************************************/
function submission() {
    var valid = validation();
    if (valid == "usernameError1")
    {
        document.getElementById("usernameError").innerHTML = "This field is required"; //Displays error message if nothing is entered
        document.getElementById("username").focus(); //Focuses on text field
    }
    else if (valid == "usernameError2")
    {
        document.getElementById("usernameError").innerHTML = "Invalid entry"; //Displays error message if regex is entered incorrectly
        document.getElementById("username").focus(); //Focuses on text field
    }
    else if (valid == "passwordError")
    {
        document.getElementById("passwordError").innerHTML = "This field is required"; //Displays error message if nothing is entered
        document.getElementById("password").focus(); //Focuses on text field
    }
    else if (valid == "confirmPasswordError1")
    {
        document.getElementById("confirmPasswordError").innerHTML = "This field is required"; //Displays error message if nothing is entered
        document.getElementById("confirmPassword").focus(); //Focuses on text field
    }
    else if (valid == "confirmPasswordError2")
    {
        document.getElementById("confirmPasswordError").innerHTML = "Passwords do not match"; //Displays error message if passwords don't match
        document.getElementById("confirmPassword").focus(); //Focuses on text field
    }
    else if (valid == "firstNameError1")
    {
        document.getElementById("firstNameError").innerHTML = "This field is required"; //Displays error message if nothing is entered
        document.getElementById("firstName").focus(); //Focuses on text field
    }
    else if (valid == "firstNameError2")
    {
        document.getElementById("firstNameError").innerHTML = "Invalid entry"; //Displays error message if regex is entered incorrectly
        document.getElementById("firstName").focus(); //Focuses on text field
    }
    else if (valid == "middleNameError")
    {
        document.getElementById("middleNameError").innerHTML = "Invalid entry"; //Displays error message if regex is entered incorrectly
        document.getElementById("middleName").focus(); //Focuses on text field
    }
    else if (valid == "lastNameError1")
    {
        document.getElementById("lastNameError").innerHTML = "This field is required"; //Displays error message if nothing is entered
        document.getElementById("lastName").focus(); //Focuses on text field
    }
    else if (valid == "lastNameError2")
    {
        document.getElementById("lastNameError").innerHTML = "Invalid entry"; //Displays error message if regex is entered incorrectly
        document.getElementById("lastName").focus(); //Focuses on text field
    }
    else if (valid == "emailAddressError1")
    {
        document.getElementById("emailAddressError").innerHTML = "This field is required"; //Displays error message if nothing is entered
        document.getElementById("emailAddress").focus(); //Focuses on text field
    }
    else if (valid == "emailAddressError2")
    {
        document.getElementById("emailAddressError").innerHTML = "Invalid entry"; //Displays error message if regex is entered incorrectly
        document.getElementById("emailAddress").focus(); //Focuses on text field
    }
    else if (valid == "phoneNumberError")
    {
        document.getElementById("phoneNumberError").innerHTML = "Invalid entry"; //Displays error message if regex is entered incorrectly
        document.getElementById("phoneNumber").focus(); //Focuses on text field
    }
    else if (valid == "major1Error")
    {
        document.getElementById("major1Error").innerHTML = "This field is required"; //Displays error message if nothing is selected
        document.getElementById("major1").focus(); //Focuses on text field
    }
    else if (valid == "major2Error")
    {
        document.getElementById("major2Error").innerHTML = "Cannot have more than one of the same major"; //Displays error message if same major is selected again
        document.getElementById("major2").focus(); //Focuses on text field
    }
    else if (valid == "major3Error1")
    {
        document.getElementById("major3Error").innerHTML = "Cannot have more than one of the same major"; //Displays error message if same major is selected again
        document.getElementById("major3").focus(); //Focuses on text field
    }
    else if (valid == "major3Error2")
    {
        document.getElementById("major3Error").innerHTML = "Cannot select a third major before selecting a second major"; //Displays error message if third major is selected before second major
        document.getElementById("major3").focus(); //Focuses on text field
    }
    else if (valid == "minor2Error1")
    {
        document.getElementById("minor2Error").innerHTML = "Cannot have more than one of the same minor"; //Displays error message if same minor is selected again
        document.getElementById("minor2").focus(); //Focuses on text field
    }
    else if (valid == "minor2Error2")
    {
        document.getElementById("minor2Error").innerHTML = "Cannot select a second minor before selecting a first minor"; //Displays error message if second minor is selected before first minor
        document.getElementById("minor2").focus(); //Focuses on text field
    }
    else if (valid == "minor3Error1")
    {
        document.getElementById("minor3Error").innerHTML = "Cannot have more than one of the same minor"; //Displays error message if same minor is selected again
        document.getElementById("minor3").focus(); //Focuses on text field
    }
    else if (valid == "minor3Error2")
    {
        document.getElementById("minor3Error").innerHTML = "Cannot select a third minor before selecting a second minor"; //Displays error message if third minor is selected before second minor
        document.getElementById("minor3").focus(); //Focuses on text field
    }
}