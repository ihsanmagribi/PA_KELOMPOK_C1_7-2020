<?php 
 
require 'koneksi.php'; 
session_start();
 
if (!isset($_SESSION['username'])) {
    header("Location: LOG-IN.php");}
 
    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>HOTEL XXVIII - Landing</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="CSS/user-menu2.css">
        <script src="https://kit.fontawesome.com/dbed6b6114.js" crossorigin="anonymous"></script>
        <link rel = "icon" href = "https://www.pngarts.com/files/4/Hotel-PNG-Image-Background.png" type = "image/png">
    </head>
    <body>
        
        <!-- header -->
        <header class = "header" id = "header">
            <div class = "head-top">
                <div class = "site-name">
                    <span>HOTEL XXVIII</span>
                </div>
                <div class = "site-nav">
                    <span id = "nav-btn">MENU <i class = "fas fa-bars"></i></span>
                </div>
            </div>

            <div class = "head-bottom flex">
                <h2>Selamat Datang <?= $_SESSION['username'] ?></h2>
                <p>Selamat datang di Hotel XXVIII, Aplikasi reservasi hotel terbaik di Indonesia. Semoga Dapat memenuhi kebutuhan anda dalam melakukan Reservasi ^_^</p>
                <a type="button" class = "head-btn" href="user-menu.php">Lihat Hotel</a>
            </div>
        </header>
        <!-- end of header -->

        <!-- side navbar -->
        <div class = "sidenav" id = "sidenav">
            <span class = "cancel-btn" id = "cancel-btn">
                <i class = "fas fa-times"></i>
            </span>
            <ul class = "navbar">
                <li><a href = "user-final.php">Riwayat Anda</a></li>
                <li><a href = "user-menu.php">Hotel</a></li>
                <li><a href = "user-feed.php">Feed Back</a></li>
                <li><a href = "user-akun.php">Akun : <?=$_SESSION['username']; ?></a></li>
            </ul>
            <a type="button" class = "btn log-in" href="LOG-OUT.php" onClick="return confirm ('Yakin?')">Logout</a>
        </div>
        <!-- end of side navbar -->

        <!-- fullscreen modal -->
        <div id = "modal"></div>
        <!-- end of fullscreen modal -->
        <script src="JS/script.js"></script>
    </body>
</html>


