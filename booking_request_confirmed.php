<html>
    <meta charset="utf-8"

  <?php






      
 

      //$conn = new mysqli("localhost","root","cake123","polestar");
       
      //if ($conn->connect_error) {
        //  die("Connection failed: " . $conn->connect_error);
      //}

      //Prepares 
      



      

			$fname = $_POST["fname"];
			$lname = $_POST["lname"];
			$mobile = $_POST["mobile"];
			$email = $_POST["email"];			
			$date = date('Y-m-d', strtotime($_POST['date']));
			$startTime = $_POST["startTime"];
			$endTime = $_POST["endTime"];
  		$room = $_POST["room"];


      //Database connection details.
      $dbhost     = "localhost";
      $dbname     = "polestar";
      $dbuser     = "root";
      $dbpass     = "cake123";
   
      // database connection
      $conn = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);

      //Prepares SQL statement to deal with storing booking to database
      //Then executes the query passing to it the information obtained through the post system.
      $sql = "INSERT INTO requested_Bookings (fname, lname, mobile, email, booking_Date,
        start_Time, end_Time, room ) VALUES (:fname,:lname,:mobile,:email,:booking_Date,:start_Time,
        :end_Time,:room)";
      $q = $conn->prepare($sql);
      $q->execute(array(':fname'=>$fname, ':lname' => $lname, ':mobile'=> $mobile, ':email'=>$email, 
        ':booking_Date'=>$date, ':start_Time'=>$startTime, ':end_Time' => $endTime, ':room' =>$room));
      


  
  			
			echo '<!-- BEGIN content -->
  			
    		<p>'.$fname.'</p>
    		<p>'.$lname.'</p>
    		<p>'.$mobile.'</p>
    		<p>'.$email.'</p>
    		<p>'.$date.'</p>
    		<p>'.$startTime.'</p>
    		<p>'.$endTime.'</p>
    		<p>'.$room.'</p>
        <p>'.$thedate.'</p>

			
      		

    			</div>';



       

		
		?> 	


</html>
