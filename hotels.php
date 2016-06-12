<?php 
session_start();
include 'header.php';

$hotels = get_hotels();

?>


<?php foreach ($hotels as $hotel): ?>
    <?php 
    $hotel_id = intval($hotel["idHotel"]);
    $hotel_name = $hotel["Name"];
    $hotel_descr = $hotel["Description"];
    
    $rooms = get_hotel_rooms($hotel_id);
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">Hotel <?=$hotel_name?></div>
        <div class="panel-body">
            <div class="row">
            <div class="col-md-4">
                <img src="//placehold.it/300x300" class="img-rounded"></img>
            </div>
            <div class="col-md-8">
                <p><?=$hotel_descr?></p>
                
                <table class="table">
                    <tr>
                        <th>Room Type</th>
                        <th>Price</th>
                        <th></th>
                    </tr>
                    
                    <?php foreach ($rooms as $room): ?>
                    <?php
                    $room_type_id = $room["RoomTypeId"];
                    $room_type = $room["RoomType"];
                    $room_price = $room["RoomPrice"];
                    $num_rooms = $room["NumRooms"];
                    $reservation_link = "newreservation.php?"."HotelId=".urlencode($hotel_id)."&"."RoomTypeId=".urlencode($room_type_id);
                    ?>
                    <tr>
                        <td><?=$room_type?></td>
                        <td><?=$room_price?> $</td>
                        <td>
                            <a class="btn btn-default" href='<?=$reservation_link?>'>Make Reservation</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
            
                </table>
            </div> 
            </div>
        </div>
    </div>
<?php endforeach; ?>


<?php
include 'footer.php';
?>