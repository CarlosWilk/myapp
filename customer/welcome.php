<?php

//Menu
require('/xampp/htdocs/myapp/templates/menu.php');

//Connection to the database
require('/xampp/htdocs/myapp/customer/conf.php');

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
} else {

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

}

?>

<!DOCTYPE html>
<html>


<body>
    <h1> Welcome to your homepage </h1> 
    
    <h4> <!-- Display the name of the logged user -->
        <?php echo $userInfo['fullname'] ?>
    </h4>
    <img src="https://onmotor.com.br/wp-content/uploads/2022/02/2022-03-21-oficina-mecanica-moderna.jpg">
    


</body>

</html>