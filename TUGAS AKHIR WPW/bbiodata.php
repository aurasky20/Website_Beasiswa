<?php
include "service/database.php";
session_start();

if (isset($_POST['simpan'])) {
    $nrp = $_SESSION['valid'];
    $query = mysqli_query($db, "SELECT * FROM registrasi WHERE nrp='$nrp'");
    $result = mysqli_fetch_assoc($query);
    $id = $result['id_registrasi'];

    $nik = $_POST["nik"];
    $nama = $_POST["nama"];
    $nrp = $_POST["nrp"];
    $jurusan = $_POST["jurusan"];
    $gender = $_POST["gender"];
    $agama = $_POST["agama"];
    $tgl_lhr = $_POST["tanggal_lahir"];
    $tempat_lhr = $_POST["tempat_lahir"];
    $alamat = $_POST["alamat"];
    $kode_pos = $_POST["kode_pos"];
    $email = $_POST["email"];
    $no_telp = $_POST["no_telp"];

    // Proses file gambar
    if(isset($_FILES['pas_foto'])){
        $pas_foto = $_FILES['pas_foto']['name'];
        $temp_name = $_FILES['pas_foto']['tmp_name'];
        move_uploaded_file($temp_name, "uploads/$pas_foto");
    } else {
        $pas_foto = NULL;
    }

    $sql = "REPLACE INTO berkas_biodata (id_registrasi, nik, nama_lengkap, nrp, jurusan, jenis_kelamin, agama, tempat_lahir, tanggal_lahir, alamat, kode_pos, email, no_telp, pas_foto)
            VALUES ('$id', '$nik', '$nama', '$nrp', '$jurusan', '$gender', '$agama', '$tempat_lhr', '$tgl_lhr', '$alamat', '$kode_pos', '$email', '$no_telp', '$pas_foto')";

    if ($db->query($sql)) {
        $updateStatus = "UPDATE registrasi SET status_biodata = TRUE WHERE id_registrasi = '$id'";
        $db->query($updateStatus);
        header("Location: berkas1.php");
        exit();
    } else {
        echo "Data akun gagal disimpan, silahkan coba lagi";
    }

    $db->close();
}
?>
