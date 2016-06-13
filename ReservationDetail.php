<?php

include 'database.php';

class ReservationDetail extends Illuminate\Database\Eloquent\Model
{
     public $timestamps = false;
     
     protected $table = "ReservationDetails";
     
     protected $primaryKey = null;
     public $incrementing = false;
}


//print(ReservationDetail::all());

