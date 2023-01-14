<?php

require('/xampp/htdocs/myapp/customer/conf.php');

if(isset($_POST['update']))
    {

    $bookingID = $_POST['id'];
    $booking_status = $_POST['bstatus'];


    $sqlUpdate = "UPDATE bookings SET status='$booking_status' where id='$bookingID'";

    print($sqlUpdate);

    $result = $link->query($sqlUpdate);

    

}

