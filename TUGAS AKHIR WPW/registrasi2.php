<?php
    include "service/database.php";
    session_start();

    $login_message = "";

    if(!isset($_SESSION['valid'])){
        header("Location: registrasi1.php");
    }

    if (isset($_SESSION["registrasi2"])) {
        header("location: registrasi3.php");
    }

    $nrp = $_SESSION['valid'];
    $query = mysqli_query($db,"SELECT*FROM registrasi WHERE nrp='$nrp'");

    while($result = mysqli_fetch_assoc($query)){
        $nama = $result['nama_lengkap'];
        $id = $result['id_registrasi'];
    }

    if(isset($_POST["registrasi2"])){
      header("location: registrasi3.php");
    }

    $db->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pendaftaran Akun</title>
    <link rel="stylesheet" href="registrasi2.css" />
    <link rel="icon" type="image/svg" href="logo/PSG.svg" />
    <link href="https://fonts.googleapis.com/css2?family=Karla&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet"/>
</head>
<body>
    <header>
        <img src="logo/logoWarna.svg" alt="logo" />
    </header>
    <div class="container">
        <div class="left">
            <h2>Anda memenuhi syarat untuk mendaftar</h2>
            <a>Silahkan periksa data anda dan masukkan email untuk mendapatkan No. Pendaftaran</a>
            <img src="picture/gambarOrangDanBuku.svg" alt="Image" class="main-image">
        </div>
        <div class="right">
            <div class="form-container">
                <div class="header">
                    <img src="icon/info.svg" alt="info">
                    <a>Pastikan data berikut sudah sesuai dengan identitas anda.</a>
                </div>
                <table>
                    <tr>
                        <td><strong>Nama</strong></td>
                        <td><?= $nama ?></td>
                    </tr>
                    <tr>
                        <td><strong>NRP</strong></td>
                        <td><?= $nrp ?></td>
                    </tr>
                </table>
                <div class="content">
                    <form id="registrasi2" method="post" action="registrasi2.php" onsubmit="return validateForm();">
                        <div class="coolinput">
                            <label for="input" class="text">Email PENS</label>
                            <div class="withIcon">
                                <div class="icon">
                                    <img src="icon/mail.svg" alt="">
                                </div>
                                <input type="email" placeholder="123a@it.student.pens.ac.id" name="input" class="input" required>
                            </div>
                        </div>
                        <div class="checkbox-container">
                            <div class="input">
                                <input type="checkbox" id="agreement" name="agreement" required>
                            </div>
                            <div class="ket">
                                <label for="agreement">Saya menyatakan data yang diinputkan dalam proses pendaftaran akun PSG sudah benar dan sesuai</label>
                            </div>
                        </div>
                        <button type="submit" name="registrasi">Selanjutnya</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 PENS Scolarship Gateway | ZZA</p>
    </footer>

    <script>
    </script>
</body>
</html>
