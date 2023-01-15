<?php //Invoices displayed for each customer

// Initialize the session
session_start();

//Display the menu
require("/xampp/htdocs/myapp/templates/menu.php");

//Connecttion to the database
require_once("/xampp/htdocs/myapp/customer/conf.php");

//Store the name of the user logged in
$username = $_SESSION['username'];

//Get the user id in order to retrieve information from the database
$userID = $_SESSION['id'];

//Get the customer fullname from the database
$sql = "SELECT fullname FROM users WHERE id = '$userID'";
$allcustomer = mysqli_query($link,$sql);

//array to store the information about the customer
$userInfo = mysqli_fetch_array(
    $allcustomer,
    MYSQLI_ASSOC
);

//SQL query to bring all the invoices where the current customer appears
$query = ("SELECT * FROM invoice_order LEFT JOIN bookings on invoice_order.booking_id = bookings.id where order_receiver_name = '$userInfo[fullname]'");


// Execute the query (the recordset $rs contains the result)
$rs = mysqli_query($link, $query);


?>

<?php echo '<table border="1" cellspacing="3" cellpadding="3"> 
      <tr> 
          <td> <font face="Arial">Order ID</font> </td> 
          <td> <font face="Arial">Order Date</font> </td> 
          <td> <font face="Arial">Receiver</font> </td> 
          <td> <font face="Arial">Total Tax</font> </td> 
          <td> <font face="Arial">Total after Tax</font> </td> 
          <td> <font face="Arial">Amount Paid</font> </td> 
          <td> <font face="Arial">Amount Due</font> </td> 
          <td> <font face="Arial">Note</font> </td> 
      </tr>';
      

if ($result = $link->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $orderID = $row["order_id"];
        $orderDate = $row["order_date"];
        $receiver = $row["order_receiver_name"];
        $totalTax = $row["order_total_tax"];
        $totalAfterTax = $row["order_total_after_tax"];
        $amountPaid = $row["order_amount_paid"];
        $amountDue = $row["order_total_amount_due"];
        $note = $row["note"];

        echo '<tr> 
                  <td>'.$orderID.'</td> 
                  <td>'.$orderDate.'</td> 
                  <td>'.$receiver.'</td>
                  <td>'.$totalTax.'</td>
                  <td>'.$totalAfterTax.'</td>
                  <td>'.$amountPaid.'</td> 
                  <td>'.$amountDue.'</td>
                  <td>'.$note.'</td> 

              </tr>';
    }
    $result->free();
} 
// Close the database connection
mysqli_close($link);?> 

</body>
</html>