
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


function changedate() {
  
      chosendate = $("#grid_datepicker").val();

      $("#timeline").load("select.php", {chosendate:chosendate}, function(responseTxt,statusTxt,xhr){
            if(statusTxt=="error")
              alert("Error: "+xhr.status+": "+xhr.statusText)
          });


    }
    