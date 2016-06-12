<?php

require_once 'my_api.php';


$reservation_id = $_GET["ReservationId"];
confirm_reservation($reservation_id);

// return to the reservations page
header('location: reservations.php');

?>