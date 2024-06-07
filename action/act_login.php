<?php
session_start();
include("../config/koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $pass = md5($password);

    $query = "SELECT id_user, nik, role, nama_guru FROM pegawai WHERE username = '$username' AND password = '$pass'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // Login berhasil
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id_user'];
        $_SESSION['nik'] = $row['nik'];
        $_SESSION['nama'] = $row['nama_guru'];
        $_SESSION['role'] = $row['role'];
        if ($row['role'] == '1') {
            header("location: ../user/index.php?page=home"); // Redirect ke halaman dashboard atau halaman yang sesuai.
        } else if ($row['role'] == '2') {
            header("location: ../admin/index.php"); // Redirect ke halaman dashboard atau halaman yang sesuai.
        } else {
            header("location: ../user/index.php?page=home"); // Redirect ke halaman dashboard atau halaman yang sesuai.
        }
        
    } else {
        // Login gagal
        header("location: ../index.php?pesan=gagal");
    }
}
?>
