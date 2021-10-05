<?php  
session_start();
include 'koneksi.php';

//jika tidak ada session pelanggan(belum login), maka dilarikan ke login.php
if (!isset($_SESSION["pelanggan"])) 
{
	echo "<script>alert('Silahkan Login terlebih dahulu')</script>";
	echo "<script>location='login.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Checkout</title>
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
			<h1>Menu yang dipilih</h1>
			<hr><br>
			<table class="table">
				<thead class="thead-light">
					<tr>
						<th scope="col">No</th>
						<th scope="col">Menu Makanan</th>
						<th scope="col">Harga</th>
						<th scope="col">Jumlah</th>
						<th scope="col">Subharga</th>
					</tr>
				</thead>
				<tbody>
					<?php $nomor=1; ?>
					<?php $totalbelanja=0; ?>
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
					</tr>
					<?php $nomor++; ?>
					<?php $totalbelanja+=$subharga; ?>
					<?php endforeach ?>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="4">Total Belanja</th>
						<th>Rp. <?php echo number_format($totalbelanja) ?></th>
					</tr>
				</tfoot>
			</table>
			<br>
			<form method="post">
				
				<div class="row">
					<div class="col-md-4">
						<h5>Nama Pembeli</h5>
						<div class="form-group">
						<input type="text" value="<?php echo $_SESSION["pelanggan"]['nama_pelanggan'] ?>" class="form-control">
						</div>
					</div>
				<div class="col-md-4">
					<h5>Nomor Pembeli</h5>
					<div class="form-group">
						<input type="text" value="<?php echo $_SESSION["pelanggan"]['telepon_pelanggan'] ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-4">
					<h5>Pilih Ongkos Kirim</h5>
						<select class="form-control" name="id_ongkir">
							<?php  
							$ambil=$koneksi->query("SELECT * FROM ongkir");
							while($perongkir=$ambil->fetch_assoc()){
							?>
							<option value="<?php echo $perongkir["id_ongkir"] ?>">
								<?php echo $perongkir['nama_kota'] ?> -
								Rp. <?php echo number_format($perongkir['tarif']) ?> 
							</option>
							<?php } ?>
						</select>
					</div>
				</div><br>
				<div class="form-group">
					<h5>Alamat Lengkap Pengiriman</h5>
					<textarea class="form-control" name="alamat_pengiriman" placeholder="Masukkan Alamat Lengkap Pengiriman (Nama Jalan, RT, RW, Kodepos, Kecamatan, serta Kelurahan)." required></textarea>
				</div>
				<button class="btn btn-primary" name="checkout">Checkout</button>
				
			</form>

			<?php  
			if (isset($_POST["checkout"])) 
			{
				$id_pelanggan=$_SESSION["pelanggan"]["id_pelanggan"];
				$id_ongkir=$_POST["id_ongkir"];
				$tanggal_pembelian=date("y-m-d");
				$alamat_pengiriman=$_POST['alamat_pengiriman'];

				$ambil=$koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
				$arrayongkir=$ambil->fetch_assoc();
				$nama_kota=$arrayongkir['nama_kota'];
				$tarif=$arrayongkir['tarif'];

				$total_pembelian=$totalbelanja+$tarif;

				//menyimpan data ke tabel pembelian
				$koneksi->query("INSERT INTO pembelian(id_pelanggan,id_ongkir,tanggal_pembelian,total_pembelian,nama_kota,tarif,alamat_pengiriman)
					VALUES ('$id_pelanggan','$id_ongkir','$tanggal_pembelian','$total_pembelian','$nama_kota','$tarif','$alamat_pengiriman')");

				//mendapatkan id_pembelian yang baru saja terjadi
				$id_pembelian_barusan=$koneksi->insert_id;

				foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) 
				{

					//mendapatkan data produk berdasarkan id_produk
					$ambil=$koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
					$perproduk=$ambil->fetch_assoc();

					$nama=$perproduk['nama_produk'];
					$harga=$perproduk['harga_produk'];
					$subharga=$perproduk['harga_produk']*$jumlah;

					$koneksi->query("INSERT INTO pembelian_produk(id_pembelian,id_produk,nama,harga,subharga,jumlah)
						VALUES ('$id_pembelian_barusan','$id_produk','$nama','$harga','$subharga','$jumlah')");

					//update stok
					$koneksi->query("UPDATE produk SET stok_produk=stok_produk - $jumlah WHERE id_produk='$id_produk'");
				}

				//mengkosongkan keranjang belanja

				unset($_SESSION["keranjang"]);


				//tampilan dialihkan ke halaman nota dari pembelian yang barusan
				echo "<script>alert('Pembelian Sukses');</script>";
				echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";

			} ?>

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