<?php
// Koneksi database
include_once "library/inc.seslogin.php";
include_once "library/inc.connection.php";

// Jika data Kode ditemukan dari URL (alamat browser)
if(isset($_GET['Kode'])){
	$Kode	= $_GET['Kode'];
	// Hapus data sesuai Kode yang terbaca
	$mySql = "DELETE FROM penerbit WHERE kd_penerbit='$Kode'";
	$myQry = mysql_query($mySql, $koneksidb) or die ("Eror hapus data".mysql_error());
	if($myQry){
		// Refresh halaman
		echo "<meta http-equiv='refresh' content='0; url=?open=Penerbit-Data'>";
	}
}
else {
	// Jika tidak ada data Kode ditemukan di URL
	echo "<b>Data yang dihapus tidak ada</b>";
}
?>