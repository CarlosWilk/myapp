<?php
session_start();
include('inc/header.php');
include 'Invoice.php';

$mysqli = new mysqli('localhost', 'root', 'root', 'garage');

// Get all the categories from category table
$sql = "SELECT * FROM vehicles";
$all_categories = mysqli_query($mysqli, $sql);

//Get all the items from items table
$sql2 = "SELECT * FROM itens";
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

// Get the product id 
 $product_id = "";
print_r($product_id);


      
//     // Get corresponding name and price for that product id    
    $query = mysqli_query($mysqli, "SELECT name, price FROM itens WHERE product_id='$product_id'");
  
    $row = mysqli_fetch_array($query);
  
     // Get the first name
   isset($row['name']);
  
     // Get the first name
    $price = $row["price"];
	

  
// Store it in a array
$result = array("$name", "$price");
  
// Send in JSON encoded form
$myJSON = json_encode($result);
echo $myJSON;

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
					<h3>To,</h3>
					<div class="form-group">
						<input type="text" class="form-control" name="companyName" id="companyName"
							placeholder="Client Name" autocomplete="off">
						<label>Select a vehicle</label>
						<select name="client">
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
								<option value="<?php echo $category["license"];
								// The value we usually set is the primary key
								?>">
									<?php echo $category["license"];
									// To show the category name to the user
									?>
								</option>
								<?php
							endwhile;
							// While loop must be terminated
							?>
						</select>
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
								<input type='text' name="product_id[]" id='product_id' class='form-control'
									placeholder='Enter the product code' onkeyup="GetDetail(this.value)">
							</td>
							<td>
								<input type="text" name="productName[]" id="productName_1" class="form-control"
							 value="" autocomplete="off">
							 		
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
								<div class="input-group-addon currency">$</div>
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
								<div class="input-group-addon currency">$</div>
								<input value="" type="number" class="form-control" name="taxAmount" id="taxAmount"
									placeholder="Tax Amount">
							</div>
						</div>
						<div class="form-group">
							<label>Total: &nbsp;</label>
							<div class="input-group">
								<div class="input-group-addon currency">$</div>
								<input value="" type="number" class="form-control" name="totalAftertax"
									id="totalAftertax" placeholder="Total">
							</div>
						</div>
						<div class="form-group">
							<label>Amount Paid: &nbsp;</label>
							<div class="input-group">
								<div class="input-group-addon currency">$</div>
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


<?php include('inc/footer.php'); ?>