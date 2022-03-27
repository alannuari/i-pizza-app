<?php

    $conn = mysqli_connect('localhost', 'alan', 'phpmyadmin123', 'i_pizza');

    if (!$conn) {
        echo 'Connection error: ' . mysqli_connect_error();
    }

?>