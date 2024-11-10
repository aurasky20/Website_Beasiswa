<?php
    include "service/database.php";
    session_start();

    if(!isset($_SESSION['valid'])){
        header("Location: login.php");
    }

    $nrp = $_SESSION['valid'];
    $query = mysqli_query($db,"SELECT*FROM registrasi WHERE nrp='$nrp'");

    while($result = mysqli_fetch_assoc($query)){
        $nama = $result['nama_lengkap'];
        $id = $result['id_registrasi'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pengisian Berkas</title>
    <link rel="icon" type="image/svg" href="logo/PSG.svg">
    <link rel="stylesheet" href="berkas1.css">
    <link href="https://fonts.googleapis.com/css2?family=Karla&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
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
                            <h4><?= $nama ; ?></h4>
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
    <!-- Navbar End -->

    <!-- Isi Berkas -->
    <div class="content">
        <div class="status">
            <h2>Kelengkapan Berkas</h2>
        </div>
        <div class="link-berkas">
            <label class="radio-container active-tab" for="biodata">
                <input type="radio" name="berkas" id="biodata" checked />Biodata
            </label>
            <label class="radio-container" for="keluarga">
                <input type="radio" name="berkas" id="keluarga" />Keluarga
            </label>
            <label class="radio-container" for="ekonomi">
                <input type="radio" name="berkas" id="ekonomi" />Ekonomi
            </label>
            <label class="radio-container" for="prestasi">
                <input type="radio" name="berkas" id="prestasi" />Nilai & Prestasi
            </label>
            <label class="radio-container" for="upload">
                <input type="radio" name="berkas" id="upload" />Upload Berkas
            </label>
        </div>
<div class="berkas" style=" box-shadow:  2px 2px 4px rgba(82, 93, 134, 0.3);">

            <!-- berkas biodata -->
    <div class="berkasItem" id="berkas-biodata" >
        <div class="biodata">
            <?php
                $nrp = $_SESSION['valid'];
                $query = mysqli_query($db, "SELECT * FROM registrasi WHERE nrp='$nrp'");
                $result = mysqli_fetch_assoc($query);
                $id = $result['id_registrasi'];

                // Ambil data berkas biodata dari database
                $queryBerkas = mysqli_query($db, "SELECT * FROM berkas_biodata WHERE id_registrasi='$id'");
                $berkas = mysqli_fetch_assoc($queryBerkas);

                $nik = isset($berkas['nik']) ? $berkas['nik'] : '';
                $nama = isset($berkas['nama_lengkap']) ? $berkas['nama_lengkap'] : '';
                $nrp = isset($berkas['nrp']) ? $berkas['nrp'] : '';
                $jurusan = isset($berkas['jurusan']) ? $berkas['jurusan'] : '';
                $gender = isset($berkas['jenis_kelamin']) ? $berkas['jenis_kelamin'] : '';
                $agama = isset($berkas['agama']) ? $berkas['agama'] : '';
                $tempat_lahir = isset($berkas['tempat_lahir']) ? $berkas['tempat_lahir'] : '';
                $tanggal_lahir = isset($berkas['tanggal_lahir']) ? $berkas['tanggal_lahir'] : '';
                $alamat = isset($berkas['alamat']) ? $berkas['alamat'] : '';
                $kode_pos = isset($berkas['kode_pos']) ? $berkas['kode_pos'] : '';
                $email = isset($berkas['email']) ? $berkas['email'] : '';
                $no_telp = isset($berkas['no_telp']) ? $berkas['no_telp'] : '';
                $gambar = isset($berkas['pas_foto']) ? $berkas['pas_foto'] : '';
            ?>
            <form class="form" name="biodata" method="post" action="bbiodata.php" enctype="multipart/form-data" onsubmit="return validateForm();">
                <div class="input-foto">
                    <label class="custum-file-upload" for="imageInput">
                        <div class="icon">
                            <!-- SVG Icon -->
                        </div>
                        <div class="text">
                            <span>Pas Foto 4 x 6</span>
                        </div>
                        <input type="file" id="imageInput" name="pas_foto" accept="image/*">
                        <img id="pas-foto" src="<?= $gambar; ?>">
                    </label>
                </div>
                
                <div class="input-data">
                    <table>
                        <tr>
                            <td><span>NIK</span></td>
                            <td><input type="text" class="input" name="nik" value="<?php echo $nik; ?>" required></td>
                        </tr>
                        <tr>
                            <td><span>Nama Lengkap</span></td>
                            <td><input type="text" class="input" id="nama" name="nama" value="<?php echo $nama; ?>" required></td>
                        </tr>
                        <tr>
                            <td><span>NRP</span></td>
                            <td><input type="text" class="input" name="nrp" value="<?php echo $nrp; ?>" required></td>
                        </tr>
                        <tr>
                            <td><span>Jurusan</span></td>
                            <td><input type="text" class="input" name="jurusan" value="<?php echo $jurusan; ?>" required></td>
                        </tr>
                        <tr>
                            <td><span>Jenis Kelamin</span></td>
                            <td>
                                <input type="radio" name="gender" value="Laki-laki" id="laki-laki" <?php echo ($gender == 'Laki-laki') ? 'checked' : ''; ?> required>
                                <label for="laki-laki">Laki-laki</label>
                                <input type="radio" name="gender" value="Perempuan" id="perempuan" <?php echo ($gender == 'Perempuan') ? 'checked' : ''; ?> required>
                                <label for="perempuan">Perempuan</label>
                            </td>
                        </tr>
                        <tr>
                            <td><span>Agama</span></td>
                            <td>
                                <select name="agama" id="pilihan" required>
                                    <option value="Default" <?php echo ($agama == 'Default') ? 'selected' : ''; ?>>-- Pilih --</option>
                                    <option value="Islam" <?php echo ($agama == 'Islam') ? 'selected' : ''; ?>>Islam</option>
                                    <option value="Kristen" <?php echo ($agama == 'Kristen') ? 'selected' : ''; ?>>Kristen</option>
                                    <option value="Katolik" <?php echo ($agama == 'Katolik') ? 'selected' : ''; ?>>Katolik</option>
                                    <option value="Hindu" <?php echo ($agama == 'Hindu') ? 'selected' : ''; ?>>Hindu</option>
                                    <option value="Budha" <?php echo ($agama == 'Budha') ? 'selected' : ''; ?>>Budha</option>
                                    <option value="Lainnya" <?php echo ($agama == 'Lainnya') ? 'selected' : ''; ?>>Lainnya</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><span>Tempat Lahir</span></td>
                            <td><input type="text" class="input" name="tempat_lahir" value="<?php echo $tempat_lahir; ?>" required></td>
                        </tr>
                        <tr>
                            <td><span>Tanggal Lahir</span></td>
                            <td><input type="date" class="input" name="tanggal_lahir" value="<?php echo $tanggal_lahir; ?>" required></td>
                        </tr>
                        <tr>
                            <td><span>Alamat</span></td>
                            <td><textarea name="alamat" rows="3" cols="45" id="alamat" required><?php echo $alamat; ?></textarea></td>
                        </tr>
                        <tr>
                            <td><span>Kode Pos</span></td>
                            <td><input type="text" class="input" name="kode_pos" value="<?php echo $kode_pos; ?>" required></td>
                        </tr>
                        <tr>
                            <td><span>Email</span></td>
                            <td><input type="email" class="input" name="email" value="<?php echo $email; ?>" required></td>
                        </tr>
                        <tr>
                            <td><span>Nomor HP/WA</span></td>
                            <td><input type="text" class="input" name="no_telp" value="<?php echo $no_telp; ?>" required></td>
                        </tr>
                    </table>
                    <button type="submit" class="submit" name="simpan">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
            
            <!-- berkas ekonomi -->
    <div class="berkasItem" id="berkas-ekonomi">
        <div class="ekonomi">
            <?php
                $queryBerkas = mysqli_query($db, "SELECT * FROM berkas_ekonomi WHERE id_registrasi='$id'");
                $berkas = mysqli_fetch_assoc($queryBerkas);

                $kepemilikan_rumah = isset($berkas['kepemilikan_rumah']) ? $berkas['kepemilikan_rumah'] : '';
                $jumlah_orang = isset($berkas['jumlah_penghuni']) ? $berkas['jumlah_penghuni'] : '';
                $daya_listrik = isset($berkas['daya_listrik']) ? $berkas['daya_listrik'] : '';
                $tagihan_listrik = isset($berkas['tagihan_listrik']) ? $berkas['tagihan_listrik'] : '';
                $pbb = isset($berkas['pbb']) ? $berkas['pbb'] : '';
                $roda_dua = isset($berkas['roda_dua']) ? $berkas['roda_dua'] : '';
                $roda_empat = isset($berkas['roda_empat']) ? $berkas['roda_empat'] : '';
                $rumah_depan = isset($berkas['rumah_depan']) ? $berkas['rumah_depan'] : '';
                $rumah_dalam = isset($berkas['rumah_dalam']) ? $berkas['rumah_dalam'] : '';
            ?>
            <form class="form" name="ekonomi" method="post" action="bekonomi.php" enctype="multipart/form-data">
                <div class="input-foto">
                    <label class="custum-file-upload" for="imageInput1">
                        <div class="icon">
                            <!-- SVG Icon -->
                        </div>
                        <div class="text">
                            <span>Foto Rumah Bagian Depan</span>
                        </div>
                        <input type="file" id="imageInput1" name="rumah_depan" accept="image/*">
                        <img id="rumah-depan" src="<?php echo $rumah_depan; ?>">
                    </label>
                    <label class="custum-file-upload" for="imageInput2">
                        <div class="icon">
                            <!-- SVG Icon -->
                        </div>
                        <div class="text">
                            <span>Foto Rumah Bagian Dalam</span>
                        </div>
                        <input type="file" id="imageInput2" name="rumah_dalam" accept="image/*">
                        <img id="rumah-dalam" src="<?php echo $rumah_dalam; ?>">
                    </label>
                </div>                      
                <div class="input-data">
                    <table>
                        <tr>
                            <td><span>Kepemilikan Rumah</span></td>
                            <td>
                                <select name="kepemilikan" id="pilihan" required>
                                    <option value="Default" <?php echo ($kepemilikan_rumah == 'Default') ? 'selected' : ''; ?>>-- Pilih --</option>
                                    <option value="Sendiri" <?php echo ($kepemilikan_rumah == 'Sendiri') ? 'selected' : ''; ?>>Sendiri</option>
                                    <option value="Sewa" <?php echo ($kepemilikan_rumah == 'Sewa') ? 'selected' : ''; ?>>Sewa</option>
                                    <option value="Menumpang" <?php echo ($kepemilikan_rumah == 'Menumpang') ? 'selected' : ''; ?>>Menumpang</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><span>Jumlah Orang Tinggal</span></td>
                            <td><input type="text" class="input" name="jumlah_orang_tinggal" value="<?php echo $jumlah_orang; ?>" required></td>
                        </tr>
                        <tr>
                            <td><span>Daya Listik (Watt)</span></td>
                            <td><input type="text" class="input" name="daya_listrik" value="<?php echo $daya_listrik; ?>" required></td>
                        </tr>
                        <tr>
                            <td><span>Tagihan Listik</span></td>
                            <td>
                                <select name="listrik" id="pilihan" required>
                                    <option value="Default" <?php echo ($tagihan_listrik == 'Default') ? 'selected' : ''; ?>>-- Pilih --</option>
                                    <option value="<= Rp499.999" <?php echo ($tagihan_listrik == '<= Rp499.999') ? 'selected' : ''; ?>><= Rp499.999</option>
                                    <option value="Rp500.000-Rp999.999" <?php echo ($tagihan_listrik == 'Rp500.000-Rp999.999') ? 'selected' : ''; ?>>Rp500.000 - Rp999.999</option>
                                    <option value=">= Rp1.000.000" <?php echo ($tagihan_listrik == '>= Rp1.000.000') ? 'selected' : ''; ?>>>= Rp1.000.000</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><span>PBB</span></td>
                            <td><input type="text" class="input" name="pbb" value="<?php echo $pbb; ?>" required></td>
                        </tr>
                        <tr>
                            <td><h3 class="message">Jumlah Kendaraan</h3></td>
                        </tr>
                        <tr>
                            <td><span>Roda Dua</span></td>
                            <td><input type="number" class="input" name="roda_dua" value="<?php echo $roda_dua; ?>" required></td>
                        </tr>
                        <tr>
                            <td><span>Roda Empat</span></td>
                            <td><input type="number" class="input" name="roda_empat" value="<?php echo $roda_empat; ?>" required></td>
                        </tr>
                    </table>
                    <button type="submit" class="submit" name="simpan">Simpan Data</button>
                </div>    
            </form>
        </div>
    </div>
            
            <!-- Berkas keluarga -->
            <div class="berkasItem" id="berkas-keluarga">
        <div class="keluarga">
            <?php
                $queryBerkas = mysqli_query($db, "SELECT * FROM berkas_keluarga WHERE id_registrasi='$id'");
                $berkas = mysqli_fetch_assoc($queryBerkas);

                $no_kk = isset($berkas['no_kk']) ? $berkas['no_kk'] : '';
                $jumlah_tanggungan = isset($berkas['jumlah_tanggungan']) ? $berkas['jumlah_tanggungan'] : '';
                $nama_lengkap_ayah = isset($berkas['nama_ayah']) ? $berkas['nama_ayah'] : '';
                $nik_ayah = isset($berkas['nik_ayah']) ? $berkas['nik_ayah'] : '';
                $pekerjaan_ayah = isset($berkas['pekerjaan_ayah']) ? $berkas['pekerjaan_ayah'] : '';
                $penghasilan_ayah = isset($berkas['penghasilan_ayah']) ? $berkas['penghasilan_ayah'] : '';
                $notelp_ayah = isset($berkas['notelp_ayah']) ? $berkas['notelp_ayah'] : '';
                $nama_lengkap_ibu = isset($berkas['nama_ibu']) ? $berkas['nama_ibu'] : '';
                $nik_ibu = isset($berkas['nik_ibu']) ? $berkas['nik_ibu'] : '';
                $pekerjaan_ibu = isset($berkas['pekerjaan_ibu']) ? $berkas['pekerjaan_ibu'] : '';
                $penghasilan_ibu = isset($berkas['penghasilan_ibu']) ? $berkas['penghasilan_ibu'] : '';
                $notelp_ibu = isset($berkas['notelp_ibu']) ? $berkas['notelp_ibu'] : '';
            ?>

            <form class="form" name="keluarga" method="post" action="bkeluarga.php" onsubmit="return validateForm();">
                <table>
                    <tr>
                        <td><span>No. KK</span></td>
                        <td><input required type="text" class="input" name="no_kk" value="<?php echo $no_kk; ?>"></td>
                    </tr>
                    <tr>
                        <td><span>Jumlah Tanggungan</span></td>
                        <td><input required type="text" class="input" name="jumlah_tanggungan" value="<?php echo $jumlah_tanggungan; ?>"></td>
                    </tr>
                    <tr>
                        <td><h3 class="message">Ayah</h3></td>
                    </tr>
                    <tr>
                        <td><span>Nama Lengkap</span></td>
                        <td><input required type="text" class="input" name="nama_lengkap_ayah" value="<?php echo $nama_lengkap_ayah; ?>"></td>
                    </tr>
                    <tr>
                        <td><span>NIK</span></td>
                        <td><input required type="text" class="input" name="nik_ayah" value="<?php echo $nik_ayah; ?>"></td>
                    </tr>
                    <tr>
                        <td><span>Pekerjaan</span></td>
                        <td><input required type="text" class="input" name="pekerjaan_ayah" value="<?php echo $pekerjaan_ayah; ?>"></td>
                    </tr>
                    <tr>
                        <td><span>Penghasilan</span></td>
                        <td>
                            <select name="penghasilan_ayah" id="pilihan">
                                <option value="Default" <?php echo ($penghasilan_ayah == 'Default') ? 'selected' : ''; ?>>-- Pilih --</option>
                                <option value="<= Rp999.999" <?php echo ($penghasilan_ayah == '<= Rp999.999') ? 'selected' : ''; ?>> Kurang dari Rp999.999</option>
                                <option value="Rp1.000.000-Rp4.999.999" <?php echo ($penghasilan_ayah == 'Rp1.000.000-Rp4.999.999') ? 'selected' : ''; ?>>Rp1.000.000-Rp4.999.999</option>
                                <option value="Rp5.000.000-Rp9.999.999" <?php echo ($penghasilan_ayah == 'Rp5.000.000-Rp9.999.999') ? 'selected' : ''; ?>>Rp5.000.000-Rp9.999.999</option>
                                <option value=">= Rp10.000.000" <?php echo ($penghasilan_ayah == '>= Rp10.000.000') ? 'selected' : ''; ?>>Lebih dari Rp10.000.000</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><span>No Telp.</span></td>
                        <td><input required type="text" class="input" name="notelp_ayah" value="<?php echo $notelp_ayah; ?>"></td>
                    </tr>
                    <tr>
                        <td><h3 class="message">Ibu</h3></td>
                    </tr>
                    <tr>
                        <td><span>Nama Lengkap</span></td>
                        <td><input required type="text" class="input" name="nama_lengkap_ibu" value="<?php echo $nama_lengkap_ibu; ?>"></td>
                    </tr>
                    <tr>
                        <td><span>NIK</span></td>
                        <td><input required type="text" class="input" name="nik_ibu" value="<?php echo $nik_ibu; ?>"></td>
                    </tr>
                    <tr>
                        <td><span>Pekerjaan</span></td>
                        <td><input required type="text" class="input" name="pekerjaan_ibu" value="<?php echo $pekerjaan_ibu; ?>"></td>
                    </tr>
                    <tr>
                        <td><span>Penghasilan</span></td>
                        <td>
                            <select name="penghasilan_ibu" id="pilihan">
                                <option value="Default" <?php echo ($penghasilan_ibu == 'Default') ? 'selected' : ''; ?>>-- Pilih --</option>
                                <option value="<= Rp999.999" <?php echo ($penghasilan_ibu == '<= Rp999.999') ? 'selected' : ''; ?>> Kurang dari Rp999.999</option>
                                <option value="Rp1.000.000-Rp4.999.999" <?php echo ($penghasilan_ibu == 'Rp1.000.000-Rp4.999.999') ? 'selected' : ''; ?>>Rp1.000.000-Rp4.999.999</option>
                                <option value="Rp5.000.000-Rp9.999.999" <?php echo ($penghasilan_ibu == 'Rp5.000.000-Rp9.999.999') ? 'selected' : ''; ?>>Rp5.000.000-Rp9.999.999</option>
                                <option value=">= Rp10.000.000" <?php echo ($penghasilan_ibu == '>= Rp10.000.000') ? 'selected' : ''; ?>>Lebih dari Rp10.000.000</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><span>No Telp.</span></td>
                        <td><input required type="text" class="input" name="notelp_ibu" value="<?php echo $notelp_ibu; ?>"></td>
                    </tr>
                </table>
                <button type="submit" class="submit" name="simpan">Simpan Data</button>      
            </form>
        </div>
    </div>
            
            <!-- berkas prestasi nilai -->
            <div class="berkasItem" id="berkas-prestasi">
                <div class="prestasi-nilai">
                <?php
                    $queryBerkas = mysqli_query($db, "SELECT * FROM berkas_nilai WHERE id_registrasi='$id'");
                    $berkas = mysqli_fetch_assoc($queryBerkas);

                    $nilai = isset($berkas['Nilai_IPS']) ? $berkas['Nilai_IPS'] : '';
                ?>
                    <form class="form" name="bidata" method="post" action="bprestasi.php" onsubmit="return validateForm();">
                        <div class="nilai">
                            <table>
                                <div class="input-nilai">
                                    <tr>
                                        <td>
                                            <label>Nilai IPS Terakhir</label>
                                        </td>
                                        <td>
                                            <input type="text" name="nilai" value="<?php echo $nilai; ?>" required>
                                        </td> 
                                    </tr> 
                                </div>
                                
                                <div class="input-scan">
                                    <tr>
                                        <td>
                                            <label for="fileUpload">Scan Transkrip Nilai</label>
                                        </td>
                                        <td>
                                            <div class="file-upload-wrapper">
                                                <label for="fileUpload" class="file-label">
                                                    <div class="upload-icon">
                                                        <img src="icon/upload.svg" alt="">
                                                    </div>
                                                    <div class="nama-file">
                                                        <span id="fileName">No file chosen</span>
                                                    </div>
                                                </label>
                                                <input type="file" id="fileUpload" name="scan-nilai" accept="image/*">
                                            </div>
                                        </td> 
                                    </tr> 
                                </div>
                            </table>                         
                        </div>
                        <div class="prestasi">
                            <div class="upload-prestasi">
                                <h3>Prestasi</h3>
                                <button>
                                    <a id="add" href="tambahPrestasi.php" name="tambah">
                                        <img src="icon/tambah.svg" alt="tambah">
                                        Tambah Prestasi
                                    </a>
                                </button>
                            </div>
                            <div class="info">
                                <img src="icon/info.svg" alt="info">
                                <p>Anda diperkenankan untuk mengisi hingga 3 prestasi. Isilah prestasi yang menurut Anda merupakan yang terbaik.
                                    Tidak wajib untuk diisi.
                                </p>
                            </div>
                            <div class="input">
                                <table>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kegiatan</th>
                                        <th>Jenis</th>
                                        <th>Tingkat</th>
                                        <th>Tahun</th>
                                        <th>Pencapaian</th>
                                        <th>Aksi</th>
                                    </tr>
                                    
                                    <?php
                                    $no = 1;
                                    $liat_prestasi = mysqli_query($db, "SELECT*FROM berkas_prestasi WHERE id_registrasi='$id' ");
                                    
                                    while($row=mysqli_fetch_assoc($liat_prestasi)){
                                        $id_prestasi = $row['id_prestasi'];
                                        echo "
                                        <tr>
                                        <td> $no </td>
                                        <td>$row[nama_kegiatan]</td>
                                            <td>$row[jenis_kegiatan]</td>
                                            <td>$row[tingkat]</td>
                                            <td>$row[tahun]</td>
                                            <td>$row[pencapaian]</td>
                                            <td>
                                                <div style='display: flex; align-items: center; justify-content: space-evenly;'>
                                                    <a href='editPrestasi.php?id=<?= $row[id_prestasi]; ?>' name='edit'>
                                                        <img src='icon/edit.svg' alt='edit' id='edit'>
                                                    </a>
                                                    <a href='deletePrestasi.php?id=<?= $row[id_prestasi]; ?>' name='delete'>
                                                        <img src='icon/delete.svg' alt='delete' id='delete'>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        ";
                                        $no++;
                                    } ?>
                                </table>
                            </div>
                        </div>
                        <div class="btn-upload">
                            <input type="submit" value="Simpan" name="simpan" >
                        </div>
                    </form>
                </div>
            </div>

            <!-- upload berkas -->
    <div class="berkasItem" id="berkas-upload">
        <div class="upload_berkas">
            <?php
                if (isset($_SESSION["upload"])) {
                    header("Location: uploadBerhasil.php");
                }

                $status_biodata = $result['status_biodata'];
                $status_keluarga = $result['status_keluarga'];
                $status_ekonomi = $result['status_ekonomi'];
                $status_nilai = $result['status_nilai'];
            ?>

            <div class="judul">
                <h2>Status Kelengkapan</h2>
            </div>
            <div class="tabel_status">
                <table>
                    <tr>
                        <th>Jenis Berkas</th>
                        <th>Status</th>
                    </tr>
                    <tr>
                        <td>Biodata</td>
                        <td>
                            <?php if($status_biodata): ?>
                                <img src="icon/sudah.svg">
                            <?php else: ?>
                                <img src="icon/belum.svg">
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Keluarga</td>
                        <td>
                            <?php if($status_keluarga): ?>
                                <img src="icon/sudah.svg">
                            <?php else: ?>
                                <img src="icon/belum.svg">
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Ekonomi</td>
                        <td>
                            <?php if($status_ekonomi): ?>
                                <img src="icon/sudah.svg">
                            <?php else: ?>
                                <img src="icon/belum.svg">
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Prestasi</td>
                        <td>
                            <?php if($status_nilai): ?>
                                <img src="icon/sudah.svg">
                            <?php else: ?>
                                <img src="icon/belum.svg">
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
                <div class="btn-upload">
                    <a href="uploadBerhasil.php">
                        <input type="submit" value="Upload Berkas" name="upload" >
                    </a>
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>

    <!-- Footer dan kopyright -->
    <footer>
        <p>&copy; 2024 PENS Scolarship Gateway | ZZA</p>
    </footer>
    <script>
        // profile overlay --
        let subMenu = document.getElementById('subMenu');

        function toggleMenu(){
            subMenu.classList.toggle('open-menu');
        }

        // foto muncul--
        // pas foto
        document.getElementById('imageInput').addEventListener('change', function(event) {
            var file = event.target.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                var imgElement = document.getElementById('pas-foto');
                imgElement.src = e.target.result;
                imgElement.style.display = 'block'; // Menampilkan elemen gambar
                document.querySelector('.custum-file-upload .text').style.display = 'none'; // Menyembunyikan teks
            }

            reader.readAsDataURL(file);
        });

        // rumah depan dan dalam
        document.getElementById('imageInput1').addEventListener('change', function(event) {
            var file = event.target.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                var imgElement = document.getElementById('rumah-depan');
                imgElement.src = e.target.result;
                imgElement.style.display = 'block'; // Menampilkan elemen gambar
                document.querySelector('label[for="imageInput1"] .text').style.display = 'none'; // Menyembunyikan teks
            }

            reader.readAsDataURL(file);
        });

        document.getElementById('imageInput2').addEventListener('change', function(event) {
            var file = event.target.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                var imgElement = document.getElementById('rumah-dalam');
                imgElement.src = e.target.result;
                imgElement.style.display = 'block'; // Menampilkan elemen gambar
                document.querySelector('label[for="imageInput2"] .text').style.display = 'none'; // Menyembunyikan teks
            }

            reader.readAsDataURL(file);
        });

        // link berkas --
        const radios = document.querySelectorAll('.radio-container input[type="radio"]');

        radios.forEach((radio) => {
            radio.addEventListener('change', function() {
                radios.forEach((activeRadio) => {
                    activeRadio.parentElement.classList.remove('active-tab');
                })

                document.querySelectorAll('.berkasItem').forEach(item => {
                    item.style.display = 'none';
                });

                const selectedBerkas = document.querySelector(`#berkas-${this.id}`);

                if (selectedBerkas) {
                    selectedBerkas.style.display = 'block';
                    this.parentElement.classList.add('active-tab');
                }
            });
        });
        document.querySelector('.radio-container input[type="radio"]:checked').dispatchEvent(new Event('change'));

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

<?php $db->close(); ?>