<?php

require_once('../function/helper.php');
require_once('../function/koneksi.php');

$nama = $_POST['nama'];
$kelas = $_POST['kelas'];
$email = $_POST['email'];
$alamat = $_POST['alamat'];
$id = $_POST['id'];

if (empty($nama) || empty($kelas) || empty($email) || empty($alamat)) {
    header("location: " . BASE_URL . 'dashboard.php?page=edit&id=' . $id . '&emptyform=true');
} else {
    mysqli_query($koneksi, "UPDATE siswa SET nama='$nama', kelas = '$kelas', email='$email', alamat = '$alamat' WHERE id='$id'");
    header("location: " . BASE_URL . 'dashboard.php?page=home&status=success');
}
