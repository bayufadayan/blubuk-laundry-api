<?php
include 'conn.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$sql = "SELECT
    t.id,
    t.invoice,
    t.tanggal_order,
    c.name AS customer_name,
    c.phone_number AS nomor_wa,
    GROUP_CONCAT(ic.nama SEPARATOR ', ') AS item_laundry,
    SUM(td.total_bayar) AS total,
    t.status_laundry,
    t.layanan,
    t.tanggal_bayar,
    t.status_bayar
FROM 
    transaction t
JOIN 
    customer c ON t.id_customer = c.id
JOIN 
    transaction_detail td ON t.id = td.id_transaksi
JOIN 
    item_laundry il ON td.id_item_laundry = il.id
JOIN 
    item_category ic ON il.id_item_category = ic.id
GROUP BY 
    t.id, c.id;";

$result = $connect->query($sql);

if ($result->num_rows > 0) {
    $transactions = [];
    while ($row = $result->fetch_assoc()) {
        $row['total'] = 'Rp. ' . number_format($row['total'], 0, ',', '.');
        $transactions[] = $row;
    }
    echo json_encode($transactions);
} else {
    echo json_encode([]);
}
