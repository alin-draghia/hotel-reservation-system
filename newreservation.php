<?php session_start(); ?>
<?php
    include 'header.php';
?>

<?php

function validate() {

    if (!isset($_POST["start_date"])) {
        $GLOBALS["validation_error"] = "Start date field is required!";
        return FALSE;
    }

    if (!isset($_POST["end_date"])) {
        $GLOBALS["validation_error"] = "End date field is required!";
        return FALSE;
    }

    if (!isset($_POST["number_of_rooms"])) {
        $GLOBALS["validation_error"] = "Number of rooms field is required!";
        return FALSE;
    }

    if (!isset($_POST["hotel_id"])) {
        $GLOBALS["validation_error"] = "hotel_id field is required!";
        return FALSE;
    }

    if (!isset($_POST["room_type_id"])) {
        $GLOBALS["validation_error"] = "room_type_id field is required!";
        return FALSE;
    }

    $tomorrow = date("Y-m-d", strtotime("Tomorrow noon"));
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $num_rooms = $_POST["number_of_rooms"];
    $hotel_id = $_POST["hotel_id"];
    $room_type_id = $_POST["room_type_id"];

    if ($start_date < $tomorrow) {
        $GLOBALS["validation_error"] = "Start date can't be less than $tomorrow!";
        return FALSE;
    }

    if ($end_date < $start_date) {
        $GLOBALS["validation_error"] = "End date can't be smaller than start date!";
        return FALSE;
    }

    $diff = date_diff(date_create($end_date), date_create($start_date), FALSE);

    if ($diff -> d < 1) {
        $GLOBALS["validation_error"] = "Can't book for less than 1 night";
        return FALSE;
    }

    if ($num_rooms < 1) {
        $GLOBALS["validation_error"] = "Can't book less than 1 room";
        return FALSE;
    }

    $GLOBALS["validation_error"] = "";
    return TRUE;
}

function main() {

    $dt = new DateTime();

    // if the user is not login then round trip to login page
    // and come back later with my own callback mechanism
    $request_uri = $_SERVER["REQUEST_URI"];
    if (!get_login_user()) {
        set_callback_uri($request_uri);
        header('location: login.php');
    }

    $requested_hotel_id = $_GET["HotelId"];
    $requested_room_type_id = $_GET["RoomTypeId"];

    if (!isset($_POST['start_date'])) {
        $_POST['start_date'] = date("Y-m-d", strtotime("Tomorrow noon"));
    }

    if (!isset($_POST['end_date'])) {
        $_POST['end_date'] = date("Y-m-d", strtotime($_POST['start_date'] . "+1 days"));
    }

    //$start_date = date("Y-m-d",strtotime("Tomorrow noon"));
    //$end_date = date("Y-m-d", strtotime("Tomorrow noon + 1day"));

    $GLOBALS["start_date"] = $_POST['start_date'];
    $GLOBALS["end_date"] = $_POST['end_date'];

    echo "requested_hotel_id=" . $requested_hotel_id . "</br>";
    echo "requested_room_type_id=" . $requested_room_type_id . "</br>";

    echo "GOT GET REQUEST:" . "</br>";
    print_r($_GET);
    echo "</br>";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        echo "GOT POST REQUEST:" . "</br>";
        print_r($_POST);
        echo "</br>";

        if (validate()) {
            $user_id = get_user_id(get_login_user());
            $start_date = $_POST["start_date"];
            $end_date = $_POST["end_date"];
            $num_rooms = $_POST["number_of_rooms"];
            $hotel_id = $_POST["hotel_id"];
            $room_type_id = $_POST["room_type_id"];
            
            $result = make_reservation($user_id, $hotel_id, $room_type_id, $start_date, $end_date, $num_rooms);
            if ($result) {
                header('location: reservations.php');
            }
        } 
    }

    return null;
}
?>

<?php main(); ?>

<div id="reservation-form">

	<form method="post" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

		<fieldset>
			<legend>
				Reservation Form
			</legend>

			<p>
				<label>Hotel:</label>
				<input name="hotel" type="text" readonly="true" value="[Ambasador]"/>
			</p>

			<p>
				<label>Room type:</label>
				<input name="room_type" type="text" readonly="true" value="[Single]"/>
			</p>

			<p>
				<label>Price per night:</label>
				<input name="price_per_night" type="text" readonly="true" value="[100$]"/>
			</p>

			<p>
				<label for="start_date">Start date:</label>
				<input type="date" name="start_date" value="<?php print $start_date; ?>"/>
			</p>

			<p>
				<label for="end_date">End date:</label>
				<input type="date" name="end_date" value="<?php print $end_date; ?>"/>
			</p>

			<p>
				<label for="number_of_rooms">Number of rooms:</label>
				<input type="number" name="number_of_rooms" value="1" min="1" step="1"/>
			</p>

			<input type="hidden" name="hotel_id" value="<?php print $_GET["HotelId"]; ?>"/>
			<input type="hidden" name="room_type_id" value="<?php print $_GET["RoomTypeId"]; ?>"/>

			<span>
				<input type="submit" value="Submit"/>
				<input type="reset" value="Reset"/>
			</span>

			<?php
            if (isset($GLOBALS["validation_error"])) {
                echo "<p><span class='error-message'>" . $GLOBALS['validation_error'] . "</span></p>";
            }
			?>
		</fieldset>
	</form>
</div>

<?php
    include 'footer.php';
?>