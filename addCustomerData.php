<?php
require 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $phone_number = $_POST['phone_number'] ?? '';

    if (empty($name) || empty($phone_number)) {
        echo json_encode(["status" => "error", "message" => "Semua field wajib diisi"]);
        exit();
    }

    // Check if the phone number already exists
    $checkStmt = $connect->prepare("SELECT COUNT(*) FROM customer WHERE phone_number = ?");
    $checkStmt->bind_param("s", $phone_number);
    $checkStmt->execute();
    $checkStmt->bind_result($count);
    $checkStmt->fetch();
    $checkStmt->close();

    if ($count > 0) {
        echo json_encode(["status" => "error", "message" => "Nomor telepon sudah terdaftar"]);
        exit();
    }

    // Insert new customer
    $stmt = $connect->prepare("INSERT INTO customer (name, phone_number) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $phone_number);

    if ($stmt->execute()) {
        $last_id = $connect->insert_id;
        
        echo json_encode([
            "status" => "success",
            "message" => "Customer berhasil ditambahkan",
            "data" => [
                "id" => $last_id,
                "name" => $name,
                "phone_number" => $phone_number
            ]
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "Customer gagal ditambahkan"]);
    }

    $stmt->close();
    $connect->close();
}
