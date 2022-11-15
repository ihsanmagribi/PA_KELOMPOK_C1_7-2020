<?php
require 'koneksi.php';
session_start();
if (isset($_POST['kirim'])) {
    $ID              = htmlspecialchars($_POST['ID']);
    $Nama            = htmlspecialchars($_POST['Nama']);
    $Lokasi          = htmlspecialchars($_POST['Lokasi']);
    $Telepon         = htmlspecialchars($_POST['Telepon']);
    
    $insert_sql = "INSERT INTO hotel VALUES ('$ID','$Nama','$Lokasi',0,'$Telepon')";
    $result = mysqli_query($conn, $insert_sql);
    if ($result) {
        echo "<script>
            alert('Data berhasil ditambahkan!');
            document.location.href = 'Admin-Hotel.php';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal ditambahkan!');
            document.location.href = 'CREATE-Hotel.php';
        </script>";
    }
}


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="CSS/style2.css">
 
    <title>Create Hotel</title>
</head>
<body>
    <div class="container">
        <form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800; color:white;">Tambah Hotel</p>
            <p style="transform: translateX(22px);">ID Hotel</p>
            <div class="input-group">
                <input type="text"     placeholder="Masukan ID Hotel....." name="ID" required>
            </div>
            <p style="transform: translateX(22px);">Nama Hotel</p>
            <div class="input-group">
                <input type="text"     placeholder="Masukan Nama Hotel..." name="Nama" required>
            </div>
            <p style="transform: translateX(22px);">Lokasi Hotel</p>
            <div class="input-group">
                <input type="text"    placeholder="Masukan Lokasi Hotel.." name="Lokasi" required>
            </div>
            <p style="transform: translateX(22px);">No Telepon</p>
            <div class="input-group">
                <input type="Text" placeholder="Masukan No Telepon..." name="Telepon" required>
            </div>
            <div class="input-group">
                <button name="kirim" class="btn">CREATE</button>
            </div>
        </form>
    </div>
</body>
</html>