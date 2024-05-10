<?php
include "../utils/header.php";

switch ($method) {
    case 'POST':
        // Memeriksa apakah email dan password diberikan
        if (
            isset($_POST['email']) &&
            isset($_POST['tipe']) &&
            isset($_POST['judul']) &&
            isset($_POST['isi']) &&
            isset($_POST['lokasi']) &&
            isset($_POST['kategori'])
        ) {
            $email = $_POST['email'];
            $tipe = $_POST['tipe'];
            $judul = $_POST['judul'];
            $isi = $_POST['isi'];
            $tanggal = null;
            $tanggal && $tanggal =  $_POST['tanggal'];
            $lokasi = $_POST['lokasi'];
            $kategori = $_POST['kategori'];

            // get pengguna
            $query = mysqli_query($conn, "SELECT * FROM pengguna WHERE email = '$email'");
            $nobox_token = mysqli_fetch_assoc($query);
            $pengguna_id= $nobox_token['id'];

            // Masukkan token ke database
            $sql = "INSERT INTO laporan (
                pengguna_id,
                tipe,
                judul,
                isi,
                tanggal,
                lokasi,
                kategori
                ) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param(
                "sssssss",
                $pengguna_id,
                $tipe,
                $judul,
                $isi,
                $tanggal,
                $lokasi,
                $kategori
            );
            if ($stmt->execute()) {
                echo json_encode(array("message" => "Buat data berhasil"));
            } else {
                echo json_encode(array('message' => 'Error: ' . $stmt->error));
            }
            $stmt->close();
        } else {
            echo json_encode(array('message' => 'Data yang diperlukan tidak valid'));
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(array('error' => 'Method tidak didukung'));
        break;
}
