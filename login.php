<?php
require 'conn.php';

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->email) && !empty($data->password)) {
    $email = $data->email;
    $password = $data->password;

    $query = "SELECT * FROM admin WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) > 0) {
        $admin = mysqli_fetch_assoc($result);

        echo json_encode([
            "status" => "success",
            "message" => "Login berhasil",
            "admin" => [
                "id" => $admin['id'],
                "name" => $admin['name'],
                "email" => $admin['email'],
                "phone_number" => $admin['phone_number'],
                "address" => $admin['address']
            ]
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Email atau password salah"
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Data tidak lengkap"
    ]);
}
