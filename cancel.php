<?php
require_once 'my_api.php';

$conn = database_connect();

$reservation_id = $_GET["ReservationId"];
$query = "CALL setReservationStatus($reservation_id, 'canceled')";
$result = $conn->query($query);

$conn->close();

header('location: reservations.php');
?>