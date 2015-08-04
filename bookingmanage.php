<html>


<head>
<meta charset="utf-8">
<title>Booking Administration</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">




<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>    
<script src="//code.jquery.com/ui/1.9.2/jquery-ui.js"></script>


<link rel="stylesheet" type="text/css" href="csstest.css" media="screen" />



<head>

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


	//$('#poop').text(idnumber); //Purely here for testing purposes delete later
	
    // If the user clicked to confirm true
    var booking_Status = "Accepted"
    var click =confirm("Press Ok to confirm booking!")
    if (click == true) {
    // txt = "You pressed OK!"; 
    $("#superDiv").load("booking_confrej.php", {booking_ID:booking_ID, booking_Status: booking_Status}, function(responseTxt,statusTxt,xhr){
          if(statusTxt=="error")
              alert("Error: "+xhr.status+": "+xhr.statusText)
      });
    
	} else {
   // txt = "You pressed Cancel!";
    //If the user cancels the box then nothing happens
	}
	//$('#poop').text(txt);
}




function rejFunc(booking_ID) {


	//$('#poop').text(idnumber); //Purely here for testing purposes delete later
	
    // If the user clicked to confirm true
    var click =confirm("Press Ok to reject booking!")
    var booking_Status = "Rejected"
    if (click == true) {
    // txt = "You pressed OK!"; 
    $("#superDiv").load("booking_confrej.php", {booking_ID:booking_ID, booking_Status:booking_Status}, function(responseTxt,statusTxt,xhr){
          if(statusTxt=="error")
              alert("Error: "+xhr.status+": "+xhr.statusText)
      });
    
	} else {
   // txt = "You pressed Cancel!";
    //If the user cancels the box then nothing happens
	}
	//$('#poop').text(txt);
}



function cancFunc(booking_ID) {


  //$('#poop').text(idnumber); //Purely here for testing purposes delete later
  
    // If the user clicked to cancel a booking
    var click =confirm("Press Ok to cancel booking!")
    var booking_Status = "Cancelled"
    if (click == true) {
    // txt = "You pressed OK!"; 
    $("#superDiv").load("booking_cancelled.php", {booking_ID:booking_ID, booking_Status:booking_Status}, function(responseTxt,statusTxt,xhr){
          if(statusTxt=="error")
              alert("Error: "+xhr.status+": "+xhr.statusText)
      });
    
  } else {
   // txt = "You pressed Cancel!";
    //If the user cancels the box then nothing happens
  }
  //$('#poop').text(txt);
}
</script>

</head>
<body>
<div id="superDiv">
<p id = "red">
This is the web page which displays requested/accepted bookings.
</p>
<p>

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
			#Connects to the database
			$con=mysqli_connect("localhost","root","cake123","polestar"); 
			#Loads the bookings that have had inital reciept emails sent out
			$result = mysqli_query($con, "SELECT * FROM requested_Bookings WHERE status = 'Reciept'"); 
			
			echo '<h5> The following are booking requests that have been made and yet to be confirmed</h5>';
			while($row = mysqli_fetch_array($result)) {
 			# Run a loop that fetches everything from the query.

  				$id = $row['id'];	
  				$fname["$id"] = $row['fname'];
  				$lname["$id"] = $row['lname'];
  				$mobile["$id"] = $row['mobile'];
  				$date["$id"] = $row['booking_Date'];
  				$start_Time["$id"] = $row['start_Time'];
  				$end_Time["$id"] = $row['end_Time'];
  				$room["$id"] = $row['room'];
  				$booking_id["$id"] = $id;
  				$myDateTime = DateTime::createFromFormat('Y-m-d', $date["$id"]);
				  $newdate = $myDateTime->format('d-m-Y');



  				#$url["$id"] = $row['url'];
				#$date["$id"] = $row['date'];
				#$category["{$id}"] = $row['category'];
				#$readingEase["{$id}"] = $row['readingEase'];

				echo '<!-- BEGIN content -->
  				<div id="booking_Requests">
  				<p>
    			<p>Name : '.$fname["{$id}"] . ' '.$lname["{$id}"].' <br> 
    			Contact : '.$mobile["{$id}"].' <br>
    			Date / Time : '.$newdate.' '.$start_Time["{$id}"].' '.$end_Time["{$id}"].' </br>
    			Requests : '.$room["{$id}"].' </br>
    			Booking ID: '.$booking_id["{$id}"].' </br>
    			<button type="button" id="'.$booking_id["{$id}"].'" onclick="accFunc('.$booking_id["{$id}"].')">Accept</button>
    			<button type="button" id="'.$booking_id["{$id}"].'" onclick="rejFunc('.$booking_id["{$id}"].')">Reject</button>
    			</p>
  
    			</div>


    			'	

    			;
			
      

    			
    		}

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
  				$myDateTime = DateTime::createFromFormat('Y-m-d', $date["$id"]);
				  $newdate = $myDateTime->format('d-m-Y');
  				#$url["$id"] = $row['url'];
				#$date["$id"] = $row['date'];
				#$category["{$id}"] = $row['category'];
				#$readingEase["{$id}"] = $row['readingEase'];

				echo '<!-- BEGIN content -->
  				<div id="accepted_Bookings">
  				<p>
    			<p>Name : '.$fname["{$id}"] . ' '.$lname["{$id}"].' <br> 
    			Contact : '.$mobile["{$id}"].' <br>
    			Date / Time : '.$newdate.' '.$start_Time["{$id}"].' '.$end_Time["{$id}"].' </br>
    			Requests : '.$room["{$id}"].' </br>
    			Booking ID: '.$booking_id["{$id}"].' </br>  
          <button type="button" id="'.$booking_id["{$id}"].'" onclick="cancFunc('.$booking_id["{$id}"].')">Cancel</button>';



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