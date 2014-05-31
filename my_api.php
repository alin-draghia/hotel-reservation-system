<?php

require_once "database_connect.php";

function check_exists($user) {
    $conn = database_connect();

    $user = stripcslashes($user);
    $user = mysqli_escape_string($conn, $user);

    $query = "select username from user where username='$user'";
    $resutl = mysqli_query($conn, $query, MYSQLI_STORE_RESULT);
    $count = mysqli_num_rows($resutl);
    
    $conn->close();
    
    if ($count == 1) {
        return TRUE;
    }
    return FALSE;
}

function login($user, $pass) {

    $conn = database_connect();

    $user = stripcslashes($user);
    $pass = stripcslashes($pass);
    $user = mysqli_escape_string($conn, $user);
    $pass = mysqli_escape_string($conn, $pass);

    $query = "select username, password from user where username='$user' and password='$pass'";
    $resutl = mysqli_query($conn, $query, MYSQLI_STORE_RESULT);

    $count = mysqli_num_rows($resutl);
    $conn->close();
     
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

    $query = "insert into user (username,password) values ('$user','$pass')";
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
    $query = "select getIdForUsername('$username')";

    $result = $conn -> query($query);

    $row = $result -> fetch_row();

    $id = $row[0];

    $conn -> close();

    return $id;
}

function make_reservation($user_id, $hotel_id, $room_type_id, $start_date, $end_date, $num_rooms) {
    $conn = database_connect();
    
    $query = "CALL makeReservation($user_id, $hotel_id, $room_type_id, '$start_date', '$end_date', $num_rooms)";
    
    $result = $conn -> query($query);
    
    $conn -> close();
    
    return $result;
}
?>