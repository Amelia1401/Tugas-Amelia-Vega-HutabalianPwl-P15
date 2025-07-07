    <?php
include "koneksi.php";

$keyword = mysqli_real_escape_string($conn, $_POST['keyword']);

$sql = "SELECT * FROM pasien 
        WHERE Id_Pasien LIKE '%$keyword%' 
        OR Nama_Pasien LIKE '%$keyword%' 
        OR Alamat LIKE '%$keyword%' 
        OR No_Telepon LIKE '%$keyword%'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($r = mysqli_fetch_assoc($result)) {
        echo "<tr>
            <td>{$r['Id_Pasien']}</td>
            <td>{$r['Nama_Pasien']}</td>
            <td>{$r['Tanggal_Lahir']}</td>
            <td>{$r['Jenis_Kelamin']}</td>
            <td>{$r['Alamat']}</td>
            <td>{$r['No_Telepon']}</td>
            <td>
                <a href='editpasien.php?id={$r['Id_Pasien']}'>✏️ Ubah</a> |
                <a href='pasien.php?hapus={$r['Id_Pasien']}' onclick=\"return confirm('Yakin hapus?')\">🗑️ Hapus</a>
            </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='7'>❌ Tidak ada data ditemukan.</td></tr>";
}
?>
