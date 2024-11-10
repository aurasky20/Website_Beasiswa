<?php
    include "service/database.php";
    session_start();

    if(!isset($_SESSION['valid'])){
        header("Location: login.php");
    }

    if (isset($_SESSION["upload"])) {
        header("location: uploadBerhasil.php");
    }

    $nrp = $_SESSION['valid'];
    $query = mysqli_query($db,"SELECT*FROM registrasi WHERE nrp='$nrp'");

    while($result = mysqli_fetch_assoc($query)){
        $email = $result['email'];
        $nama = $result['nama_lengkap'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pendaftaran Akun</title>
    <link rel="stylesheet" href="uploadBerhasil1.css">
    <link rel="icon" type="image/svg" href="logo/PSG.svg">
    <link href="https://fonts.googleapis.com/css2?family=Karla&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="gambar">
            <a href="beranda.html">
                <img src="logo/logoPutih.svg" alt="logo">
            </a>
        </div>

        <div class="profile">
            <h4>LUMINE TRAVELER</h4>
            <div class="profile-content">
                <div class="menu">
                    <a onclick="toggleMenu()">
                        <img src="icon/profile kecil.svg" alt="">
                    </a>
                </div>

                <div class="sub-menu-wrap" id="subMenu">
                    <div class="sub-menu">
                        <div class="user-info">
                            <img src="icon/profilePutih.svg">
                            <h4><?= $nama ?></h4>
                        </div>
                        <div class="logout">
                            <a class="sub-menu-link" href="login.php" style="text-decoration: none; color: white;">
                                <img src="icon/logout.svg">
                                <h4>Logout</h4>
                            </a>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="content">
            <div class="gambar">
                <img src="picture/berhasil.svg" alt="Icon3">
            </div>
            <div class="selamat">
                <div class="ket">
                    <h1>Pendaftaran Beasiswa Berhasil!</h1>
                    <p>Hasil pengumuman akan dikirim melalui email <strong><?= $email ?></strong> pada tanggal 14 September 2024</p>
                </div>
                <div class="btn">
                    <a href="beranda.html">
                        <button style="width: 82%">
                            Kembali ke Beranda
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 PENS Scolarship Gateway | ZZA</p>
    </footer>

    <script>
        let subMenu = document.getElementById("subMenu");
        function toggleMenu(){
            subMenu.classList.toggle("open-menu");
        }
    </script>
</body>
</html>