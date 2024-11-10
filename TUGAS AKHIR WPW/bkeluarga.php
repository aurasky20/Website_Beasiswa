<?php
include "service/database.php";
session_start();

if(isset($_POST['simpan'])){
    $nrp = $_SESSION['valid'];
    $query = mysqli_query($db, "SELECT * FROM registrasi WHERE nrp='$nrp'");
    $result = mysqli_fetch_assoc($query);

    $id = $result['id_registrasi'];

    $no_kk = $_POST["no_kk"];
    $tanggungan = $_POST["jumlah_tanggungan"];
    $nama_ayah = $_POST["nama_lengkap_ayah"];
    $nik_ayah = $_POST["nik_ayah"];
    $pekerjaan_ayah = $_POST["pekerjaan_ayah"];
    $penghasilan_ayah = $_POST["penghasilan_ayah"];
    $notelp_ayah = $_POST["notelp_ayah"];
    $nama_ibu = $_POST["nama_lengkap_ibu"];
    $nik_ibu = $_POST["nik_ibu"];
    $pekerjaan_ibu = $_POST["pekerjaan_ibu"];
    $penghasilan_ibu = $_POST["penghasilan_ibu"];
    $notelp_ibu = $_POST["notelp_ibu"];

    $sql = "REPLACE INTO berkas_keluarga (id_registrasi, no_kk, jumlah_tanggungan, 
    nama_ayah, nik_ayah, pekerjaan_ayah, penghasilan_ayah, notelp_ayah, 
    nama_ibu, nik_ibu, pekerjaan_ibu, penghasilan_ibu, notelp_ibu) 
            VALUES (
                '$id', '$no_kk', '$tanggungan', 
                '$nama_ayah', '$nik_ayah', '$pekerjaan_ayah', '$penghasilan_ayah', '$notelp_ayah', 
                '$nama_ibu', '$nik_ibu', '$pekerjaan_ibu', '$penghasilan_ibu', '$notelp_ibu')";

    if($db->query($sql)){
        $updateStatus = "UPDATE registrasi SET status_keluarga = TRUE WHERE id_registrasi = '$id'";
        $db->query($updateStatus);
        header("Location: berkas1.php");
        exit();
    } else {
        echo "Data akun gagal disimpan, silahkan coba lagi";
    }

    $db->close(); 
}
?>
