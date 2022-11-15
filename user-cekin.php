<?php 
 
require 'koneksi.php'; 
session_start();

$Sekarang         = date("Y-m-d");
$ples_Satu        = mktime(0,0,0,date("n"),date("j")+1,date("Y"));
$Besok            = date("Y-m-d", $ples_Satu);



$ID = $_GET["ID"];
$BG = $_GET["BG"];
$PT = $_GET["PT"];

if (!isset($_SESSION['username'])) {
    header("Location: LOG-IN.php");}
 
$select_sql = " SELECT kamar.ID,
    Lantai,
    Jenis,
    Harga,
    hotel.Nama AS Hotel,
    STT FROM kamar
    INNER JOIN hotel
    ON ID_Hotel = hotel.ID
    Where kamar.ID='$ID'";



$result = mysqli_query($conn, $select_sql);

if (!$result) {
    echo mysqli_error($conn);
}

$penduduk = [];

while ($row = mysqli_fetch_assoc($result)) {
    $penduduk[] = $row;
}

$penduduk = $penduduk[0];

$Lantai = $penduduk["Lantai"];
$Jenis  = $penduduk["Jenis"];
$Harga  = $penduduk["Harga"];
$Hotel  = $penduduk["Hotel"];




?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>HOTEL XXVIII - Cek-in</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="CSS/user-menu2.css">
        <script src="https://kit.fontawesome.com/dbed6b6114.js" crossorigin="anonymous"></script>
        <link rel = "icon" href = "images/logo.png" type = "image/png">
    </head>
    <body style="background-color:;">
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


        <section  class = "rooms sec-width" id = "rooms">
            <div class = "title">
                <h2><?= $Hotel ?></h2>
            </div>
            <form ACTION="user-transaksi.php" METHODE="POST" NAME="kirim">
                <div style="margin:20px 0 10px 0;" class = "book">
                    <div class = "book-form">
                        <div class = "form-item">
                            <label for = "checkin-date">Check In : </label>
                            <input name="Cek_In" type = "date" value="<?=$Sekarang;?>" id = "chekin-date">
                        </div>
                        <div class = "form-item">
                            <label for = "checkout-date">Check Out : </label>
                            <input name="Cek_Out" type = "date" value="<?=$Besok;?>" id = "chekout-date">
                        </div>
                        <div class = "form-item">
                            <label for = "adult">Jumlah Malam : </label>
                            <input name="Durasi" type = "number" min = "1" value = "1" id = "adult">
                            <input type="hidden" name="ID_Kamar" value="<?=$ID?>"/>
                        </div>
                    </div>
                </div>

                <div class = "rooms-container">
                    <!-- single room -->
                    <article class = "room">
                        <div class = "room-image">
                            <img src = "<?=$PT?>" alt = "room image">
                        </div>
                    </article>
                    <!-- end of single room -->
                    <article class = "room">
                        <div class = "room-text">
                            <h3><?= $Jenis ?></h3>
                            <table>
                                <tr>
                                    <td width="30px"><i style="color:#3bd8ff;" class = "fas fa-drumstick-bite"></td>
                                    <td width="150px">Makan & Minum</td>
                                    <td width="30px"><i style="color:#3bd8ff;" class = "fas fa-luggage-cart"></td>
                                    <td width="150px">Jasa Kurir</td>
                                    <td width="30px" height="50px"><i style="color:#3bd8ff;" class = "fas fa-wifi"></td>
                                    <td width="150px"><p>Wifi </p></td>
                                </tr>
                                <tr>
                                    <td><i style="color:#3bd8ff;" class = "fas fa-swimming-pool"></td>
                                    <td><p>Kolam Renang</p></td>
                                    <td><i style="color:#3bd8ff;" class = "fas fa-dumbbell"></td>
                                    <td><p>Work Out</p></td>
                                    <td height="50px"><i style="color:#3bd8ff;" class = "fas fa-air-freshener"></td>
                                    <td><p>AC</p></td>
                                </tr>
                                <tr>
                                    <td height="50px" ><i style="color:#3bd8ff;" class = "fas fa-arrow-alt-circle-right"></td>
                                    <td><p>Televisi</p></td>
                                    <td><i style="color:#3bd8ff;" class = "fas fa-cat"></td>
                                    <td><p>Peliharaan </p></td>
                                    <td><i style="color:#3bd8ff;" class = "fas fa-smoking"></td>
                                    <td><p>Area Rokok</p></td>
                                </tr>

                            </table>
                            <p class = "rate">
                                <span>RP <?= $Harga ?> /</span> Malam
                                <input type="hidden" name="Harga_Permalam" value="<?=$Harga?>"/>
                            </p>
                            <input type="submit" class = 'btn' name="kirim" value="Pesan">
                        </div>
                    </article>
                </div>
            </form>
        </section>

        
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




