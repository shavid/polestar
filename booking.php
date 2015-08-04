<html>

  <head>

    <!--Sets up webpage charset and sets title -->
    <meta charset="utf-8">
    <title>Polestar booking test</title>

    <!-- Sets up ref's to jquery-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>    
    <script src="//code.jquery.com/ui/1.9.2/jquery-ui.js"></script>


    <!--Start of webpages Javascript-->
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
          $("#superDiv").load("booking_request_confirmed.php", {fname:fname, lname:lname, mobile:mobile, email:email, date:date, startTime:startTime
      	  , endTime:endTime, room:room, costEstimate:costEstimate} , function(responseTxt,statusTxt,xhr){
            if(statusTxt=="error")
              alert("Error: "+xhr.status+": "+xhr.statusText)
          });
        });
      }); 

    </script>

  </head>


  <body> 

    <div id="superDiv">
     <div id="inputDiv">

  
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


      Room requests are subject to availability.
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


  </div>

  <!-- Submit button for input data-->
  <p id="Submit">Submit</p>

  </body>
</html>
