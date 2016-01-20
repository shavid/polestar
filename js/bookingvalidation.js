//This Javascript file contains the validation for bookings. Handling the Mobile number, email addresses and start/end times.




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


      


//Function that ensures that when modifiying the start time that it is prior to the end time.      
$(document).ready(function(){
  $('#startTime').on('change', function (e) {
    //locally stores values of the start time and end time
    var startTime = $("#startTime").val();  
    var endTime = $("#endTime").val();  
    //First if statement checks if the end time value is blank
    //if so the correct_Time value is set to false , but the user doesn't recieve an error
    //message as no end time has yet been selected. This would cause issues if the user 
    //later selects a blank value for end time, as they won't have an error message pushed.
    if($("#endTime").val() == "")  
    {     
      correct_Time = false;
    }    
    //Else if checks if the start Time is greater than (meaning later than) or equal to the end 
    //time, if so an alert is sent and the correct_Time variable is set to false.
    else if (startTime >= endTime)  
      {  
        alert('Start time must be before end time');   
        correct_Time = false;
      } 
    //If the above conditions are not met then the start time must be a value that can be considered 
    //correct and the correct_Time variable is set to true.  
    else
      {
    correct_Time = true;
      }
  });
});





$(document).ready(function(){
  $('#endTime').on('change', function (e) {
    //locally stores values of the start time and end time
    var startTime = $("#startTime").val();  
    var endTime = $("#endTime").val();  
    //First if statement checks if the start time value is blank
    //if so the correct_Time value is set to false , but the user doesn't recieve an error
    //message as no end time has yet been selected. This would cause issues if the user 
    //later selects a blank value for end time, as they won't have an error message pushed.
    if($("#startTime").val() == "")  
    {     
      correct_Time = false;
    }    
    //Else if checks if the start Time is greater than (meaning later than) or equal to the end 
    //time, if so an alert is sent and the correct_Time variable is set to false.
    else if (startTime >= endTime)  
    {  
      alert('Start time must be before end time');   
      correct_Time = false;
    } 
    //If the above conditions are not met then the start time must be a value that can be considered 
    //correct and the correct_Time variable is set to true.  
    else
    {
      correct_Time = true;
    }
  });
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