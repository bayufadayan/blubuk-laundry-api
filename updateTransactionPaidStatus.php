<?php
include 'conn.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data dari POST
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $status_bayar = isset($_POST['status_bayar']) ? $connect->real_escape_string($_POST['status_bayar']) : '';

    // Validasi input
    if ($id > 0 && !empty($status_bayar)) {
        // Query untuk memperbarui data transaksi
        $sql = "UPDATE transaction SET status_bayar = '$status_bayar' WHERE id = $id";

        // Eksekusi query
        if ($connect->query($sql) === TRUE) {
            echo json_encode(["status" => "success", "message" => "Data transaksi berhasil diperbarui"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error saat memperbarui data: " . $connect->error]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Data input tidak valid", "id" => $id, "statusByata" => $status_bayar]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Metode permintaan tidak valid"]);
}
?>