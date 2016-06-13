<?php

include 'database.php';

class Hotel extends Illuminate\Database\Eloquent\Model
{
     public $timestamps = false;
     
     protected $table = "Hotel";
     
     protected $primaryKey = "idHotel";
}


//$users = User::all();
//print(Hotel::all());

