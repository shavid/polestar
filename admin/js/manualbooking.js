
      //Function that is active on the page load. 
      //When an element contained in the main input div is changed
      //Make variables equal to the values of the corresponding input boxes 
      //Note to self, can probably make this more efficient so it only executes once the page is
      //submitted and not everytime something is changed.
      $(document).ready(function(){
        $('#inputDiv').on('change', function (e) {
          fname = $("#fname").val();
          lname = $("#lname").val();
          mobile = $("#mobile").val();
          email = $("#email").val();
          thedate = $("#manual_book_date").val(); 
          startTime = $("#startTime").val();
          endTime = $("#endTime").val();
          room = $("#room").val();
		  band_Name = $("#band_Name").val();
          
          });
      });

      $(document).ready(function(){
        $("#Submit").on("click", function(){
          $("#inputDiv").load("booking_add.php", {fname:fname, lname:lname,band_Name:band_Name, mobile:mobile, email:email, thedate:thedate, startTime:startTime
          , endTime:endTime, room:room} , function(responseTxt,statusTxt,xhr){
            if(statusTxt=="error")
              alert("Error: "+xhr.status+": "+xhr.statusText)
          });
        });
      }); 


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
        function testfunc(bookingID, bookingTime) {
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