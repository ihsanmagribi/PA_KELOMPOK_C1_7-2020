<?php 
 
require 'koneksi.php'; 
session_start();
 
if (!isset($_SESSION['username'])) {
    header("Location: LOG-IN.php");}
 
    $select_sql = "SELECT *FROM hotel";



if( isset($_POST["cari"])){
    $nama_dicari = $_POST["keyword"];
    $select_sql = "SELECT *FROM hotel WHERE Nama         LIKE '%$nama_dicari%' OR
                                            Lokasi       LIKE '%$nama_dicari%' OR
                                            Jumlah_kamar LIKE '%$nama_dicari%'";
}

if( isset($_POST["urut"])){
    
    if($_POST["salahuddin"] == "Askending"){
        $select_sql = "SELECT *FROM hotel ORDER BY Nama ASC";}
    else{
        $select_sql = "SELECT *FROM hotel ORDER BY Nama DESC";}
}


$result = mysqli_query($conn, $select_sql);

if (!$result) {
    echo mysqli_error($conn);
}

$penduduk = [];

while ($row = mysqli_fetch_assoc($result)) {
    $penduduk[] = $row;
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>HOTEL XXVIII - Hotel</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="CSS/user-menu2.css">
        <script src="https://kit.fontawesome.com/dbed6b6114.js" crossorigin="anonymous"></script>
        <link rel = "icon" href = "images/logo.png" type = "image/png">
    </head>
    <body>
        <nav>
            <div class = "head-top">
                <div class = "site-name">
                    <span><a href = "user.php">HOTEL XXVIII</a></span>
                </div>
                <div class = "site-nav">
                    <span id = "nav-btn">MENU <i class = "fas fa-bars"></i></span>
                </div>
            </div>
        </nav>
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

        <!-- body content  -->
        <section class = "services sec-width" id = "services">
            <div class = "title">
                <h2>Pelayanan Utama</h2>
            </div>
            <div class = "services-container">
                <!-- single service -->
                <article class = "service">
                    <div class = "service-icon">
                        <span>
                            <i class = "fas fa-utensils"></i>
                        </span>
                    </div>
                    <div class = "service-content">
                        <h2>Pelayanan Makanan</h2>
                        <p>Menyediakan makanan dan minuman yang didapatkan gratis jika telah memesan hotel di semua kategori. Costumer akan mendapatkan pelayanan makanan sehari 3 kali yaitu pada pukul 08:00, 14:00, dan 20:00. Jenis makanan ada yang cepat saji maupun tipe lain yang akan di tampilakan di menu makanan</p>
                        <button type = "button" class = "btn">Detail</button>
                    </div>
                </article>
                <!-- end of single service -->
                <!-- single service -->
                <article class = "service">
                    <div class = "service-icon">
                        <span>
                            <i class = "fas fa-swimming-pool"></i>
                        </span>
                    </div>
                    <div class = "service-content">
                        <h2>Kolam Segar</h2>
                        <p>Kalau Anda juga punya hobi berenang, Hotel kami memiliki fasilitas kolam renang yang menarik. Fasilitas eksklusif yang disediakan sangat mendukung untuk aktivitas santai karena mengusung konsep lingkungan hijau yang asri. Ada juga kolam khusus untuk anak-anak yang mau berenang, atau bermain air.</p>
                        <button type = "button" class = "btn">Detail</button>
                    </div>
                </article>
                <!-- end of single service -->
                <!-- single service -->
                <article class = "service">
                    <div class = "service-icon">
                        <span>
                            <i class = "fas fa-broom"></i>
                        </span>
                    </div>
                    <div class = "service-content">
                        <h2>Fasilitas Kamar</h2>
                        <p>Fasilitas yang di sediakan kamar tergnatung dari jenis kamar yang di pesan. adapun jenis kamar yang di sediakan di setiap hotel ialah Standar Room, Deluxe Room, Superior Room, Suite room, Suite Presidensial Room. Anda Dapat Melihatnya secara keseluruhan dengan menekan tombol Detail dsi bawah ini </p>
                        <button type = "button" class = "btn">Detail</button>
                    </div>
                </article>
                <!-- end of single service -->
            </div>
        </section>


        <section class = "rooms sec-width" id = "rooms">
            <div class = "title">
                <h2>Daftar Hotel</h2>
            </div>
            <div class = "rooms-container">


            <?php $poto = 1; ?>
                <?php foreach ($penduduk as $KTP) : ?>
                    <!-- Hotel -->
                    <?php if($KTP["Jumlah_Kamar"] == 0){continue;} ?>
                    <article class = "room">
                        <div class = "room-image">
                            <?php $BG = "isi hotel/hotel".$poto.".jpg"; ?><!-- Jika Kamar kosong, hotel tidak ditampilkan -->
                            <img src = "<?=$BG?>" alt = "room image">
                        </div>
                        <div class = "room-text">
                            <h3><?= $KTP["Nama"] ?></h3>
                            <ul>
                                <li>
                                    <i class = "fas fa-arrow-alt-circle-right"></i>
                                    Alamat : <?= $KTP["Lokasi"] ?>
                                </li>
                                <li>
                                    <i class = "fas fa-arrow-alt-circle-right"></i>
                                    CS : <?= $KTP["Telepon"] ?>
                                </li>
                                <li>
                                    <i class = "fas fa-arrow-alt-circle-right"></i>
                                    Memiliki <?= $KTP["Jumlah_Kamar"] ?> Jumlah Kamar
                                </li>
                            </ul>                            
                            <a href="user-kamar.php?Nama=<?=$KTP["Nama"];?>&BG=<?=$BG?>"><button type = "button" class = "btn">Lihat Hotel</button></a>
                        </div>
                    </article>
                    <?php $poto++; ?>
                    <!-- end Hotel -->
                <?php endforeach; ?>    


            </div>
        </section>
        <!-- end of body content -->
        <!-- footer -->
        <footer class = "footer">
            <div class = "footer-container">
                <div>
                    <h2>About Us </h2>
                    <p>Hotel XXVII adalah ditus yang melayani resevasi hotel yang berlokasi di samarinda, situs ini sangat membantu Anda mencari tempat penginapan.</p>
                    <ul class = "social-icons">
                        <li class = "flex">
                            <i class = "fa fa-twitter fa-2x"></i>
                        </li>
                        <li class = "flex">
                            <i class = "fa fa-facebook fa-2x"></i>
                        </li>
                        <li class = "flex">
                            <i class = "fa fa-instagram fa-2x"></i>
                        </li>
                    </ul>
                </div>

                <div>
                    <h2>Useful Links</h2>
                    <a href = "#">Blog</a>
                    <a href = "#">Rooms</a>
                    <a href = "#">Subscription</a>
                    <a href = "#">Gift Card</a>
                </div>

                <div>
                    <h2>Privacy</h2>
                    <a href = "#">Visi & Misi</a>
                    <a href = "#">Tentang Kami</a>
                    <a href = "#">Kontak</a>
                    <a href = "#">Servis</a>
                </div>

                <div>
                    <h2>Kritik & Saran</h2>
                    <div class = "contact-item">
                        <span>
                            <i class = "fas fa-map-marker-alt"></i>
                        </span>
                        <span>
                            Jalan Pramuka IV, Samarinda
                        </span>
                    </div>
                    <div class = "contact-item">
                        <span>
                            <i class = "fas fa-phone-alt"></i>
                        </span>
                        <span>
                            +6282243809090
                        </span>
                    </div>
                    <div class = "contact-item">
                        <span>
                            <i class = "fas fa-envelope"></i>
                        </span>
                        <span>
                            hotel.xxviii@gmail.com
                        </span>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end of footer -->
        
        <script src="JS/script.js"></script>
    </body>
</html>