<?php
include "koneksi.php";

$id_rekam   = $_POST['id_rekam'];
$id_pasien  = $_POST['id_pasien'];
$id_dokter  = $_POST['id_dokter'];
$tanggal    = $_POST['tanggal'];
$keluhan    = $_POST['keluhan'];
$diagnosa   = $_POST['diagnosa'];
$tindakan   = $_POST['tindakan'];
$resep      = $_POST['resep'];

if ($id_rekam == "" || $id_pasien == "" || $id_dokter == "") {
    echo "<p style='color:red;'>❌ Id Rekam, Pasien, dan Dokter wajib diisi!</p>";
    exit;
}

$q = "INSERT INTO rekammedik 
    (Id_Rekam, Id_Pasien, Id_Dokter, Tanggal_Kunjungan, Keluhan, Diagnosa, Tindakan, Resep_Obat)
    VALUES
    ('$id_rekam', '$id_pasien', '$id_dokter', '$tanggal', '$keluhan', '$diagnosa', '$tindakan', '$resep')";

if (mysqli_query($conn, $q)) {
    echo "<p style='color:green;'>✅ Data berhasil disimpan!</p>";
} else {
    echo "<p style='color:red;'>❌ Gagal menyimpan: " . mysqli_error($conn) . "</p>";
}
?>