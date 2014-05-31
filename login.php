<?php session_start(); ?>

<?php
require_once 'my_api.php';
?>

<?php
function validate() {
    if (empty($_POST["username"]) || empty($_POST["password"])) {
        return FALSE;
    } else {
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
                call_callback_uri();
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

<?php
    include 'header.php';
  ?>

<div id="login-form">
    <form method="post" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
        <fieldset>
            <legend>Login Form</legend>
            <span class="error-message"><?php echo $errstr ?></span><br>
            <label for="username">User:</label>
            <input type="text" name="username" value="<?php echo $user; ?>" placeholder="user@domain.ext" autofocus/>
            <br />
            <label for="passwork">Pass:</label>
            <input type="password" name="password"/>
            <br />
            <p style="text-align: center;">
            <input type="submit" value="Login"/>
            </p>
            <a href="register.php">Register new accout</a>
        </fieldset>
    </form>
</div>

<?php
include 'footer.php';
 ?>