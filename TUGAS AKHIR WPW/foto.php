<?php
include "service/database.php"; // Sesuaikan path-nya jika diperlukan
// session_start();

// Ambil id registrasi dari URL
$id_registrasi = $_GET['id'];

// Ambil data gambar dari database
$queryBerkas = mysqli_query($db, "SELECT pas_foto FROM berkas_biodata WHERE id_registrasi='$id_registrasi'");
$berkas = mysqli_fetch_assoc($queryBerkas);

// Set header untuk menampilkan gambar
header("Content-type: image/jpeg"); // Sesuaikan dengan jenis gambar yang disimpan

echo $berkas['pas_foto'];
?>