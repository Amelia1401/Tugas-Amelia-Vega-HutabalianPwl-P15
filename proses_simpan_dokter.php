<?php
include "koneksi.php";

$id = $_POST['tid_dokter'];
$nama = $_POST['tnama_dokter'];
$spesialis = $_POST['tspesialis'];
$telp = $_POST['tnotelepon'];

if ($id == "" || $nama == "") {
    echo "<p style='color:red;'>❌ Id dan Nama wajib diisi!</p>";
} else {
    $sql = "INSERT INTO dokter (Id_Dokter, Nama_Dokter, Spesialis, No_Telepon)
            VALUES ('$id', '$nama', '$spesialis', '$telp')";
    if (mysqli_query($conn, $sql)) {
        echo "<p style='color:green;'>✅ Data berhasil disimpan!</p>";
    } else {
        echo "<p style='color:red;'>❌ Gagal menyimpan: " . mysqli_error($conn) . "</p>";
    }
}
?>