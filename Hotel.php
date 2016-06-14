<?php

include 'database.php';

class Hotel extends Illuminate\Database\Eloquent\Model
{
     public $timestamps = false;
     
     protected $table = "Hotel";
     
     protected $primaryKey = "idHotel";
     
     public function rooms()
     {
          return $this->hasMany("HotelDetail", "Hotel_idHotel");
     }
}


//$users = User::all();
//print(Hotel::all());

