<?php session_start(); ?>
<?php
include 'header.php';
?>

<?php

include 'database_connect.php';

function main() {
    $con = database_connect();

    $result = $con -> query("call getHotels();", MYSQLI_STORE_RESULT);
    $hotels = $result -> fetch_all(MYSQLI_ASSOC);

    $result -> free();
    $result = null;

    $con -> next_result();

    foreach ($hotels as $hotel) {

        $hotel_id = intval($hotel["idHotel"]);
        $hotel_name = $hotel["Name"];
        $hotel_descr = $hotel["Description"];

        print("<table class='hotelTable'>");
        print("<tr>");
        print("<th colspan='3'>" . $hotel_name . "</th>");
        print("</tr>");
        print("<tr>");
        print("<td colspan='3'>" . $hotel_descr . "</td>");
        print("</tr>");

        $result = $con -> query("call getHotelRooms($hotel_id);", MYSQLI_STORE_RESULT);
        if (FALSE == $result) {
            print("mysql error:" . $con -> error);
            continue;
        }

        $rooms = $result -> fetch_all(MYSQLI_ASSOC);
        $result -> free();
        $result = null;
        $con -> next_result();

        foreach ($rooms as $room) {
            $room_type = $room["RoomType"];
            $room_price = $room["RoomPrice"];
            $num_rooms = $room["NumRooms"];
            print("<tr>");
            print("<td>" . $room_type . "</td>");
            print("<td>" . $room_price . "</td>");
            print("<td style='width:150px;'><a href='#'>Make reservation</a></td>");
            print("</tr>");
        }

        print("</table>");

    }

}
?>

<div id="hotel-list">
	<?php main(); ?>
</div>
<?php
include 'footer.php';
?>