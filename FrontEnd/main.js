$( ".icon" ).click(function() {
	$( "#links" ).toggle();
});

//Toggle userlinks when user is logged in
$( "#userdropdown" ).click(function() {
	$( "#userlinks" ).toggle();
});

//Used from http://stackoverflow.com/questions/13831064/toggle-hide-item-when-click-outside-of-the-div
//Stop event propagations
$(document).on("click", function () {
    $("#userlinks").hide();
});

$("#userlinks").on("click", function (event) {
    event.stopPropagation();
});

$("#userdropdown").on("click", function (event) {
    event.stopPropagation();
});

//Confirmation popup to confirm deleting a book
$('.deletebook').click(function(){
    return confirm("Are you sure you want to delete this book?");
})
