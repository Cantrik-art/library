<?php



$servername = "localhost";
$username = "root";
$password = "";
$database = "function";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $database);

define('conn', $conn);
