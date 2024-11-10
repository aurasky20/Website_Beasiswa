<?php
include "service/database.php";
session_start();

include "service/no_pendaftaran.php";

$no_pendaftaran = generatePendaftaran(10);
$register_message = "";
$nama_message = "";
$nrp_message = "";
$email_message = "";

if(isset($_POST["registrasi"])){

    $form_nama = '/^[A-Z\.]+(\s[A-Z\.]+)*$/';
    $form_nrp = '/^\d{8}(3[1-9]|4[0-9]|5[0-9]|60)$/';
    $form_email = '/^[a-zA-Z0-9._%+-]+@([a-zA-Z0-9.-]+\.)?pens\.ac\.id$/';

    if(preg_match($form_nama, $_POST["nama"])){
        $nama = $_POST["nama"];
    }else{
        $nama_message = "Format nama salah.";
    }
    
    if(preg_match($form_email, $_POST["email"])){
        $email = $_POST["email"];
    }else{
        $email_message = "Email tidak terdaftar.";
    }

    $nrp = $_POST["nrp"];

    if(preg_match($form_nrp, $nrp)){
        try {
            $sql = "INSERT INTO registrasi (nama_lengkap, nrp, email, no_pendaftaran) 
            VALUES ('$nama', '$nrp', '$email', '$no_pendaftaran')";

            if($db->query($sql)){
                header("Location: registrasi2.php");
            } else {
                echo "Daftar akun gagal, silahkan coba lagi";
                header("Location: registrasi1.php");
            }
        } catch (mysqli_sql_exception $e) {
            if($e->getCode() == 1062) {
                $nrp_message = "NRP sudah digunakan, silahkan coba lagi.";
                header("Location: registrasi1.php");
            } else {
                $register_message = "Terjadi kesalahan pada server, silahkan coba lagi";
            }
        }
    } else {
        $register_message = "Anda tidak memenuhi syarat untuk mendaftar.";
    }

    $sql = "SELECT * FROM registrasi WHERE nrp = '$nrp'";
    $result = $db->query($sql);
    $row = mysqli_fetch_assoc($result);

    if (is_array($row) && !empty($row) > 0) {
        $_SESSION['valid'] = $row['nrp'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['nama'] = $row['nama_lengkap'];
    }

    if(isset($_SESSION['valid'])){
        header("Location: registrasi2.php");
    }

    $db->close(); 
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <title>Pendaftaran Akun</title>
  <link rel="stylesheet" href="registrasi1.css">
  <link rel="icon" type="image/svg" href="logo/PSG.svg">
  <link href="https://fonts.googleapis.com/css2?family=Karla&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <a href="beranda.html"><img src="logo/logoWarna.svg" alt="logo"></a>
    </header>

    <!-- content -->
    <div class="content">
        <div class="img-container">
            <p>Pendaftaran Akun Baru</p>
            <img src="picture/gambarOrangDanBuku.svg" alt="bulpen">
        </div>
        <div class="container">
            <div class="header">
                <h4>
                    <img src="icon/info.svg" alt="info">
                    Harap diperhatikan!
                </h4>
                <p>
                    Pendaftaran akun PSG 2024 diperuntukkan untuk mahasiswa semester 3 hingga semester 5 (bagi mahasiswa D4) yang masih terdaftar sebagai mahasiswa aktif PENS.
                </p>
            </div>
            
            <div class="content">
                <form id="registrasi" name="registrasi" method="post" action="registrasi1.php" onsubmit="return validateForm();">
                    <div class="coolinput">
                        <label for="input" class="text">
                            Nama Lengkap
                        </label>
                        <div class="withIcon">
                            <div class="icon">
                                <img src="icon/profil.svg" alt="">
                            </div>
                            <input type="text" placeholder="NAMA" name="nama" class="input" required>
                        </div>
                        <div class="salah" style="font-size: 12px; color: #D72525;">
                            <i><?php echo $nama_message ?></i>
                        </div>
                    </div>   
                    <br>
                    <div class="coolinput">
                        <label for="input" class="text">
                            Nomor Registrasi Pokok (NRP)
                        </label>
                        <div class="withIcon">
                            <div class="icon">
                                <img src="icon/numbers.svg" alt="">
                            </div>
                            <input type="text" placeholder="NRP" name="nrp" class="input" required>
                        </div>
                        <div class="salah" style="font-size: 12px; color: #D72525;">
                            <i><?php echo $nrp_message ?></i>
                        </div>
                    </div>
                    <br>
                    <div class="coolinput">
                        <label for="input" class="text">
                            Email PENS
                        </label>
                        <div class="withIcon">
                            <div class="icon">
                                <img src="icon/mail.svg" alt="">
                            </div>
                            <input type="email" placeholder="123a@it.student.pens.ac.id" name="email" class="input" required>
                        </div>
                        <div class="salah" style="font-size: 12px; color: #D72525;">
                            <i><?php echo $email_message ?></i>
                        </div>
                    </div>
                    <button type="submit" name="registrasi">Selanjutnya</button>
                </form>
            </div>

            <div class="footer">
                <p>Sudah punya akun? <a href="login.php">Masuk</a></p>
            </div>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 PENS Scolarship Gateway | ZZA</p>
    </footer>
</body>
</html>
