<?php session_start(); ?>
<?php include 'header.php'; ?>

<?php
function main() {
    
    // if the user is not login then round trip to login page
    // and come back later with my own callback mechanism
    $request_uri = $_SERVER["REQUEST_URI"];
    if (!get_login_user()) {
        set_callback_uri($request_uri);
        header('location: login.php');
    }
    return null;
}
?>

<?php main(); ?>


<div id="reservation-form">
    <form method="post" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <fieldset>
            <legend>Reservation Form</legend>
            
            <p>
            <label>Hotel:</label>
            <input type="text" readonly="true" value="[Ambasador]"/>
            </p>
            
            <p>
            <label>Room type:</label>
            <input type="text" readonly="true" value="[Single]"/>
            </p>
            
            <p>
            <label>Price per night:</label>
            <input type="text" readonly="true" value="[100$]"/>
            </p>
            
            <p>
            <label for="start_date">Start date:</label>
            <input type="date" name="start_date" value=""/>
            </p>
            
            <p>
            <label for="end_date">End date:</label>
            <input type="date" name="end_date" value=""/>
            </p>
            
            <p>
            <label for="number_of_rooms">Number of rooms:</label>
            <input type="number" name="number_of_rooms" value="1" min="1" step="1"/>
            </p>
            
            <span>
            <input type="submit" value="Submit"/>
            <input type="reset" value="Reset"/>
            </span>
        </fieldset>
    </form>
</div>


<?php include 'footer.php'; ?>