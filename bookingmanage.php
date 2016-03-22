
 <!--  <?php


       require("common.php");
    
    // At the top of the page we check to see whether the user is logged in or not
    //if(empty($_SESSION['user']))
    //{
        // If they are not, we redirect them to the login page.
    //    header("Location: login.php");
        
       // Remember that this die statement is absolutely critical.  Without it,
   //     // people can view your members-only content without logging in.
 //       die("Redirecting to login.php");
//    }
      

      ?> -->



<html>


  <head>
    <meta charset="utf-8">
    <title>Booking Administration</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>    
    <script src="//code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    <script type="text/javascript" src="moment.js"></script>
    <script type="text/javascript" src="js/datepicker.js"></script>
    <script type="text/javascript" src="js/pickday.js"></script>
    <script type="text/javascript" src="js/bookingstatus.js"></script>
    <script type="text/javascript" src="js/bookingvalidation.js"></script>
      <script type="text/javascript" src="js/manualbooking.js"></script>
    
    <link rel="stylesheet" type="text/css" href="styletest.css" media="screen" />



  

    <script>

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


    </script>

  </head>

  <body>

<div class="overlay"></div>
<div id="selectedBooking" class="popup-container">
  
  <div id="selectedBooking-info"></div>
  <div id="selectedBooking-info"><button class="close-popup">Close</button>
  								 <button id="Submit">Submit</button></div>
</div>

<div id="manualBooking" class="popup-container">
      <div class="manualBooking-info">
      <h1>Manual Booking</h1><p>Manually added bookings will be auto accepted, confirmation emails will be sent to both 
      the administrator and the customer.</p>
      <div id="popup-form">
      <label class="booking-label">First Name:</label> <input type="text" id="fname"></input><br>
     <label class="booking-label">Last Name:</label> <input type="text" id="lname"></input><br>
      <label class="booking-label">Mobile Number:</label> <input type="text" id="mobile"></input><br>
      <label class="booking-label">Email:</label> <input type="text" id="email"><br>
      <label class="booking-label">Date of Booking:</label> <input type="text" id="manual_book_date" class="date_input"><br>
      <label class="booking-label">Start Time:</label> 
       <select id="startTime">
         <option value = "10:00">10:00</option>
         <option value = "10:30">10:30</option>
         <option value = "11:00">11:00</option>
       </select>
      <span style="padding-right:37px;"></span>
      <label class="booking-label">End Time:</label>
       <select id="endTime">
        <option value = "10:30">10:30</option>
        <option value = "11:00">11:00</option>
       </select><br>
      
      <label class="booking-label">Room Requested:</label>
        <select id="room">
          <option value="Red">Red</option>
          <option value="Blue">Blue</option>
          <option value="Yellow">Yellow</option>
          <option value="Green">Green</option>
        </select> 
        </div></div>
      
      <!-- Requires Implementation
      <p>Equipment Required:</p>
      <p id ="costEstimate">Cost Estimate: </p>
      -->
      <div class="manualBooking-info">
 <button class="close-popup">Close</button>
 <button id="Submit">Submit</button> 
 </div>
    
    </div>



    <div id="superDiv" class="test123">
    <?php include ('header.php');?>
    <div class="wrapper">
    
    
        



        <div class="top-box left" >
         
          <?php

          include 'dbsettings.php'; 
		  
            $con=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);   
            $result = mysqli_query($con, "SELECT * FROM requested_Bookings WHERE status = 'Accepted' AND booking_Date = DATE(NOW())");
            echo '<h5> The following are todays confirmed bookings:</h5>';
			
            echo '<div class="top-box-container">';
			echo '<div class="scroller">';
            while($row = mysqli_fetch_array($result)) {
            # Run a loop that fetches everything fro mthe query.

              $id = $row['id']; 
              $fname["$id"] = $row['fname'];
              $lname["$id"] = $row['lname'];
			  $band_Name ["$id"] = $row['band_Name'];
              $mobile["$id"] = $row['mobile'];
              $date["$id"] = $row['booking_Date'];
              $start_Time["$id"] = $row['start_Time'];
              $end_Time["$id"] = $row['end_Time'];
              $room["$id"] = $row['room'];
              $booking_id["$id"] = $id;
              
              $formatDate = DateTime::createFromFormat('Y-m-d', $date["$id"]);
              $newdate = $formatDate->format('d/m/y');

              //Reformats the start time to a more view friendly format.
              $format_ST = DateTime::createFromFormat('H:i:s', $start_Time["$id"]);
              $start_Time["$id"] = $format_ST->format('g:ia');

              //Reformats the end time to a more view friendly format.
              $format_ET = DateTime::createFromFormat('H:i:s', $end_Time["$id"]);
              $end_Time["$id"] = $format_ET->format('g:ia');

    
              echo '<!-- BEGIN content -->
                <div id="accepted_Bookings">
                <p>
                </br>
                <p>Name: '.$fname["{$id}"] . ' '.$lname["{$id}"].' </br>
				Band:  '.$band_Name["{$id}"] . ' </br>
                Phone Number : '.$mobile["{$id}"].' </br>
                Date: '.$newdate.' </br>
                Time: '.$start_Time["$id"].' to '.$end_Time["{$id}"].' </br>
                Room: '.$room["{$id}"].' </br>
            <!--Booking ID: '.$booking_id["{$id}"].' </br> --> 
			<button type="button" id="edit">Edit</button>
                <button type="button" id="'.$booking_id["{$id}"].'" 
                onclick="cancFunc('.$booking_id["{$id}"].')">Cancel</button>
                </div>'
                ;
              }
          ?>
        	</div></div>
        </div>


        <div class="top-box right">
          <?php 

            include 'dbsettings.php'; 
            #Connects to the database
            $con=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);   
            #Loads the bookings that have had inital reciept emails sent out
			//RECEIPT SPELLED WRONG
            $result = mysqli_query($con, "SELECT * FROM requested_Bookings WHERE status = 'Reciept'"); 
      
            echo '<h5>Unconfirmed bookings.</h5>
			<div class="top-box-container">';
			
			echo '<p>currently not active.</br>
						Implement in bookingmanage.php under top-right div</p>';
			
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
</div>






