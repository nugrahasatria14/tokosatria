<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['level'] !== 'user') {
    header("Location: login.php");
    exit;
}
?>
<html>
<head>
    <title>Home E-commmerce</title>
    <style>
        .promo img {
            width: 90%;
            height: 40%;
            border-radius: 10px 10px;
            margin: 5px 5px 10px 70px;
        }
        .penjelasan {
            margin-left: 20px;
            margin-right: 30px;
            font-family: sans-serif;
            font-size: 13px;
        }

        .penjelasan p {
            color: gray;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        require_once './layout/header.php'
        ?>

        <div class="Promo">
            <img src="../img/dashboard.png" alt="">
        </div>

        <?php
        require_once 'katalog.php'

        ?>

        <div class="penjelasan">
            <hr>
            <h3>Nikmati Mudah Jualan Online di Tokopedia</h3>
            <div class="item">
                <p>Tokopedia merupakan salah satu situs jual beli online di Indonesia yang perkembangannya terhitung cepat dan memiliki tujuan untuk memudahkan setiap masyarakat di Indonesia, agar dapat melakukan aneka transaksi jual beli secara online. Selain kamu dapat menikmati proses pembelian aneka produk lebih mudah dan efisien, kamu para seller juga dapat melakukan jualan online di Tokopedia. Kamu bisa bergabung dengan komunitas khusus Tokopedia Seller bagi kamu yang ingin memulai bisnis dan jualan online atau ingin memperluas bisnis yang sedang kamu jalankan. Proses pendaftaran untuk menjadi Tokopedia Seller juga sangat mudah cukup dengan memasukkan data diri, nama toko, alamat toko setelah itu kamu akan langsung terdaftar sebagai Tokopedia Seller. Kamu juga dapat melakukan upgrade akun toko kamu menjadi Power Merchant untuk menjangkau pelanggan Tokopedia yang lebih luas lagi, sehingga bisnis online kamu semakin laris. Keuntungan Power Merchant adalah kamu dapat memberikan fitur Bebas Ongkir sehingga dapat menarik lebih banyak lagi pelanggan, lalu kamu dapat menikmati fitur TopAds yang dapat menjangkau masyarakat pengguna Tokopedia lebih banyak lagi dengan modal yang sangat minim mulai dari Rp 25 ribuan, hingga toko kamu akan tampil lebih menarik lagi serta dapat meningkatkan kepercayaan pembeli. Ayo mulai jualan online di Tokopedia dan mulai kembangkan usahamu secara online bersama Tokopedia.</p>
                <p>Tokopedia merupakan salah satu e-commerce di Indonesia yang menawarkan berbagai macam produk dan menjadikannya sebagai marketplace pilihan bagi banyak masyarakat Indonesia. Tidak hanya itu, kehadiran Tokopedia membuat pengalaman belanja online para penggunanya menjadi lebih mudah, aman, dan efisien. Tersedia berbagai fitur dan metode pembayaran yang dapat Anda pilih, untuk memastikan kegiatan belanja Anda dapat dilakukan senyaman mungkin. Baik itu melalui transfer bank yang bisa dilakukan menggunakan rekening dari berbagai bank yang tersedia, uang elektronik seperti OVO, hingga cicilan. Sistem berbelanja di Tokopedia terintegrasi pula dengan sistem beberapa jasa ekspedisi. Kerjasama yang dijalin ini memungkinkan Tokopedia untuk memberikan penawaran pengiriman gratis, dan memungkinkan pengguna yang berbelanja untuk terus melacak status pengiriman produk yang mereka beli. Jadi, produk apapun yang dibeli di Tokopedia baik itu pakaian bayi, aksesoris mobil, aksesoris kamera, celana, jam, hingga peralatan elektronik seperti kabel dan peralatan gaming, atau makanan sekali pun dapat terus Anda lacak keberadaannya untuk memastikan akan sampai dengan aman. Data pribadi dan seluruh transaksi yang sudah maupun yang akan Anda lakukan di Tokopedia dilindungi oleh kebijakan privasi Tokopedia, sehingga tak perlu khawatir data Anda akan jatuh ke pihak yang tidak bertanggungjawab dan/atau disalahgunakan. Karena faktor-faktor tersebut lah, Tokopedia menjadi solusi untuk belanja online dengan mudah dan aman.</p>
            </div>
        </div>

        <?php
        require_once './layout/footer.php'
        ?>
    </div>
</body>

</html>