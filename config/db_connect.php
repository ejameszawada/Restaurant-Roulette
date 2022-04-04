<?php

    define("DB_HOST", 'localhost');
    define("DB_DATABASE", 'restaurant_roulette');
    define("DB_USERNAME", 'ejzawada');
    define("DB_PASSWORD", 'Enzoismybo!!24');

    // connect to database
    $conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

    // check connection
    if (!$conn) {
        echo "Connection error: " . mysqli_connect_error();
    }

?>