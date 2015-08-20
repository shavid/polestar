<select>
<?php


//Sets the inital open and close time.
//These can be changed as per requirements
$opentime = strtotime('09:00');
$closetime = strtotime('22:00');


    //Initalizes the booking time to be used in the loop
    $bookingtime = $opentime;
  
    //Echos a blank option for default.
    echo '<option></option>';


    //While the booking time is before the closing time and after the open time.
    while($bookingtime <= $closetime && $bookingtime >= $opentime) 

        {
            //Echos a option , the value is the same as the time displayed
            echo '<option value="'. date('H:i', $bookingtime) .'">' . date('H:i', $bookingtime) . 
            '</option>'."\n";


            $bookingtime = strtotime('+30 minutes', $bookingtime);
        }
    echo "</select>"; 
