<?php 
 
require 'koneksi.php'; 

$NIK = $_GET["Nama"];
$BG = $_GET["BG"];

session_start();
 
if (!isset($_SESSION['username'])) {
    header("Location: LOG-IN.php");}
 
$select_sql = " SELECT kamar.ID,Lantai,Jenis,Harga,hotel.Nama AS Hotel,STT FROM kamar
                INNER JOIN hotel
                ON ID_Hotel = hotel.ID
                Where Nama='$NIK';";


if( isset($_POST["cari"])){
    $nama_dicari = $_POST["keyword"];
    $select_sql = "SELECT kamar.ID,Lantai,Jenis,Harga,hotel.Nama AS Hotel,STT FROM kamar
                   INNER JOIN hotel
                   ON ID_Hotel = hotel.ID
                   Where Nama='$NIK'
                   and (Lantai LIKE '%$nama_dicari%' OR
                        Jenis  LIKE '%$nama_dicari%' OR
                        Harga  LIKE '%$nama_dicari%' OR
                        STT    LIKE '%$nama_dicari%')";}

if( isset($_POST["urut"])){
    
    if($_POST["salahuddin"] == "Askending"){
        $select_sql = "SELECT kamar.ID,Lantai,Jenis,Harga,hotel.Nama AS Hotel,STT FROM kamar
                       INNER JOIN hotel
                       ON ID_Hotel = hotel.ID
                       Where Nama='$NIK'
                       ORDER BY Jenis ASC";}



    elseif($_POST["salahuddin"] == "Deskending"){
        $select_sql = "SELECT kamar.ID,Lantai,Jenis,Harga,hotel.Nama AS Hotel,STT FROM kamar
                       INNER JOIN hotel
                       ON ID_Hotel = hotel.ID
                       Where Nama='$NIK'
                       ORDER BY Jenis DESC";}

    elseif($_POST["salahuddin"] == "Tersedia"){
        $select_sql = " SELECT kamar.ID,Lantai,Jenis,Harga,hotel.Nama AS Hotel,STT FROM kamar
        INNER JOIN hotel
        ON ID_Hotel = hotel.ID
        Where Nama='$NIK' AND
              STT ='Tersedia';";}

    elseif($_POST["salahuddin"] == "Diboking"){
        $select_sql = " SELECT kamar.ID,Lantai,Jenis,Harga,hotel.Nama AS Hotel,STT FROM kamar
        INNER JOIN hotel
        ON ID_Hotel = hotel.ID
        Where Nama='$NIK' AND
              STT ='Di Booking';";}

    else{
        $select_sql = " SELECT kamar.ID,Lantai,Jenis,Harga,hotel.Nama AS Hotel,STT FROM kamar
        INNER JOIN hotel
        ON ID_Hotel = hotel.ID
        Where Nama='$NIK';";}
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
        <title>HOTEL XXVIII - Kamar</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="CSS/user-menu2.css">
        <script src="https://kit.fontawesome.com/dbed6b6114.js" crossorigin="anonymous"></script>
        <link rel = "icon" href = "images/logo.png" type = "image/png">
    </head>
    <body>
        <nav>
            <div class = "head-top">
                <div class = "site-name">
                    <span>HOTEL XXVIII</span>
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

        <div class = "book">
            <form class = "book-form" ACTION="" METHOD="POST">
                <div class = "form-item">
                    <label style="margin-buttom:0px;padding-buttom:0px;" for = "checkout-date">Cari kamar</label>
                    <input name="keyword" style="margin:0;" type="text">
                    <button style="height:25px;" type="submit" name="cari"><i class="fas fa-search"></i>Cari</button>
                </div>
                <div class = "form-item">
                    <label style="margin-buttom:0px;padding-buttom:0px;" for = "checkout-date">Format Tampilan </label>
                    <select style="height:45px;margin-top:0px;padding-top:0px;" name="salahuddin" class="create">
                        <option nama="jenisSort" value="Semua"     >Tampilkan Semua</option>
                        <option nama="jenisSort" value="Askending" >Askending</option>
                        <option nama="jenisSort" value="Deskending">Deskending</option>
                        <option nama="jenisSort" value="Tersedia"  >Status Tersedia</option>
                        <option nama="jenisSort" value="Diboking"  >Status Diboking</option>

                    </select>
                    <button style="height:25px;" type="submit" name="urut"><i class="fas fa-sort"></i>Sort</button>
                </div>
            </form>
        </div>
        <section class = "rooms sec-width" id = "rooms">
            <div class = "title">
                <h2>Daftar kamar <?=$penduduk[0]["Hotel"] ?></h2>
            </div>
            <div class = "rooms-container">
            <?php $deluxe = 1; ?>
            <?php $presidential = 1; ?>
            <?php $superior = 1; ?>
            <?php $standard = 1; ?>
            <?php $suite = 1; ?>
                <?php foreach ($penduduk as $KTP) : ?>
                    <!-- single room -->
                    <article class = "room">
                        <div class = "room-image">
                            <?php if ($KTP["Jenis"] == "Standard") : ?>
                                <?php $PT = "isi hotel/STANDARD/s".$standard.".jpg"; ?>
                                <img src = "<?=$PT?>" alt = "room image">
                                <?php $standard++; ?>

                                
                            <?php elseif ($KTP["Jenis"] == "Superior") : ?>
                                <?php $PT = "isi hotel/SUPERIOR/su".$Superior.".jpg"; ?>
                                <img src  = "<?=$PT?>" alt = "room image">
                                <?php $Superior++; ?>

                                
                            <?php elseif ($KTP["Jenis"] == "Deluxe") : ?>
                                <?php $PT = "isi hotel/DELUXE/d".$deluxe.".jpg"; ?>
                                <img src  = "<?=$PT?>" alt = "room image">
                                <?php $deluxe++; ?>

                                
                            <?php elseif ($KTP["Jenis"] == "Suite") : ?>
                                <?php $PT = "isi hotel/SUITE/su".$suite.".jpg"; ?>
                                <img src  = "<?=$PT?>" alt = "room image">
                                <?php $suite++; ?>

                                
                            <?php else : ?> 
                                <?php $PT = "isi hotel/PRESIDENTIAL/p".$presidential.".jpg"; ?>
                                <img src  = "<?=$PT?>" alt = "room image">
                                <?php $presidential++; ?>

                                
                            <?php endif; ?>  
                        
                            
                        </div>
                        <div class = "room-text">
                            <h3><?= $KTP["Jenis"] ?></h3>
                            <ul>
                                <li class="statuss">
                                    <i class = "fas fa-arrow-alt-circle-right"></i>
                                    <p> Posisi : Lantai <?= $KTP["Lantai"] ?></p>
                                </li>
                                <li class="statuss">
                                    <i class = "fas fa-arrow-alt-circle-right"></i>
                                    <?php if ($KTP["STT"] == "Tersedia") : ?>
                                        <p style="color:#17fc03;"> Status : <?= $KTP["STT"] ?></p>
                                    <?php else : ?> 
                                        <p style="color:#ff2929;"> Status : <?= $KTP["STT"] ?></p>
                                    <?php endif; ?>  
                                </li>
                            </ul>
                            <p class = "rate">
                                <span>RP <?= $KTP["Harga"] ?> /</span> Malam
                            </p>

                            <?php if ($KTP["STT"] == "Tersedia") : ?>
                                <a href="user-cekin.php?ID=<?=$KTP["ID"];?>&BG=<?=$BG?>&PT=<?=$PT?>"><button type = "button" class = "btn">Pilih Kamar</button></a>
                            <?php else : ?> 
                                <button style="background-color:#ff0000;" type = "button" class = "btn">Disable</button>
                            <?php endif; ?> 
                        </div>
                    </article>
                    
                    <!-- end of single room -->
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