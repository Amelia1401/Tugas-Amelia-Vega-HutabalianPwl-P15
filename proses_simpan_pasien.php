<?php
include "koneksi.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

$idpasien     = $_POST['tid_pasien'];
$namapasien   = $_POST['tnama_pasien'];
$tanggallahir = $_POST['ttanggallahir'];
$jeniskelamin = $_POST['tjeniskelamin'];
$alamat       = $_POST['talamat'];
$notelepon    = $_POST['tnotelepon'];

if ($idpasien == "" || $namapasien == "") {
    echo "<p style='color:red;'>❌ Id dan Nama Pasien wajib diisi!</p>";
    exit;
}

$sql = "INSERT INTO pasien (Id_Pasien, Nama_Pasien, Tanggal_Lahir, Jenis_Kelamin, Alamat, No_Telepon)
        VALUES ('$idpasien', '$namapasien', '$tanggallahir', '$jeniskelamin', '$alamat', '$notelepon')";

if (mysqli_query($conn, $sql)) {
    echo "<p style='color:green;'>✅ Data pasien berhasil disimpan!</p>";
} else {
    echo "<p style='color:red;'>❌ Gagal menyimpan: " . mysqli_error($conn) . "</p>";
}
?>
