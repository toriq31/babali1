<div class="container">
<h2>Data Kategori</h2>

<?php  
$semuadata=array();
$ambil=$koneksi->query("SELECT * FROM kategori");
while($tiap=$ambil->fetch_assoc())
{
	$semuadata[]=$tiap;
}
?>


<table class="table table-bordered">
	<thead class="thead-dark">
		<tr>
			<th>No</th>
			<th>Kategori</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($semuadata as $key => $value): ?>
			
		
		<tr>
			<td><?php echo $key+1; ?></td>
			<td><?php echo $value["nama_kategori"]; ?></td>
			<td>
				<a href="index.php?halaman=hapuskategori&id=<?php echo $value['id_kategori']; ?>" class="btn btn-danger btn-sm">Hapus</a>
			</td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>

<div class="bottom">
<a href="index.php?halaman=tambahkategori" class="btn btn-primary">Tambah Data</a>
</div>
</div>