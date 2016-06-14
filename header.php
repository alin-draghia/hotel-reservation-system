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
					<?php if(get_login_user()): ?>

					<li>
						<a href="<?php echo $_SERVER['PHP_SELF'] . '?logout=1'; ?>">
							<span class="glyphicon glyphicon-log-out"></span>
							<?php if(get_login_user()){echo "Logout, ".get_login_user();} ?> </a>
					</li>
					<?php else: ?>
						<li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
						<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
					<?php endif; ?>

					<?php if(false): ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Login <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li>
								<form id="login-form" action='<?= htmlspecialchars($_SERVER[" PHP_SELF "]) ?>' method="post" role="form" style="padding:20px">
									<div class="form-group">
										<input type="text" id="username" tabindex="1" class="form-control" placeholder="Username" name="username" value="<?= $user; ?>">
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
									</div>
									<div class="form-group text-center">
										<input type="checkbox" tabindex="3" class="" name="remember" id="remember">
										<label for="remember"> Remember Me</label>
									</div>
									<div class="form-group">
										<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-primary" value="Log In">
									</div>
									<div class="form-group">
										<div class="text-center">
											<a href="#" tabindex="5" class="forgot-password">Forgot Password?</a>
										</div>
									</div>
								</form>
								<div class="bottom text-center">
									New here ? <a href="#"><b>Join Us</b></a>
								</div>
							</li>
						</ul>
					</li>
					<?php endif; ?>
					
				</ul>
			</div>
		</nav>

		<div class="container">
