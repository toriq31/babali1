<div class="container">
<h2>Ubah Stok Produk</h2>
<?php 

$ambil=$koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
$pecah=$ambil->fetch_assoc();

?>
<form method="post">
	<div class="form-group">
		<label>Stok Produk</label>
		<input type="text" class="form-control col-md-3" name="stok_produk">
	</div>
	<br>
	<div class="bottom">
		<button class="btn btn-primary" name="save">Simpan</button>
	</div>
</form>

<?php 
	if (isset($_POST['save'])) 
	{
		$koneksi->query("UPDATE produk SET stok_produk='$_POST[stok_produk]' WHERE id_produk='$_GET[id]'");

		echo "<script>alert('Stok telah berhasil dirubah');</script>";
		echo "<script>location='index.php?halaman=produk';</script>";
	}
?>
</div>