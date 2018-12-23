<?php
session_start();
include_once "../library/inc.seslogin.php";
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";
?>
<html>
<head>
<title>:: Laporan Data Kategori</title>
<link href="../styles/styles_cetak.css" rel="stylesheet" type="text/css">
</head>
<body>
<h2>LAPORAN DATA KATEGORI </h2>
<table class="table-list" width="700" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td width="24" align="center" bgcolor="#F5F5F5"><strong>No</strong></td>
    <td width="55" bgcolor="#F5F5F5"><strong>Kode</strong></td>
    <td width="605" bgcolor="#F5F5F5"><strong>Nama Kategori </strong></td>
  </tr>
  <?php
  	// Skrip menampilkan data Kategori
	$mySql = "SELECT * FROM kategori ORDER BY kd_kategori ASC";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
?>
  <tr>
    <td><?php echo $nomor; ?></td>
    <td><?php echo $myData['kd_kategori']; ?></td>
    <td><?php echo $myData['nm_kategori']; ?></td>
  </tr>
  <?php } ?>
</table>
<img src="../images/btn_print.png" height="20" onClick="javascript:window.print()" />
</body>
</html>