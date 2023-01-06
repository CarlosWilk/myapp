<?php 

// Initialize the session
session_start();

require("/xampp/htdocs/myapp/templates/menu2.php");

$username = "root";
$password = "root";
$database = "garage";


$mysqli = new mysqli("localhost", $username, $password, $database);

//SQL query
$query = ("SELECT * FROM bookings where username_id = '".$_SESSION['id']."'");

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
    while ($row = $result->fetch_assoc()) {
        $date = $row["date"];
        $timeslot = $row["timeslot"];
        $vehicle = $row["vehicle_license"];
        $bookingID = $row["booking_id"];
        $comments = $row["comments"];
        $status = $row["status"];

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



