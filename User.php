<?php

include 'database.php';

class User extends Illuminate\Database\Eloquent\Model
{
     public $timestamps = false;
     
     protected $table = "user";
     
     protected $primaryKey = "iduser";
}


//$users = User::all();
//print($users);

