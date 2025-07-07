<?php
include "koneksi.php";

// Proses Hapus Pasien
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $hapus = mysqli_query($conn, "DELETE FROM pasien WHERE Id_Pasien='$id'");
    if ($hapus) {
        echo "<p style='color:green;'>✅ Data berhasil dihapus!</p>";
    } else {
        echo "<p style='color:red;'>❌ Gagal menghapus data!</p>";
    }
}
?>

<h3>Data Pasien</h3>
<input type="text" id="searchPasien" placeholder="Cari pasien..." style="padding:5px; width:250px;">
<br><br>

<table border='1' cellpadding='5' id="tabelPasien" style='border-collapse:collapse; width:100%; text-align:center;'>
  <thead>
    <tr style='background:#e0e0e0;'>
        <th>Id Pasien</th>
        <th>Nama Pasien</th>
        <th>Tanggal Lahir</th>
        <th>Jenis Kelamin</th>
        <th>Alamat</th>
        <th>No Telepon</th>
        <th>Aksi</th>
    </tr>
  </thead>
  <tbody id="dataPasien">
    <!-- Isi data akan ditampilkan melalui AJAX -->
  </tbody>
</table>

<br><br>

<h3 id="tambah">Form Tambah Pasien</h3>
<form id="formPasien" style="width:300px;">
  <div style="margin-bottom:10px;">
    <label for="tid_pasien">Id Pasien :</label><br>
    <input type="text" name="tid_pasien" id="tid_pasien" required style="width:100%;" />
  </div>
  <div style="margin-bottom:10px;">
    <label for="tnama_pasien">Nama Pasien :</label><br>
    <input type="text" name="tnama_pasien" id="tnama_pasien" required style="width:100%;" />
  </div>
  <div style="margin-bottom:10px;">
    <label for="ttanggallahir">Tanggal Lahir :</label><br>
    <input type="date" name="ttanggallahir" id="ttanggallahir" style="width:100%;" />
  </div>
  <div style="margin-bottom:10px;">
    <label for="tjeniskelamin">Jenis Kelamin :</label><br>
    <select name="tjeniskelamin" id="tjeniskelamin" style="width:100%;">
      <option value="L">Laki-laki</option>
      <option value="P">Perempuan</option>
    </select>
  </div>
  <div style="margin-bottom:10px;">
    <label for="talamat">Alamat :</label><br>
    <input type="text" name="talamat" id="talamat" style="width:100%;" />
  </div>
  <div style="margin-bottom:10px;">
    <label for="tnotelepon">No Telepon :</label><br>
    <input type="text" name="tnotelepon" id="tnotelepon" style="width:100%;" />
  </div>
  <button type="submit" style="width:100%; padding: 6px;">Simpan</button>
</form>

<div id="pesan"></div>

<!-- Tanggal Pembuatan -->
<hr>
<p id="tanggalPembuatan" style="text-align:center; color:gray; font-size:14px;"></p>

<!-- jQuery + AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  // Menampilkan data saat pertama dibuka
  function loadPasien(keyword = '') {
    $.ajax({
      url: 'proses_cari_pasien.php',
      type: 'POST',
      data: { keyword: keyword },
      success: function(data) {
        $('#dataPasien').html(data);
      }
    });
  }

  loadPasien(); // load semua data pertama kali

  // Tambah Pasien via AJAX
  $('#formPasien').submit(function(e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: 'proses_simpan_pasien.php',
      data: $(this).serialize(),
      success: function(res) {
        $('#pesan').html(res);
        $('#formPasien')[0].reset();
        loadPasien(); // reload data
      },
      error: function(xhr) {
        $('#pesan').html('<p style="color:red;">❌ Gagal: ' + xhr.status + ' - ' + xhr.statusText + '</p>');
      }
    });
  });

  // Pencarian Pasien via AJAX
  $('#searchPasien').on('keyup', function() {
    const q = $(this).val();
    loadPasien(q);
  });

  // Tampilkan tanggal pembuatan
  $(document).ready(function() {
    const tanggalPembuatan = new Date('2025-07-01'); // Ganti jika tanggal pembuatan berbeda
    const opsiFormat = { year: 'numeric', month: 'long', day: 'numeric' };
    const teksTanggal = tanggalPembuatan.toLocaleDateString('id-ID', opsiFormat);
    $('#tanggalPembuatan').html('📅 Website ini dibuat pada: ' + teksTanggal);
  });
</script>