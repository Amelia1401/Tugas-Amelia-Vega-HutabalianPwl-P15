<?php
// index.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard RS XYZ</title>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jQuery UI for Datepicker -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        header {
            background: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: 30px auto;
            background: white;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        h1 {
            margin-top: 0;
        }
        .menu {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 30px;
        }
        .menu a {
            text-decoration: none;
            background: #007bff;
            color: white;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            transition: background 0.3s ease, transform 0.2s ease;
        }
        .menu a:hover {
            background: #0056b3;
        }
        .datepicker-form {
            margin-top: 40px;
            text-align: center;
        }
        .datepicker-form input {
            padding: 8px;
            width: 200px;
            font-size: 16px;
        }
        .web-created {
            text-align: center;
            margin-top: 30px;
            font-style: italic;
            color: #555;
        }
        footer {
            text-align: center;
            padding: 15px;
            background: #f2f2f2;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <header>
        <h1>Selamat Datang di Sistem Informasi RS XYZ</h1>
    </header>
    <div class="container">
        <p>Silakan pilih menu di bawah ini untuk mengelola data rumah sakit.</p>
        <div class="menu">
            <a href="pasien.php">🧑‍⚕️ Data Pasien</a>
            <a href="dokter.php">👨‍⚕️ Data Dokter</a>
            <a href="rekammedik.php">📋 Rekam Medis</a>
        </div>


        <div class="web-created" id="tanggalPembuatan">
            <!-- Tanggal pembuatan akan muncul di sini -->
        </div>
    </div>
    <footer>
        &copy; 2025 RS XYZ. Sistem Informasi Rumah Sakit.
    </footer>

    <script>
    $(document).ready(function(){
        // Efek hover pada menu
        $(".menu a").hover(
            function() {
                $(this).css("transform", "scale(1.05)");
            },
            function() {
                $(this).css("transform", "scale(1)");
            }
        );

        // Aktifkan datepicker
        $("#tanggal").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
            yearRange: "2000:2030"
        });

        // Tampilkan tanggal pembuatan web ini (hardcoded atau bisa pakai tanggal hari ini)
        let tanggalPembuatan = "01 Juli 2025"; // Ganti sesuai tanggal asli
        $("#tanggalPembuatan").html("📅 Website ini dibuat pada: <strong>" + tanggalPembuatan + "</strong>");
    });
    </script>
</body>
</html>