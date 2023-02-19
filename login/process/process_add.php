<?php

require_once('../function/helper.php');
require_once('../function/koneksi.php');

$nama = $_POST['nama'];
$kelas = $_POST['kelas'];
$email = $_POST['email'];
$alamat = $_POST['alamat'];

// Pengecekan kelengkapan data
if (empty($nama) || empty($kelas) || empty($email) || empty($alamat)) {
    header("location: " . BASE_URL . 'dashboard.php?page=create&process=failed');
} else {
    mysqli_query($koneksi, "INSERT INTO siswa(nama, kelas, email, alamat) VALUES ('$nama', '$kelas', '$email', '$alamat')");
    header("location: " . BASE_URL . 'dashboard.php?page=home&process=success');
}
