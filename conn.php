<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "blubuklaundry";

$connect = new mysqli ($host, $user, $password, $dbname);

if ($connect->connect_error) {
    die(json_encode(["status" => "error", "message" => "Database connection failed"]));
}