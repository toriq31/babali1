<div class="container">
<h2>Tambah Kategori</h2>
<form method="post">
	<div class="form-group">
		<label>Kategori</label>
		<input type="text" class="form-control col-md-3" name="kategori">
	</div>
	<br>
	<div class="bottom">
		<button class="btn btn-primary" name="save">Simpan</button>
	</div>
</form>

<?php 
	if (isset($_POST['save'])) 
	{
		$koneksi->query("INSERT INTO kategori(nama_kategori)
			VALUES('$_POST[kategori]')");

		echo "<script>alert('Kategori telah ditambahkan');</script>";
		echo "<script>location='index.php?halaman=kategori';</script>";
	}
?>
</div>