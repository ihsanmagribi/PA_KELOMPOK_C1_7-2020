<?php
require 'koneksi.php';
session_start();

$ID = $_GET["ID"];
$select_sql = "SELECT * FROM kamar WHERE ID ='$ID'";
$result = mysqli_query($conn, $select_sql);

$KTP = [];

while ($row = mysqli_fetch_assoc($result)) {
    $KTP[] = $row;
}
$KTP = $KTP[0];



$Nama_Kamar = $KTP['ID_Hotel'];

$delete_sql3 = "SELECT Nama FROM hotel WHERE ID = '$Nama_Kamar'";
$RE = mysqli_query($conn, $delete_sql3);
$KTP2 = [];
while ($row = mysqli_fetch_assoc($RE)) {
    $KTP2[] = $row;}
$KTP2 = $KTP2[0];
$Nama_Kamar = $KTP2['Nama'];




if (isset($_POST["kirim"])) {
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
    $update_sql = "UPDATE kamar SET
                   Lantai='$Lantai',
                   Jenis='$Jenis',
                   STT='$STT',
                   Harga='$Harga'
                   WHERE ID ='$ID'";

    $result = mysqli_query($conn, $update_sql);

    if ($result) {
        echo "<script>
            alert('Data berhasil diupdate!');
            document.location.href = 'Admin-Kamar.php?Nama=$Nama_Kamar';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal diupdate!');
            document.location.href = 'Admin-Kamar.php?Nama=$Nama_Kamar';
        </script>";
    }}
?>

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
            <p class="login-text" style="font-size: 2rem; font-weight: 800; color:white;">Ubah Kamar</p>
            <p style="transform: translateX(22px);">ID Kamar</p>
            <div class="input-group">
                <input type="text"     placeholder="Masukan ID Hotel....."  name="ID" value="<?= $KTP["ID"]?>" readonly>
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
                <button name="kirim" class="btn">UPDATE</button>
            </div>
        </form>
    </div>
</body>
</html>