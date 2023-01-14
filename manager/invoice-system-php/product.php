<?php

//Page to search a product in the database
  
// Get the product id 
$productCode = $_REQUEST['productCode'];

$name = null;
$price = null;

// Database connection
require_once("/xampp/htdocs/myapp/customer/conf.php");
  
if ($productCode !== "") {
      
    // Get corresponding product name and 
    // price for that product code    
    $sql = "SELECT name, 
    price FROM itens WHERE product_id=?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param('s', $productCode);


    if ($stmt -> execute()){

        $result = $stmt->get_result();
        $row = $result->fetch_array(MYSQLI_ASSOC);
  
        // Get the first name
        $name = $row["name"];
      
        // Get the first name
        $price = $row["price"];


    } else {

        error_log("Product not found");
    }
   
}
  
// Store it in a array
$result = array("$name", "$price");
  
// Send in JSON encoded form
$myJSON = json_encode($result);
echo $myJSON;
?>