<div id="timeline" class="clear">
  <div class="timeline-title">
   <p>Currently Showing: Today</p>
    </div>

  <div class="timeline-buttons">
    <?php

      $all_rooms = array("Red", "Blue", "Green", "Yellow");

      $opentime = strtotime('10:00');
      $closetime = strtotime('23:00');

      //Initalizes the booking time to be used in the loop
      //CHANGE THE NAME OF BOOKING TIME POSSIBLY? SEEMS A BIT DAFT HERE 
    $bookingtime = $opentime;
  
    echo '<button onclick="yesterdayFuncaddada">Yesterday</button>';
    echo '<button onclick="todayFunc()">Today</button>';
     echo '<button onclick="tomorrowFunc()">Tomorrow</button>';
 
  //ENDS TIMELINE-BUTTONDIV
    echo '</div>';
    echo '<div class="timeline-content">';
    //^Starts Timeline-content div

      echo '<table id="timeline-table">';



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

            //Formats the booking time to pass via javascript - RENAME ME PLEASE
            $js_bookingtime = (string)date('Hi', $bookingtime);

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
              echo '<td id="'.$cell_ref.'" onclick="testfunc('.$booking_id.', null)" style="background-color:'.$val.'">'.$band_Name.'</td>';
              $bookingtime = strtotime('+30 minutes', $bookingtime);
            }
            else
            {


              //'.$js_bookingtime.'

              $cell_ref = (string)date('H:i', $bookingtime);
              $cell_ref = ((string) $val) . $cell_ref;
              echo '<td id = "'.$cell_ref.'" onclick="testfunc(null, '.$js_bookingtime.')"></td>';
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

echo '</table> </div>';
//^ ENDS TIMELINE CONTENT DIV AND TABLE





echo '<div class="timeline-selector">';

echo '<button type="button" id="bob" 
                onclick="changedate()">Pick Date</button>';

 echo '<input type="text" class="date_input" id="grid_datepicker" width:50px>';

echo '</div></div>';
//^ENDS ALL TIMELINE SECTION
?>








    </div>
  </div>
    
</body>
</html>
