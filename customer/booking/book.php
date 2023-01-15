<?php

//Remember the data from the login
session_start();

//Get the user id in order to retrieve information from the database
$userID = $_SESSION['id'];

//Require the connection to the database
require_once("/xampp/htdocs/myapp/customer/conf.php");

// Get all the categories from category table
$sql = "SELECT * FROM booking_type";
$all_categories = mysqli_query($link, $sql);

// Get all the categories from vechile type table
$sql1 = "SELECT * FROM vehicle_type";
$all_types = mysqli_query($link, $sql1);

// Get all the categories from vechile type table
$sql2 = "SELECT * FROM vehicle_engine";
$all_engines = mysqli_query($link, $sql2);

//Get the customer information such as name and email from the database
$sql3 = "SELECT fullname, email FROM users WHERE id = '$userID'";
$allcustomer = mysqli_query($link,$sql3);

//array to store the information about the customer
$userInfo = mysqli_fetch_array(
    $allcustomer,
    MYSQLI_ASSOC
);


if (isset($_GET['date'])) {
    $date = $_GET['date'];
    $stmt = $link->prepare("SELECT * from bookings where date =?");
    $stmt->bind_param('s', $date);
    $bookings = array();

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $bookings[] = $row['timeslot'];
            }
            $stmt->close();
        }
    }
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $timeslot = $_POST['timeslot'];
    $phone = $_POST['phone'];
    $vehicle_type[] = array();
    $vehicle_license = $_POST['vehicle_license'];
    $vehicle_engine[] = array(); 
    $bookingId[] = array();
    $comments = $_POST['comments'];
    $id = $_POST['userID'];


    $stmt = $link->prepare("SELECT * from bookings where date =? AND timeslot =?");
    $stmt->bind_param('ss', $date, $timeslot);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $msg = "<div class='alert alert-danger'> Already booked</div>";
        } else {
            $stmt = $link->prepare("INSERT INTO bookings (name, phone, email, date, timeslot, vehicle_type, vehicle_license, engine_type, booking_type, comments, username_id) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
            $stmt->bind_param('sssssisiiss', $name, $phone, $email, $date, $timeslot, $vehicle_type, $vehicle_license, $vehicle_engine, $bookingId,$comments,$id );
            $stmt->execute();
            $msg = "<div class='alert alert-success'> Booking Successfull</div>";
            $bookings[] = $timeslot;
            $stmt->close();
            $link->close();

        }
    }



}

//Configuration of the timeslot
$duration = 120;
$cleanup = 0;
$start = "09:00";
$end = "17:00";

function timeslots($duration, $cleanup, $start, $end)
{
    $start = new DateTime($start);
    $end = new DateTime($end);
    $interval = new DateInterval("PT" . $duration . "M");
    $cleanupInterval = new DateInterval("PT" . $cleanup . "M");
    $slots = array();

    for ($intStart = $start; $intStart < $end; $intStart->add($interval)->add($cleanupInterval)) {
        $endPeriod = clone $intStart;
        $endPeriod->add($interval);
        if ($endPeriod > $end) {
            break;
        }

        $slots[] = $intStart->format("H.iA") . "-" . $endPeriod->format("H:iA");
    }

    return $slots;

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Booking date</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudfire.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <hr>
    <button type="button" onclick="history.back();">Return</button>
    <div class="container">
        <h1 class="text-center">Book for date: <?php echo date('m/d/Y', strtotime($date)); ?> </h1>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <?php echo isset($msg) ? $msg : ""; ?>
            </div>
            <?php $timeslots = timeslots($duration, $cleanup, $start, $end);

            foreach ($timeslots as $ts) {
                ?>
                <div class="col-md-2">
                    <div class="form-group">
                        <?php if (in_array($ts, $bookings)) { ?>
                            <button class="btn btn-danger"><?php echo $ts; ?></button>
                            <?php } else { ?>
                            <button class="btn btn-success book" data-timeslot="<?php echo $ts; ?>">
                                <?php echo $ts;
                                ?>
                            </button>
                            <?php } ?>

                    </div>
                </div>
                <?php } ?>

            <!-- Modal plugin -->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Booking: <span id="slot"></span></h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label for=""> Timeslot</label>
                                            <input required type="text" readonly name="timeslot" id="timeslot"
                                                class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Name</label>
                                            <input required type="text" name="name" class="form-control" value="<?php echo $userInfo['fullname']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Phone</label>
                                            <input required type="text" name="phone" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input required type="email" name="email" class="form-control" value="<?php echo $userInfo['email']; ?>">
                                        </div>
                                        <label>Select a Category</label>
                                        <select name="Category">
                                            <?php
                                            // use a while loop to fetch data
                                            // from the $all_categories variable
                                            // and individually display as an option
                                            while (
                                                $category = mysqli_fetch_array(
                                                    $all_categories,
                                                    MYSQLI_ASSOC
                                                )
                                            ):
                                                ;
                                                ?>
                                                <option value="<?php echo $category["id"];
                                                // The value we usually set is the primary key
                                                ?>">
                                                    <?php echo $category["booking_name"];
                                                    // To show the category name to the user
                                                    ?>
                                                </option>
                                                <?php
                                            endwhile;
                                            // While loop must be terminated
                                            ?>
                                        </select>
                                        <p><label>Select the vehicle type</label>
                                        <select name="type">
                                            <?php
                                            // use a while loop to fetch data
                                            // from the $all_types variable
                                            // and individually display as an option
                                            while (
                                                $vehicle_type = mysqli_fetch_array(
                                                    $all_types,
                                                    MYSQLI_ASSOC
                                                )
                                            ):
                                                ;
                                                ?>
                                                <option value="<?php echo $vehicle_type["type_id"];
                                                // The value we usually set is the primary key
                                                ?>">
                                                    <?php echo $vehicle_type["type_name"];
                                                    // To show the category name to the user
                                                    ?>
                                                </option>
                                                <?php
                                            endwhile;
                                            // While loop must be terminated
                                            ?>
                                        </select>
                                        <p><label>Select the vehicle engine</label>
                                        <select name="engine">
                                            <?php
                                            // use a while loop to fetch data
                                            // from the $all_engines variable
                                            // and individually display as an option
                                            while (
                                                $vehicle_engine = mysqli_fetch_array(
                                                    $all_engines,
                                                    MYSQLI_ASSOC
                                                )
                                            ):
                                                ;
                                                ?>
                                                <option value="<?php echo $vehicle_engine["engine_id"];
                                                // The value we usually set is the primary key
                                                ?>">
                                                    <?php echo $vehicle_engine["engine_desc"];
                                                    // To show the category name to the user
                                                    ?>
                                                </option>
                                                <?php
                                            endwhile;
                                            // While loop must be terminated
                                            ?>
                                        </select>
                                        <div class="form-group">
                                            <label for="">Vehicle license</label>
                                            <input required type="text" name="vehicle_license" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Comments</label>
                                            <input required type="comments" name="comments" class="form-control">
                                        </div>
                                        <input type="hidden" name="userID" value="<?php echo $_SESSION["id"] ?>">
                                        <div class="form-group pull-right">
                                            <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- <script src="/jquery-3.3.1.min.js"></script>
    <script src="/bootstrap.min.js"></script> -->
    <script>
        $(".book").click(function () {
            var timeslot = $(this).attr('data-timeslot');
            $("#slot").html(timeslot);
            $("#timeslot").val(timeslot);
            $("#myModal").modal("show");
        })

    </script>

    <!--<script src="js/bootstrap.min.js"></script>-->
</body>

</html>