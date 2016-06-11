<?php

function database_connect() {
    //$db_hostname = ini_get("myhost");
    //$db_username = ini_get("myuser");
    //$db_password = ini_get("mypass");
    //$db_database = ini_get("mydb");
    
    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    $database = "hotel_db";
    $dbport = 3306;

    //$db_hostname = "localhost";
    //$db_username = "root";
    //$db_password = "";
    //$db_database = "hotel_db";
    //$mysqli = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
    // if (mysqli_connect_error()) {
    //     die('MySql connect error[' . mysqli_connect_errno() . ']: ' . mysqli_connect_error());
    // }
    
    
    $db = mysqli_connect($servername, $username, $password, $database, $dbport);
    
    if (mysqli_connect_error()) {
        die('MySql connect error[' . mysqli_connect_errno() . ']: ' . mysqli_connect_error());
    }
    
    // Create connection
    // $db = new mysqli($servername, $username, $password, $database, $dbport);

    // // Check connection
    // if ($db->connect_error) {
    //     die("Connection failed: " . $db->connect_error);
    // } 
    // echo "Connected successfully (".$db->host_info.")";

    
    return $db;
}
?>