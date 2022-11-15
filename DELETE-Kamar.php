<?php
session_start();
require 'koneksi.php';

$ID = $_GET["ID"];

$delete_sql2 = "SELECT ID_Hotel FROM kamar WHERE ID = '$ID'";
$RE = mysqli_query($conn, $delete_sql2);
$KTP2 = [];
while ($row = mysqli_fetch_assoc($RE)) {
    $KTP2[] = $row;
}
$KTP2 = $KTP2[0];
$Nama_Kamar = $KTP2['ID_Hotel'];

$delete_sql3 = "SELECT Nama FROM hotel WHERE ID = '$Nama_Kamar'";
$RE = mysqli_query($conn, $delete_sql3);
$KTP = [];
while ($row = mysqli_fetch_assoc($RE)) {
    $KTP[] = $row;
}
$KTP = $KTP[0];
$Nama_Kamar = $KTP['Nama'];


$delete_sql = "DELETE FROM kamar WHERE ID = '$ID'";
$result = mysqli_query($conn, $delete_sql);

if ($result) {
    echo "<script>
        alert('Data berhasil dihapus!');
        document.location.href = 'Admin-Kamar.php?Nama=$Nama_Kamar';
    </script>";
} else {
    echo "<script>
        alert('Data gagal dihapus!');
        document.location.href = 'Admin-Kamar.php?Nama=$Nama_Kamar';
    </script>";
}