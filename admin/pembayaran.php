<div class="container">	
<h2>Data Pembayaran</h2>

<?php  
//mendapatkan id_pembelian dari url
$id_pembelian=$_GET['id'];

//mengambil data pembayaran berdasarkan id_pembelian
$ambil=$koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian='$id_pembelian'");
$detail=$ambil->fetch_assoc();

?>

<div class="row">
	<div class="col-md-6">
		<table class="table">
			<tr>
				<th>Nomor Pembelian</th>
				<td><?php echo $detail['id_pembelian'] ?></td>
			</tr>
			<tr>
				<th>Atas Nama</th>
				<td><?php echo $detail['nama']; ?></td>
			</tr>
			<tr>
				<th>Bank</th>
				<td><?php echo $detail['bank']; ?></td>
			</tr>
			<tr>
				<th>Nomor Rekening</th>
				<td><?php echo $detail['nomor_rekening']; ?></td>
			</tr>
			<tr>
				<th>Tanggal</th>
				<td><?php echo $detail['tanggal']; ?></td>
			</tr>
			<tr>
				<th>Jumlah</th>
				<td><?php echo number_format($detail['jumlah']); ?></td>
			</tr>
		</table>
		<br><br>
		<label>Ubah Status Pesanan</label>
		<form method="post">
			<div class="form-group">
				<select class="form-control" name="status" >
					<option value="Terkonfirmasi, Pesanan akan segera disiapkan">Konfirmasi Pembayaran</option>
					<option value="Pesanan telah dikirim">Pesanan Dikirim</option>
					<option value="Pesanan telah sampai tujuan">Pesanan Sampai</option>
				</select>
			</div>
			<div class="bottom">
			<button class="btn btn-primary" name="submit">Submit</button>
			</div>
		</form>
	</div>
</div>
<br>


<?php 
if (isset($_POST["submit"])) 
{
	$status=$_POST["status"];
	$koneksi->query("UPDATE pembelian SET status_pembelian='$status' WHERE id_pembelian='$id_pembelian'");

	echo "<script>alert('Data pembelian terupdate')</script>";
	echo "<script>location='index.php?halaman=pembelian';</script>";
}
?>
</div>