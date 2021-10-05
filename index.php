<?php 
session_start();
//koneksi ke database
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Nasi Goreng Babali</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://use.fontawesome.com/2472639833.js"></script>
</head>
<body> 
<header>
	<nav class="navbar navbar-expand-lg navbar-light">
		<div class="container">
		  <a class="navbar-brand" href="index.php">Babali</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav ml-lg-auto">
		      <li class="nav-item active">
		        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="keranjang.php">Cart</a>
		      </li>

		 	  <?php  if (isset($_SESSION["pelanggan"])): ?>
		      <li class="nav-item">
		        <a class="nav-link" href="riwayat.php">Purchase History</a>
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
</header>
<section class="banner">
	<div class="container">
  			<h2>Nasi Goreng Kambing & Ayam Bakar Bumbu Babali</h2>
  			<p>Nasi Goreng, Ayam Bakar, Mie Ayam</p><br>
  			<div class="row">
				<div class="col-md-3">
		  			<strong>Opening Hours</strong>
		  			<p>Everyday 09.00-21.00</p>
				</div>
			</div>
  		</div>
</section>

<!-- konten -->
<section class="konten">
	<div class="container">
		<h3>Nasi Goreng</h3>
		<hr class="bg-success mb-4 mt-0 mx-auto">
		<div class="row">
		<?php $ambil=$koneksi->query("SELECT * FROM produk WHERE id_kategori='1'"); ?>
		<?php while($nasgor=$ambil->fetch_assoc()){ ?>
			<div class="card">
			  <img src="foto_produk/<?php echo $nasgor['foto_produk']; ?>" class="card-img-top" alt="...">
			  <div class="card-body">
			    <h5 class="card-title">
        		<?php echo $nasgor['nama_produk']; ?></h5>
			    <p class="card-text">Rp. <?php echo number_format($nasgor['harga_produk']); ?></p>
			    <a href="beli.php?id=<?php echo $nasgor['id_produk']; ?>" class="btn btn-primary" >Beli</a>
			  </div>
			</div>
			<?php } ?>
		</div>

		<h3>Ayam Bakar Bumbu</h3>
		<hr class="bg-success mb-4 mt-0 mx-auto">
		<div class="row">
		<?php $ambil=$koneksi->query("SELECT * FROM produk WHERE id_kategori='2'"); ?>
		<?php while($nasgor=$ambil->fetch_assoc()){ ?>
			<div class="card">
			  <img src="foto_produk/<?php echo $nasgor['foto_produk']; ?>" class="card-img-top" alt="...">
			  <div class="card-body">
			    <h5 class="card-title">
        		<?php echo $nasgor['nama_produk']; ?></h5>
			    <p class="card-text">Rp. <?php echo number_format($nasgor['harga_produk']); ?></p>
			    <a href="beli.php?id=<?php echo $nasgor['id_produk']; ?>" class="btn btn-primary" >Beli</a>
			  </div>
			</div>
			<?php } ?>
		</div>
		
		<h3>Mie Ayam</h3>
		<hr class="bg-success mb-4 mt-0 mx-auto">
		<div class="row">
		<?php $ambil=$koneksi->query("SELECT * FROM produk WHERE id_kategori='3'"); ?>
		<?php while($nasgor=$ambil->fetch_assoc()){ ?>
			<div class="card">
			  <img src="foto_produk/<?php echo $nasgor['foto_produk']; ?>" class="card-img-top" alt="...">
			  <div class="card-body">
			    <h5 class="card-title">
        		<?php echo $nasgor['nama_produk']; ?></h5>
			    <p class="card-text">Rp. <?php echo number_format($nasgor['harga_produk']); ?></p>
			    <a href="beli.php?id=<?php echo $nasgor['id_produk']; ?>" class="btn btn-primary" >Beli</a>
			  </div>
			</div>
			<?php } ?>
		</div>

		<h3>Menu Tambahan</h3>
		<hr class="bg-success mb-4 mt-0 mx-auto">
		<div class="row">
		<?php $ambil=$koneksi->query("SELECT * FROM produk WHERE id_kategori='4'"); ?>
		<?php while($nasgor=$ambil->fetch_assoc()){ ?>
			<div class="card">
			  <img src="foto_produk/<?php echo $nasgor['foto_produk']; ?>" class="card-img-top" alt="...">
			  <div class="card-body">
			    <h5 class="card-title">
        		<?php echo $nasgor['nama_produk']; ?></h5>
			    <p class="card-text">Rp. <?php echo number_format($nasgor['harga_produk']); ?></p>
			    <a href="beli.php?id=<?php echo $nasgor['id_produk']; ?>" class="btn btn-primary" >Beli</a>
			  </div>
			</div>
			<?php } ?>
		</div>
	</div>
</section>

<?php 
	include 'footer.php';
?>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</body>
</html>