<?php
include "service/database.php";
session_start();

if(isset($_POST['simpan'])){
    $nrp = $_SESSION['valid'];
    $query = mysqli_query($db, "SELECT * FROM registrasi WHERE nrp='$nrp'");
    $result = mysqli_fetch_assoc($query);
    $id = $result['id_registrasi'];

    $kepemilikan_rumah = $_POST["kepemilikan"];
    $jumlah_orang = $_POST["jumlah_orang_tinggal"];
    $daya_listrik = $_POST["daya_listrik"];
    $tagihan_listrik = $_POST["listrik"];
    $pbb = $_POST["pbb"];
    $roda_dua = $_POST["roda_dua"];
    $roda_empat = $_POST["roda_empat"];

    // Proses upload file rumah_depan
    if(isset($_FILES['rumah_depan'])){
        $rumah_depan = $_FILES['rumah_depan']['name'];
        $temp_name = $_FILES['rumah_depan']['tmp_name'];
        move_uploaded_file($temp_name, "uploads/$rumah_depan");
    } else {
        $rumah_depan = NULL;
    }

    // Proses upload file rumah_dalam
    if(isset($_FILES['rumah_dalam'])){
        $rumah_dalam = $_FILES['rumah_dalam']['name'];
        $temp_name = $_FILES['rumah_dalam']['tmp_name'];
        move_uploaded_file($temp_name, "uploads/$rumah_dalam");
    } else {
        $rumah_dalam = NULL;
    }

    $sql = "REPLACE INTO berkas_ekonomi (id_registrasi, kepemilikan_rumah, jumlah_penghuni, daya_listrik, tagihan_listrik, pbb, roda_dua, roda_empat, rumah_depan, rumah_dalam)
            VALUES ('$id', '$kepemilikan_rumah', '$jumlah_orang', '$daya_listrik', '$tagihan_listrik', '$pbb', '$roda_dua', '$roda_empat', '$rumah_depan', '$rumah_dalam')";

    if($db->query($sql)){
        $updateStatus = "UPDATE registrasi SET status_ekonomi = TRUE WHERE id_registrasi = '$id'";
        $db->query($updateStatus);
        header("Location: berkas1.php");
        exit();
    } else {
        echo "Data akun gagal disimpan, silahkan coba lagi";
    }

    $db->close(); 
}
?>
