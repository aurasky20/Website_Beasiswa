<?php
include "service/database.php";
session_start();
$nrp = $_SESSION['valid'];
$query = mysqli_query($db, "SELECT * FROM registrasi WHERE nrp='$nrp'");

while ($result = mysqli_fetch_assoc($query)) {
    $id = $result['id_registrasi'];
}

if (isset($_GET['id'])) {
    $id_prestasi = $_GET['id'];

    // Menggunakan parameter prepared statement untuk mencegah SQL injection
    $delete_query = mysqli_prepare($db, "DELETE FROM berkas_prestasi WHERE id_prestasi=? AND id_registrasi=?");
    mysqli_stmt_bind_param($delete_query, "ii", $id_prestasi, $id);
    $execute = mysqli_stmt_execute($delete_query);

    if ($execute) {
        header("Location: berkas1.php");
    } else {
        echo "Tidak bisa menghapus data.";
    }

    mysqli_stmt_close($delete_query);
} else {
    // Handle error if id parameter is not provided
}
?>
