<?php

include 'database.php';

class ReservationDetail extends Illuminate\Database\Eloquent\Model
{
     public $timestamps = false;
     
     protected $table = "ReservationDetails";
     
     protected $primaryKey = null;
     public $incrementing = false;
     
     public function hotel()
     {
          return $this->belongsTo("Hotel", "Hotel_idHotel");
     }
     
     public function roomType()
     {
          return $this->belongsTo("RoomType", "RoomType_idRoomType");
     }
}


//print(ReservationDetail::all());

