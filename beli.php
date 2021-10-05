<?php session_start(); ?>
<?php include 'koneksi.php'; ?>
<?php  
// mendapatkan id_produk dari url
$id_produk=$_GET["id"];

//query ambil data
$ambil=$koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$detail=$ambil->fetch_assoc();

?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $detail["nama_produk"]; ?></title>
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
	<br><br>
	<section class="konten">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<img src="foto_produk/<?php echo $detail["foto_produk"]; ?>" class="img-responsive" width="320" style="border-radius: 20px;">
				</div>
				<div class="col-md-6">
					<h2><?php echo $detail["nama_produk"]; ?></h2>
					<h4>Rp. <?php echo number_format($detail["harga_produk"]); ?></h4><br>
					<h5>Stok: <?php echo $detail['stok_produk'] ?></h5>
					<p><?php echo $detail["deskripsi_produk"]; ?></p><br>
					<h4>Jumlah:</h4>
					
					<form method="post">
						<div class="form-group">
							<div class="input-group">
								<input type="number" value="1" min="1" max="<?php echo $detail['stok_produk'] ?>" class="form-control col-md-2" name="jumlah">
							</div>
						</div>
						<button class="btn btn-primary" name="beli">Beli</button>

					</form>

					<?php  
					//jika ada tombol beli
					if (isset($_POST["beli"])) 
					{
						//mendapatkan jumlah yang diinput
						$jumlah=$_POST["jumlah"];
						//masukkan di keranjang
						$_SESSION["keranjang"][$id_produk]=$jumlah;

						echo "<script>alert('Produk telah masuk keranjang');</script>";
						echo "<script>location='keranjang.php';</script>";
					}

					?>
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