<?php
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$password = getenv('DB_PASS');
$dbname = getenv('DB_NAME');
$port = getenv('DB_PORT');

$connect = new mysqli($host, $user, $password, $dbname, $port);

if ($connect->connect_error) {
    die(json_encode(["status" => "error", "message" => "Database connection failed"]));
}