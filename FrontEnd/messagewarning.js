function sendMessage() {
    var subject = document.getElementById("subject").value; //Retrieves the value entered for subject
    var messagebox = document.getElementById("messagebox").value; //Retrieves the value entered for body 

    if (subject == "") //Confirmation window appears if subject is empty
    {
        var confirmSubject = confirm("Send message without a subject?");
        if (confirmSubject) //If user clicks ok, then sends message with empty subject
        {
            document.getElementById("subject").value = "(no subject)";
        }
        else //If user clicks cancel, then stays on page
        {
            return false;
        }
    }

    if (messagebox == "") //Confirmation window appears if body is empty
    {
        var confirmMessage = confirm("Send message without a body?");
        if (confirmMessage) //If user clicks ok, then sends message with empty body
        {
            document.getElementById("messagebox").value = "";
        }
        else
        {
            document.getElementById("subject").value = subject;
            return false;
        }
    }
}