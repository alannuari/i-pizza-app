<?php

    $conn = mysqli_connect('localhost', 'root', '', 'i_pizza');

    if (!$conn) {
        echo 'Connection error: ' . mysqli_connect_error();
    }

?>