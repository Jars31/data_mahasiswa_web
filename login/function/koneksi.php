<?php

$server = "localhost";
$username = "root";
$password = "";
$dbname = "akademik";

$koneksi = mysqli_connect($server, $username, $password, $dbname) or die("Koneksi ke database gagal");
