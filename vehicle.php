<?php

// Include config file

require_once "customer/conf.php";
// Define variables and initialize with empty values
$type = $license = $brand = $bookingId = $comments = "";

//Take the variables from the form
$type = $_POST['type'];
$license = $_POST['license'];
$brand = $_POST['brand'];
$bookingId = $_POST['booking_id'];
$comments = $_POST['comments'];


if(empty($type) && empty ($license) && empty($brand) && empty($bookingId) && empty ($comments)){

    echo "Please fill all the fields";

} else {
    // Prepare an insert statement
    $sql = "INSERT INTO vehicles (`type`,`license`,`brand`,`booking_id`,`comments`)VALUES ('$type', '$license', '$brand','$bookingId', '$comments')";

    //insert in database
    $rs = mysqli_query($link, $sql);

    if ($rs) {

        echo "Records inserted";
    }

}

mysqli_close($link);

?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php'); ?>

    <h4 class="center"> Register a vehicle</h4>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<form action="vehicle.php" method="post">
        <label>Vehicle type: </label>
        <input type="text" name="type" value="<?php echo $type; ?>">
        <label>License Plate: </label>
        <input type="text" name="license" value="<?php echo $license; ?>">
        <label>Brand: </label>
        <input type="text" name="brand" value="<?php echo $brand; ?>">
        <label> Comments: </label>
        <input type="text" name="comments" value="<?php echo $comments; ?>">
        <fieldset>
        <label> Booking: </label>
        <input type="text" name="bookingId" value="<?php echo $bookingId; ?>">

        1 - Annual Service<input type="radio" name="booking" value="annual">
        2 - Major Service <input type="radio" name="booking" value="major">
        <br> 3 Repair or Fault
        <br> 4 - Major Repair
        </fieldset>
        <input type="submit" name="submit" value="Submit">
        <input type="reset" name="reset" value="Reset">

</form>
       


<?php include('templates/footer.php'); ?>

</html>