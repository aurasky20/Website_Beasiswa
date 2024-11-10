<?php
include "service/database.php";
session_start();

if (isset($_GET['id_prestasi'])) {
    $id_prestasi = $_GET['id_prestasi'];

    $query = mysqli_query($db, "SELECT * FROM berkas_prestasi WHERE id_prestasi='$id_prestasi'");
    $prestasi = mysqli_fetch_assoc($query);

    // if (!$prestasi) {
    //     echo "Data prestasi tidak ditemukan";
    // }

    if (isset($_POST['update'])) {
        $kegiatan = $_POST["kegiatan"];
        $jenis_kegiatan = $_POST["jenis"];
        $tingkat = $_POST["tingkat"];
        $tahun = $_POST["tahun"];
        $pencapaian = $_POST["pencapaian"];

        $sql = "UPDATE berkas_prestasi SET 
                nama_kegiatan='$kegiatan', 
                jenis_kegiatan='$jenis_kegiatan', 
                tingkat='$tingkat', 
                tahun='$tahun', 
                pencapaian='$pencapaian' 
                WHERE id_prestasi='$id_prestasi'";

        if ($db->query($sql)) {
            header("Location: berkas1.php");
        } else {
            echo "Data prestasi gagal diperbarui, silahkan coba lagi";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Prestasi</title>
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
                / Edit Prestasi
            </h2>
        </div>
        <div class="berkas">
            <!-- berkas biodata -->
                <div class="tambah">
                <?php
                    if (isset($_GET['id_prestasi'])) {
                        $id_prestasi = $_GET['id_prestasi'];
                    
                        $query = mysqli_query($db, "SELECT * FROM berkas_prestasi WHERE id_prestasi='$id_prestasi'");
                        $prestasi = mysqli_fetch_assoc($query);
                    }
                    $kegiatan = isset($berkas['nama_kegiatan']) ? $berkas['nama_kegiatan'] : '';
                    $jenis_kegiatan = isset($berkas['jenis_kegiatan']) ? $berkas['jenis_kegiatan'] : '';
                    $tingkat = isset($berkas['tingkat']) ? $berkas['tingkat'] : '';
                    $tahun = isset($berkas['tahun']) ? $berkas['tahun'] : '';
                    $pencapaian = isset($berkas['pencapaian']) ? $berkas['pencapaian'] : '';
                ?>
                    <form class="form" name="tambah" method="post" action="" onsubmit="return validateForm();">                        
                        <div class="input-data">
                            <table>
                                <tr>
                                    <td>
                                        <span>Nama Kegiatan</span>
                                    </td>
                                    <td>
                                        <input type="text" class="input" name="kegiatan" value="<?= $kegiatan; ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Jenis Kegiatan</span>
                                    </td>
                                    <td>
                                        <input type="radio" name="jenis" value="Individu" id="individu" <?php echo ($jenis_kegiatan == 'Individu') ? 'checked' : ''; ?>>
                                        <label for="individu">Individu</label>
                                        <input type="radio" name="jenis" value="Kelompok" id="kelompok" <?php echo ($jenis_kegiatan == 'Kelompok') ? 'checked' : ''; ?>>
                                        <label for="kelompok">Kelompok/Tim</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Tingkat</span>           
                                    </td>
                                    <td>
                                        <select name="tingkat" id="agama">
                                            <option value="Default" <?php echo ($tingkat == 'Default') ? 'selected' : ''; ?>>-- Pilih --</option>
                                            <option value="Kabupaten/Kota" <?php echo ($tingkat == 'Kabupaten/Kota') ? 'selected' : ''; ?>>Kabupaten/Kota</option>
                                            <option value="Provinsi" <?php echo ($tingkat == 'Provinsi') ? 'selected' : ''; ?>>Provinsi</option>
                                            <option value="Nasional" <?php echo ($tingkat == 'Nasional') ? 'selected' : ''; ?>>Nasional</option>
                                            <option value="Internasional" <?php echo ($tingkat == 'Internasional') ? 'selected' : ''; ?>>Internasional</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Tahun Perolehan</span>                
                                    </td>
                                    <td>
                                        <input type="text" class="input" name="tahun" value="<?= $tahun; ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Pencapaian</span>                      
                                    </td>
                                    <td>
                                        <input type="text" class="input" id="pencapaian" name="pencapaian" placeholder="contoh: Juara 1" value="<?= $pencapaian; ?>">
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
                        <button type="submit" class="submit" name="edit">Edit Prestasi</button>
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
