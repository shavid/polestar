<html>


  <head>

    <!--Sets up webpage charset and sets title -->
    <meta charset="utf-8">
    <title>Polestar booking test</title>

    <!-- Sets up ref's to jquery-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>    
    <script src="//code.jquery.com/ui/1.9.2/jquery-ui.js"></script>

	<link rel="stylesheet" href="style.css">

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




     //Function that checks if the user has entered a valid UK phone number. 
     //This is done by checking if the length of number is 10 or 11 digits

     //Also uses isNaN to ensure that the user inputs a purely numerical input.

        $(document).ready(function(){
        $('#mobile').on('change', function (e) {
          
          var mobile = $("#mobile").val();  
          var is_numerical = !isNaN(mobile);

          if((mobile.length == 10 || mobile.length == 11) && is_numerical == true)  
            {     
              correct_mobile = true;  
            }  
          else  
            {  
              alert('incorrect mobile number');   
              correct_mobile = false;  
            }   
          });
        });


      $("#mobile").keypress(function(e) {
    var a = [];
    var k = e.which;
    
    for (i = 48; i < 58; i++)
        a.push(i);
    
    if (!(a.indexOf(k)>=0))
        e.preventDefault();
    
    $("#submit_text").text('KeyCode: '+k);
});

   



      //This function is active when the email address input box is changed. 
      //Uses reg expressions to ensure emails are in correct format
      //such as admin@polestar.com
      //If invalid email is entered variable is updated which prevents page submission and 
      //user is alerted.
      $(document).ready(function(){
        $('#email').on('change', function (e) {
          
          email = $("#email").val();  
          var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
          if(email.match(mailformat))  
            {     
              correct_email = true;  
            }  
          else  
            {  
              alert("You have entered an invalid email address!");   
              correct_email = false;  
            }   
          });
      });



      //Function that is active on the page load. 
      //Note to self, can probably make this more efficient so it only executes once the page is
      //submitted and not everytime something is changed.
      $(document).ready(function(){
        $('#inputDiv').on('change', function (e) {
          

          //Checks input boxes to ensure a value is entered before enabling the submit button.
          //Also ensures that a correct email address has been entered.
          if($("#fname").val().length > 0 && $("#lname").val().length > 0 && $("#lname").val().length > 0
            && $("#mobile").val().length > 0 && $("#email").val().length > 0 && 
            $("#date_input").val().length > 0 && $("#startTime").val().length > 0
            && $("#endTime").val().length > 0 && $("#room").val().length > 0 && correct_email == true
            && correct_mobile == true && !isNaN($("mobile").val()))
            {
              $('#Submit').prop('disabled', false);
              $('#submit_text').prop('hidden', true);
            }
          else 
            {
              $('#Submit').prop('disabled', true);
              $('#submit_text').prop('hidden', false);
            }

          
          //When an element contained in the main input div is changed
          //Make variables equal to the values of the corresponding input boxes 
          fname = $("#fname").val();
 	        lname = $("#lname").val();
 	        mobile = $("#mobile").val();
 	        email = $("#email").val();
        	date = $("#date_input").val(); 
        	startTime = $("#startTime").val();
 	        endTime = $("#endTime").val();
        	room = $("#room").val();
 	        costEstimate = $("#costEstimate").val();
          captcha_code = $("#captcha_code").val();
          
          });
      });


      //Function ready on page load, when user clicks the submit button, loads into the over-arching
      //or main Div the web page that will confirm with the user a booking request has been submitted
      //Passes to this webpage all the variables collected from the webpages input boxes.
      //Relevant error checking is in place
      $(document).ready(function(){
        $("#Submit").on("click", function(){

       
          
          
          $("#superDiv").load("booking_request_confirmed.php", {fname:fname, lname:lname, mobile:mobile, email:email, date:date, startTime:startTime
      	  , endTime:endTime, room:room, costEstimate:costEstimate, captcha_code:captcha_code} , function(responseTxt,statusTxt,xhr){
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
      <label id="booking-label">Start Time:</label>
	     <select id="startTime" class="input">
	       <option value = "09:00">09:00</option>
	       <option value = "09:30">09:30</option>
	       <option value = "10:00">10:00</option>
	     </select>
      <br />
      <label id="booking-label">End Time:</label>
	      <select id="endTime" class="input">
	       <option value = "09:30">09:30</option>
	       <option value = "10:00">10:00</option>
	     </select>
      <br />
      <label id="booking-label">Room Requested:</label>
        <select id="room" class="input">
          <option value="Red">Red</option>
          <option value="Blue">Blue</option>
          <option value="Yellow">Yellow</option>
          <option value="Green">Green</option>
        </select> 
      <br />

<!-- Requires Implementation-->
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
<!--<label id="booking-label"><p id ="costEstimate">Cost Estimate:</p></label>


       Requires Implementation
      <p>Equipment Required:</p>
      <p id ="costEstimate">Cost Estimate: </p>
      -->
<img id="captcha" src="/securimage/securimage_show.php" alt="CAPTCHA Image" />  
<input type="text" class ="input "id="captcha_code" size="10" maxlength="6" />
<a href="#" onclick="document.getElementById('captcha').src = '/securimage/securimage_show.php?' + Math.random(); return false">[ Different Image ]</a>
    
    </div>

</br>
<!-- Not sure why this label isn't lined up like the rest - Alex? Changed it to a Paragraph for time being--> 
<label id ="submit_text">You must fill in all fields before being able to submit.</label>

<button id="Submit" disabled>Submit</button>


  </div>

  <!-- Submit button for input data-->
 

  </body>
</html>
