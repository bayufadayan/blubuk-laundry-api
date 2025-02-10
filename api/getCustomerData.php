<?php
include 'conn.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$sql = "SELECT 
    c.*, 
    COUNT(t.id) AS total_transactions
FROM 
    customer c
LEFT JOIN 
    transaction t ON c.id = t.id_customer
GROUP BY 
    c.id";

$result = $connect->query($sql);

if ($result->num_rows > 0) {
    $customers = [];
    while ($row = $result->fetch_assoc()) {
        $customers[] = $row;
    }
    echo json_encode($customers);
} else {
    echo json_encode([]);
}
