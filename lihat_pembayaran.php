<?php  
session_start();
include 'koneksi.php';

$id_pembelian=$_GET['id'];

$ambil=$koneksi->query("SELECT * FROM pembayaran LEFT JOIN pembelian 
	ON pembayaran.id_pembelian=pembelian.id_pembelian 
	WHERE pembelian.id_pembelian='$id_pembelian'");
$detail=$ambil->fetch_assoc();

//jika belum ada data pembayaran
if (empty($detail))
{
	echo "<script>alert('Belum ada data pembayaran');</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}

//jika data pelanggan yang bayar tidak sesuai dengan yang login
if ($_SESSION["pelanggan"]["id_pelanggan"]!==$detail["id_pelanggan"]) 
{
	echo "<script>alert('Tidak dapat melihat pembayaran milik orang lain');</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Lihat Pembayaran</title>
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
	<h1>Bukti Pembayaran Anda</h1><br><br>
	<div class="row">
		<div class="col-md-6">
			<table class="table">
				<tr>
					<th>Nomor Pembelian</th>
					<td><?php echo $detail['id_pembelian'] ?></td>
				</tr>
				<tr>
					<th>Atas Nama</th>
					<td><?php echo $detail['nama']; ?></td>
				</tr>
				<tr>
					<th>Bank</th>
					<td><?php echo $detail['bank']; ?></td>
				</tr>
				<tr>
					<th>Nomor Rekening</th>
					<td><?php echo $detail['nomor_rekening']; ?></td>
				</tr>
				<tr>
					<th>Tanggal</th>
					<td><?php echo $detail['tanggal']; ?></td>
				</tr>
				<tr>
					<th>Jumlah</th>
					<td>Rp. <?php echo number_format($detail['jumlah']); ?></td>
				</tr>
			</table>
		</div>
	</div>
</div>

<?php 
	include 'footer.php';
?>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</body>
</html>