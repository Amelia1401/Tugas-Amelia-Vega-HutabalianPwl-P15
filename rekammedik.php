<?php
include "koneksi.php";

// Proses Hapus Rekam Medik
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $hapus = mysqli_query($conn, "DELETE FROM rekammedik WHERE Id_Rekam='$id'");
    if ($hapus) {
        echo "<p style='color:green;'>✅ Data berhasil dihapus!</p>";
    } else {
        echo "<p style='color:red;'>❌ Gagal menghapus data!</p>";
    }
}
?>

<h3>Data Rekam Medik</h3>
<input type="text" id="searchRekam" placeholder="Cari rekam medik..." style="padding:5px; width:250px;">
<br><br>

<table border='1' cellpadding='5' id="tabelRekam" style='border-collapse:collapse; width:100%; text-align:center;'>
  <thead>
    <tr style='background:#e0e0e0;'>
        <th>Id Rekam</th>
        <th>Id Pasien</th>
        <th>Id Dokter</th>
        <th>Tanggal Kunjungan</th>
        <th>Keluhan</th>
        <th>Diagnosa</th>
        <th>Tindakan</th>
        <th>Resep Obat</th>
        <th>Aksi</th>
    </tr>
  </thead>
  <tbody id="dataRekam">
    <!-- Data ditampilkan via AJAX -->
  </tbody>
</table>

<br><br>

<h3 id="tambah">Form Tambah Rekam Medik</h3>
<form id="formRekam" style="width:350px;">
<?php
$fields = [
  ['id_rekam', 'Id Rekam'], ['id_pasien', 'Id Pasien'], ['id_dokter', 'Id Dokter'],
  ['tanggal', 'Tanggal Kunjungan'], ['keluhan', 'Keluhan'],
  ['diagnosa', 'Diagnosa'], ['tindakan', 'Tindakan'], ['resep', 'Resep Obat']
];
foreach ($fields as $f) {
  $type = ($f[0] === 'tanggal') ? 'text' : 'text';
  $extra = ($f[0] === 'tanggal') ? "placeholder='yyyy-mm-dd'" : "";
  echo "<div style='margin-bottom:10px;'>
          <label for='{$f[0]}'>{$f[1]} :</label><br>
          <input type='{$type}' name='{$f[0]}' id='{$f[0]}' style='width:100%;' {$extra} required />
        </div>";
}
?>
  <button type="submit" style="width:100%; padding: 6px;">Simpan</button>
</form>

<div id="pesan"></div>

<!-- Tanggal Pembuatan -->
<hr>
<p id="tanggalPembuatan" style="text-align:center; color:gray; font-size:14px;"></p>

<!-- jQuery dan jQuery UI -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<script>
  function loadRekam(keyword = '') {
    $.ajax({
      url: 'proses_cari_rekam.php',
      type: 'POST',
      data: { keyword: keyword },
      success: function(data) {
        $('#dataRekam').html(data);
      }
    });
  }

  loadRekam();

  $('#formRekam').submit(function(e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: 'proses_simpan_rekam.php',
      data: $(this).serialize(),
      success: function(res) {
        $('#pesan').html(res);
        $('#formRekam')[0].reset();
        loadRekam();
      },
      error: function(xhr) {
        $('#pesan').html('<p style="color:red;">❌ Gagal: ' + xhr.status + ' - ' + xhr.statusText + '</p>');
      }
    });
  });

  $('#searchRekam').on('keyup', function() {
    const q = $(this).val();
    loadRekam(q);
  });

  // Aktifkan jQuery UI Datepicker untuk input tanggal
  $(function() {
    $("#tanggal").datepicker({
      dateFormat: "yy-mm-dd",
      changeMonth: true,
      changeYear: true,
      yearRange: "2000:2035"
    });
  });

  // Tampilkan tanggal pembuatan
  $(document).ready(function() {
    const tanggalPembuatan = new Date('2025-07-01'); // Ganti sesuai kebutuhan
    const opsiFormat = { year: 'numeric', month: 'long', day: 'numeric' };
    const teksTanggal = tanggalPembuatan.toLocaleDateString('id-ID', opsiFormat);
    $('#tanggalPembuatan').html('📅 Website ini dibuat pada: ' + teksTanggal);
  });
</script>