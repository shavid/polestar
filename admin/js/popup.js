// OPENS AND CLOSES MANUALBOOKING DIV //PSEUDO
// If SelectedBooking windows is open, close it and open Manual Booking. or just open manual booking.
  $(document).ready(function() {
  $("a#manual-booking-button").click(function(){
    if ($("div#selectedBooking").is(':visible')) {
      $("div#selectedBooking").fadeOut(500);
      $("div#manualBooking").fadeIn(500);
	  $("div.overlay").fadeIn(500);
    }
    else {
  $("div#manualBooking").fadeIn(500);}
  $("div.overlay").fadeIn(500);
});});



// OPENS AND CLOSES THE SELECTEDBOOKING DIV - u fucking wot //
//
        function selectedPopup(bookingID, bookingTime) {
      if ($('div#manualBooking').is(':visible')) {
		  $("div.overlay").fadeIn(500);
        $('div#manualBooking').fadeOut(500);
        $("div#selectedBooking").fadeIn(500);
     	$("#selectedBooking-info").load("booking_popup.php", 
          {bookingID:bookingID, bookingTime:bookingTime}, 
          function(responseTxt,statusTxt,xhr){
            if(statusTxt=="error")
              alert("Error: "+xhr.status+": "+xhr.statusText)
          });
        }
      else{
		$("div.overlay").fadeIn(500);
		$("div#selectedBooking").fadeIn(500);
      	$("#selectedBooking-info").load("booking_popup.php", 
          {bookingID:bookingID, bookingTime:bookingTime}, 
          function(responseTxt,statusTxt,xhr){
            if(statusTxt=="error")
              alert("Error: "+xhr.status+": "+xhr.statusText)
          });};
//ADD USER POPUP - NOT WORKING
$(document).ready(function() {
  $("a#add-user-button").click(function(){
    if ($("div#editUser-container").is(':visible')) {
      $("div#editUser-container").fadeOut(500);
      $("div#addUser-container").fadeIn(500);
	  $("div.overlay").fadeIn(500);
    }
    else {
  $("div#addUser-container").fadeIn(500);}
  $("div.overlay").fadeIn(500);
});});
 
 //EDIT USER POPUP -NOT WORKING
 $(document).ready(function editUserPopup() {
    if ($("div#addUser-container").is(':visible')) {
      $("div#addUser-container").fadeOut(500);
      $("div#editUser-container").fadeIn(500);
	  $("div.overlay").fadeIn(500);
    }
    else {
  $("div#editUser-container").fadeIn(500);}
  $("div.overlay").fadeIn(500);
});
//CLOSES ALL POPUPS
$("button.close-popup").click(function(){
    $("div.overlay").fadeOut(500);
	$("div.popup-container").fadeOut(500);
	});
//Click outside the popup should close it!
$("div.overlay").click(function(){
	$("div.overlay").fadeOut(500);
	$("div.popup-container").fadeOut(500); 
});
};
		
//THIS IS MESSY AS FUCK.^^^^^^^^^^^^
//Also it doesnt work.. I've spent a couple of hours trying to fix it with no avail.
//Problem:
//	When freshly loading index.php kicking on 'Add Booking' opens popup.
//	However the close button does not close it.
//	If click on the table and open 'Selected Booking' popup before clicking 'Add Booking' it closes fine.
//	I'm stumped.


//PERHAPS THIS CAN BE USED TO OPEN THE MANUAL POPUP
//THE CODE SHOULD BE RIGHT HOWEVER IT NEEDS TERMINATING CORRECTLY
//function manualPopup(bookingID, bookingTime) {
//      if ($('div#selectedBooking').is(':visible')) {
//		  $("div.overlay").fadeIn(500);
//        $('div#selectedBooking').fadeOut(500);
//        $("div#manualBooking").fadeIn(500);
//     	$("#manualBooking-info").load("booking_popup.php", 
//          {bookingID:bookingID, bookingTime:bookingTime}, 
//          function(responseTxt,statusTxt,xhr){
//            if(statusTxt=="error")
//              alert("Error: "+xhr.status+": "+xhr.statusText)
//          });
//        }
//      else{
//		$("div.overlay").fadeIn(500);
//		$("div#manualBooking").fadeIn(500);
//      	$("#manualBooking-info").load("booking_popup.php", 
//          {bookingID:bookingID, bookingTime:bookingTime}, 
//          function(responseTxt,statusTxt,xhr){
//            if(statusTxt=="error")
//              alert("Error: "+xhr.status+": "+xhr.statusText)
//          });
//	  