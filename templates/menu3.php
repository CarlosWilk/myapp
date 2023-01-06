<!--
    Menu displayed when user access the calendar to book 
    The option here are: Return, My bookings, Invoices and Logout.
-->
<head>
    <title>Welcome</title>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style type="text/css">
.brand{
    background: #cbb09c !important;
}
.brand-text{
    color: #cbb07c !important;
}
form{
    max-width: 460px;
    margin: 10px auto;
    padding: 10px;
}
</style>
</head>

<body class="blue lighten-3">
    <nav class="white z-depth-0"> <!-- by default give no depth -->
    <div class="container">  <!-- central column -->

<a href="/customer/welcome.php" class="brand-logo brand-text">Ger's Garage</a>
<ul id="nav-mobile" class="right hide-on-small-and-down">

<li><a button type="button" onclick="history.back();" class="btn brand"> Return</a></li>
<li><a href="dashboard.php" class="btn brand z-depth-0"> My bookings</a></li>
<li><a href="#" class="btn brand z-depth-0"> Invoices</a></li>
<li><a href="./customer/logout.php" class="btn brand z-depth-0"> Logout</a></li>

</ul>
    </div>
    </nav>