<?php
session_start();

include('inc/header.php');
include 'Invoice.php';

$mysqli = new mysqli('localhost', 'root', 'root', 'garage');

$bookingID = $_GET['id'];

// Get all the vehicles licenses from booking table
$sqlBookings = "SELECT id, name, phone, vehicle_license, vehicle_type FROM bookings where id=$bookingID";

$result = $mysqli->query($sqlBookings);

if ($result->num_rows > 0) {

	while ($booking_data = mysqli_fetch_assoc($result)) {

		$id = $booking_data['id'];
		$name = $booking_data['name'];
		$phone = $booking_data['phone'];
		$vehicle_license = $booking_data['vehicle_license'];
		$vehicle_type = $booking_data['vehicle_type'];

	}
}

//Get all the items from items table
$sql1 = "SELECT id FROM bookings";
$all_bookings = mysqli_query($mysqli, $sql1);

//Get all the items from items table
$sql2 = "SELECT name, price FROM itens";
$all_itens = mysqli_query($mysqli, $sql2);

//Get all the items from items table
$sql3 = "SELECT * FROM mechanics";
$all_mechanics = mysqli_query($mysqli, $sql3);

$invoice = new Invoice();
$invoice->checkLoggedIn();
if (!empty($_POST['companyName']) && $_POST['companyName']) {
	$invoice->saveInvoice($_POST);
	header("Location:invoice_list.php");
}


?>

<!-- Template provider by phpzag.com 
the modifications include the selection of itens from the table and autocomplete them within the fields needed-->
<title>Invoice System with PHP & MySQL</title>
<script src="js/invoice.js"></script>
<link href="css/style.css" rel="stylesheet">

