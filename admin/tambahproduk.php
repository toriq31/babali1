<?php  
$datakategori=array();

$ambil=$koneksi->query("SELECT * FROM kategori");
while($tiap=$ambil->fetch_assoc())
{
	$datakategori[]=$tiap;
}
?>

<div class="container">
<h2>Tambah Produk</h2>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" name="nama">
	</div>
	<div class="form-group">
		<label>Kategori</label>
		<select class="form-control" name="id_kategori">
			<option value="">Pilih Kategori</option>
			<?php foreach ($datakategori as $key => $value): ?>
				
			<option value="<?php echo $value['id_kategori']; ?>"><?php echo $value["nama_kategori"]; ?></option>
			<?php endforeach ?>
		</select>
	</div>
	<div class="form-group">
		<label>Harga (Rp)</label>
		<input type="number" class="form-control" name="harga">
	</div>
	<div class="form-group">
		<label>Foto</label>
		<input type="file" class="form-control" name="foto">
	</div>
	<div class="form-group">
		<label>Deskripsi</label>
		<textarea class="form-control" name="deskripsi" rows="10"></textarea>
	</div>
	<div class="bottom">
	<button class="btn btn-primary" name="save">Simpan</button>
	</div>
</form>
<?php 
	if (isset($_POST['save'])) 
	{
		$nama = $_FILES['foto']['name']; 
		$lokasi = $_FILES['foto']['tmp_name'];
		move_uploaded_file($lokasi, "../foto_produk/".$nama);
		$koneksi->query("INSERT INTO produk(nama_produk,harga_produk,foto_produk,deskripsi_produk,id_kategori)
			VALUES('$_POST[nama]','$_POST[harga]','$nama','$_POST[deskripsi]','$_POST[id_kategori]')");

		echo '<div class="alert alert-info">Data Tersimpan</div>';
		echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";
	}
?>
</div>