<?php
    include "service/database.php";
    session_start();

    if (isset($_SESSION["tambah"])) {
        header("location: berkas1.php");
    }

    $nrp = $_SESSION['valid'];
    $query = mysqli_query($db,"SELECT*FROM registrasi WHERE nrp='$nrp'");

    while($result = mysqli_fetch_assoc($query)){
        $id = $result['id_registrasi'];
    }

    $query = mysqli_query($db,"SELECT*FROM berkas_prestasi WHERE id_registrasi='$id'");
    $row = mysqli_fetch_assoc($query);

        if(isset($_POST['tambah'])){
            $kegiatan = $_POST["kegiatan"];
            $jenis = $_POST["jenis"];        
            $tingkat = $_POST["tingkat"];
            $tahun = $_POST["tahun"];
            $pencapaian = $_POST["pencapaian"];
                
            $sql = "INSERT INTO berkas_prestasi (id_registrasi, nama_kegiatan, jenis_kegiatan,
                    tingkat, tahun, pencapaian
                    ) VALUES (
                        '$id',
                        '$kegiatan',
                        '$jenis', 
                        '$tingkat', 
                        '$tahun', 
                        '$pencapaian'
                    )";

            if($db->query($sql)){
                echo "Data akun berhasil disimpan.";
                header("Location: berkas1.php");
                exit();
            } else {
                echo "Data akun gagal disimpan, silahkan coba lagi";
            }  

            $db->close(); 
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tambah Prestasi</title>
    <link rel="icon" type="image/svg" href="logo/PSG.svg">
    <link rel="stylesheet" href="berkas1.css">
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
            <h4>
                <?= $_SESSION['nama']; ?>
            </h4>
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
                            <h4>
                                <?= $_SESSION['nama']; ?>
                            </h4>
                        </div>
                        <div class="logout">
                            <a class="sub-menu-link" href="login.php">
                                <img src="icon/logout.svg">
                                <h4>Logout</h4>
                            </a>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="content" id="tambah-content">
        <div class="status">
            <h2>
                <a href="berkas1.php" style="text-decoration: none; color: #0A2471;">Dashbord</a> 
                / Tambah Prestasi
            </h2>
        </div>
        <div class="berkas">
            <!-- berkas biodata -->
                <div class="tambah">
                    <form class="form" name="tambah" method="post" action="" onsubmit="return validateForm();">                        
                        <div class="input-data">
                            <table>
                                <tr>
                                    <td>
                                        <span>Nama Kegiatan</span>
                                    </td>
                                    <td>
                                        <input type="text" class="input"
                                        name="kegiatan">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Jenis Kegiatan</span>
                                    </td>
                                    <td>
                                        <input type="radio" name="jenis" value="Individu" id="individu" >
                                        <label for="individu">Individu</label>
                                        <input type="radio" name="jenis" value="Kelompok" id="kelompok">
                                        <label for="kelompok">Kelompok/Tim</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Tingkat</span>           
                                    </td>
                                    <td>
                                        <select name="tingkat" id="agama">
                                            <option value="Default">-- Pilih --</option>
                                            <option value="Kabupaten/Kota">Kabupaten/Kota</option>
                                            <option value="Provinsi">Provinsi</option>
                                            <option value="Nasional">Nasional</option>
                                            <option value="Internasional">Internasional</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Tahun Perolehan</span>                
                                    </td>
                                    <td>
                                        <input type="text" class="input"
                                        name="tahun">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Pencapaian</span>                      
                                    </td>
                                    <td>
                                        <input type="text" class="input" id="pencapaian"
                                        name="pencapaian" placeholder="contoh: Juara 1">
                                    </td>
                                </tr>
                                <tr>
                            </table>
                            <div class="input-scan">
                                <table>
                                    <tr>
                                        <td>
                                            <label for="fileUpload" id="judul-tambah">Scan Transkrip Nilai</label>
                                            <div class="file-upload-wrapper">
                                                <label for="fileUpload" class="file-label">
                                                    <div class="upload-icon">
                                                        <img src="icon/upload.svg" alt="">
                                                    </div>
                                                    <div class="nama-file">
                                                        <span id="fileName">No file chosen</span>
                                                    </div>
                                                </label>
                                                <input type="file" id="fileUpload" name="scan-prestasi" accept="image/*">
                                            </div>
                                        </td> 
                                    </tr> 
                                </table>
                            </div>
                        </div>
                        <button type="submit" class="submit" name="tambah">Tambah Prestasi</button>
                    </form>
                </div>

        </div>
    </div>
    <footer id="footer-tambah">
        <p>&copy; 2024 PENS Scolarship Gateway | ZZA</p>
    </footer>
    <script>
        // profile overlay --
        let subMenu = document.getElementById('subMenu');

        function toggleMenu(){
            subMenu.classList.toggle('open-menu');
        }

        // upload scan nilai
        document.getElementById('fileUpload').addEventListener('change', function(event) {
            const fileName = event.target.files[0]?.name || 'No file chosen';
            const truncatedFileName = truncateFileName(fileName, 20); // Adjust the maximum length as needed
            document.getElementById('fileName').textContent = truncatedFileName;
        });

        function truncateFileName(fileName, maxLength) {
            if (fileName.length <= maxLength) {
                return fileName;
            }
            const start = fileName.substring(0, Math.ceil(maxLength / 2));
            const end = fileName.substring(fileName.length - Math.floor(maxLength / 2));
            return `${start}...${end}`;
        }
    </script>
</body>
</html>
