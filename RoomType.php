<?php

include 'database.php';

class RoomType extends Illuminate\Database\Eloquent\Model
{
     public $timestamps = false;
     
     protected $table = "RoomType";
     
     protected $primaryKey = "idRoomType";
}


//print(RoomType::all());