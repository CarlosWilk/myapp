<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!-- jQuery -->
<script>

	// onkeyup event will occur when the user 
	// release the key and calls the function
	// assigned to this event
	function GetDetail(str) {
		console.log("Test");

		if (str.length == $product_id) {
			document.getElementById("productName_1").value = "";
			document.getElementById("price_1").value = "";
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
					// received to product name input field

					document.getElementById
						("productName_1").value = myObj[1];

					// Assign the value received to
					// price input field
					document.getElementById(
						"price_1").value = myObj[3];
				}
			};

			// xhttp.open("GET", "filename", true);
			xmlhttp.open("GET", "garage.php?product_id=" + str, true);

			// Sends the request to the server
			xmlhttp.send();
		}
	}

</script>
