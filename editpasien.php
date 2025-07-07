<?php
include "koneksi.php";
$id = $_GET['id'];
$q = mysqli_query($conn, "SELECT * FROM pasien WHERE Id_Pasien='$id'");
$data = mysqli_fetch_assoc($q);
?>

<h3>Edit Data Pasien</h3>
<form method="POST" action="">
  <table>
    <tr>
      <td>Id Pasien</td>
      <td><input type="text" name="id_pasien" value="<?= $data['Id_Pasien'] ?>" readonly></td>
    </tr>
    <tr>
      <td>Nama Pasien</td>
      <td><input type="text" name="nama_pasien" value="<?= $data['Nama_Pasien'] ?>"></td>
    </tr>
    <tr>
      <td>Tanggal Lahir</td>
      <td><input type="date" name="tgl_lahir" value="<?= $data['Tanggal_Lahir'] ?>"></td>
    </tr>
    <tr>
      <td>Jenis Kelamin</td>
      <td>
        <select name="jenis_kelamin">
          <option value="L" <?= $data['Jenis_Kelamin'] == 'L' ? 'selected' : '' ?>>Laki-laki</option>
          <option value="P" <?= $data['Jenis_Kelamin'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
        </select>
      </td>
    </tr>
    <tr>
      <td>Alamat</td>
      <td><input type="text" name="alamat" value="<?= $data['Alamat'] ?>"></td>
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
if (isset($_POST['update'])) {
    $nama = $_POST['nama_pasien'];
    $tgl = $_POST['tgl_lahir'];
    $jk = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['no_telepon'];

    $u = mysqli_query($conn, "UPDATE pasien SET 
        Nama_Pasien='$nama', 
        Tanggal_Lahir='$tgl', 
        Jenis_Kelamin='$jk', 
        Alamat='$alamat', 
        No_Telepon='$telp' 
        WHERE Id_Pasien='$id'");

    if ($u) {
        echo "<p style='color:green;'>✅ Data berhasil diubah!</p>";
        echo "<meta http-equiv='refresh' content='1; url=pasien.php'>";
    } else {
        echo "<p style='color:red;'>❌ Gagal mengubah data.</p>";
    }
}
?>
