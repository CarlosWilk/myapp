<html>

<head>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js">
    </script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript">
    </script>
    <script src="js/invoice.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
    </script>
</head>

<body>
    <div class="container">
        <h1>Invoice</h1>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 pull-right">
					<h3>To,</h3>
					<div class="form-group">
						<input type="text" class="form-control" name="companyName" id="companyName"
							placeholder="Client Name" autocomplete="off">
						<label>Select a vehicle</label>
</div>
					<div class="form-group">
					<label>Select a mechanic</label>
					<select name="mechanic">
                    <option value="" data-default disabled selected></option>
                    <option value="mechanic1">Finbar Shanahan</option>
                <option value="mechanic2">Dermot O'Connell</option>
                <option value="mechanic3">Colman Murphy</option>
                <option value="mechanic4">Donagh Quinn</option>

								</option>
								

						</select>
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
            </div>
        </div>
        <tr>
            <td>
                <input class="itemRow" type="checkbox">
            </td>
            <td>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type='text' name="product_id" id='product_id' class='form-control'
                                placeholder='Enter user id' onkeyup="GetDetail(this.value)" value="">
                        </div>
                    </div>

                </div>
            </td>
            <td>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="text" name="first_name" id="first_name" class="form-control"
                                placeholder='Description' value="">
                        </div>
                    </div>
                </div>
            </td>
            <td>
                <input type="number" name="quantity[]" id="quantity_1" class="form-control quantity" autocomplete="off">
            </td>
            <td>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="text" name="last_name" id="last_name" class="form-control"
                                placeholder='price' value="">
                        </div>
                    </div>
                </div>
            </td>
            <td>
                <input type="number" name="total[]" id="total_1" class="form-control total" autocomplete="off">
            </td>
        </tr>
        </table>
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
    <script>

        //Script based on GeeksforGeeks
        //https://www.geeksforgeeks.org/how-to-fill-all-input-fields-automatically-from-database-by-entering-input-in-one-textbox-using-php/

        // onkeyup event will occur when the user release the key and calls the function
        // assigned to this event
        function GetDetail(str) {
            if (str.length == 0) {
                document.getElementById("first_name").value = "";
                document.getElementById("last_name").value = "";
                return;
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
                            ("first_name").value = myObj[0];

                        // Assign the value received to
                        // last name input field
                        document.getElementById(
                            "last_name").value = myObj[1];
                    }
                };

                // xhttp.open("GET", "filename", true);
                xmlhttp.open("GET", "product.php?product_id=" + str, true);

                // Sends the request to the server
                xmlhttp.send();
            }
        }
    </script>
</body>

</html>