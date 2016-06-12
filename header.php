<?php

require_once 'my_api.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["logout"])) {
        $val = $_GET["logout"];
        if ($val == 1) {
            logout();
        }
    }
}
?>

	<!DOCTYPE html>
	<html>

	<head>
		<title>Hotels Brasov</title>
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>

	<body>

		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="index.php">Hotels@Brasov</a>
				</div>
				<ul class="nav navbar-nav">
					<li><a href="index.php">Home</a></li>
					<li><a href="hotels.php">Hotels</a></li>
					<li><a href="reservations.php">Reservations</a></li>
					<li><a href="contact.php">Contact</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<?php 
					if(get_login_user()){
						?> 
						
	      				<li><a href="<?php echo $_SERVER['PHP_SELF'] . '?logout=1'; ?>">
	      					<span class="glyphicon glyphicon-log-out"></span>  <?php if(get_login_user()){echo "Logout, ".get_login_user();} ?> </a></li>
						<?php
					} else {
						?> 
						<li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
	      				<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
						<?php
					}
					?>
					
				</ul>
			</div>
		</nav>

		<div class="container">
		


