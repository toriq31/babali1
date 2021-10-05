<?php  
session_start();

include 'koneksi.php';

//jika keranjang kosong
if (empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"])) 
{
	echo "<script>alert('Keranjang kosong, silahkan masukkan Produk');</script>";
	echo "<script>location='index.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Keranjang</title>
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
		      <li class="nav-item active">
		        <a class="nav-link" href="keranjang.php">Cart <span class="sr-only">(current)</span></a>
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

	<section class="konten">
		<div class="container"><br>
			<h1>Keranjang</h1>
			<hr><br>
			<table class="table">
				<thead class="thead-light">
					<tr>
						<th scope="col">No</th>
						<th scope="col">Menu Makanan</th>
						<th scope="col">Harga</th>
						<th scope="col">Jumlah</th>
						<th scope="col">Subharga</th>
						<th scope="col">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $nomor=1; ?>
					<?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
					<!-- menampilkan produk yang sedang diperulangkan berdasarkan id_produk-->
					<?php  
					$ambil=$koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
					$pecah=$ambil->fetch_assoc();
					$subharga=$pecah["harga_produk"]*$jumlah;
					?>
					<tr>
						<td><?php echo $nomor; ?></td>
						<td><?php echo $pecah["nama_produk"]; ?></td>
						<td>Rp. <?php echo number_format($pecah["harga_produk"]); ?></td>
						<td><?php echo $jumlah; ?></td>
						<td>Rp. <?php echo number_format($subharga); ?></td>
						<td>
							<a href="hapuskeranjang.php?id=<?php echo $id_produk ?>" class="btn btn-danger btn-xs">Hapus</a>
						</td>
					</tr>
					<?php $nomor++; ?>
					<?php endforeach ?>
				</tbody>
			</table>

			<a href="index.php" class="btn btn-light">Lanjutkan Belanja</a>
			<a href="checkout.php" class="btn btn-primary">Checkout</a>
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