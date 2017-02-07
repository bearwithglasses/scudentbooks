var modal = document.getElementById("popupbox"); //Get the popup box (the modal)
var open = document.getElementById("messagebutton"); //Get the button that opens the popup ("Send Message")
var close = document.getElementById("closemessage"); //Get the button that closes the popup ("Close Message")

// When a user clicks on the open button, open the modal
open.onclick = function() {
    modal.style.display = "block";
}
// When a user clicks on the close button, open the modal
close.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the popup box, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}