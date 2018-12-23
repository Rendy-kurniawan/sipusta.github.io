<?php
include_once "../library/inc.connection.php";

// Periksa ada atau tidak variabel Kode pada URL (alamat browser)
if(isset($_GET['Kode'])){
	$Kode	= $_GET['Kode'];
	
	// Hapus data sesuai Kode yang didapat di URL
	$mySql = "DELETE FROM peminjaman WHERE no_pinjam='$Kode'";
	$myQry = mysql_query($mySql, $koneksidb) or die ("Eror hapus 1 data ".mysql_error());
	if($myQry){
		// Hapus data pada tabel anak (peminjaman_tindakan)
		$mySql = "DELETE FROM peminjaman_detil WHERE no_pinjam='$Kode'";
		mysql_query($mySql, $koneksidb) or die ("Eror hapus data".mysql_error());

		// Refresh halaman
		echo "<meta http-equiv='refresh' content='0; url=?open=Peminjaman-Tampil'>";
	}
}
else {
	// Jika tidak ada data Kode ditemukan di URL
	echo "<b>Data yang dihapus tidak ada</b>";
}
?>