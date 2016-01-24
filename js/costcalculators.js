 //Function that is active on the page load. 
      //Note to self, can probably make this more efficient so it only executes once the page is
      //submitted and not everytime something is changed.
      $(document).ready(function(){
        $('#booking-form').on('change', function (e) {
          

          //Checks input boxes to ensure a value is entered before enabling the submit button.
          //Also ensures that a correct email address has been entered.
          if($("#fname").val().length > 0 && $("#lname").val().length > 0 && $("#lname").val().length > 0
            && $("#mobile").val().length > 0 && $("#email").val().length > 0 && 
            $("#date_input").val().length > 0 && $("#room").val().length > 0 && correct_email == true
            && correct_mobile == true && 
			
			
			$("#startTime").val() != ""
            && $("#endTime").val() != "" && correct_Time == true)
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
          bandName = $("#band_Name").val();
          email = $("#email").val();
          date = $("#date_input").val(); 
          startTime = $("#startTime").val();
          endTime = $("#endTime").val();
          room = $("#room").val();
          costEstimate = $("#costEstimate").val();
      

          //Minimun booking time is one hour, the following code calculates if the booking time 
          //is less than this, if so it changes the selected value in the end time option box to the next 
          //following option.
          theEnd = endTime.replace(':','');
          theStart = startTime.replace(':','');
          totalTime = theEnd - theStart;
          printedTime = Math.ceil(totalTime)
      

          if (totalTime <100 && endTime != '') {

              endTimeIndex =document.getElementById("endTime").selectedIndex;
              alert("Minimun booking time is 1 hour, end time has been changed.");
              endTimeIndex = endTimeIndex + 1;
              document.getElementById("endTime").selectedIndex = endTimeIndex;

          }

          //

          cpr = 9; //Cost Per Hour
          //Calculates the cost estimate.
          startTimec = startTime.replace(':','.');
          endTimec = endTime.replace(':','.');
          startTimec = Math.ceil(startTimec);
          endTimec = Math.ceil(endTimec);
          totalTime = endTimec - startTimec;
          totalcost = totalTime * cpr;

          if (totalcost < 9){
          document.getElementById("costEstimate").innerHTML = "Cost Estimate: £" + totalTime + " Number should be taken as an estimate only";
          
          };
      });

  //Function ready on page load, when user clicks the submit button, loads into the over-arching
      //or main Div the web page that will confirm with the user a booking request has been submitted
      //Passes to this webpage all the variables collected from the webpages input boxes.
      //Relevant error checking is in place
      $(document).ready(function(){
        $("#Submit").on("click", function(){
          $("#superDiv").load("booking_request_confirmed.php", {fname:fname, lname:lname, mobile:mobile, bandName:bandName, email:email, date:date, startTime:startTime
          , endTime:endTime, room:room, costEstimate:costEstimate} , function(responseTxt,statusTxt,xhr){
            if(statusTxt=="error")
              alert("Error: "+xhr.status+": "+xhr.statusText)
          });
        });
      }); 

    });