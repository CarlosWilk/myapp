<?php

//Code to update the new status into the database

require('/xampp/htdocs/myapp/customer/conf.php');

if(isset($_POST['update']))
    {

    $bookingID = $_POST['id'];
    $selectOption = $_POST['status'];


    $sqlUpdate = "UPDATE bookings SET status='$selectOption' where id='$bookingID'";

    print($sqlUpdate);

    $result = $link->query($sqlUpdate);
    
}

header('Location: view_book.php');
