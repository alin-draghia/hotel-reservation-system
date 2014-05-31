<?php session_start(); ?>
<?php
include 'header.php';
?>

<?php ?>

<?php
function main() {

    // if the user is not login then round trip to login page
    // and come back later with my own callback mechanism
    $request_uri = $_SERVER["REQUEST_URI"];
    if (!get_login_user()) {
        set_callback_uri($request_uri);
        header('location: login.php');
    }

    $user = get_login_user();
    $user_id = get_user_id($user);

    $conn = database_connect();
    $result = $conn -> query("call getReservations($user_id)");

    $reservations = $result -> fetch_all(MYSQLI_ASSOC);

    foreach ($reservations as $reservation) {
        $hotel_name = $reservation["Name"];
        $room_type = $reservation["type"];
        $start_date = $reservation["StartDate"];
        $end_date = $reservation["EndData"];
        $number_of_rooms = $reservation["ReservationNumberOfRooms"];
        $price_per_room = $reservation["Price"];
        $status = $reservation["Status"];
        
        if ($status=="canceled") {
            continue;
        }
        
        $diff = date_diff(date_create($end_date), date_create($start_date), FALSE);
        $number_of_days = $diff -> d;

        $total_price = $number_of_days * $number_of_rooms * $price_per_room;

        $reservation_id = $reservation["idReservation"];
        $confirm_link = "confirm.php?ReservationId=".urlencode($reservation_id);
        $cancel_link = "cancel.php?ReservationId=".urlencode($reservation_id);
        
        print("<table class='hotelTable'>");
        print("<tr><td>Hotel</td><td>$hotel_name</td></tr>");
        print("<tr><td>Room</td><td>$room_type</td></tr>");
        print("<tr><td>Start Date</td><td>$start_date</td></tr>");
        print("<tr><td>End Date</td><td>$end_date</td></tr>");
        print("<tr><td>Number of rooms</td><td>$number_of_rooms $</td></tr>");
        print("<tr><td>Price</td><td>$price_per_room $</td></tr>");
        print("<tr><td>Total</td><td>$total_price</td></tr>");
        print("<tr><td>Status</td><td>$status</td></tr>");
        print("<tr>");
        if($status == "confirmed") {
            print("<td></td>");
        } else {
            print("<td><a href='$confirm_link'>Confirm</a></td>");
        }
        print("<td><a href='$cancel_link'>Cancel</a></td>");
        print("</tr>");
        print("</table>");
    }

    $conn -> close();
}
?>

<div id="hotel-list">
	<?php main(); ?>
</div>

<?php
include 'footer.php';
?>