<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? '';

    if (!empty($id)) {
        $sql = "DELETE FROM transaction_detail WHERE id = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Data berhasil dihapus"]);
        } else {
            echo json_encode(["success" => false, "message" => "Gagal menghapus data"]);
        }
        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "ID tidak valid"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Metode tidak valid"]);
}

$connect->close();
