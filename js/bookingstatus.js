  function accFunc(booking_ID) {

        //Sets the new_room variable to blank each time the accept function is called
        new_room = ""

  
        //A confirm message is presented to the user.        
        var click =confirm("Press Ok to confirm booking!")
        // If the user clicked to accept the booking the booking_status is set to Accepted.
        var booking_Status = "Accepted"


        //The variable room_change_sel is used to identify the corresponding Select box that is part of 
        //the same booking as the 
        //accept button that has just been pressed.
        room_change_sel = "room_change"+booking_ID;

        //The room_change_sel select button is only available if the user has pressed the adjust button.
        //As such the variable new_room will only be updated if the select box has been displayed to the user.
        if (document.getElementById(room_change_sel).style.display = "inline"){
           new_room = document.getElementById(room_change_sel).options
           [document.getElementById(room_change_sel).selectedIndex].value;        
        }

        //If the user has accepted the confirmation box
        if (click == true) {

          //If the room wasn't adjusted and was kept at it's original value
          //Then it'll be set to the value of the room paragraph.
          if (new_room == "")
          {
              var requested_room_ID = "requested_room" + booking_ID;
              new_room = document.getElementById(requested_room_ID).innerHTML;

          }
          
          $(".booking_Requests").load("booking_confrej.php", {booking_ID:booking_ID,
           booking_Status: booking_Status, new_room:new_room}, function(responseTxt,statusTxt,xhr){
            if(statusTxt=="error")
            alert("Error: "+xhr.status+": "+xhr.statusText)
          });
    
        } 
        else {
          // txt = "You pressed Cancel!";
          //If the user cancels the box then nothing happens
        }
      }


      function rejFunc(booking_ID) {

        // If the user clicked to confirm true
        var click =confirm("Press Ok to reject booking!")
        var booking_Status = "Rejected"
        if (click == true) {
          // txt = "You pressed OK!"; 
          $(".left").load("booking_confrej.php", {booking_ID:booking_ID, booking_Status:booking_Status}, function(responseTxt,statusTxt,xhr){
            if(statusTxt=="error")
              alert("Error: "+xhr.status+": "+xhr.statusText)
          });
        } 
        else {
         // txt = "You pressed Cancel!";
        //If the user cancels the box then nothing happens
        } 
      }


      //function delayedRedirect(){
    //window.location = "bookingmanage.php"
}


      function cancFunc(booking_ID) {
  
        // If the user clicked to cancel a booking
        var click =confirm("Press Ok to cancel booking!")
        var booking_Status = "Cancelled"
        if (click == true) {
          // txt = "You pressed OK!"; 
          $(".left").load("booking_cancelled.php", {booking_ID:booking_ID}, function(responseTxt,statusTxt,xhr){
            if(statusTxt=="error")
              alert("Error: "+xhr.status+": "+xhr.statusText)
          });
    
        } 
        else {
          // txt = "You pressed Cancel!";
          //If the user cancels the box then nothing happens
        }
        setTimeout('delayedRedirect()', 6000)
      }