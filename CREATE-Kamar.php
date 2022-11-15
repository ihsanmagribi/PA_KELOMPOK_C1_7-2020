<?php
require 'koneksi.php';
session_start();
$Hotel = $_GET["Hotel"];
$Hotel_ID = "SELECT ID,Nama FROM hotel Where Nama = '$Hotel'";
$RE = mysqli_query($conn, $Hotel_ID);

$KTP2 = [];

while ($row = mysqli_fetch_assoc($RE)) {
    $KTP2[] = $row;
}

$KTP2 = $KTP2[0];

$Nama_Kamar = $KTP2['Nama'];

if (isset($_POST['kirim'])) {
    $ID              = htmlspecialchars($_POST['ID']);
    $ID_hotel        = $KTP2['ID'];
    $Lantai          = htmlspecialchars($_POST['Lantai']);
    $Jenis           = htmlspecialchars($_POST['Jenis']);
    $STT             = htmlspecialchars($_POST['STT']);
    if($Jenis=="Standard"){
        $Harga = 300000;
    }
    elseif($Jenis=="Superrior"){
        $Harga = 400000;
    }
    elseif($Jenis=="Deluxe"){
        $Harga = 450000;
    }
    elseif($Jenis=="Suite"){
        $Harga = 600000;
    }
    elseif($Jenis=="Presidential Suite"){
        $Harga = 1000000;
    }
    
    $insert_sql = "INSERT INTO kamar VALUES ('$ID','$ID_hotel','$Lantai','$Jenis',$Harga,'$STT')";
    $result = mysqli_query($conn, $insert_sql);

    if ($result) {
        echo "<script>
            alert('Data berhasil ditambahkan!');
            document.location.href = 'Admin-Kamar.php?Nama=$Nama_Kamar';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal ditambahkan!');
            document.location.href = 'CREATE-Kamar.php';
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
            <p class="login-text" style="font-size: 2rem; font-weight: 800; color:white;">Tambah Kamar</p>
            <p style="transform: translateX(22px);">ID Kamar</p>
            <div class="input-group">
                <input type="text"     placeholder="Masukan ID Hotel....." name="ID" required>
            </div>
            <p style="transform: translateX(22px);">Lantai Kamar</p>
            <div class="input-group">
                <select name="Lantai">
                    <option  value="1">1</option>
                    <option  value="2">2</option>
                    <option  value="3">3</option>
                    <option  value="4">4</option>
                    <option  value="5">5</option>
                </select>
            </div>
            <p style="transform: translateX(22px);">Jenis Kamar</p>
            <div class="input-group">
                <select name="Jenis">
                    <option  value="Standard">Standard</option>
                    <option  value="Superrior">Superrior</option>
                    <option  value="Deluxe">Deluxe</option>
                    <option  value="Suite">Suite</option>
                    <option  value="Presidential Suite">Presidential Suite</option>
                </select>
            </div>
            <p style="transform: translateX(22px);">Status Kamar</p>
            <div class="input-group">
                <select name="STT">
                    <option  value="Tersedia">Tersedia</option>
                    <option  value="Di Booking">Di Booking</option>
                </select>
            </div>
            <div class="input-group">
                <button name="kirim" class="btn">CREATE</button>
            </div>
        </form>
    </div>
</body>
</html>