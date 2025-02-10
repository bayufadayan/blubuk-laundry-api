<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "blubuklaundry";
$port = 3306;

$connect = new mysqli($host, $user, $password, $dbname, $port);

if ($connect->connect_error) {
    die(json_encode(["status" => "error", "message" => "Database connection failed"]));
}