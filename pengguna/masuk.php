<?php
include "../utils/header.php";

switch ($method) {
    case 'POST':
        // Memeriksa apakah email dan password diberikan
        if (
            isset($_POST['email']) &&
            isset($_POST['password'])
        ) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // chek apakah email dan password salah
            $query = mysqli_query(
                $conn,
                "SELECT * FROM pengguna WHERE email = '$email' && password= '$password'"
            );
            $pengguna = mysqli_fetch_assoc($query);
            if (!$pengguna) echo json_encode(array('message' => 'Email atau password salah'));

            // login berhasil
            echo json_encode(array("message" => "Login berhasil"));
        } else {
            echo json_encode(array('message' => 'Data yang diperlukan tidak valid'));
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(array('error' => 'Method tidak didukung'));
        break;
}
