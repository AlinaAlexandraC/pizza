<?php

// connect to database
$conn = mysqli_connect('localhost', 'Alina', 'test1234', 'ninja_pizza');

// check the connection
if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
}

?>