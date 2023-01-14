<?php

//Include connection to the database
require_once("/xampp/htdocs/myapp/customer/conf.php");

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<?php

//Include connection to the database
require_once("/xampp/htdocs/myapp/customer/conf.php");

if (!empty($_GET['id'])) {

    //Get the booking id selected in the previous page
    $bookingID = $_GET['id'];



    //query
    $sqlSelect = ("SELECT bookings.id, name, phone, date, timeslot, booking_type.booking_name, vehicle_license, vehicle_type.type_name, comments, bookings.status, booking_status.status_desc FROM bookings 
LEFT JOIN booking_status ON bookings.status = booking_status.status_id 
LEFT JOIN booking_type on bookings.booking_type = booking_type.id
LEFT JOIN vehicle_type on bookings.vehicle_type = vehicle_type.type_id
where bookings.id = $bookingID");

    // Get all the status from booking status table
    $sqlStatus = "SELECT * FROM booking_status";
    $all_status = mysqli_query($link, $sqlStatus);

    $result = $link->query($sqlSelect);

    if ($result->num_rows > 0) {

        while ($booking_data = mysqli_fetch_assoc($result)) {

            $name = $booking_data['name'];
            $phone = $booking_data['phone'];
            $phone = $booking_data['phone'];
            $date = $booking_data['date'];
            $timeslot = $booking_data['timeslot'];
            $type_booking = $booking_data['booking_name'];
            $vehicle_license = $booking_data['vehicle_license'];
            $vehicle_type = $booking_data['type_name'];
            $comments = $booking_data['comments'];
            $status = $booking_data['status_desc'];
            $booking_data['status'] = $status;
        }


    } else {

        header('Location: editbook.php');
    }

}




?>

<html>

<body class="blue lighten-3">
    <
    <a href="editbook.php" class="btn btn-primary"> Return </a>

    <div class="box">
        <form action="saveEdit.php" method="POST">
            <fieldset>
            <legend>Editing Client Booking</legend>
            <br>
                <label> Booking ID </label>
                <input readonly name="bookingID" id="bookingID" class="form-control" value="<?php echo $bookingID ?>">
                <div class="form-group">
                    <label for="">Name</label>
                        <input readonly name="name" class="form-control" value="<?php echo $name ?>">
                </div>
                <div class="form-group">
                    <label for=""> Timeslot</label>
                        <input readonly name="timeslot" id="timeslot" class="form-control" value="<?php echo $timeslot ?>">
                </div>
                <div class="form-group">
                    <label for="">Phone</label>
                        <input type="text" name="phone" class="form-control" value="<?php echo $phone ?>">
                </div>
                <div class="form-group">
                    <label>Vehicle license</label>
                        <input readonly name="vehicle_license" class="form-control" value="<?php echo $vehicle_license ?>">
                </div>
                <div class="form-group">
                    <label>Vehicle Model</label>
                        <input readonly name="vehicle_license" class="form-control" value="<?php echo $vehicle_type ?>">
                </div>
                <div class="form-group">
                    <label for="">Comments</label>
                        <input readonly name="comments" class="form-control" value="<?php echo $comments ?>">
                </div>
                <div class="form-group">
                    <label>Select a status</label>
                        <select name="Category">
                        <?php
                        // use a while loop to fetch data
                        // from the $all_categories variable
                        // and individually display as an option
                        while (
                            $status = mysqli_fetch_array(
                                $all_status,
                                MYSQLI_ASSOC
                            )
                        ):
                            ;
                            ?>
                            <option value="<?php echo $status['status_id']; ?>">


                                <?php echo $status['status_desc']; ?>
                            </option>
                            <?php
                        endwhile;
                        // While loop must be terminated
                        ?>
                    </select>
                </div>

                <div class="form-group pull-right">
                    <input type="hidden" name="id" value="<?php echo $bookingID?>">
                    <input type="hidden" name="bstatus" value="<?php echo $booking_data?>">
                    <button class="btn btn-primary" type="submit" name="update" id="update">Save</button>
                    </div>
            </fieldset>
        </form>


</body>

</html>