
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
          thedate = $("#manual_book_date").val(); 
          startTime = $("#startTime").val();
          endTime = $("#endTime").val();
          room = $("#room").val();
		  band_Name = $("#band_Name").val();
          
          });
      });

      $(document).ready(function(){
        $("#Submit").on("click", function(){
          $("#inputDiv").load("booking_add.php", {fname:fname, lname:lname,band_Name:band_Name, mobile:mobile, email:email, thedate:thedate, startTime:startTime
          , endTime:endTime, room:room} , function(responseTxt,statusTxt,xhr){
            if(statusTxt=="error")
              alert("Error: "+xhr.status+": "+xhr.statusText)
          });
        });
      }); 
