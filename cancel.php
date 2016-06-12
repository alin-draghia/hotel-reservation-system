<?php
require_once 'my_api.php';

$reservation_id = $_GET["ReservationId"];
cancel_reservation($reservation_id);

// return to the reservations page
header('location: reservations.php');
?>