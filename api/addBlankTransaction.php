<?php
require 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $invoice = $_POST['invoice'] ?? '';
    $id_customer = $_POST['id_customer'] ?? '';

    $checkStmt = $connect->prepare("SELECT COUNT(*) FROM transaction WHERE invoice = ?");
    $checkStmt->bind_param("s", $invoice);
    $checkStmt->execute();
    $checkStmt->bind_result($count);
    $checkStmt->fetch();
    $checkStmt->close();

    if ($count > 0) {
        echo json_encode(["status" => "error", "message" => "Invoice sudah ada terdaftar"]);
        exit();
    }

    if ($invoice == '' || $id_customer == '') {
        echo json_encode(["status" => "error", "message" => "Field tidak boleh kosong"]);
        exit();
    }

    // Insert transaction
    $stmt = $connect->prepare("INSERT INTO transaction (invoice, id_customer) VALUES (?, ?)");
    $stmt->bind_param("ss", $invoice, $id_customer);

    if ($stmt->execute()) {
        $last_id = $connect->insert_id;

        echo json_encode([
            "status" => "success",
            "message" => "Transaksi Berhasil ditambahkan",
            "data" => [
                "id" => $last_id,
                "invoice" => $invoice,
                "id_customer" => $id_customer
            ]
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "Transaksi gagal ditambahkan"]);
    }

    $stmt->close();
    $connect->close();
}
