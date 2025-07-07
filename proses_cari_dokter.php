<?php
include "koneksi.php";

$keyword = $_POST['keyword'] ?? '';
$q = "SELECT * FROM dokter WHERE 
      Id_Dokter LIKE '%$keyword%' OR 
      Nama_Dokter LIKE '%$keyword%' OR 
      Spesialis LIKE '%$keyword%' OR 
      No_Telepon LIKE '%$keyword%'";

$res = mysqli_query($conn, $q);
while ($r = mysqli_fetch_assoc($res)) {
    echo "<tr>";
    echo "<td>".$r['Id_Dokter']."</td>";
    echo "<td>".$r['Nama_Dokter']."</td>";
    echo "<td>".$r['Spesialis']."</td>";
    echo "<td>".$r['No_Telepon']."</td>";
    echo "<td>
            <a href='editdokter.php?id=".$r['Id_Dokter']."'>✏️ Ubah</a> |
            <a href='dokter.php?hapus=".$r['Id_Dokter']."' onclick=\"return confirm('Yakin hapus?')\">🗑️ Hapus</a>
          </td>";
    echo "</tr>";
}
?>
