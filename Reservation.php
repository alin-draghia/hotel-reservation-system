<?php

include 'database.php';

class Reservation extends Illuminate\Database\Eloquent\Model
{
     public $timestamps = false;
     
     protected $table = "Reservation";
     
     protected $primaryKey = "idReservation";
}


//print(Reservation::all());

