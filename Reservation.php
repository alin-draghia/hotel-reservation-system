<?php

include 'database.php';

class Reservation extends Illuminate\Database\Eloquent\Model
{
     public $timestamps = false;
     
     protected $table = "Reservation";
     
     protected $primaryKey = "idReservation";
     
     public function detail()
     {
          return $this->hasOne('ReservationDetail', 'Reservation_idReservation');
     }
}


//print(Reservation::all());

