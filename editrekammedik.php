<?php
include "koneksi.php";

// Ambil data berdasarkan ID dari URL
$id = $_GET['id'];
$q = mysqli_query($conn, "SELECT * FROM rekammedik WHERE Id_Rekam='$id'");
$data = mysqli_fetch_assoc($q);
?>

<h3>Edit Data Rekam Medik</h3>
<form method="POST" action="">
  <table>
    <tr>
      <td>Id Rekam</td>
      <td><input type="text" name="id_rekam" value="<?= $data['Id_Rekam'] ?>" readonly></td>
    </tr>
    <tr>
      <td>Id Pasien</td>
      <td><input type="text" name="id_pasien" value="<?= $data['Id_Pasien'] ?>"></td>
    </tr>
    <tr>
      <td>Id Dokter</td>
      <td><input type="text" name="id_dokter" value="<?= $data['Id_Dokter'] ?>"></td>
    </tr>
    <tr>
      <td>Tanggal Kunjungan</td>
      <td><input type="date" name="tanggal" value="<?= $data['Tanggal_Kunjungan'] ?>"></td>
    </tr>
    <tr>
      <td>Keluhan</td>
      <td><input type="text" name="keluhan" value="<?= $data['Keluhan'] ?>"></td>
    </tr>
    <tr>
      <td>Diagnosa</td>
      <td><input type="text" name="diagnosa" value="<?= $data['Diagnosa'] ?>"></td>
    </tr>
    <tr>
      <td>Tindakan</td>
      <td><input type="text" name="tindakan" value="<?= $data['Tindakan'] ?>"></td>
    </tr>
    <tr>
      <td>Resep Obat</td>
      <td><input type="text" name="resep" value="<?= $data['Resep_Obat'] ?>"></td>
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
    $id_pasien = $_POST['id_pasien'];
    $id_dokter = $_POST['id_dokter'];
    $tanggal = $_POST['tanggal'];
    $keluhan = $_POST['keluhan'];
    $diagnosa = $_POST['diagnosa'];
    $tindakan = $_POST['tindakan'];
    $resep = $_POST['resep'];

    $u = mysqli_query($conn, "UPDATE rekammedik SET 
        Id_Pasien='$id_pasien', 
        Id_Dokter='$id_dokter', 
        Tanggal_Kunjungan='$tanggal',
        Keluhan='$keluhan',
        Diagnosa='$diagnosa',
        Tindakan='$tindakan',
        Resep_Obat='$resep'
        WHERE Id_Rekam='$id'");

    if ($u) {
        echo "<p style='color:green;'>✅ Data rekam medik berhasil diubah!</p>";
        echo "<meta http-equiv='refresh' content='1; url=rekammedik.php'>";
    } else {
        echo "<p style='color:red;'>❌ Gagal mengubah data rekam medik.</p>";
    }
}
?>
