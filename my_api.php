<?php

require_once "database_connect.php";

function check_exists($user) {
    $conn = database_connect();

    $user = stripcslashes($user);
    $user = mysqli_escape_string($conn, $user);

    $query = "SELECT username FROM user WHERE username='$user'";
    $resutl = mysqli_query($conn, $query, MYSQLI_STORE_RESULT);
    $count = mysqli_num_rows($resutl);
    
    $conn->close();
    
    if ($count == 1) {
        return TRUE;
    }
    return FALSE;
}

function login($user, $pass) {

    $db = database_connect();

    $user = stripcslashes($user);
    $pass = stripcslashes($pass);
    $user = mysqli_escape_string($db, $user);
    $pass = mysqli_escape_string($db, $pass);

    $query = "SELECT username, password FROM user WHERE username='$user' AND password='$pass'";
    $resutl = $db->query($query, MYSQLI_STORE_RESULT);

    $count = mysqli_num_rows($resutl);
    $db->close();
     
    if ($count == 1) {
        $_SESSION["login_user"] = $user;
        return TRUE;
    }

    return FALSE;
}

function register($user, $pass) {
    $conn = database_connect();

    $user = stripcslashes($user);
    $pass = stripcslashes($pass);
    $user = mysqli_escape_string($conn, $user);
    $pass = mysqli_escape_string($conn, $pass);

    $query = "INSERT INTO user (username,password) VALUES ('$user','$pass')";
    $resutl = mysqli_query($conn, $query, MYSQLI_STORE_RESULT);

 $conn->close();
 
    if ($resutl == TRUE) {
        $_SESSION["login_user"] = $user;
        return TRUE;
    }
    return FALSE;
}

function get_login_user() {
    if (isset($_SESSION["login_user"])) {
        return $_SESSION["login_user"];
    } else {
        return null;
    }
}

function logout() {
    echo "logout was called";
    if (isset($_SESSION["login_user"])) {
        unset($_SESSION["login_user"]);
    }
    header("location: index.php");
}

function set_callback_uri($cb_uri) {
    $_SESSION["callback_uri"] = $cb_uri;
}

function have_callback_uri() {
    if (isset($_SESSION["callback_uri"])) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function call_callback_uri() {
    if (have_callback_uri()) {
        $cb_uri = $_SESSION["callback_uri"];
        unset($_SESSION["callback_uri"]);
        header('location: ' . $cb_uri);
    }
}

function get_user_id($username) {
    $conn = database_connect();
    $username = mysqli_escape_string($conn, $username);
    // $query = "SELECT getIdForUsername('$username')";

    $query =  "SELECT iduser FROM user WHERE username = '$username'";

    $result = $conn -> query($query);
    
    $row = $result -> fetch_row();
    
    $id = $row[0];

    $conn -> close();

    return $id;
}

function make_reservation($user_id, $hotel_id, $room_type_id, $start_date, $end_date, $num_rooms) {
    
    $db = database_connect();
    
    $query = "
        INSERT INTO `hotel_db`.`Reservation` 
            (`idReservation`, `StartDate`, `EndData`, `Status`, `user_iduser`) 
        VALUES (NULL, '$start_date', '$end_date', 'pending', '$user_id');";
    
    $r = $db->query($query);
    
    if($r === TRUE)
    {
        // get the inserted reservation id
        $reservation_id = $db->insert_id;
        
        $query = "
            INSERT INTO ReservationDetails 
            VALUES ($reservation_id, $user_id, $hotel_id, $room_type_id, $num_rooms)
        ";
        
        $r = $db->query($query);
    }
    
    $db->close();
    
    return $r;
}

function get_reservations($user_id)
{
    
    $query = "
        SELECT 
            `Reservation`.`idReservation`,
            `Reservation`.`StartDate`,
            `Reservation`.`EndData`,
            `Reservation`.`Status`,
            `ReservationDetails`.`NumberOfRooms` AS `ReservationNumberOfRooms`,
            `HotelDetails`.`Price`,
            `Hotel`.`Name` 
        FROM Reservation
            LEFT JOIN `hotel_db`.`ReservationDetails` ON `Reservation`.`idReservation` = `ReservationDetails`.`Reservation_idReservation` 
            LEFT JOIN `hotel_db`.`Hotel` ON `ReservationDetails`.`Hotel_idHotel` = `Hotel`.`idHotel` 
            LEFT JOIN `hotel_db`.`HotelDetails` ON `Hotel`.`idHotel` = `HotelDetails`.`Hotel_idHotel` 
        WHERE(( user_iduser = $user_id))
    ";
    
    $reservations = null;
    $db = database_connect();
    $r = $db->query($query, MYSQLI_STORE_RESULT);
    if($r)
    {
        $reservations = $r->fetch_all(MYSQLI_ASSOC);
    }
    $db->close();
    return $reservations;
}

function get_hotels() {
    $query = "SELECT `idHotel`, `Name`, `Description` FROM `Hotel`";
    $db = database_connect();
    
    $r = $db->query($query, MYSQLI_STORE_RESULT);
    
    if($r)
    {
        $hotels = $r->fetch_all(MYSQLI_ASSOC);
    } 
    else
    {
        $hotels = [];
    }
    
    $db->close();
    
    return $hotels;
}

function get_hotel_rooms($hotel_id) {
    $query = "
        SELECT 
            `hoteldetails`.`RoomType_idRoomType` AS `RoomTypeId`,
        	`roomtype`.`type` AS `RoomType`,
        	`hoteldetails`.`Price` AS `RoomPrice`, 
        	`hoteldetails`.`NumberOfRooms` AS `NumRooms`	
        FROM 
        	`hotel_db`.`HotelDetails` AS `hoteldetails`, 
        	`hotel_db`.`Hotel` AS `hotel`, 
        	`hotel_db`.`RoomType` AS `roomtype` 
        WHERE 
        	`hoteldetails`.`Hotel_idHotel` = `hotel`.`idHotel` AND 
        	`hoteldetails`.`RoomType_idRoomType` = `roomtype`.`idRoomType` AND
        	`hotel`.`idHotel` = $hotel_id
        ";
    
    $db = database_connect();

    $r = $db->query($query, MYSQLI_STORE_RESULT);
    
    $rooms = $r->fetch_all(MYSQLI_ASSOC);

    $db->close();
    
    return $rooms;
    
}


function insert_room_type($room_type)
{
    $sql = "INSERT INTO `hotel_db`.`RoomType` (`idRoomType`, `type`) VALUES (NULL, $room_type);";
    
    $db = database_connect();

    $db->query($sql);

    $db->close();
}

function insert_hotel_room()
{
    $sql = "INSERT INTO `hotel_db`.`HotelDetails` 
                (`RoomType_idRoomType`, `Hotel_idHotel`, `Price`, `NumberOfRooms`)
            VALUES ('1', '1', '50', '5');";
    
    $db = database_connect();

    $db->query($sql);

    $db->close();
    
}

function confirm_reservation($reservation_id)
{
    $db = database_connect();
    
    $new_status = "confirmed";
    
    $sql = "UPDATE Reservation SET Status='$new_status' WHERE idReservation=$reservation_id";
    
    $result = $db->query($sql);
    
    $db->close();
}

function cancel_reservation($reservation_id)
{
    $db = database_connect();
    
    $new_status = "canceled";
    
    $sql = "UPDATE Reservation SET Status='$new_status' WHERE idReservation=$reservation_id";
    
    $db->query($sql);
    
    $db->close();
}

?>

