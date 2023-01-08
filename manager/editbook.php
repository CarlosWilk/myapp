<?php

//Include connection to the database
require_once("/xampp/htdocs/myapp/customer/conf.php");

session_start();
//By default will be displayed all the bookings
$query = ("SELECT name, phone, date, timeslot, booking_id, comments, booking_status.status_desc 
FROM bookings LEFT JOIN booking_status ON bookings.status = booking_status.status_id where booking_id = 1");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Booking date</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudfire.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <hr>
    <button type="button" onclick="history.back();">Return</button>
    <div class="container">
        <h1 class="text-center">Edit Book for date: </h1>
            <!-- Modal plugin -->

    <?php echo '<table border="1" cellspacing="3" cellpadding="3"> 
      <tr> 
          <td> <font face="Arial">Name</font> </td> 
          <td> <font face="Arial">Phone</font> </td> 
          <td> <font face="Arial">Date</font> </td> 
          <td> <font face="Arial">Time</font> </td> 
          <td> <font face="Arial">Booking ID</font></td>
          <td> <font face="Arial">Comments</font></td>
          <td><font face="Arial">Status </font></td>
          

      </tr>';

    if ($result = $link->query($query)) {
        while ($row = $result->fetch_assoc()) {
            $field1name = $row["name"];
            $field2name = $row["phone"];
            $field3name = $row["date"];
            $field4name = $row["timeslot"];
            $field5name = $row["booking_id"];
            $field6name = $row["comments"];
            $field7name = $row["status_desc"];

            echo '<tr> 
                  <td>' . $field1name . '</td> 
                  <td>' . $field2name . '</td> 
                  <td>' . $field3name . '</td> 
                  <td>' . $field4name . '</td> 
                  <td>' . $field5name . '</td> 
                  <td>' . $field6name . '</td> 
                  <td>' . $field7name . '</td> 

           
                  <td> 
                    <a class="btn btn-sm btn-primary" href="editbook.php?id=$userID[id]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
  <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                        </svg>
                    </a>
                    </td>
              </tr>';
        }
        $result->free();
    } ?>


    <!--<script src="js/bootstrap.min.js"></script>-->
</body>

</html>