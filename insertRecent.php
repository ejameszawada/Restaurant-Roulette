<?php

session_start();
if (!$_SESSION['auth']) {
    header('Location: login.php');
}

if ($_SESSION['usertype'] == 2) {
    header('Location: login.php');
}

include('/home/ejzawada/config/db_connect.php');

$restaurant_id = $_GET['get_id'];

$users_id = $_SESSION['users_id'];
$date_eaten = date('Y-m-d h:i:s', time());

$sql = "INSERT INTO recents(restaurant_id, users_id, date_eaten) VALUES ($restaurant_id, $users_id, '$date_eaten')";
// save to db and check
if (mysqli_query($conn, $sql)) {
    // success
    header('Location: profile.php');
} else {
    echo 'query error: ' . mysqli_error($conn);
}


?>