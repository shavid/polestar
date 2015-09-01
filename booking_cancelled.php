<html>
  <head>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="utf-8" http-equiv="encoding">
  </head>

  <body>

    <?php

      //Gathers neccessary data from common.php
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
			
      //Gets the booking ID and it's status (Accepted/Rejected) via POST
			$booking_ID = $_POST["booking_ID"];
			
   
			//Opens up a connection to the database
		  	$con=mysqli_connect("localhost","root","cake123","polestar"); 
			
      //First the If statement checks if a booking was accepted,
      // If so it echos this to the user and updates the database so that the correct 
      //booking now has the status of accepted
    		
    			echo '<!-- BEGIN content -->
  				<p> Booking with ID: '.$booking_ID.' has been cancelled.</p>';

  				$update = mysqli_query($con, "UPDATE requested_Bookings SET status = 'Cancelled' 
  					WHERE id = $booking_ID");
    		

    		//Does the same as above but echos to the user and updates the database to show that the
    		//booking was rejected
    		
?>
</body>

</html>
