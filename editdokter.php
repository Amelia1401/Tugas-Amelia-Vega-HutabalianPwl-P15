<?php
include "koneksi.php";

// Ambil data berdasarkan ID dari URL
$id = $_GET['id'];
$q = mysqli_query($conn, "SELECT * FROM dokter WHERE Id_Dokter='$id'");
$data = mysqli_fetch_assoc($q);
?>

<h3>Edit Data Dokter</h3>
<form method="POST" action="">
  <table>
    <tr>
      <td>Id Dokter</td>
      <td><input type="text" name="id_dokter" value="<?= $data['Id_Dokter'] ?>" readonly></td>
    </tr>
    <tr>
      <td>Nama Dokter</td>
      <td><input type="text" name="nama_dokter" value="<?= $data['Nama_Dokter'] ?>"></td>
    </tr>
    <tr>
      <td>Spesialis</td>
      <td><input type="text" name="spesialis" value="<?= $data['Spesialis'] ?>"></td>
    </tr>
    <tr>
      <td>No Telepon</td>
      <td><input type="text" name="no_telepon" value="<?= $data['No_Telepon'] ?>"></td>
    </tr>
    <tr>
      <td></td>
      <td><button type="submit" name="update">Simpan Perubahan</button></td>
    </tr>
  </table>
</form>

<?php
// Proses simpan perubahan
if (isset($_POST['update'])) {
    $nama = $_POST['nama_dokter'];
    $spesialis = $_POST['spesialis'];
    $telp = $_POST['no_telepon'];

    $u = mysqli_query($conn, "UPDATE dokter SET 
        Nama_Dokter='$nama', 
        Spesialis='$spesialis', 
        No_Telepon='$telp' 
        WHERE Id_Dokter='$id'");

    if ($u) {
        echo "<p style='color:green;'>✅ Data dokter berhasil diubah!</p>";
        echo "<meta http-equiv='refresh' content='1; url=dokter.php'>";
    } else {
        echo "<p style='color:red;'>❌ Gagal mengubah data dokter.</p>";
    }
}
?>