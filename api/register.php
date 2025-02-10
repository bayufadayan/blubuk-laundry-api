<?php
require 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $phone_number = $_POST['phone_number'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $address = $_POST['address'] ?? '';

    if (empty($name) || empty($phone_number) || empty($email) || empty($password) || empty($address)) {
        echo json_encode(["status" => "error", "message" => "Semua field wajib diisi"]);
        exit();
    }

    // Cek apakah email sudah dipakai
    $stmt = $connect->prepare("SELECT id FROM admin WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo json_encode(["status" => "error", "message" => "Email sudah terdaftar"]);
        exit();
    }

    // Insert data admin baru
    $stmt = $connect->prepare("INSERT INTO admin (name, phone_number, email, password, address) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $phone_number, $email, $password, $address);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Registrasi berhasil"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal registrasi"]);
    }

    $stmt->close();
    $connect->close();
}
