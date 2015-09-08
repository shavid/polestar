
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



<html>




  <head>
    <meta charset="utf-8">
    <title>Booking Administration</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>    
    <script src="//code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
       <script type="text/javascript" src="moment.js"></script>

    <link rel="stylesheet" type="text/css" href="style.css" media="screen" />



  

    <script>

   //   $(function () {
 //var isMouseDown = false;
 // $("#the_table td")
  //  .mousedown(function () {
  //    isMouseDown = true;
   //   first_cell = $(this).attr('id');
   //   $(this).toggleClass("highlighted");
      
     
    //  return false; // prevent text selection
   // })
   // .mouseover(function () {
   //  if (isMouseDown) {
   //     $(this).toggleClass("highlighted");
   //   }
   // });
  
  //$(document)
   // .mouseup(function () {
    //  isMouseDown = false;
   // });
//});

      //Function to set up the Jquery datepicker used within the web page, add's the options to 
      //pick month and year, also forces minimun date to be today's date + 2 days.
      //Finally sets the format to Day - Month - Year as per standard British.
      $(function() {
        $( ".date_input" ).datepicker({
         changeMonth: true,
         changeYear: true,
         minDate: 0,
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
          thedate = $("#manual_book_date").val(); 
          startTime = $("#startTime").val();
          endTime = $("#endTime").val();
          room = $("#room").val();
          
          });
      });

      
      


      $(document).ready(function(){
        $("#Submit").on("click", function(){
          $("#inputDiv").load("manual_booking.php", {fname:fname, lname:lname, mobile:mobile, email:email, thedate:thedate, startTime:startTime
          , endTime:endTime, room:room} , function(responseTxt,statusTxt,xhr){
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
          $(".left").load("booking_cancelled.php", {booking_ID:booking_ID}, function(responseTxt,statusTxt,xhr){
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
  
        //Function that's called when the user clicks the alter button.

        var room_change_ID = "room_change" + booking_ID
        var requested_room_ID = "requested_room" + booking_ID
        var alter_button_ID = "alter_room" + booking_ID
        var room_available_ID = "room_available" + booking_ID

        
       
        document.getElementById(room_change_ID).style.display = "inline"
        document.getElementById(requested_room_ID).style.display = "none"
        document.getElementById(alter_button_ID).style.display = "none"
        document.getElementById(room_available_ID).style.display = "none"

        


      }


      function testfunc(bookingID) {
  

      $("#selectedBooking").load("phptest.php", {bookingID:bookingID}, function(responseTxt,statusTxt,xhr){
            if(statusTxt=="error")
              alert("Error: "+xhr.status+": "+xhr.statusText)
          });
     

      }
	//RESTING WAITING TO BE INTEGRATED...
	//, first_cell:first_cell

      function changedate() {
  
      chosendate = $("#grid_datepicker").val();

      $("#timeline").load("select.php", {chosendate:chosendate}, function(responseTxt,statusTxt,xhr){
            if(statusTxt=="error")
              alert("Error: "+xhr.status+": "+xhr.statusText)
          });
     
      }


      function todayFunc() {
  
      chosendate = moment().format('YYYY-MM-DD'); 

      $("#timeline").load("select.php", {chosendate:chosendate}, function(responseTxt,statusTxt,xhr){
            if(statusTxt=="error")
              alert("Error: "+xhr.status+": "+xhr.statusText)
          });
     
      }


      function tomorrowFunc() {


      var today = moment();
      var tomorrow = today.add('days', 1);
      chosendate = moment(tomorrow).format("YYYY-MM-DD");
                   
      $("#timeline").load("select.php", {chosendate:chosendate}, function(responseTxt,statusTxt,xhr){
            if(statusTxt=="error")
              alert("Error: "+xhr.status+": "+xhr.statusText)
         });
      }

      function yesterdayFunc() {


      var today = moment();
      var tomorrow = today.subtract('days', 1);
      chosendate = moment(tomorrow).format("YYYY-MM-DD");
                   
      $("#timeline").load("select.php", {chosendate:chosendate}, function(responseTxt,statusTxt,xhr){
            if(statusTxt=="error")
              alert("Error: "+xhr.status+": "+xhr.statusText)
         });
      }

    </script>

  </head>

  <body>




    <div id="superDiv">
    <div class="wrapper">
    
    <nav id="manager-nav" role="navigation">
		<!-- #site-navigation -->
        <ul class="manager-menu-items">
        	<li class="menu-item"><a href="logout.php">Logout</a></li>
            <li class="menu-item"><a href="booking.php">Booking.php</a></li>
            <li class="menu-item"><a href="bookingmanage.php">Reload</a></li>
        </ul></nav>
        



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


                      if (empty($all_rooms)){

                        echo "<option>No rooms available for chosen time</option>";

                      }                 

                      else{
                        foreach($all_rooms as $val) {
                          echo "<option>$val</option>"; // OR 
                        }
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
  <p>Today's booking grid view</p>
  </br>


    <?php

      $all_rooms = array("Red", "Blue", "Green", "Yellow");

      $opentime = strtotime('10:00');
      $closetime = strtotime('23:00');

      //Initalizes the booking time to be used in the loop
      //CHANGE THE NAME OF BOOKING TIME POSSIBLY? SEEMS A BIT DAFT HERE 

      $bookingtime = $opentime;
  
      echo '<button onclick="yesterdayFunc">Yesterday</button>';
      echo '<button onclick="todayFunc()">Today</button>';
      echo '<button onclick="tomorrowFunc()">Tomorrow</button>';
      echo '</br>';
      echo '</br>';
      echo '<table border ="1" id="the_table">';



        //Summary of this loop is running through each room that has been set
        //For each room a loop is further run for each time slot available
        //For each time slot in each room a query is run, should this room be booked for such
        //a time then it's particular table cell has it's background colour set , making it readily 
        //viewable to the administrator what time slots are booked



        //Loop that runs through each room one by one.
        foreach($all_rooms as $val) {

          //Sets a row and sets the ID equal to the room name, possibly conflict of ID's? 
          //Set's up an inital cell with a class of roomcolour and that has in it printed the corresponding
          //room colour/name for that row.
          //Resets the bookingtime variable to that of the open time

          echo '<tr id="'.$val.'">';         
          echo '<td class="roomcolour">'.$val.'</td>';
          $bookingtime = $opentime;
          
          //Loop that runs while the booking time is between the open time and the end time.        
          while($bookingtime <= $closetime && $bookingtime >= $opentime) 

          {
            //Formats the booking time so it can be used to query the database
            $form_bookingtime = (string)date('H:i:s', $bookingtime);

            //Query that will check for any bookings that match given date (default today), room and time
            //and that are accepted.
            $query_Room = mysqli_query($con, "SELECT * FROM requested_Bookings WHERE 
                room = '$val' AND booking_Date = DATE(NOW()) AND status = 'Accepted' AND (start_Time <= 
                '$form_bookingtime' AND end_Time > '$form_bookingtime')
                                "); 

            //Checks to see if any results are returned from the query
            $num_results = mysqli_num_rows($query_Room);
          
            
            //If there is more than 0 results (In general there should only be one result max because mutliple bookings
            // for the same room/time shouldn't be allowed - however using a greater than 0 is a better failsafe here.)
            if ($num_results > 0)
            {

              //Creates a variable for the cell_ref that is the bookingtime + the room,
              //this probably isn't needed because of data passed in the onclick method.
              //$cell_ref = (string)date('H:i', $bookingtime);
              // $cell_ref = ((string) $val) . $cell_ref;

              while($row = mysqli_fetch_array($query_Room)) {
              # Run a loop that fetches the ID from from the query.

              //Stores the bookings ID in a variable called ID, used to pass in the onclick method. REPHRASE THIS
                //NOT WORKING JUST RETURNS 10.
              
              $booking_id = $row['id']; 
              $band_Name = $row['band_Name'];

              }


              $cell_ref = (string)date('H:i', $bookingtime);
              $cell_ref = ((string) $val) . $cell_ref;
              echo '<td id = "'.$cell_ref.'" onclick="testfunc('.$booking_id.')" style="background-color:'.$val.'">'.$band_Name.'</td>';
              $bookingtime = strtotime('+30 minutes', $bookingtime);
            }
            else
            {




              $cell_ref = (string)date('H:i', $bookingtime);
              $cell_ref = ((string) $val) . $cell_ref;
              echo '<td id = "'.$cell_ref.'" onclick="testfunc(null)"></td>';
              $bookingtime = strtotime('+30 minutes', $bookingtime);

            }
          }

        }

        $bookingtime = $opentime;
        echo '<tr>';
        echo '<td id="cell_time"></td>';
        while($bookingtime <= $closetime && $bookingtime >= $opentime) 
        {

        $cell_ref = (string)date('H:i', $bookingtime);
        echo '<td id="cell_time">'.$cell_ref.'</td>';
        $bookingtime = strtotime('+30 minutes', $bookingtime);

      }

echo '</table>';







echo '<button type="button" id="bob" 
                onclick="changedate()">Pick Date</button>';

 echo '<input type="text" class="date_input" id="grid_datepicker" width:50px>';

echo '</div>';

echo '</br>';
?>

<div id="selectedBooking" class="clear">
  <p>This box will contain the booking that has been selected in the above grid</p>
  </br>


   

</div>






<div id="inputDiv" class="clear">
      <p>Manually added bookings will be auto accepted, confirmation emails will be sent to both 
      the administrator and the customer.</p>
      <p>First Name: <input type="text" id="fname"></input> </p>
      <p>Last Name : <input type="text" id="lname"></input></p>
      <p>Mobile Number : <input type="text" id="mobile"></input></p>
      <p>Email : <input type="text" id="email"></p>
      <p>Date of Booking: <input type="text" id="manual_book_date" class="date_input"></p>

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
 <button id="Submit">Submit</button> 
    
    </div>
    </div>
	</div>
    
</body>
</html>