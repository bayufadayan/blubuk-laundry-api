<?php
require 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_transaksi = $_POST['id_transaksi'] ?? '';
    $id_item_laundry = $_POST['id_item_laundry'] ?? '';
    $total_bayar = $_POST['total_bayar'] ?? '';

    if (empty($id_transaksi) || empty($id_item_laundry) || empty($total_bayar)) {
        echo json_encode(["status" => "error", "message" => "Semua field wajib diisi"]);
        exit();
    }

    // Insert Item Laundry
    $stmt = $connect->prepare("INSERT INTO transaction_detail (id_transaksi, id_item_laundry, total_bayar) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $id_transaksi, $id_item_laundry, $total_bayar);

    if ($stmt->execute()) {
        $last_id = $connect->insert_id;

        echo json_encode([
            "status" => "success",
            "message" => "Transaksi Detail berhasil ditambahkan"
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "Transaksi Detail gagal ditambahkan"]);
    }

    $stmt->close();
    $connect->close();
}
