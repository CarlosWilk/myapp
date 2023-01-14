<?php

//Include connection to the database
require_once("/xampp/htdocs/myapp/customer/conf.php");
require("/xampp/htdocs/myapp/templates/menu4.php");  

session_start();

?>

<?php

//Include connection to the database
require_once("/xampp/htdocs/myapp/customer/conf.php");


//By default will be displayed all the bookings
$query = ("SELECT bookings.id, name, phone, date, timeslot, booking_type.booking_name, comments, booking_status.status_desc FROM bookings LEFT JOIN booking_status ON bookings.status = booking_status.status_id LEFT JOIN booking_type on bookings.booking_type = booking_type.id");

if (isset($_POST['all'])) {
    //Show all the booking for the current day
    $query = ("SELECT bookings.id, name, phone, date, timeslot, booking_type.booking_name, comments, booking_status.status_desc FROM bookings LEFT JOIN booking_status ON bookings.status = booking_status.status_id LEFT JOIN booking_type on bookings.booking_type = booking_type.id");
} else if (isset($_POST['today'])) {
    //Show all the booking for the current day
    $query = ("SELECT bookings.id, name, phone, date, timeslot, booking_type.booking_name, comments, booking_status.status_desc FROM bookings LEFT JOIN booking_status ON bookings.status = booking_status.status_id LEFT JOIN booking_type on bookings.booking_type = booking_type.id where date=current_date");
}
if (isset($_POST['week'])) {
    //Show all the booking for the current day
    $query = ("SELECT bookings.id, name, phone, date, timeslot, booking_type.booking_name, comments, booking_status.status_desc FROM bookings LEFT JOIN booking_status ON bookings.status = booking_status.status_id LEFT JOIN booking_type on bookings.booking_type = booking_type.id where date>=current_date");
}


?>

<!-- Page to display all bookings -->

<body class="blue lighten-3">
    <nav class="white z-depth-0"> <!-- by default give no depth -->
        <div class="container"> <!-- central column -->
            <ul id="nav-mobile" class="right hide-on-small-and-down">
                <form action='' method='POST'>
                    <input type="submit" name="all" value="All bookings">
                    <input type="submit" name="week" value="This week">
                    <input type="submit" name="today" value="Today">
                </form>
            </ul>
        </div>
    </nav>
    <div class="m-5">
    <?php echo '<table border="1" cellspacing="3" cellpadding="3"> 
      <tr> 
          <td> <font face="Arial">Booking ID</font> </td>
          <td> <font face="Arial">Name</font> </td> 
          <td> <font face="Arial">Phone</font> </td> 
          <td> <font face="Arial">Date</font> </td> 
          <td> <font face="Arial">Timeslot</font> </td> 
          <td> <font face="Arial">Service type</font></td>
          <td> <font face="Arial">Comments</font></td>
          <td><font face="Arial">Status </font></td>
          

      </tr>';
 

    if ($result = $link->query($query)) {
        while ($booking_data = mysqli_fetch_assoc($result)) {
           
            echo "<tr>";
            echo "<td>" . $booking_data['id'] . "</td>";
            echo "<td>" . $booking_data['name'] . "</td>";
            echo "<td>" . $booking_data['phone'] . "</td>";
            echo "<td>" . $booking_data['date'] . "</td>";
            echo "<td>" . $booking_data['timeslot'] . "</td>";
            echo "<td>" . $booking_data['booking_name'] . "</td>";
            echo "<td>" . $booking_data['comments'] . "</td>";
            echo "<td>" . $booking_data['status_desc'] . "</td>";
            echo"<td> 
                    <a class='btn btn-sm btn-primary' href='testbook.php?id=$booking_data[id]'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                            <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
                        </svg>
                    </a>
                    <a class='btn btn-sm btn-primary' href='/myapp/manager/invoice-system-php/create_invoice.php?id=$booking_data[id]'>
                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-receipt' viewBox='0 0 16 16'>
                    <path d='M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z'/>
                    <path d='M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z'/>
                  </svg>
                    </a>
                </td>";
            echo "</tr>";


        }
        $result->free();
    } ?>
     </div>

</body>

</html>