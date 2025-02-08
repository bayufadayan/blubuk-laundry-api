<?php
require 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_customer = $_POST['id_customer'] ?? '';
    $id_item_category = $_POST['id_item_category'] ?? '';
    $id_transaction = $_POST['id_transaction'] ?? '';
    $berat_qty = $_POST['berat_qty'] ?? '';
    $total_harga_item = $_POST['total_harga_item'] ?? '';

    if (empty($id_customer) || empty($id_item_category) || empty($id_transaction) || empty($berat_qty) || empty($total_harga_item)) {
        echo json_encode(["status" => "error", "message" => "Semua field wajib diisi"]);
        exit();
    }

    // Insert Item Laundry
    $stmt = $connect->prepare("INSERT INTO item_laundry (id_customer, id_item_category, id_transaction, `berat/qty`, total_harga_item) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iiidi", $id_customer, $id_item_category, $id_transaction, $berat_qty, $total_harga_item);

    if ($stmt->execute()) {
        $last_id = $connect->insert_id;

        echo json_encode([
            "status" => "success",
            "message" => "Item berhasil ditambahkan",
            "id_item_category" =>  $last_id,
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "item gagal ditambahkan"]);
    }

    $stmt->close();
    $connect->close();
}
