<?php
include 'conn.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$sql = "SELECT * FROM item_category";

$result = $connect->query($sql);

if ($result->num_rows > 0) {
    $item_categories = [];
    while ($row = $result->fetch_assoc()) {
        $item_categories[] = $row;
    }
    echo json_encode($item_categories);
} else {
    echo json_encode([]);
}
