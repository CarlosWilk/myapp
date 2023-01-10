<?php

include("/xampp/htdocs/myapp/templates/header.php");

?>

<style>
* {
  box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column {
  float: left;
  width: 50%;
  padding: 20px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .column {
    width: 100%;
  }
}
</style>

<h2 style="text-align:center">Our Services</h2>
<div class="row">
  <div class="column">
    <div class="card">
      <div class="container">
      <img src="images/deal.png" height="100px" weight="50px" alt="Transportation icons created by Freepik - Flaticon">
        <h2>Annual Service</h2>
        <p class="title">From € 130 </p>
        <p>The checklist is made up of over 50 individual checks.</p>
      </div>
    </div>
  </div>

  <div class="column">
    <div class="card">
      <div class="container">
      <img src="images/car.jpg" height="100px" weight="50px" alt="deal icon created by Freepik - Flaticon">
        <h2>Major Service</h2>
        <p class="title">From € 260</p>
        <p>Replacements of wearable parts: air filter, spark plugs .</p>
      </div>
    </div>
  </div>

  <div class="column">
    <div class="card">
      <div class="container">
      <img src="images/tools-and-utensils.png" height="100px" weight="50px" alt="tools icon created by Freepik - Flaticon">
        <h2>Repair / Fault</h2>
        <p class="title">From € 90 </p>
        <p>Oil, oil filter, bulbs, pollen filter, vehicle check</p>
      </div>
    </div>
  </div>

  <div class="column">
    <div class="card">
      <div class="container">
      <img src="images/car-insurance.png" height="100px" weight="50px" alt="car insurance icon created by Freepik - Flaticon">
        <h2>Major Repair</h2>
        <p class="title">From € 300</p>
        <p>Repair or replacement of frames and bodies, including painting and the repair or replacement of engines, transmissions, power trains and wheels.</p>
      </div>
    </div>
  </div>
</div>

</body>
</html>