<?php



$room_requested = 'Red';

  $con=mysqli_connect("localhost","root","cake123","polestar"); 
              #Loads the bookings that have had inital reciept emails sent out
              $resulting = mysqli_query($con, "SELECT room FROM requested_Bookings WHERE room = '$room_requested'"); 
              $num_results = mysqli_num_rows($resulting);

    echo "$num_results"
?>
---
<?php
            $con=mysqli_connect("localhost","root","cake123","polestar");   
            $result = mysqli_query($con, "SELECT * FROM requested_Bookings WHERE status = 'Accepted' AND room = 'Red'        ");
            echo '<h5> The following are todays confirmed bookings:</h5>';
            
			$num_rows = mysqli_num_rows($result);	

			echo "$num_rows Rows\n";
			echo '</br>';
            while($row = mysqli_fetch_array($result)) {
            # Run a loop that fetches everything fro mthe query.
              $num_rows = mysql_num_rows($result);	
              echo "$num_rows Rows\n";
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
                <p>Results : '.$num_results.'</p>
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