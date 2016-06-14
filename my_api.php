<?php

require_once "database_connect.php";

require_once 'User.php';
require_once 'Hotel.php';
require_once 'HotelDetail.php';
require_once 'RoomType.php';
require_once 'Reservation.php';
require_once 'ReservationDetail.php';

function _check_exists($user) {
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

function check_exists($user) 
{
    $user = User::where('username', $user)
                ->first();
    if($user)
    {
        return TRUE;
    }
    return FALSE;
}

function login($user, $pass)
{

    $user = User::where('username', $user)
                ->where('password', $pass)
                ->first();
                
    if(user)
    {
        $_SESSION['login_user'] = $user->username;
        return TRUE;
    }
    return FALSE;
}

function __register($user, $pass) {
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

function register($username, $password) {

    $user = new User;
    $user->username = $username;
    $user->password = $password;
     
    if ($user->save()) {
        $_SESSION["login_user"] = $user->username;
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
    return User::find($user_id)->reservations;
}

function get_hotels()
{
    return Hotel::all();
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

