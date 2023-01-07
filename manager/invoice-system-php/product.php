<?php
  
// Get the user id 
$product_id = $_REQUEST['product_id'];
  
// Database connection
$con = mysqli_connect("localhost", "root", "root", "garage");
  
if ($product_id !== "") {
      
    // Get corresponding first name and 
    // last name for that user id    
    $query = mysqli_query($con, "SELECT name, 
    price FROM itens WHERE product_id='$product_id'");
  
    $row = mysqli_fetch_array($query);
  
    // Get the first name
    $name = $row["name"];
  
    // Get the first name
    $price = $row["price"];
}
  
// Store it in a array
$result = array("$name", "$price");
  
// Send in JSON encoded form
$myJSON = json_encode($result);
echo $myJSON;
?>