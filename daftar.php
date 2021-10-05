<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<title>Daftar</title>
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
		      <li class="nav-item active">
		        <a class="nav-link" href="daftar.php">Register <span class="sr-only">(current)</span></a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="login.php">Login</a>
		       <?php endif ?>
		      </li>
		    
		    </ul>
		  </div>
		</div>
	</nav>

<div class="container">
	<div class="row">
		<div class="col-md-6 offset-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1 class="panel-title" align="center" style="margin-top: 30px;">Daftar</h1><hr><br>
				</div>
				
					<form method="post">
					<div class="form-row">
					    <div class="form-group col-md-6">
					      <label>Email</label>
					      <input type="email" class="form-control" placeholder="Masukkan email" name="email" required>
					    </div>
					    <div class="form-group col-md-6">
					      <label>Password</label>
					      <input type="text" class="form-control" placeholder="Masukkan password" name="password" required>
					    </div>
					</div>
					<div class="form-row">
					    <div class="form-group col-md-6">
					    	<label>Nama</label>
					    	<input type="text" class="form-control" placeholder="Masukkan nama lengkap" name="nama" required>
						</div>
					<div class="form-group col-md-6">
					    <label>Nomor Telp/Handphone</label>
					    <input type="text" class="form-control" placeholder="Masukkan nomor" name="telepon" required>
					</div>
					</div>
					    <div class="form-group">
					      <label>Alamat</label>
					      <textarea class="form-control" placeholder="Masukkan alamat lengkap" name="alamat" required></textarea>
					    </div>
					</div><br>
					<button type="submit" class="btn btn-primary" name="daftar">Daftar</button>
					</form>

					<?php  
					//jika tombol daftar ditekan
					if (isset($_POST["daftar"])) 
					{
						//mengambil isian nama,email,password,alamat,telepon
						$nama=$_POST["nama"];
						$email=$_POST["email"];
						$password=$_POST["password"];

						$alamat=$_POST["alamat"];
						$telepon=$_POST["telepon"];

						//cek apakah email sudah digunakan
						$ambil=$koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email'");
						$yangcocok=$ambil->num_rows;

						if ($yangcocok==1) 
						{
							echo "<script>alert('Pendaftaran gagal, email sudah digunakan')</script>";
							echo "<script>location='daftar.php';</script>";
						}
						else
						{
							//query insert ke tabel pelanggan
							$koneksi->query("INSERT INTO pelanggan (email_pelanggan,password_pelanggan,nama_pelanggan,telepon_pelanggan,alamat_pelanggan) VALUES ('$email','$password','$nama','$telepon','$alamat')");

							echo "<script>alert('Pendaftaran berhasil')</script>";
							echo "<script>location='login.php';</script>";
						}
					}
					?>
				</div>
			</div>
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