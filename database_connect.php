<?php

function database_connect() {
    //$db_hostname = ini_get("myhost");
    //$db_username = ini_get("myuser");
    //$db_password = ini_get("mypass");
    //$db_database = ini_get("mydb");
    
    $db_hostname = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_database = "hoteluri-brasov-ro";
    
    $mysqli = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

    if (mysqli_connect_error()) {
        die('MySql connect error[' . mysqli_connect_errno() . ']: ' . mysqli_connect_error());
    }
    
    return $mysqli;
}
?>