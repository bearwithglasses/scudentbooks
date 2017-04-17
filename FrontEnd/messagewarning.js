function sendMessage() {
    var subject = document.getElementById("subject").value; //Retrieves the value entered for subject
    var messagebox = document.getElementById("messagebox").value; //Retrieves the value entered for body

    if (subject == "") //Alerts user if subject is empty
    {
        alert("Send message without a subject?");
    }
    else if (messagebox == "") //Alerts user if body is empty
    {
        alert("Send message without a body?");
    }
}