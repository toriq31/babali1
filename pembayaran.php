<?php 
session_start();
//koneksi ke database
include 'koneksi.php';

//jika tidak ada session pelanggan (belum login)
if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"])) 
{
	echo "<script>alert('Silahkan login terlebih dahulu');</script>";
	echo "<script>location='login.php';</script>";
	exit();
}


//mendapatkan id_pembelian dari url
$idpem=$_GET["id"];
$ambil=$koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
$detpem=$ambil->fetch_assoc();

//mendapatkan id_pelanggan yang beli
$id_pelanggan_beli=$detpem["id_pelanggan"];
//mendapatkan id_pelanggan yang login
$id_pelanggan_login=$_SESSION["pelanggan"]["id_pelanggan"];

if ($id_pelanggan_login !==$id_pelanggan_beli) 
{
	echo "<script>alert('ID tidak sesuai');</script>";
	echo "<script>location='riwayat.php';</script>";
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Pembayaran</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<!--navbar-->
<nav class="navbar navbar-expand-lg navbar-light">
		<div class="container">
		  <a class="navbar-brand" href="index.php">Babali</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav ml-lg-auto">
		      <li class="nav-item">
		        <a class="nav-link" href="index.php">Home</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="keranjang.php">Cart</a>
		      </li>

		 	  <?php  if (isset($_SESSION["pelanggan"])): ?>
		      <li class="nav-item active">
		        <a class="nav-link" href="riwayat.php">Purchase History <span class="sr-only">(current)</span></a>
		      </li>
		      <?php endif ?>
		      <!-- jika sudah login(ada session pelanggan) -->
		      <?php  if (isset($_SESSION["pelanggan"])): ?>
		      <li class="nav-item">
		        <a class="nav-link" href="logout.php">Logout</a>
		      </li>
		      <!-- selain itu(belum ada login/session pelanggan) -->
		      <?php else: ?>
		      <li class="nav-item">
		        <a class="nav-link" href="daftar.php">Register</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="login.php">Login</a>
		       <?php endif ?>
		      </li>
		    
		    </ul>
		  </div>
		</div>
	</nav>

<div class="container"><br>
	<h1>Konfirmasi Pembayaran</h1>
	<p>Kirim bukti pembayaran Anda disini</p><hr><br>
	<div class="alert alert-info">Total tagihan Anda <strong>Rp. <?php echo number_format($detpem["total_pembelian"]) ?></strong></div>


	<form method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label>Atas Nama</label>
			<input type="text" class="form-control" name="nama" required>
		</div>
		<div class="form-group">
			<label>Bank</label>
			<input type="text" class="form-control" name="bank" required>
		</div>
		<div class="form-group">
			<label>Nomor Rekening</label>
			<input type="text" class="form-control" name="nomor_rekening" required>
		</div>
		<div class="form-group">
			<label>Jumlah Dibayar (Rp.)</label>
			<input type="text" class="form-control" name="jumlah" required>
		</div>
		<button class="btn btn-primary" name="kirim">Kirim</button>
	</form>
</div>

<?php  
//jika tombol kirim ditekan
if (isset($_POST["kirim"])) 
{
	$namabukti=$_FILES["bukti"]["name"];
	$lokasibukti=$_FILES["bukti"]["tmp_name"];

	$nama=$_POST["nama"];
	$bank=$_POST["bank"];
	$nomor_rekening=$_POST["nomor_rekening"];
	$jumlah=$_POST["jumlah"];
	$tanggal=date("Y-m-d");

	//simpan pembayaran
	$koneksi->query("INSERT INTO pembayaran(id_pembelian,nama,bank,nomor_rekening,jumlah,tanggal)
		VALUES ('$idpem','$nama','$bank','$nomor_rekening','$jumlah','$tanggal')");

	//update data pembelian dari pending ke sudah kirim pembayaran
	$koneksi->query("UPDATE pembelian SET status_pembelian='Pembayaran terkirim'
		WHERE id_pembelian='$idpem'");

	echo "<script>alert('Berhasil mengirimkan bukti pembayaran');</script>";
	echo "<script>location='riwayat.php';</script>";

}

?>

<?php 
	include 'footer.php';
?>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</body>
</html>