<?php
    include "service/database.php";
    session_start();

    $login_message = "";

    if(isset($_POST['login'])){
        $no_pendaftaran = mysqli_real_escape_string($db,$_POST['no_pendaftaran']);
        $nrp = mysqli_real_escape_string($db,$_POST['nrp']);

        $result = mysqli_query($db,"SELECT * FROM registrasi WHERE no_pendaftaran='$no_pendaftaran' AND nrp='$nrp' ") or die("Select Error");
        $row = mysqli_fetch_assoc($result);

        if(is_array($row) && !empty($row)){
            $_SESSION['valid'] = $row['nrp'];
            $_SESSION['nama'] = $row['nama_lengkap'];
        }else{
            echo "<div class='message'>
              <p>Nomor Pendaftaran atau NRP salah, silahkan coba lagi!</p>
               </div> <br>";
           echo "<a href='login.php'><button class='btn'>Go Back</button>";
 
        }
        if(isset($_SESSION['valid'])){
            header("Location: berkas1.php");
        }
        
    }else{
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <style>
    :root {
    --light-blue: #1A43BF;
    --medium-blue: #0D2FA7;
    --dark-blue: #0A2471;
    --half-blue: #C8D3F2;
    --black: #00072C;
    --white: #F4F7FF;
    --red: #D72525;
    --yellow: #F0C901;
    --hover-yellow: #FDD922;
    --light-grey: #adb7cd;
    --dark-grey: #4F5E73;
    }

    body {
    font-family: 'Open Sans';
    margin: 0;
    padding: 0;
    height: 100%;
    color: var(--dark-blue);
    background-color: var(--white);
    }

    .content {
    display: flex;
    margin: 0 20px;
    }

    header img{
    margin: 20px 0 0 50px;
    width: 150px;
    }

    .img-container {
    display: flex;
    width: 50%;
    display: grid;
    place-items: center;
    border-radius: 15px;
    }

    .img-container p{
    margin-top: 100px;
    margin-bottom: 0;
    font-size: 32px;
    font-weight: bold;
    text-align: center;
    }

    .img-container img {
    width: 70%;
    }

    .container {
    width: 35%;
    padding: 20px;
    border: 1px solid #ccc;
    background-color: var(--half-blue);
    border-radius: 20px;
    margin-top: 100px;
    box-shadow: 4px 4px 4px rgba(82, 93, 134, 0.3);
    }

    .content form {
    background-color: var(--half-blue);
    width: 100%;
    font-family: 'Open Sans';
    }

    .content label {
    display: block;
    margin-bottom: 5px;
    }

    .content input {
    width: 100%;
    padding: 10px;
    border: none;
    box-sizing: border-box;
    }

    button {
    color: var(--dark-blue);
    display: flex;
    font-family: 'Open Sans';
    justify-content: center;
    width: 100%;
    height: 2.4em;
    line-height: 2.4em; 
    overflow: hidden;
    margin-top: 20px;
    font-size: 14px;
    z-index: 1;
    color: var(--dark-blue);
    border: none;
    border-radius: 20px;
    position: relative;
    font-weight: bold;
    }

    button::before {
    position: absolute;
    content: "";
    background: var(--yellow);
    width: 120%;
    height: 200px;
    z-index: -1;
    border-radius: 50%;
    }

    button:before {
    top: 100%;
    left: -100%;
    transition: .1s all;
    }

    button:hover::before {
    top: -90px;
    left: -30px;
    }

    .footer {
    text-align: center;
    margin-top: 0px;
    font-size: 14px;
    }

    .footer a {
    color: var(--light-blue);
    text-decoration: none;
    }

    .content-input {
    display: flex;
    margin: 30px 20px 0;
    }

    .coolinput {
    display: flex;
    flex-direction: column;
    position: static;
    width: 100%;
    margin: auto;
    }

    .coolinput .withIcon{
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: var(--light-grey);
    border-radius: 8px;
    padding-left: 8px;
    }

    .coolinput .withIcon .icon{
    display: flex;
    width: 40px;
    }

    .coolinput .withIcon .icon img{
    width: 30px;
    }

    .coolinput input{
    border-bottom-right-radius: 8px;
    border-top-right-radius: 8px;
    z-index: 1;
    }

    .content .coolinput label{
    font-weight: bold;
    font-size: 16px;
    }
    .coolinput label .text {
    color: var(--black);
    position: relative;
    top: 0rem;
    margin: 10px 0 0 7px;
    }

    .coolinput input[type=text].input {
    padding: 11px 10px;
    font-size: 14px;
    background: #fff;
    }

    .coolinput input[type=text].input:focus {
    outline: none;
    }

    .coolinput a{
    margin-top: 8px;
    text-decoration: none;
    color: var(--light-blue);
    font-size: 14px;
    }

    footer{
    position: fixed;
    width: 100%;
    padding: 12px 0;
    bottom: 0;
    color: var(--white);
    background-color: var(--dark-blue);
    text-align: center;
    z-index: 2;
    }

    footer p{
    margin: 0;
    font-size: 12px;
    }
  </style>
  <title>Masuk Akun</title>
  <link rel="icon" type="image/svg" href="logo/PSG.svg">
  <link href="https://fonts.googleapis.com/css2?family=Karla&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <a href="beranda.html"><img src="logo/logoWarna.svg" alt="logo"></a>
    </header>
    <div class="content">
        <div class="img-container">
            <p>Pendaftaran Akun Baru</p>
            <img class="gambar" src="picture/gambarOrangDanBuku.svg" alt="bulpen">
        </div>
        
        <div class="container">            
            <div class="content-input">
                <form id="login" method="POST" action="">
                    <div class="coolinput">
                        <label for="input" class="text">
                            No. Pendaftaran
                        </label>
                        <div class="withIcon">
                            <div class="icon">
                                <img src="icon/profil.svg" alt="">
                            </div>
                            <input type="text" name="no_pendaftaran" class="input" required>
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
                            <input type="text" name="nrp" class="input" required>
                        </div>
                        <div class="salah" style="font-size: 12px; color:#d5d7e6;">
                            <i><?php echo $login_message ?></i>
                        </div>
                        <a href="#">Lupa Nomor Pendaftaran ?</a>
                    </div>
                    <br>
                    <!-- <a href="berkas1.php"> -->
                        <button type="submit" name="login">Log in</button>
                    <!-- </a> -->
                </form>
            </div>

            <div class="footer">
                <p>Belum punya akun? <a href="registrasi1.php">Registrasi</a></p>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 PENS Scolarship Gateway | ZZA</p>
    </footer>
    <?php 
    }
     ?>
</body>
</html>
