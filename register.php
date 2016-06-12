<?php session_start(); ?>

<?php require_once 'my_api.php'; ?>

<?php

function validate() 
{
    if (empty($_POST["username"])) 
    {        
        return array(FALSE, "Username required!");
    }
    
    if (empty($_POST["password"])) 
    {
        return array(FALSE, "Password required!");
    }
    
    if (empty($_POST["password2"])) 
    {
        return array(FALSE, "Confirm password required!");
    }
    
    if ($_POST["password"] != $_POST["password2"]) 
    {
        return array(FALSE, "Passwords must match!");
    }
    return array(TRUE, "");
}

// Main starts here
$errstr = "";

$user = "";
$pass = "";
$pass2 = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $valid = validate();
    $errstr = $valid[1];
    if ($valid[0]) 
    {
        $user = $_POST["username"];
        $pass = $_POST["password"];
        $pass2 = $_POST["password2"];

        if (check_exists($user)) 
        {
            $errstr = "Username allready exists";
        }
        else
        {
            if (register($user, $pass)) 
            {
                if (have_callback_uri()) 
                {
                    call_callback_uri();
                } 
                else 
                {
                    header("location:index.php");
                }
            } 
            else 
            {
                $errstr = "Registration failed!";
            }
        }
    } 
    else 
    {
        $user = $_POST["username"];
    }
}
?>


<?php include 'header.php'; ?>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-login">
            <div class="panel-body">
                <form id="register-form" action='<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>' method="post" role="form">
                    <span class="bg-danger"><?= $errstr ?></span><br>
                    <div class="form-group">
                        <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password2" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-primary" value="Register Now">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>