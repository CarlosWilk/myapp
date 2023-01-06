<?php

include('connection.php');
//write query
$sql = 'SELECT * FROM vehicles';

//make the query e get result
$result = mysqli_query($conn, $sql);

//fetch the result row as array
$vehicles = mysqli_fetch_all($result, MYSQLI_ASSOC );

//print_r($customers); print array

//free the result from memory
mysqli_free_result($result);

//close the connection to database
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php'); ?>

<h4 class="center grey-text"> Vehicles registered </h4>

<div class="container">
<div class="row">

<?php foreach($vehicles as $vehicle): ?>

    <div class="col s6 md3"> 
        <div class="card z-depth-0">
            <div class="card-content center">
                <h6><?php echo htmlspecialchars($vehicle['type']); ?></h6>
                <div><?php echo htmlspecialchars($vehicle['license']); ?></div>
                <div><?php echo htmlspecialchars($vehicle['brand']); ?></div>
            </div>
            <div class="card-action right align">
                <a class="brand-text" href="details.php"> More info </a>
            </div>
        </div>
    </div>

<?php endforeach; ?>

<!-- Count how many customer there are  -->
<!-- <?php if (count($vehicles) >= 2): ?>
<p>There are 2 or more customers</p>
<?php else: ?>
<p>There are less than 2 customers</p>

<?php endif; ?> -->

</div>

</div>






<?php include('templates/footer.php'); ?>



</html>