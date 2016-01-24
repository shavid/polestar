<html>
  <head>
   <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>    
    <script src="//code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
     <script type="text/javascript" src="js/datepicker.js"></script>
  
  </head>

  <body> 

    <div id="superDiv">
     <?php 

//Will be loaded into the booking admin page
//will handle displaying of the booking that has been clicked on and providing a print out of the information.



$con=mysqli_connect("localhost","root","cake123","polestar");   


$booking_ID = $_POST["bookingID"];
$bookingTime = $_POST["bookingTime"];


//RENAME THESE





  $result = mysqli_query($con, "SELECT * FROM requested_Bookings WHERE id = '$booking_ID'");
          
//If the booking ID is null then an option should be given to the user to manually add a booking
//This should obviously take heed of times and rooms that are unavailable.

if ($booking_ID == null)

{

$output = date('H:i', $bookingTime); 

echo 'No booking on selected slot.
      </br>
      </br>
';

echo '<p>Manually added bookings will be auto accepted.</p>
      </br>
      
      <p>First Name: <input type="text" id="fname"></input> </p>
      <p>Last Name : <input type="text" id="lname"></input></p>
      <p>Mobile Number : <input type="text" id="mobile"></input></p>
      <p>Email : <input type="text" id="email"></p>
      <p>Date of Booking: <input type="text" id="date_input" class="input"></p>
     

     ';
     // <input type="text" id="date_input" class="input">
       echo '<label id="booking-label">Start Time:</label>';
        echo '<select id = "startTime">';



        //Sets the inital open and close time.
        //These can be changed as per requirements
        $opentime = strtotime('10:00');
        $closetime = strtotime('23:00');


        //Initalizes the booking time to be used in the loop
        $bookingtime = $opentime;
  
        //Echos a blank option for default.
        echo '<option></option>';

        //While the booking time is before the closing time and after the open time.
        while($bookingtime <= $closetime && $bookingtime >= $opentime) 

          {

            //RENAME THESE
            $theapple = date('H:i', $bookingtime);
            $theapple = (string)$theapple;

            if($theapple == $output){
            //Echos a option , the value is the same as the time displayed
            echo '<option selected = "selected">'.date('H:i', $bookingtime).'</option>'."\n";

            $bookingtime = strtotime('+30 minutes', $bookingtime);
            }
            else

            {

             echo '<option value="'. date('H:i', $bookingtime) .'">' . date('H:i', $bookingtime) . 
            '</option>'."\n";

            $bookingtime = strtotime('+30 minutes', $bookingtime);   

            }
          }

        echo "</select>"; 
      echo '</p>';


      echo '<label id="booking-label">End Time:</label>';
        echo '<select id = "endTime">';



        //Sets the inital open and close time.
        //These can be changed as per requirements
        $opentime = strtotime('10:00');
        $closetime = strtotime('23:00');


        //Initalizes the booking time to be used in the loop
        $bookingtime = $opentime;
  
        //Echos a blank option for default.
        echo '<option></option>';

        //While the booking time is before the closing time and after the open time.
        while($bookingtime <= $closetime && $bookingtime >= $opentime) 

          {

         
            //Echos a option , the value is the same as the time displayed
            echo '<option value="'. date('H:i', $bookingtime) .'">' . date('H:i', $bookingtime) . 
            '</option>'."\n";

            $bookingtime = strtotime('+30 minutes', $bookingtime);
            
            
          }

        echo "</select>"; 
      echo '</p>



    
      <p>Room Requested:
        <select id="room">
          <option value="Red">Red</option>
          <option value="Blue">Blue</option>
          <option value="Yellow">Yellow</option>
          <option value="Green">Green</option>
        </select> 
      </p>';

}


else 
{

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

    
              echo '
                Selected Booking:
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






    }










          




?>


</div>
</body>
</html>


</html>
<!-- 



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

    
              echo 'BEGIN content
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

              -->
