<?php 
session_start();
//koneksi ke database
include 'koneksi.php';


if (!isset($_SESSION['admin'])) 
{
    echo "<script>alert('Anda harus Login terlebih dahulu');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://use.fontawesome.com/2472639833.js"></script>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
              <a class="navbar-brand fa fa-dashboard fa-2x" href="index.php"> Dashboard</a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-lg-auto">
                        <br>
                        <li><a class="btn btn-danger btn-sm" href="index.php?halaman=logout" role="button"> Logout</a></li>
                </ul>
              </div>
            </div>
        </nav>
    </header>
                <?php 
                if (isset($_GET['halaman'])) 
                {
                     
                    if ($_GET['halaman']=="produk") 
                    {
                       include 'produk.php';
                    }
                    elseif ($_GET['halaman']=="pembelian") 
                    {
                        include 'pembelian.php';
                    }
                    elseif ($_GET['halaman']=="pelanggan") 
                    {
                        include 'pelanggan.php';
                    }
                    elseif ($_GET['halaman']=="detail") 
                    {
                        include 'detail.php';
                    }
                    elseif ($_GET['halaman']=="tambahproduk") 
                    {
                        include 'tambahproduk.php';
                    }
                    elseif ($_GET['halaman']=="hapusproduk")
                    {
                        include 'hapusproduk.php';
                    }
                    elseif ($_GET['halaman']=="hapuspelanggan")
                    {
                        include 'hapuspelanggan.php';
                    }
                    elseif ($_GET['halaman']=="logout") 
                    {
                        include 'logout.php';
                    }
                    elseif ($_GET['halaman']=="pembayaran") 
                    {
                        include 'pembayaran.php';
                    }
                    elseif ($_GET['halaman']=="kategori") 
                    {
                        include 'kategori.php';
                    }
                    elseif ($_GET['halaman']=="tambahkategori") 
                    {
                        include 'tambahkategori.php';
                    }
                    elseif ($_GET['halaman']=="hapuskategori") 
                    {
                        include 'hapuskategori.php';
                    }
                    elseif ($_GET['halaman']=="ubahstok") 
                    {
                        include 'ubahstok.php';
                    }
                 }
                 else{
                    include 'home.php';
                 } 
                 ?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    
   
</body>
</html>
