<html>
  <head>

    <!--Sets up webpage character set and sets title -->
    <meta charset="utf-8">
    <title>Polestar booking test</title>

    <!-- Sets up ref's to jquery-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>    
    <script src="//code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    <script type="text/javascript" src="js/datepicker.js"></script>
    <script type="text/javascript" src="js/bookingvalidation.js"></script>
    <script type="text/javascript" src="js/costcalculator.js"></script>

    <link rel="stylesheet" href="style.css">
  </head>

  <body> 

    <div id="superDiv">
      <div id="booking-form">

        <label id="booking-label">First Name:</label>
        <input type="text" id="fname" class="input"></input>
        <br />

        <label id="booking-label">Last Name :</label>
        <input type="text" id="lname" class="input"></input>
        <br />

        <label id="booking-label">Mobile Number :</label>
        <input type="text" id="mobile" class="input"></input>
        <br />

        <label id="booking-label">Email :</label>
        <input type="email" id="email" class="input">
        <br />

        <label id="booking-label">Date of Booking :</label>
        <input type="text" id="date_input" class="input">
        <br />

        <label id="booking-label">Band Name :</label>
        <input type="text" id="band_Name" class="input">
        <br />

        <!-- Following PHP code auto populates the start/end time input -->
        <?php

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
            //Echos a option , the value is the same as the time displayed
            echo '<option value="'. date('H:i', $bookingtime) .'">' . date('H:i', $bookingtime) . 
            '</option>'."\n";
            $bookingtime = strtotime('+30 minutes', $bookingtime);
          }

          echo "</select>"; 
          echo "<br />";

          $bookingtime = $opentime;


          echo'<label id="booking-label">End Time:</label>';
          echo'<select id="endTime" class="input">';
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

        ?>

    <br />
    <label id="booking-label">Room Requested:</label>
    <select id="room" class="input">
      <option value="Red">Red</option>
      <option value="Blue">Blue</option>
      <option value="Yellow">Yellow</option>
      <option value="Green">Green</option>
    </select> 
    <br />


  <!-- Requires Implementation
  <label id="booking-label">Equipment Required:</label>
  <select id="gear1">
  <option value="Drums">Drum Kit</option>
  <option value="Bass">Bass Amp</option>
  <option value="Guitar">Guitar Amp</option>
  <option selected="selected"value="None">None</option>
  </select>
  <select id="gear2">
  <option value="Drums">Drum Kit</option>
  <option value="Bass">Bass Amp</option>
  <option value="Guitar">Guitar Amp</option>
  <option selected="selected"value="None">None</option>
  </select>
  <select id="gear3">
  <option value="Drums">Drum Kit</option>
  <option value="Bass">Bass Amp</option>
  <option value="Guitar">Guitar Amp</option>
  <option selected="selected"value="None">None</option>
  </select>
  <select id="gear4">
  <option value="Drums">Drum Kit</option>
  <option value="Bass">Bass Amp</option>
  <option value="Guitar">Guitar Amp</option>
  <option selected="selected"value="None">None</option>
  </select>
  <br />
  <label id="booking-label"><p id ="costEstimate">Cost Estimate:</p></label>


  Requires Implementation
  <p>Equipment Required:</p>-->

  <p id ="costEstimate">Cost Estimate: </p>
  <div class="bottom-note">
  <label id ="submit_text">You must fill in all fields before being able to submit.</label>

  <button id="Submit" disabled>Submit</button></div>
  </div>

  </br>




</div>
</body>
</html>
