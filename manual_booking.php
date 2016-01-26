<html>
 <script type="text/javascript" src="js/datepicker.js"></script>
<?php



//Deals with manual addition of bookings by administrators, 
//said bookings automatically updated to 'accepted'





	$fname = $_POST["fname"];
	$lname = $_POST["lname"];
	$mobile = $_POST["mobile"];
	$email = $_POST["email"];			
	$date = date('Y-m-d', strtotime($_POST['thedate']));
	$startTime = $_POST["startTime"];
	$endTime = $_POST["endTime"];
  $room = $_POST["room"];


    $status = "Accepted";

      //Database connection details.
    include 'dbsettings.php'; 
            #Connects to the database
      


   
      // database connection
      $conn = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);

      //Prepares SQL statement to deal with storing booking to database
      //Then executes the query passing to it the information obtained through the post system.
      $sql = "INSERT INTO requested_Bookings (fname, lname, mobile, email, booking_Date,
        start_Time, end_Time, room, status) VALUES (:fname,:lname,:mobile,:email,:booking_Date,:start_Time,
        :end_Time,:room,:status)";
      $q = $conn->prepare($sql);
      $q->execute(array(':fname'=>$fname, ':lname' => $lname, ':mobile'=> $mobile, ':email'=>$email, 
        ':booking_Date'=>$date, ':start_Time'=>$startTime, ':end_Time' => $endTime, ':room' =>$room, ':status' => $status));
      


  
  			
			echo '<!-- BEGIN content -->
<div id="inputDiv">
			<h1>Booking Submitted</h1>
			<p> The booking has been submitted with the following details : </p>
    		<label id="booking-label">First Name:</label><b>'.$fname.'</b><br/>
    		<label id="booking-label">Last Name:</label><b>'.$lname.'</b><br/>
    		<label id="booking-label">Mobile Number:</label><b>'.$mobile.'</b><br/>
    		<label id="booking-label">Email:</label><b>'.$email.'</b><br/>
    		<label id="booking-label">Date of Booking:</label><b>'.$date.'</b><br/>
    		<label id="booking-label">Start Time:</label><b>'.$startTime.'</b><br/>
    		<label id="booking-label">End Time:</label><b>'.$endTime.'</b><br/>
    		<label id="booking-label">Room Requested:</label><b>'.$room.'</b><br/>
        	
			
</div>
    			</div>';



       

		
	


?>

</html>