<?php
include 'Calendar.php';
$calendar = new Calendar('2022-12-01');
$calendar->add_event('Bank Holidays', '2022-12-26', 1, 'green');
$calendar->add_event('New Year Bank Holiday', '2023-01-02', 1, 'red');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Event Calendar</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link href="calendar.css" rel="stylesheet" type="text/css">
	</head>
	<body>
	    <nav class="navtop">
	    	<div>
	    		<h1>Event Calendar</h1>
	    	</div>
	    </nav>
		<div class="content home">
			<?=$calendar?>
		</div>
	</body>
</html>