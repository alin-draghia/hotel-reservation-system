<?php

include 'database.php';

class HotelDetail extends Illuminate\Database\Eloquent\Model
{
     public $timestamps = false;
     
     protected $table = "HotelDetails";
     
     protected $primaryKey = null;
     public $incrementing = false;
     
}


//print(HotelDetail::all());

