<?php

include 'database.php';

class HotelDetail extends Illuminate\Database\Eloquent\Model
{
     public $timestamps = false;
     
     protected $table = "HotelDetails";
     
     protected $primaryKey = null;
     public $incrementing = false;
     
     public function roomType()
     {
          require $this->belongsTo('RoomType', 'RoomType_idRoomType');
     }
     
}


//print(HotelDetail::all());

