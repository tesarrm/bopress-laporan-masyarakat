<?php
include "../utils/header.php";

switch ($method) {
    case 'POST':
        // Memeriksa apakah email dan password diberikan
        if (
            isset($_POST['nama_lengkap']) && 
            isset($_POST['email']) && 
            isset($_POST['password']) && 
            isset($_POST['no_handphone']) && 
            isset($_POST['tanggal_lahir']) && 
            isset($_POST['jenis_kelamin']) && 
            isset($_POST['pekerjaan']) && 
            isset($_POST['tempat_tinggal_saat_ini']) && 
            isset($_POST['alamat'])
            ) {
            $nama_lengkap= $_POST['nama_lengkap'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $no_handphone= $_POST['no_handphone'];
            $tanggal_lahir = $_POST['tanggal_lahir'];
            $jenis_kelamin = $_POST['jenis_kelamin'];
            $pekerjaan = $_POST['pekerjaan'];
            $tempat_tinggal_saat_ini = $_POST['tempat_tinggal_saat_ini'];
            $alamat = $_POST['alamat'];

            // Masukkan token ke database
            $sql = "INSERT INTO pengguna (
                nama_lengkap,
                email,
                password,
                no_handphone,
                tanggal_lahir,
                jenis_kelamin, 
                pekerjaan,
                tempat_tinggal_saat_ini,
                alamat
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssssss", 
                $nama_lengkap,
                $email,
                $password,
                $no_handphone,
                $tanggal_lahir,
                $jenis_kelamin,
                $pekerjaan,
                $tempat_tinggal_saat_ini,
                $alamat
            );
            if ($stmt->execute()) {
                echo json_encode(array("message" => "Pendaftaran berhasil"));
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
