<?php
include "koneksi.php";

// Proses Hapus Dokter
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $hapus = mysqli_query($conn, "DELETE FROM dokter WHERE Id_Dokter='$id'");
    if ($hapus) {
        echo "<p style='color:green;'>✅ Data berhasil dihapus!</p>";
    } else {
        echo "<p style='color:red;'>❌ Gagal menghapus data!</p>";
    }
}
?>

<h3>Data Dokter</h3>
<input type="text" id="searchDokter" placeholder="Cari dokter..." style="padding:5px; width:250px;">
<br><br>

<table border='1' cellpadding='5' id="tabelDokter" style='border-collapse:collapse; width:100%; text-align:center;'>
  <thead>
    <tr style='background:#e0e0e0;'>
        <th>Id Dokter</th>
        <th>Nama Dokter</th>
        <th>Spesialis</th>
        <th>No Telepon</th>
        <th>Aksi</th>
    </tr>
  </thead>
  <tbody id="dataDokter">
    <!-- Data akan muncul dari AJAX -->
  </tbody>
</table>

<br><br>

<h3 id="tambah">Form Tambah Dokter</h3>
<form id="formDokter" style="width:300px;">
  <div style="margin-bottom:10px;">
    <label for="tid_dokter">Id Dokter :</label><br>
    <input type="text" name="tid_dokter" id="tid_dokter" required style="width:100%;" />
  </div>
  <div style="margin-bottom:10px;">
    <label for="tnama_dokter">Nama Dokter :</label><br>
    <input type="text" name="tnama_dokter" id="tnama_dokter" required style="width:100%;" />
  </div>
  <div style="margin-bottom:10px;">
    <label for="tspesialis">Spesialis :</label><br>
    <input type="text" name="tspesialis" id="tspesialis" style="width:100%;" />
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

<!-- jQuery & AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  // Menampilkan data dokter saat pertama kali
  function loadDokter(keyword = '') {
    $.ajax({
      url: 'proses_cari_dokter.php',
      type: 'POST',
      data: { keyword: keyword },
      success: function(data) {
        $('#dataDokter').html(data);
      }
    });
  }

  loadDokter(); // Load awal

  // Simpan dokter
  $('#formDokter').submit(function(e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: 'proses_simpan_dokter.php',
      data: $(this).serialize(),
      success: function(res) {
        $('#pesan').html(res);
        $('#formDokter')[0].reset();
        loadDokter(); // refresh data
      },
      error: function(xhr) {
        $('#pesan').html('<p style="color:red;">❌ Gagal: ' + xhr.status + ' - ' + xhr.statusText + '</p>');
      }
    });
  });

  // Pencarian dokter
  $('#searchDokter').on('keyup', function() {
    const q = $(this).val();
    loadDokter(q);
  });

  // Tampilkan tanggal pembuatan
  $(document).ready(function() {
    const tanggalPembuatan = new Date('2025-07-01'); // Ganti jika berbeda
    const opsiFormat = { year: 'numeric', month: 'long', day: 'numeric' };
    const teksTanggal = tanggalPembuatan.toLocaleDateString('id-ID', opsiFormat);
    $('#tanggalPembuatan').html('📅 Website ini dibuat pada: ' + teksTanggal);
  });
</script>