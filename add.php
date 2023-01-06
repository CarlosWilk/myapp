<?php

include('connection.php');

if (isset($_POST['submit'])) {
    echo htmlspecialchars ($_POST['firstName']);
    echo htmlspecialchars ($_POST['lastName']);
    echo htmlspecialchars ($_POST['city']);

    //Check if name field is filled
    if (empty($_POST['firstName'])) {
        echo 'A name is required <br />';
    } else {
        echo htmlspecialchars($_POST['firstName']);
    }

        //echo 'form is valid';
        //prevent malicious sql injection
        $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
        $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
        $city = mysqli_real_escape_string($conn, $_POST['city']);

        //Create SQL
        $sql = "INSERT INTO customer(first_name, last_name, city) VALUES ('$firstName', '$lastName', '$city')";

        //save to db and check
        if(mysqli_query($conn, $sql)){
            //sucess
            header('Location: index.php');
        } else{
            //error
            echo 'query error' . mysqli_error($conn);
        }
    }

 //end of _POST
?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php'); ?>

<section class="container grey-text">

    <h4 class="center"> Register </h4>
    <form class="white" action="add.php" method="POST">
        <label> First name: </label>
        <input type="text" name="firstName">
        <label> Last name: </label>
         <input type="text" name="lastName">
        <!-- <label> Address: </label>
        <input type="text" name="address">
        <label> Phone number: </label>
        <input type="text" name="phoneNumber"> -->
        <label> City: </label>
        <input type="text" name="city">
        <!-- <label> Vehicle license plate: </label>
        <input type="text" name="vehicle">
        <label> Postal code: </label>
        <input type="text" name="postalCode"> -->
        

        <!--SUbmitted button -->
        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
        </div>
    </form>
</section>


<?php include('templates/footer.php'); ?>

</html>