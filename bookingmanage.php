<html>


  <head>
    <meta charset="utf-8">
    <title>Booking Administration</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>    
    <script src="//code.jquery.com/ui/1.9.2/jquery-ui.js"></script>


    <link rel="stylesheet" type="text/css" href="style.css" media="screen" />



  

    <script>



      //Function to set up the Jquery datepicker used within the web page, add's the options to 
      //pick month and year, also forces minimun date to be today's date + 2 days.
      //Finally sets the format to Day - Month - Year as per standard British.
      $(function() {
        $( "#date_input" ).datepicker({
         changeMonth: true,
         changeYear: true,
         minDate: 0+2,
         dateFormat: "dd-mm-yy"
        });
      });

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
          date = $("#date_input").val(); 
          startTime = $("#startTime").val();
          endTime = $("#endTime").val();
          room = $("#room").val();
          costEstimate = $("#costEstimate").val();
          });
      });


      //Function ready on page load, when user clicks the submit button, loads into the over-arching
      //or main Div the web page that will confirm with the user a booking request has been submitted
      //Passes to this webpage all the variables collected from the webpages input boxes.
      //Relevant error checking is in place
      $(document).ready(function(){
        $("#Submit").on("click", function(){
          $("#superDiv").load("manual_booking.php", {fname:fname, lname:lname, mobile:mobile, email:email, date:date, startTime:startTime
          , endTime:endTime, room:room, costEstimate:costEstimate} , function(responseTxt,statusTxt,xhr){
            if(statusTxt=="error")
              alert("Error: "+xhr.status+": "+xhr.statusText)
          });
        });
      }); 





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
          
          $("#superDiv").load("booking_confrej.php", {booking_ID:booking_ID,
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
          $("#superDiv").load("booking_confrej.php", {booking_ID:booking_ID, booking_Status:booking_Status}, function(responseTxt,statusTxt,xhr){
            if(statusTxt=="error")
              alert("Error: "+xhr.status+": "+xhr.statusText)
          });
	      } 
        else {
         // txt = "You pressed Cancel!";
        //If the user cancels the box then nothing happens
	      }	
      }



      function cancFunc(booking_ID) {
  
        // If the user clicked to cancel a booking
        var click =confirm("Press Ok to cancel booking!")
        var booking_Status = "Cancelled"
        if (click == true) {
          // txt = "You pressed OK!"; 
          $("#superDiv").load("booking_cancelled.php", {booking_ID:booking_ID, booking_Status:booking_Status}, function(responseTxt,statusTxt,xhr){
            if(statusTxt=="error")
              alert("Error: "+xhr.status+": "+xhr.statusText)
          });
    
        } 
        else {
          // txt = "You pressed Cancel!";
          //If the user cancels the box then nothing happens
        }
      }



      function alterRoomFuncs(booking_ID) {
  
        
        var room_change_ID = "room_change" + booking_ID
        var requested_room_ID = "requested_room" + booking_ID
        var alter_button_ID = "alter_room" + booking_ID
        var room_available_ID = "room_available" + booking_ID

        
       
        document.getElementById(room_change_ID).style.display = "inline"
        document.getElementById(requested_room_ID).style.display = "none"
        document.getElementById(alter_button_ID).style.display = "none"
        document.getElementById(room_available_ID).style.display = "none"

      }
    </script>

  </head>

  <body>
    <div id="superDiv">
      <div class="wrapper">
        <div id="top" class="left" >
          <?php
            $con=mysqli_connect("localhost","root","cake123","polestar");   
            $result = mysqli_query($con, "SELECT * FROM requested_Bookings WHERE status = 'Accepted' AND booking_Date = DATE(NOW())");
            echo '<h5> The following are todays confirmed bookings:</h5>';
            
            while($row = mysqli_fetch_array($result)) {
            # Run a loop that fetches everything fro mthe query.

              $id = $row['id']; 
              $fname["$id"] = $row['fname'];
              $lname["$id"] = $row['lname'];
              $mobile["$id"] = $row['mobile'];
              $date["$id"] = $row['booking_Date'];
              $start_Time["$id"] = $row['start_Time'];
              $end_Time["$id"] = $row['end_Time'];
              $room["$id"] = $row['room'];
              $booking_id["$id"] = $id;
              
              $formatDate = DateTime::createFromFormat('Y-m-d', $date["$id"]);
              $newdate = $formatDate->format('l jS F Y');

              //Reformats the start time to a more view friendly format.
              $format_ST = DateTime::createFromFormat('H:i:s', $start_Time["$id"]);
              $start_Time["$id"] = $format_ST->format('g:i a');

              //Reformats the end time to a more view friendly format.
              $format_ET = DateTime::createFromFormat('H:i:s', $end_Time["$id"]);
              $end_Time["$id"] = $format_ET->format('g:i a');

    
              echo '<!-- BEGIN content -->
                <div id="accepted_Bookings">
                <p>
                </br>
                <p>Name : '.$fname["{$id}"] . ' '.$lname["{$id}"].' <br> 
                Phone Number : '.$mobile["{$id}"].' </br>
                Date : '.$newdate.' </br>
                Time : '.$start_Time["$id"].' to '.$end_Time["{$id}"].' </br>
                Requested room : '.$room["{$id}"].' </br>
                Booking ID: '.$booking_id["{$id}"].' </br>  
                <button type="button" id="'.$booking_id["{$id}"].'" 
                onclick="cancFunc('.$booking_id["{$id}"].')">Cancel</button>
                </div>'
                ;
              }
          ?>
        </div>


        <div id="top" class="right">
          <?php 
            #Connects to the database
            $con=mysqli_connect("localhost","root","cake123","polestar"); 
            #Loads the bookings that have had inital reciept emails sent out
            $result = mysqli_query($con, "SELECT * FROM requested_Bookings WHERE status = 'Reciept'"); 
      
            echo '<h5>Unconfirmed bookings.</h5> </br>';
            while($row = mysqli_fetch_array($result)) {
            # Run a loop that fetches everything from the query.

              //Stores each column gathered from the query in an array with a corresponding name.
              $id = $row['id']; 
              $fname["$id"] = $row['fname'];
              $lname["$id"] = $row['lname'];
              $mobile["$id"] = $row['mobile'];
              $date["$id"] = $row['booking_Date'];
              $start_Time["$id"] = $row['start_Time'];
              $end_Time["$id"] = $row['end_Time'];
              $room["$id"] = $row['room'];
              $booking_id["$id"] = $id;
          
              //Reformats the date to a more view friendly format.
              $formatDate = DateTime::createFromFormat('Y-m-d', $date["$id"]);
              $newdate = $formatDate->format('l jS F Y');

              //Reformats the start time to a more view friendly format.
              $format_ST = DateTime::createFromFormat('H:i:s', $start_Time["$id"]);
              $fstart_Time["$id"] = $format_ST->format('g:i a');

              //Reformats the end time to a more view friendly format.
              $format_ET = DateTime::createFromFormat('H:i:s', $end_Time["$id"]);
              $fend_Time["$id"] = $format_ET->format('g:i a');


              $all_rooms = array("Red", "Blue", "Green", "Yellow");



              //Small query that checks if the room that has been requested has already been confirmed 
              $date_chosen = $date["$id"];
              $room_chosen = $room["$id"];
              $sTime_chosen = $start_Time["$id"];
              $eTime_chosen = $end_Time["$id"];
              $query_Room = mysqli_query($con, "SELECT * FROM requested_Bookings WHERE 
                status = 'Accepted' AND room = '$room_chosen' and booking_Date = '$date_chosen' AND
                ((start_Time >= '$sTime_chosen' AND start_Time < '$eTime_chosen') or
                (end_Time > '$sTime_chosen' AND end_Time <= '$eTime_chosen') 
                )
                "); 
              $num_results = mysqli_num_rows($query_Room);

              if ($num_results > 0){
                

                $room_status = 'The room is unavailable.';

                //Unsets the current selected room, from the list of all_rooms
                //so that it will later be unavailable for selection in the drop down menu.
                if (($key = array_search($room_chosen, $all_rooms)) !== false) {
                unset($all_rooms[$key]);



                //If the room requested is unavailable, the select box should only show
                //options that are available.
                //Loop runs through each room ..
                foreach($all_rooms as $val) {

                  //Query that will check if there is a room clash for each of the rooms.
                  $query_Room = mysqli_query($con, "SELECT * FROM requested_Bookings WHERE 
                  status = 'Accepted' AND room = '$val' and booking_Date = '$date_chosen' AND
                  ((start_Time >= '$sTime_chosen' AND start_Time < '$eTime_chosen') or
                  (end_Time > '$sTime_chosen' AND end_Time <= '$eTime_chosen') 
                  )
                  "); 
                    
                  //Checks if any results have been returned from the query.
                  $num_results = mysqli_num_rows($query_Room);   

                  //If the query returned any results, unset that room from the list.
                  if ($num_results > 0){
                    if (($key = array_search($val, $all_rooms)) !== false) {
                      unset($all_rooms[$key]);
                    }

                  }
                }

                //Run a loop that uses each key from all_rooms and runs a query for each of 
                //them to check if they should be unset from all_rooms




                }

              }
              else{
                $room_status = 'The room is available.';
              }

              
               
              echo '<!-- BEGIN content -->
                <div id="booking_Requests">       
                  
                  <p id="pFname'.$booking_id["{$id}"].'"> Name : '.$fname["{$id}"] . ' '.$lname["{$id}"].' </p>
                    Phone Number : '.$mobile["{$id}"].' </br>
                    Date : '.$newdate.' </br>
                    Time : '.$fstart_Time["$id"].' to '.$fend_Time["{$id}"].' </br>

                    <!-- Displays the requested room -->
                    Requested room : <label id = "requested_room'.$booking_id["{$id}"].'" visible>'.$room["{$id}"].' </label>

                    <!-- Hidden Select box that is displayed when user clicks the alter button -->

                    '?>

                    <?php
                      echo '<select id = "room_change'.$booking_id["{$id}"].'" hidden>';         

                      foreach($all_rooms as $val) {
                        echo "<option>$val</option>"; // OR 
                      }
                    ?>
                    
                    </select>
          

                    <?php echo '
                 

                    <!-- Label that dispays whether or not the room is available -->
                    <label id = "room_available'.$booking_id["{$id}"].'"> |||| '.$room_status.'</label> 

                    <!-- Button that allows the user to alter the selected room, calls the function 
                    alterRoomFunc -->
                    <button type ="button" id = "alter_room'.$booking_id["{$id}"].'"
                    onclick="alterRoomFuncs('.$booking_id["{$id}"].')"> Alter </button>

                    </br> 

                    Booking ID: '.$booking_id["{$id}"].' </br>
                    <button type="button" id="'.$booking_id["{$id}"].'" 
                    onclick="accFunc('.$booking_id["{$id}"].')">Accept</button>
                    <button type="button" id="'.$booking_id["{$id}"].'" 
                    onclick="rejFunc('.$booking_id["{$id}"].')">Reject</button>
                  </p>
                  </br>
                </div>
                ' 
              ;
            }
          ?>





</div>
<div id="timeline" class="clear">
<p>timeline Displaying Rooms and busy times jQuery?</p>
</div>

<?php 


			require("common.php");
    
    // At the top of the page we check to see whether the user is logged in or not
    if(empty($_SESSION['user']))
    {
        // If they are not, we redirect them to the login page.
        header("Location: login.php");
        
        // Remember that this die statement is absolutely critical.  Without it,
        // people can view your members-only content without logging in.
        die("Redirecting to login.php");
    }
			

    		

       

    		?>
</div>
<div id="inputDiv">

      <p>Manually added bookings will be auto accepted, confirmation emails will be sent to both 
      the administrator and the customer</p>
      <p>First Name: <input type="text" id="fname"></input> </p>
      <p>Last Name : <input type="text" id="lname"></input></p>
      <p>Mobile Number : <input type="text" id="mobile"></input></p>
      <p>Email : <input type="text" id="email"></p>
      <p>Date of Booking: <input type="text" id="date_input"></p>

      <p>Start Time: 
       <select id="startTime">
         <option value = "09:00">09:00</option>
         <option value = "09:30">09:30</option>
         <option value = "10:00">10:00</option>
       </select>
      </p>

      <p>End Time:
       <select id="endTime">
        <option value = "09:30">09:30</option>
        <option value = "10:00">10:00</option>
       </select>
      </p>


    
      <p>Room Requested:
        <select id="room">
          <option value="Red">Red</option>
          <option value="Blue">Blue</option>
          <option value="Yellow">Yellow</option>
          <option value="Green">Green</option>
        </select> 
      </p>

      <!-- Requires Implementation
      <p>Equipment Required:</p>
      <p id ="costEstimate">Cost Estimate: </p>
      -->
 
    
    </div>
<p id="Submit">Submit</p> 
<a href="logout.php">Logout</a>
</body>
</html>