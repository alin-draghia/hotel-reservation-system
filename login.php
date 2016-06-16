<?php session_start(); ?>

<?php require_once 'my_api.php'; ?>

<?php

function validate() 
{
		if (empty($_POST["username"]) || empty($_POST["password"])) 
		{
				return FALSE;
		} 
		else 
		{
				return TRUE;
		}
}

$errstr = "";

$user_err = "";
$pass_err = "";

$user = "";
$pass = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (validate()) {
				$user = $_POST["username"];
				$pass = $_POST["password"];
				if (!login($user, $pass)) {
						$errstr = "Login failed!";
				} else {
						if (have_callback_uri()) {
						} else {
								header("location:index.php");   
						}            
				}
		} else {
				$user = $_POST["username"];
				$errstr = "Username and password requered!";
		}
}
?>

<?php  include 'header.php'; ?>

<div class="row">
		<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					 
						<div class="panel-body">
								<div class="row">
										<div class="col-lg-12">
												<form id="login-form" action='<?= htmlspecialchars($_SERVER[" PHP_SELF "]) ?>' method="post" role="form" style="display: block;">
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
																<div class="row">
																		<div class="col-sm-6 col-sm-offset-3">
																				<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-primary" value="Log In">
																		</div>
																</div>
														</div>
														<div class="form-group">
																<div class="row">
																		<div class="col-lg-12">
																				<div class="text-center">
																						<a href="#" tabindex="5" class="forgot-password">Forgot Password?</a>
																				</div>
																		</div>
																</div>
														</div>
												</form>
											 
										</div>
								</div>
						</div>
				</div>
		</div>
</div>


<?php include 'footer.php'; ?>