   <script type="text/javascript" src="moment.js"></script>
<script>

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






 <p id="chocolate">Selected date booking grid view</p>
 </br>


 <?php

      $all_rooms = array("Red", "Blue", "Green", "Yellow");

      $opentime = strtotime('09:00');
      $closetime = strtotime('22:00');

      $chosendate = $_POST["chosendate"];
      $first_cell = $_POST["first_cell"];
      echo ''.$first_cell.'';
    

      $newDate = date("Y-m-d", strtotime($chosendate));

 

      //Initalizes the booking time to be used in the loop
      //CHANGE THE NAME OF BOOKING TIME POSSIBLY? SEEMS A BIT DAFT HERE 

      $bookingtime = $opentime;
      $con=mysqli_connect("localhost","root","cake123","polestar"); 

      echo '<button onclick="yesterdayFunc()">Yesterday</button>';
      echo '<button onclick="todayFunc()">Today</button>';
      echo '<button onclick="tomorrowFunc()">Tomorrow</button>';
      echo '</br>';
      echo '</br>';


      echo '<table border ="1">';



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
                room = '$val' AND booking_Date = '$newDate' AND status = 'Accepted' AND (start_Time <= 
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
              
              $booking_id = $row['band_Name']; 

              }


              $cell_ref = (string)date('H:i', $bookingtime);
              $cell_ref = ((string) $val) . $cell_ref;
              echo '<td id = "'.$cell_ref.'" onclick="testfunc('.$booking_id.')" style="background-color:'.$val.'">'.$booking_id.'</td>';
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




?>

<button type="button" id="bob" 
                onclick="changedate()">Pick Date</button>

 <input type="text" class="date_input" id="grid_datepicker" width:50px>