<?php

require("/xampp/htdocs/myapp/templates/menu3.php");
function build_calendar($month, $year){

    $mysqli = new mysqli('localhost', 'root', 'root', 'garage');
    /*$stmt = $mysqli->prepare("SELECT * from bookings where MONTH(date) = ? AND YEAR(date) = ?");
    $stmt->bind_param('ss', $month, $year);
    $bookings = array();

    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $bookings[] = $row['date'];
            }
            $stmt->close();
        }
    }*/

    //Array containing days of the week
    $daysOfWeek = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday','Sunday');

    //Get the first day of the month that is in the argument of this function
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);

    //Getting the number of the days
    $numberDays = date('t', $firstDayOfMonth);

    //Get some information about the first day of the month
    $dateComponents = getdate($firstDayOfMonth);

    //Get the name of the month
    $monthName = $dateComponents['month'];

    //Get the index value 0-6 of the first day of this month
    $dayOfWeek = $dateComponents['wday'];

    //Changing the first day of the month
    if($dayOfWeek == 0){
        $dayOfWeek = 6;
    } else {
        $dayOfWeek = $dayOfWeek - 1;
    }

    //Get the current date
    $dateToday = date('Y-m-d');

    //Previous month
    $prev_month = date('m', mktime(0, 0, 0, $month - 1, 1, $year));
    $prev_year = date('Y',mktime(0,0,0,$month-1,1,$year));
    $next_month = date('m', mktime(0, 0, 0, $month + 1, 1, $year));
    $next_year = date('Y',mktime(0,0,0,$month+1,1,$year));

//
    $calendar = "<center><h2>$monthName $year</h2>";
    $calendar.= "<a class='btn btn-primary btn-xs' href='?month=".$prev_month."&year=".$prev_year."'>Prev Month </a> ";
    $calendar.= "<a class='btn btn-primary btn-xs' href='?month=".date('m')."&year=".date('Y')."'> Current Month </a> ";
    $calendar.= "<a class='btn btn-primary btn-xs' href='?month=".$next_month."&year=$next_year'>Next Month</a></center>";
    
        //Create the html table
        $calendar.= "<br><table class='table table-bordered'>";
        $calendar.= "<tr>";

        //Calendar headers
    foreach($daysOfWeek as $day){
        $calendar.= "<th class='header'>$day</th>";
    }

    $calendar.="</tr><tr>";

    //Iniating the day counter
    $currentDay = 1;

    //The variable $dayOfWeek will make sure that there mst be only 7 columns on our table
    if($dayOfWeek > 0){
        for($k=0;$k<$dayOfWeek;$k++){
            $calendar.="<td class='empty'></td>";
        }
    }

    //Getting the month number
    $month = str_pad($month, 2, "0", STR_PAD_LEFT);

    while($currentDay <= $numberDays){

        //if seventh colummn reached, start a new row
        if($dayOfWeek == 7){
            $dayOfWeek = 0;
            $calendar.="</tr><tr>";

        }
        $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
        $date = "$year-$month-$currentDayRel";
        $dayName = strtolower(date('l', strtotime($date)));
        $today = $date == date('Y-m-d') ? "today" : "";

        
        //Block sunday
        if($dayName == 'sunday'){
            $calendar.="<td><h4>$currentDay</h4><button class='btn btn-danger btn-xs'>Closed</button>";

        } else if($date<date('Y-m-d')){
            $calendar.="<td><h4>$currentDay</h4><button class='btn btn-danger btn-xs'>N/A</button>";

        } else {
            //4 slots each day
            $totalbookings = checkSlots($mysqli, $date);
            if($totalbookings>=4){
                $calendar.="<td class='$today'><h4>$currentDay</h4><a color='red' class='btn btn-danger btn-xs'>All Booked</a>";
            } else{
                $availableslots = 4 - $totalbookings;
                $calendar.="<td class='$today'><h4>$currentDay</h4><a href='book.php?date=".$date."'class='btn btn-success btn-xs'>Book</a>
                <br><small><i>$availableslots slots left<i></small>";
            }
        }
        // if(in_array($date,$bookings)){
        //     $calendar.="<td class='$today'><h4>$currentDay</h4><a class='btn btn-danger btn-xs'>Booked</a></td>";

        // } else {
        //     $calendar.="<td class='$today'><h4>$currentDay</h4><a class='btn btn-success btn-xs'>Book</a></td>";
        // }

        $calendar.="</td>";
      
                //Incrementing the counters
                $currentDay++;
                $dayOfWeek++;
    }

    //COmpleting the row of the last week in month, if necessary
    if ($dayOfWeek !=7){
        $remainingDays = 7-$dayOfWeek;

        for($i=0;$i<$remainingDays;$i++){
            $calendar.="<td class='empty'></td>";
        }

    }

    $calendar.="</tr></table>";


    return $calendar;

}

//Currently we have 4 slots in each day
function checkSlots($mysqli, $date){
    $stmt = $mysqli->prepare("SELECT * from bookings where date = ?");
    $stmt->bind_param('s', $date);
    $totalbookings = 0;
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $totalbookings++;
            }
            $stmt->close();
        }
    }

    return $totalbookings;


}

?>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link ref="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <title>Calendar</title>
    <style>
a:link, a:visited {
  background-color: #366ff4;
  color: white;
  padding: 15px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}

a:hover, a:active {
  background-color: red;
}
</style>
    <style>
        @media only screen and (max-width: 760px),
        (min-device-width: 960px) and (max-device-width: 1020px){
            table,
            thead,
            tbody,
            th,
            td,
            tr{
                display: block;
            }
        
            .empty{
                display: none;
            }

            /*Hide table header but not display none for accessibility */

            th{
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr{
                border: 1px solid #ccc;
            }

            td {
                
/* Behave like a row*/
border: none;
border-bottom: 1px solid #eee;
position: relative;
padding-left: 50%;
            }

            /*Label the data*/
            td:nth-of-type(1):before{
                content: Sunday;
            }
            td:nth-of-type(2):before{
                content: Monday;
            }
            td:nth-of-type(3):before{
                content: Tuesday;
            }
            td:nth-of-type(4):before{
                content: Wednesday;
            }
            td:nth-of-type(5):before{
                content: Thursday;
            }
            td:nth-of-type(6):before{
                content: Friday;
            }
            td:nth-of-type(7):before{
                content: Saturday;
            }
        
            @media (min-width:641px){
                table {
                    table-layout:fixed;
                }
                td {
                    width: 33%;
                }
            }
        }
            .row{
                margin-top: 20px;
            }
        
            .today{
                background:yellow;
            }
        
        </style>
</head>

<body>
<button type="button" onclick="history.back();">Back</button>

    <div class="container">
        <div class="row">
            <div class="col-md-12">

<?php
$dateComponents = getdate();
if(isset($_GET['month'])&& isset($_GET['year'])){

    $month = $_GET['month'];
    $year = $_GET['year'];
} else {
    $month = $dateComponents['mon'];
    $year = $dateComponents['year'];
}


echo build_calendar($month, $year);
?>

            </div>
        </div>

    </div>


        
</body>

</html>