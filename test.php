<?php

require_once 'Hotel.php';


//$h = Hotel::find(1);

$h = new Hotel;


$h->Name = "Aro Palace";
$h->Description = "description goes here";
$h->save();

print($h);
