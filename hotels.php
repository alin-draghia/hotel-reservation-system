<?php session_start(); ?>
<?php
include 'header.php';
?>

<?php


function main() {
    
    $hotels = get_hotels();

    if($hotels)
    {
        foreach ($hotels as $hotel)
        {
    
            $hotel_id = intval($hotel["idHotel"]);
            $hotel_name = $hotel["Name"];
            $hotel_descr = $hotel["Description"];
            
            $rooms = get_hotel_rooms($hotel_id);
    
            print("<table class='hotelTable'>");
            print("<tr>");
            print("<th colspan='3'>" . $hotel_name . "</th>");
            print("</tr>");
            print("<tr>");
            print("<td colspan='3'>" . $hotel_descr . "</td>");
            print("</tr>");
    
    
            foreach ($rooms as $room) {
                $room_type_id = $room["RoomTypeId"];
                $room_type = $room["RoomType"];
                $room_price = $room["RoomPrice"];
                $num_rooms = $room["NumRooms"];
                $reservation_link = "newreservation.php?"."HotelId=".urlencode($hotel_id)."&"."RoomTypeId=".urlencode($room_type_id);
                print("<tr>");
                print("<td>" . $room_type . "</td>");
                print("<td>" . $room_price . "</td>");
                print("<td style='width:150px;'><a href='$reservation_link'>[Make reservation]</a></td>");
                print("</tr>");
            }
    
            print("</table>");
    
        }
    }

}
?>

<div id="hotel-list">
	<?php main(); ?>
</div>
<?php
include 'footer.php';
?>