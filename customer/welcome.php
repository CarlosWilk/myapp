<?php

include('/xampp/htdocs/myapp/templates/menu.php');

// Initialize the session
session_start();
//var_dump($_SESSION);

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html>


    

<body>
    <h1> Welcome to your homepage <?php echo $_SESSION['username'] ?> </h1> 
    <img src="https://onmotor.com.br/wp-content/uploads/2022/02/2022-03-21-oficina-mecanica-moderna.jpg">
    <


</body>

</html>