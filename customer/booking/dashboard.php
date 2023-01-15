<?php 

// Initialize the session
session_start();

require("/xampp/htdocs/myapp/templates/menu.php");

//Variable to hold the connection to the database
$conn = require("/xampp/htdocs/myapp/customer/conf.php");


$username = "root";
$password = "root";
$database = "garage";

$mysqli = new mysqli("localhost", $username, $password, $database);

//SQL query
$query = ("SELECT date, timeslot,vehicle_license, booking_type.booking_name, comments, booking_status.status_desc 
FROM bookings LEFT JOIN booking_type on bookings.booking_type = booking_type.id LEFT JOIN booking_status on bookings.status = booking_status.status_id
where username_id = '".$_SESSION['id']."'");

// Execute the query (the recordset $rs contains the result)
$rs = mysqli_query($mysqli, $query);

?>

<html>
<body>

<?php echo '<table border="1" cellspacing="3" cellpadding="3"> 
      <tr> 
          <td> <font face="Arial">Date</font> </td> 
          <td> <font face="Arial">Time</font> </td> 
          <td> <font face="Arial">Vehicle License</font> </td> 
          <td> <font face="Arial">Type of Booking</font> </td> 
          <td> <font face="Arial">Comments</font> </td> 
          <td> <font face="Arial">Status</font> </td> 
      </tr>';

if ($result = $mysqli->query($query)) {
    while ($row = $rs->fetch_assoc()) {
        $date = $row["date"];
        $timeslot = $row["timeslot"];
        $vehicle = $row["vehicle_license"];
        $bookingID = $row["booking_name"];
        $comments = $row["comments"];
        $status = $row["status_desc"];

        echo '<tr> 
                  <td>'.$date.'</td> 
                  <td>'.$timeslot.'</td> 
                  <td>'.$vehicle.'</td>
                  <td>'.$bookingID.'</td>
                  <td>'.$comments.'</td>
                  <td>'.$status.'</td> 

              </tr>';
    }
    $result->free();
} 
// Close the database connection
mysqli_close($mysqli);?> 

</body>
</html>



