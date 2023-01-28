<?php
ini_set('display_errors', 'On');

$BaseDatos='konecta';
$conn = mysqli_connect("localhost", "root", "",$BaseDatos);
mysqli_set_charset($conn, "utf8");
?>