<?php
include "koneksi.php";
$keyword = $_POST['keyword'] ?? '';
$q = "SELECT * FROM rekammedik WHERE 
        Id_Rekam LIKE '%$keyword%' OR 
        Id_Pasien LIKE '%$keyword%' OR 
        Id_Dokter LIKE '%$keyword%' OR 
        Keluhan LIKE '%$keyword%' OR 
        Diagnosa LIKE '%$keyword%'";
$res = mysqli_query($conn, $q);

while ($r = mysqli_fetch_assoc($res)) {
    echo "<tr>";
    echo "<td>".$r['Id_Rekam']."</td>";
    echo "<td>".$r['Id_Pasien']."</td>";
    echo "<td>".$r['Id_Dokter']."</td>";
    echo "<td>".$r['Tanggal_Kunjungan']."</td>";
    echo "<td>".$r['Keluhan']."</td>";
    echo "<td>".$r['Diagnosa']."</td>";
    echo "<td>".$r['Tindakan']."</td>";
    echo "<td>".$r['Resep_Obat']."</td>";
    echo "<td>
            <a href='editrekammedik.php?id=".$r['Id_Rekam']."'>✏️ Ubah</a> |
            <a href='rekammedik.php?hapus=".$r['Id_Rekam']."' onclick=\"return confirm('Yakin hapus?')\">🗑️ Hapus</a>
          </td>";
    echo "</tr>";
}
?>