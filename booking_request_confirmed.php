<html>
  <meta charset="utf-8">


  <head>
  <?php



    //session_start(); 

    //include_once $_SERVER['DOCUMENT_ROOT'] . '/securimage/securimage.php';
  
    //$securimage = new Securimage();

   // if ($securimage->check($_POST['captcha_code']) == false) {
    // the code was incorrect
    // you should handle the error so that the form processor doesn't continue

    // or you can use the following code if there is no validation or you do not know how
    //echo "The security code entered was incorrect.<br /><br />";
   // echo "Please go <a href='booking.php'>back</a> and try again.";
   //exit;
    //}


      
  
      //$conn = new mysqli("localhost","root","cake123","polestar");
       
      //if ($conn->connect_error) {
        //  die("Connection failed: " . $conn->connect_error);
      //}

      //Prepares 
      



      

			$fname = $_POST["fname"];
			$lname = $_POST["lname"];
      $band_Name = $_POST["bandName"];
			$mobile = $_POST["mobile"];
			$email = $_POST["email"];			
			$date = date('Y-m-d', strtotime($_POST['date']));
			$startTime = $_POST["startTime"];
			$endTime = $_POST["endTime"];
  		$room = $_POST["room"];


      //Database connection details.
      include 'dbsettings.php'; 



   
      // database connection
      $conn = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);

      //Prepares SQL statement to deal with storing booking to database
      //Then executes the query passing to it the information obtained through the post system.
      $sql = "INSERT INTO requested_Bookings (fname, lname, mobile, email, booking_Date,
        start_Time, end_Time, room, band_Name ) VALUES (:fname,:lname,:mobile,:email,:booking_Date,:start_Time,
        :end_Time,:room, :band_Name)";
      $q = $conn->prepare($sql);
      $q->execute(array(':fname'=>$fname, ':lname' => $lname, ':mobile'=> $mobile, ':email'=>$email, 
        ':booking_Date'=>$date, ':start_Time'=>$startTime, ':end_Time' => $endTime, ':room' =>$room, ':band_Name'
        => $band_Name));
      
		//THROWIG UP ERRORS SO LIVING HERE FOR NOW
		//<label id="booking-label">Equipment Requested:</label><b>'.$gear1.', <b>'.$gear2.', <b>'.$gear3.', <b>'.$gear4.'</b><br/>

  
  			
			echo '<!-- BEGIN content -->
<div id="inputDiv">
			<h1>Request Submitted</h1>
			<p> Your request has been successfully submitted, please await a response from us.</p>
    		<label id="booking-label">First Name:</label><b>'.$fname.'</b><br/>
    		<label id="booking-label">Last Name:</label><b>'.$lname.'</b><br/>
        <label id="booking-label">Band name:</label><b>'.$band_Name.'</b><br/>
    		<label id="booking-label">Mobile Number:</label><b>'.$mobile.'</b><br/>
    		<label id="booking-label">Email:</label><b>'.$email.'</b><br/>
    		<label id="booking-label">Date of Booking:</label><b>'.$date.'</b><br/>
    		<label id="booking-label">Start Time:</label><b>'.$startTime.'</b><br/>
    		<label id="booking-label">End Time:</label><b>'.$endTime.'</b><br/>
    		<label id="booking-label">Room Requested:</label><b>'.$room.'</b><br/>

			<b>'.$date.'</b>
</div>
    			</div>';



       

		
		?> 	


</html>
