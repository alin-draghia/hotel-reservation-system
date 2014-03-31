<?php
include 'header.php';
?>

<div id="login-form">
    <form>
        <fieldset>
            <legend>Login Form</legend>
            <label for="username">User:</label>
            <input type="text" name="username" />
            <br />
            <label for="passwork">Pass:</label>
            <input type="password" name="password"/>
            <br />
            <p style="text-align: center;">
            <input type="submit" value="Register"/>
            </p>
        </fieldset>
    </form>
</div>
<?php
include 'footer.php';
?>