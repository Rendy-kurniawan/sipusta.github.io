<?php
include_once "library/inc.connection.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$baris	= 50;
$hal 	= isset($_GET['hal']) ? $_GET['hal'] : 1;
$pageSql= "SELECT * FROM siswa";
$pageQry= mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jumlah	= mysql_num_rows($pageQry);
$maks	= ceil($jumlah/$baris);
$mulai	= $baris * ($hal-1); 
?>

<h2> LAPORAN DATA SISWA </h2>
<table class="table-list" width="800" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td width="20" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="40" bgcolor="#CCCCCC"><strong>Kode</strong></td>
    <td width="49" bgcolor="#CCCCCC"><strong>NIS</strong></td>
    <td width="201" bgcolor="#CCCCCC"><strong>Nama Siswa </strong></td>
    <td width="23" bgcolor="#CCCCCC"><strong>L/P</strong></td>
    <td width="331" bgcolor="#CCCCCC"><strong>Alamat</strong></td>
    <td width="100" bgcolor="#CCCCCC"><strong>No. Telepon </strong></td>
  </tr>
  <?php
	// Skrip menampilkan data semua Siswa
	$mySql 	= "SELECT * FROM siswa ORDER BY kd_siswa ASC LIMIT $mulai, $baris";
	$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor  = $mulai; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
	?>
  <tr>
    <td> <?php echo $nomor; ?> </td>
    <td> <?php echo $myData['kd_siswa']; ?> </td>
    <td> <?php echo $myData['nisn']; ?> </td>
    <td> <?php echo $myData['nm_siswa']; ?> </td>
    <td> <?php echo $myData['kelamin']; ?> </td>
    <td> <?php echo $myData['alamat']; ?> </td>
    <td> <?php echo $myData['no_telepon']; ?> </td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="4" bgcolor="#F5F5F5"><strong>Jumlah Data :</strong> <?php echo $jumlah; ?> </td>
    <td colspan="3" align="right" bgcolor="#F5F5F5"><strong>Halaman ke :</strong>
    <?php
	for ($h = 1; $h <= $maks; $h++) {
		echo " <a href='?open=Laporan-Siswa&hal=$h'>$h</a> ";
	}
	?>
  </td>
  </tr>
</table>
<a href="cetak/siswa.php" target="_blank"><img src="images/btn_print2.png" height="18" border="0" title="Cetak ke Format HTML"/></a> 