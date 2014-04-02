<?php
require_once "database_connect.php";
 ?>

<?php session_start(); ?>

<?php
function validate() {
    if (empty($_POST["username"]) || empty($_POST["password"])) {
        return FALSE;
    } else {
        return TRUE;
    }
}
?>

<?php
function login($user, $pass) {

    $conn = database_connect();

    $user = stripcslashes($user);
    $pass = stripcslashes($pass);
    $user = mysqli_escape_string($conn, $user);
    $pass = mysqli_escape_string($conn, $pass);

    $query = "select username, password from user where username='$user' and password='$pass'";
    $resutl = mysqli_query($conn, $query, MYSQLI_STORE_RESULT);

    $count = mysqli_num_rows($resutl);

    if ($count == 1) {
        return TRUE;
    }

    return FALSE;
}
?>

<?php
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
            header("location:index.php");
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
            <input type="text" name="username" value="<?php echo $user; ?>"/>
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