<?php include('inc/container.php'); ?>
<div class="container content-invoice">
	<form action="" id="invoice-form" method="post" class="invoice-form" role="form" novalidate="">
		<div class="load-animate animated fadeInUp">
			<div class="row">
				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
					<h2 class="title">PHP Invoice System</h2>
					<?php include('menu.php'); ?>
				</div>
			</div>
			<input id="currency" type="hidden" value="$">
			<div class="row">
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
					<h3>From,</h3>
					<?php echo $_SESSION['user']; ?><br>
					<?php echo $_SESSION['address']; ?><br>
					<?php echo $_SESSION['mobile']; ?><br>
					<?php echo $_SESSION['email']; ?><br>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 pull-right">
					<h3>Customer name:</h3>
					<div class="form-group">
						<input type="text" class="form-control" name="companyName" id="companyName" value="<?php echo $name ?>" autocomplete="off">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="address" id="address" value="<?php echo $phone ?>"></textarea>
					</div>
					<div class="form-group">
						<label>Booking ID <label>
							<input type="text" name="booking_id" value="<?php echo $bookingID ?>">
							
					</div>

					</div>
				</div>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="vehicleLicense" id="vehicleLicense"
							placeholder="Vehicle Model" autocomplete="off">
					</div>
					<div>
						<lable>Select a vehicle</label>
							<input type="text" class="form-control" name="vehicle_type" value="<?php echo $vehicle_license?>">

					</div>
					<div class="form-group">
					<label>Select a mechanic</label>
					<select name="mechanic">
							<?php
							// use a while loop to fetch data
							// from the $all_categories variable
							// and individually display as an option
							while (
								$mechanics = mysqli_fetch_array(
									$all_mechanics,
									MYSQLI_ASSOC
								)
							):
								;
								?>
								<option value="<?php echo $mechanics["mechanic_id"];
								// The value we usually set is the primary key
								?>">
									<?php echo $mechanics["fullname"];
									// To show the category name to the user
									?>
								</option>
								<?php
							endwhile;
							// While loop must be terminated
							?>
						</select>
					</div>

				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<table class="table table-bordered table-hover" id="invoiceItem">
						<tr>
							<th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
							<th width="15%">Item No</th>
							<th width="38%">Item Name</th>
							<th width="15%">Quantity</th>
							<th width="15%">Price</th>
							<th width="15%">Total</th>
						</tr>
						
						<tr>
							<td>
								<input class="itemRow"type="checkbox">
							</td>
							<td>
							<div class="form-group">
								<input type='text' name="productCode[]" id='productCode_1' class='form-control'
									placeholder='Enter the product code' onkeyup="GetDetail(this.value, 1)" value="">
							</div>
							</td>
							<td>
							<div class="form-group">
								<input type="text" name="productName[]" id="productName_1" class="form-control"
							 value="" autocomplete="off">
							</div>
							</td>
							<td>
								<input type="number" name="quantity[]" id="quantity_1" class="form-control quantity"
									autocomplete="off">
								</td>
							<td>
								<input type="number" name="price[]" id="price_1" class="form-control price" autocomplete="off">
							</td>
							<td>
								<input type="number" name="total[]" id="total_1" class="form-control total"
									autocomplete="off"></td>
						</tr>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
					<button class="btn btn-danger delete" id="removeRows" type="button">- Delete</button>
					<button class="btn btn-success" id="addRows" type="button">+ Add More</button>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
					<h3>Notes: </h3>
					<div class="form-group">
						<textarea class="form-control txt" rows="5" name="notes" id="notes"
							placeholder="Your Notes"></textarea>
					</div>
					<br>
					<div class="form-group">
						<input type="hidden" value="<?php echo $_SESSION['userid']; ?>" class="form-control"
							name="userId">
						<input data-loading-text="Saving Invoice..." type="submit" name="invoice_btn"
							value="Save Invoice" class="btn btn-success submit_btn invoice-save-btm">
					</div>

				</div>
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
					<span class="form-inline">
						<div class="form-group">
							<label>Subtotal: &nbsp;</label>
							<div class="input-group">
								<div class="input-group-addon currency">€</div>
								<input value="" type="number" class="form-control" name="subTotal" id="subTotal"
									placeholder="Subtotal">
							</div>
						</div>
						<div class="form-group">
							<label>Tax Rate: &nbsp;</label>
							<div class="input-group">
								<input value="" type="number" class="form-control" name="taxRate" id="taxRate"
									placeholder="Tax Rate">
								<div class="input-group-addon">%</div>
							</div>
						</div>
						<div class="form-group">
							<label>Tax Amount: &nbsp;</label>
							<div class="input-group">
								<div class="input-group-addon currency">€</div>
								<input value="" type="number" class="form-control" name="taxAmount" id="taxAmount"
									placeholder="Tax Amount">
							</div>
						</div>
						<div class="form-group">
							<label>Service: &nbsp;</label>
							<div class="input-group">
								<div class="input-group-addon currency">€</div>
								<input value="" type="number" class="form-control" name="feeService" id="feeService"
									placeholder="Service fee">
							</div>
						</div>
						<div class="form-group">
							<label>Total: &nbsp;</label>
							<div class="input-group">
								<div class="input-group-addon currency">€</div>
								<input value="" type="number" class="form-control" name="totalAftertax"
									id="totalAftertax" placeholder="Total">
							</div>
						</div>
						<div class="form-group">
							<label>Amount Paid: &nbsp;</label>
							<div class="input-group">
								<div class="input-group-addon currency">€</div>
								<input value="" type="number" class="form-control" name="amountPaid" id="amountPaid"
									placeholder="Amount Paid">
							</div>
						</div>
						<div class="form-group">
							<label>Amount Due: &nbsp;</label>
							<div class="input-group">
								<div class="input-group-addon currency">$</div>
								<input value="" type="number" class="form-control" name="amountDue" id="amountDue"
									placeholder="Amount Due">
							</div>
						</div>
					</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</form>
</div>
</div>

<script>

//Script based on GeeksforGeeks
//https://www.geeksforgeeks.org/how-to-fill-all-input-fields-automatically-from-database-by-entering-input-in-one-textbox-using-php/

// onkeyup event will occur when the user release the key and calls the function
// assigned to this event
function GetDetail(str, count) {

	//Nothing was typed
	if (str.length == 0) {
		document.getElementById("productName_"+count).value = "";
		document.getElementById("price_"+count).value = "";
		return "not found";
	}
	else {

		// Creates a new XMLHttpRequest object
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function () {

			// Defines a function to be called when
			// the readyState property changes
			if (this.readyState == 4 &&
				this.status == 200) {

				// Typical action to be performed
				// when the document is ready
				var myObj = JSON.parse(this.responseText);

				// Returns the response data as a
				// string and store this array in
				// a variable assign the value 
				// received to first name input field

				document.getElementById
					("productName_"+count).value = myObj[0];

				// Assign the value received to
				// last name input field
				document.getElementById(
					"price_"+count).value = myObj[1];
			}
		};

		// xhttp.open("GET", "filename", true);
		xmlhttp.open("GET", "product.php?productCode=" + str, true);

		// Sends the request to the server
		xmlhttp.send();
	}
}
</script>

<?php include('inc/footer.php'); ?>