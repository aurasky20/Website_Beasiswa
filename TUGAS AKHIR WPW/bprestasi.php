<?php
    include "service/database.php";
    session_start();

    if(isset($_SESSION["simpan"])){
        header("location: berkas1.php");
        exit();
    }

    $nrp = $_SESSION['valid'];
    $query = mysqli_query($db,"SELECT*FROM registrasi WHERE nrp='$nrp'");
    
    while($result = mysqli_fetch_assoc($query)){
        $id = $result['id_registrasi'];
    }

    if(isset($_POST['simpan'])){
        $nilai = $_POST["nilai"];     
             
        $sql = "INSERT INTO berkas_nilai (id_registrasi, Nilai_IPS
                ) VALUES (
                    '$id',
                    '$nilai'
                )";

        if($db->query($sql)){
            $updateStatus = "UPDATE registrasi SET status_nilai = TRUE WHERE id_registrasi = '$id'";
            $db->query($updateStatus);
            header("Location: berkas1.php");
            exit();
        } else {
            echo "Data akun gagal disimpan, silahkan coba lagi";
        }   

        $db->close(); 
    }
?>