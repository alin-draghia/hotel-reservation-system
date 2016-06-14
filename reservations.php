<?php session_start(); ?>
<?php require_once 'header.php'; ?>

<?php 

// if the user is not login then round trip to login page
// and come back later with my own callback mechanism
$request_uri = $_SERVER["REQUEST_URI"];
if (!get_login_user()) {
    set_callback_uri($request_uri);
    header('location: login.php');
}


$user = get_login_user();
$user_id = get_user_id($user);

?>

<?php foreach (get_reservations($user_id) as $reservation) :?>


    <?php
 
    $reservation_id = $reservation->idReservation;
    $hotel_name = $reservation->detail->hotel->Name;
    $room_type = $reservation->detail->roomType->type;
    $start_date = $reservation->StartDate;
    $end_date = $reservation->EndData;
    $number_of_rooms = $reservation->detail->NumberOfRooms;
    $price_per_room = HotelDetail::where("RoomType_idRoomType", $reservation->detail->roomType->idRoomType)
                        ->where("Hotel_idHotel", $reservation->detail->hotel->idHotel)
                        ->first()->Price;
    $status = $reservation->Status;
    
    if ($status=="canceled") {
        continue;
    }
    
    $diff = date_diff(date_create($end_date), date_create($start_date), FALSE);
    $number_of_days = $diff -> d;

    $total_price = $number_of_days * $number_of_rooms * $price_per_room;

    $confirm_link = "confirm.php?ReservationId=".urlencode($reservation_id);
    $cancel_link = "cancel.php?ReservationId=".urlencode($reservation_id);
    
    ?>
    
    
    <div class="panel panel-default">
    <table class='table'>
        
        <tr><th>Hotel</th><td><?=$hotel_name?></td></tr>
        <tr><th>Room</th><td><?=$room_type?></td></tr>
        <tr><th>Start Date</th><td><?=$start_date?></td></tr>
        <tr><th>End Date</th><td><?=$end_date?></td></tr>
        <tr><th>Number of rooms</th><td><?=$number_of_rooms?></td></tr>
        <tr><th>Price</th><td><?=$price_per_room?> $</td></tr>
        <tr><th>Total</th><td><?=$total_price?> $</td></tr>
        <tr><th>Status</th><td><?=$status?></td></tr>
        <tr>
        
        <?php if($status == "confirmed"): ?>
            <td></td>
        <?php else: ?>
            <td><a class="btn btn-success" href='<?=$confirm_link?>'>Confirm</a></td>
        <?php endif; ?>
        
        <td><a class="btn btn-danger" href='<?=$cancel_link?>'>Cancel</a></td>
        </tr>
        
   </table>
   </div>
<?php endforeach; ?>


<?php require_once 'footer.php'; ?>