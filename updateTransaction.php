<?php
include 'conn.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data dari POST
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $layanan = isset($_POST['layanan']) ? $connect->real_escape_string($_POST['layanan']) : '';
    $total_tagihan = isset($_POST['total_tagihan']) ? intval($_POST['total_tagihan']) : 0;

    // Validasi input
    if ($id > 0 && !empty($layanan)) {
        // Query untuk memperbarui data transaksi
        $sql = "UPDATE transaction SET layanan = '$layanan', total_tagihan = $total_tagihan WHERE id = $id";

        // Eksekusi query
        if ($connect->query($sql) === TRUE) {
            echo json_encode(["status" => "success", "message" => "Data transaksi berhasil diperbarui"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error saat memperbarui data: " . $connect->error]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Data input tidak valid"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Metode permintaan tidak valid"]);
}
?>