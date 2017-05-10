
/************* Popup Box Coding ****************/

var modal = document.getElementById("popupbox"); //Get the popup box for sending messages
var modalimage = document.getElementById("popupimage"); //Get the popup box for book images
var open = document.getElementById("messagebutton"); //Get the button that opens the popup ("Send Message")
var close = document.getElementById("closemessage"); //Get the button that closes the popup ("Close Message")
var close2 = document.getElementById("closemessage2"); //Get the button that closes the popup ("Close Message")

// Photos
// When clicking on the main image in the book listing, have the full view pop up
function openImage(element) {
  document.getElementById("mainimagepopup").src = element.src;
  document.getElementById("popupimage").style.display = "block";
}

// Messaging
// When a user clicks on the open button, open the modal
open.onclick = function() {
    modal.style.display = "block";
}
// When a user clicks on the close button, close the modal
close.onclick = function() {
    $(modal).fadeToggle("2000");
}

close2.onclick = function() {
    $(modalimage).fadeToggle("2000");
}

// When the user clicks anywhere outside of the popup box, close it
window.onclick = function(event) {
    if (event.target == modal) {
        //modal.style.display = "none";
        $(modal).fadeToggle("2000");
    }
    if (event.target == modalimage) {
        //modalimage.style.display = "none";
        $(modalimage).fadeToggle("2000");
    }
}


/************* Book Listing Photo Slideshow Coding ****************/

// used W3.CSS slideshow code as reference

var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function currentDiv(n) {
  showDivs(slideIndex = n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("bookpic");
  var thumbnails = document.getElementsByClassName("opacity");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  for (i = 0; i < thumbnails.length; i++) {
     thumbnails[i].className = thumbnails[i].className.replace("opacity-off", "");
  }
  x[slideIndex-1].style.display = "block";
  thumbnails[slideIndex-1].className += "opacity-off";
}

