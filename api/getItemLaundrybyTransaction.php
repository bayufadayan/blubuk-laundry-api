<?php
include 'conn.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Mengambil id_customer dan id_transaction dari POST
$id_customer = isset($_POST['id_customer']) ? intval($_POST['id_customer']) : 0;
$id_transaction = isset($_POST['id_transaction']) ? intval($_POST['id_transaction']) : 0;

if ($id_customer > 0 && $id_transaction > 0) {
    $sql = "SELECT 
        il.id,
        ic.nama AS item_name,
        CASE 
            WHEN il.id_item_category = 20 THEN CONCAT(il.`berat/qty`, ' (kg)')
            ELSE CONCAT(il.`berat/qty`, ' (pcs)')
        END AS qty,
        il.total_harga_item
    FROM 
        item_laundry il
    JOIN 
        item_category ic ON il.id_item_category = ic.id
    WHERE 
        il.id_customer = $id_customer AND il.id_transaction = $id_transaction;";

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
} else {
    echo json_encode(["error" => "Invalid customer or transaction ID"]);
}
?>