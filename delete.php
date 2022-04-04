<?php

    session_start();
    if (!$_SESSION['auth']) {
        header('Location: login.php');
    }

    include('config/db_connect.php');

    if(isset($_GET['delete_id'])){
        $restaurant_id = $_GET['delete_id'];

        $sql = "DELETE FROM restaurants WHERE restaurant_id = $restaurant_id";

        $result = mysqli_query($conn, $sql);

        if($result){
            header('Location: admin.php');
        }
        else{
            die(mysqli_error($conn));
        }
    }

?>