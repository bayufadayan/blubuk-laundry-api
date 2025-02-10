<?php
include 'conn.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$sql = "SELECT id, name, phone_number, email, address FROM admin";
$result = $connect->query($sql);

if ($result->num_rows > 0) {
    $admins = [];
    while ($row = $result->fetch_assoc()) {
        $admins[] = $row;
    }
    echo json_encode($admins);
} else {
    echo json_encode([]);
}
