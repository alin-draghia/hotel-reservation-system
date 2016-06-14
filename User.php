<?php

include 'database.php';

class User extends Illuminate\Database\Eloquent\Model
{
     public $timestamps = false;
     
     protected $table = "user";
     
     protected $primaryKey = "iduser";
     
     public function reservations()
     {
          return $this->hasMany("Reservation", "user_iduser");
     }
}


//$users = User::all();
//print($users);

