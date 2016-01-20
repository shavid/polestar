

 window.onload = function() {
  todayFunc() ;
};

       function yesterdayFunc() {


 var today = moment();
 var tomorrow = today.subtract('days', 1);
 chosendate = moment(tomorrow).format("YYYY-MM-DD");

 $("#timeline").load("select.php", {chosendate:chosendate}, function(responseTxt,statusTxt,xhr){
 if(statusTxt=="error")
 alert("Error: "+xhr.status+": "+xhr.statusText)
 });
 }

 
      function todayFunc() {

 chosendate = moment().format('YYYY-MM-DD');

 $("#timeline").load("select.php", {chosendate:chosendate}, function(responseTxt,statusTxt,xhr){
 if(statusTxt=="error")
 alert("Error: "+xhr.status+": "+xhr.statusText)
 });

}


 function tomorrowFuncs() {


 var today = moment();
 var tomorrow = today.add(1 , 'days');
 chosendate = moment(tomorrow).format("YYYY-MM-DD");

$("#timeline").load("select.php", {chosendate:chosendate}, function(responseTxt,statusTxt,xhr){
if(statusTxt=="error")
alert("Error: "+xhr.status+": "+xhr.statusText)
 });
 }