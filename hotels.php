<?php session_start(); ?>
<?php require_once 'header.php'; ?>


<?php foreach (get_hotels() as $hotel): ?>

    <div class="panel panel-default">
        <div class="panel-heading">Hotel <?= $hotel->Name ?></div>
        <div class="panel-body">
            <div class="row">
            <div class="col-md-4">
                <img src="//placehold.it/300x300" class="img-rounded"></img>
            </div>
            <div class="col-md-8">
                <p><?= $hotel->Description ?></p>
                
                <table class="table">
                    <tr>
                        <th>Room Type</th>
                        <th>Price</th>
                        <th></th>
                    </tr>
                    
                    <?php foreach ($hotel->rooms as $room): ?>
                    
                    <tr>
                        <td><?= RoomType::find($room->RoomType_idRoomType)->type ?></td>
                        <td><?= $room->Price ?> $</td>
                        <td>
                            <?php $reservation_link = "newreservation.php?"."HotelId=".urlencode($hotel->idHotel)."&"."RoomTypeId=".urlencode($room->RoomType_idRoomType); ?>
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


<?php require_once 'footer.php'; ?>