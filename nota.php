<?php session_start(); ?>
<?php include 'koneksi.php';?>

<!DOCTYPE html>
<html>
<head>
	<title>Nota Pembelian</title>
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

<section class="konten">
	<div class="container"><br>
		<h1>Detail Pembelian</h1>
		<hr><br>
			<?php 
			$ambil=$koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan
				WHERE pembelian.id_pembelian='$_GET[id]'");
			$detail=$ambil->fetch_assoc();
			?>

			<!-- Jika pelanggan yang beli tidak sama dengan pelanggan yang login, maka dilarikan ke riwayat.php -->
			<!-- Pelanggan yang beli harus pelanggan yang login -->
			<?php  
			//Mendapatkan id_pelanggan yang beli
			$idpelangganyangbeli=$detail["id_pelanggan"];

			//Mendapatkan id_pelanggan yang login
			$idpelangganyanglogin=$_SESSION["pelanggan"]['id_pelanggan'];

			if ($idpelangganyangbeli!==$idpelangganyanglogin) 
			{
				echo "<script>alert('ID tidak sesuai');</script>";
				echo "<script>location='riwayat.php'</script>";
				exit();
			}

			?>
			<div class="row">
				<div class="col-md-4">
					<h3>Pembelian</h3>
					<strong>No. Pembelian: <?php echo $detail['id_pembelian']; ?></strong><br><br>
					Tanggal: <?php echo $detail['tanggal_pembelian']; ?><br>
					Total: Rp. <?php echo number_format($detail['total_pembelian']); ?>
				</div>
				<div class="col-md-4">
					<h3>Pelanggan</h3>
					<strong><?php echo $detail['nama_pelanggan']; ?></strong><br><br>
						<?php echo $detail['telepon_pelanggan']; ?> <br>
						<?php echo $detail['email_pelanggan']; ?>
				</div>
				<div class="col-md-4">
					<h3>Pengiriman</h3>
					<strong><?php echo $detail['nama_kota'] ?></strong><br><br>
					Ongkos Kirim: Rp. <?php echo number_format($detail['tarif']); ?><br>
					Alamat: <?php echo $detail['alamat_pengiriman']; ?>
				</div>
			</div>
			<br>
			<table class="table">
				<thead class="thead-light">
					<tr>
						<th scope="col">No</th>
						<th scope="col">Menu Makanan</th>
						<th scope="col">Harga</th>
						<th scope="col">Jumlah</th>
						<th scope="col">Subtotal</th>
					</tr>
				</thead>
				<tbody>
					<?php $nomor=1; ?>
					<?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian='$_GET[id]'"); ?>
					<?php while($pecah=$ambil->fetch_assoc()){ ?>
					<tr>
						<td><?php echo $nomor; ?></td>
						<td><?php echo $pecah['nama']; ?></td>
						<td>Rp. <?php echo number_format($pecah['harga']); ?></td>
						<td><?php echo $pecah['jumlah']; ?></td>
						<td>Rp. <?php echo number_format($pecah['subharga']); ?></td>
					</tr>
					<?php $nomor++; ?>
					<?php } ?>
				</tbody>
			</table><br>
		<div class="row">
			<div class="col-md-7">
				<div class="alert alert-info">
					<p>
						Silahkan melakukan pembayaran sebanyak Rp. <?php echo number_format($detail['total_pembelian']); ?> <br>
						<strong>Transfer BNI a/n: Thariq Alamsyah / No Rek: 123-456789-1011</strong>
						<br><br>
						Kirim bukti pembayaran melalui menu Purchase History.
					</p>
				</div>
			</div>
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