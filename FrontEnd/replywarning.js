function sendInboxMessage() {
    var messagebox = document.getElementById("messagebox").value;
    
    if (messagebox == "")
    {
        var confirmMessage = confirm("Send message without a body?");
        if (confirmMessage)
        {
            document.getElementById("messagebox").value = "";
        }
        else
        {
            return false;
        }
    }
}