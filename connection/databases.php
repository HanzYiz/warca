<?php

$localhost = "localhost";
$user = "root";
$pass = "";
$db_name = "perpustakaan";
$conn = mysqli_connect($localhost, $user, $pass, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
