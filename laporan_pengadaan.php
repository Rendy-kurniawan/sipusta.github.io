<?php
include_once "library/inc.connection.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$baris	= 50;
$hal 	= isset($_GET['hal']) ? $_GET['hal'] : 1;
$pageSql= "SELECT * FROM pengadaan";
$pageQry= mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jumlah	= mysql_num_rows($pageQry);
$maks	= ceil($jumlah/$baris);
$mulai	= $baris * ($hal-1); 
?>
<h2> LAPORAN DATA PENGADAAN </h2>
<table class="table-list" width="750" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td width="21" align="center" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="36" bgcolor="#CCCCCC"><strong>Kode</strong></td>
    <td width="80" bgcolor="#CCCCCC"><strong>Tanggal </strong></td>
    <td width="354" bgcolor="#CCCCCC"><strong>Judul Buku </strong></td>
    <td width="180" bgcolor="#CCCCCC"><strong>Asal Buku </strong></td>
    <td width="48" bgcolor="#CCCCCC"><strong>Jumlah</strong></td>
  </tr>
  <?php
	// Skrip menampilkan data Pengadaan ke layar
	$mySql = "SELECT pengadaan.*, buku.judul FROM pengadaan 
				LEFT JOIN buku ON pengadaan.kd_buku = buku.kd_buku ORDER BY no_pengadaan ASC  LIMIT $mulai, $baris";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor  = $mulai; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
	?>
  <tr>
    <td> <?php echo $nomor; ?> </td>
    <td> <?php echo $myData['no_pengadaan']; ?> </td>
    <td> <?php echo IndonesiaTgl($myData['tgl_pengadaan']); ?> </td>
    <td> <?php echo $myData['judul']; ?> </td>
    <td> <?php echo $myData['asal_buku']; ?> </td>
    <td> <?php echo $myData['jumlah']; ?> </td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="3"><strong>Jumlah Data : </strong>  <?php echo $jumlah; ?></td>
    <td colspan="3" align="right"><strong>Halaman Ke : </strong>
	 <?php
	for ($h = 1; $h <= $maks; $h++) {
		echo " <a href='?open=Laporan-Pengadaan&hal=$h'>$h</a> ";
	}
	?> 
  <!--</td>
  </tr>
</table>
<br />
<a href="cetak/laporan-data-pengadaan.php" target="_blank"><img src="images/btn_print2.png"/>cetak<a>