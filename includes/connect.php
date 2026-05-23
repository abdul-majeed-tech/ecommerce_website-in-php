<?php

$con=mysqli_connect('localhost','root','','mystore');


if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

?>