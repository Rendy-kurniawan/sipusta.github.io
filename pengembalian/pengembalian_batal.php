<?php
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";

// Periksa ada atau tidak variabel Kode pada URL (alamat browser)
if(isset($_GET['Kode'])){
	$Kode	= $_GET['Kode'];
	
	// Hapus data sesuai Kode yang didapat di URL
	$mySql = "SELECT * FROM pengembalian WHERE no_kembali='$Kode'";
	$myQry = mysql_query($mySql, $koneksidb) or die ("Error hapus 1 data ".mysql_error());
	$myData= mysql_fetch_array($myQry);
	if(mysql_num_rows($myQry) >=1){
		$kodePinjam	= $myData['no_pinjam'];
		
		// Update status pada tabel eminjaman menjadi Pinjam lagi
		$mySql = "UPDATE peminjaman SET status='Pinjam' WHERE no_pinjam='$kodePinjam'";
		mysql_query($mySql, $koneksidb) or die ("Error update data".mysql_error());
	}
	
	// Hapus data Pengembalian sesuai Kode yang didapat di URL
	$mySql = "DELETE FROM pengembalian WHERE no_pinjam='$Kode'";
	mysql_query($mySql, $koneksidb) or die ("Error hapus data ".mysql_error());
	
	// Refresh halaman
	echo "<meta http-equiv='refresh' content='0; url=?open=Pengembalian-Tampil'>";
}
else {
	// Jika tidak ada data Kode ditemukan di URL
	echo "<b>Data yang dihapus tidak ada</b>";
}
?>
</body>
</html>
