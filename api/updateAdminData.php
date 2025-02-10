<?php
include 'conn.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $name = isset($_POST['name']) ? $connect->real_escape_string($_POST['name']) : '';
    $phone_number = isset($_POST['phone_number']) ? $connect->real_escape_string($_POST['phone_number']) : '';
    $email = isset($_POST['email']) ? $connect->real_escape_string($_POST['email']) : '';
    $address = isset($_POST['address']) ? $connect->real_escape_string($_POST['address']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    if ($id > 0 && !empty($name) && !empty($email)) {
        $sql = "UPDATE admin SET name='$name', phone_number='$phone_number', email='$email', address='$address'";

        if (!empty($password)) {
            $password = $connect->real_escape_string($password);
            $sql .= ", password='$password'";
        }

        $sql .= " WHERE id=$id";

        if ($connect->query($sql) === TRUE) {
            echo json_encode(["status" => "success", "message" => "Data updated successfully"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error updating data: " . $connect->error]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid input data"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}
