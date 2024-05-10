<?php
include "../utils/header.php";

switch ($method) {
    case 'POST':
        // Memeriksa apakah email dan password diberikan
        if (
            isset($_POST['email'])
        ) {
            $email = $_POST['email'];

            // get data
            $query = mysqli_query(
                $conn,
                "SELECT * FROM pengguna WHERE email = '$email'"
            );
            $pengguna = mysqli_fetch_assoc($query);
            if (!$pengguna) echo json_encode(array('message' => 'Data tidak ada'));

            // get data berhasil
            echo json_encode(array("data" => $pengguna));
        } else {
            echo json_encode(array('message' => 'Data yang diperlukan tidak valid'));
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(array('error' => 'Method tidak didukung'));
        break;
}
