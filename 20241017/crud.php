<?php
$server = "192.168.100.86";
$user = "root";
$pass = "password";
$mydb = "app_development";

$conn = new mysqli($server, $user, $pass, $mydb);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

