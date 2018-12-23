<?php
include_once "library/inc.connection.php";
?>
<h2> LAPORAN DATA KATEGORI</h2>
<table class="table-list" width="600" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td width="20" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="40" bgcolor="#CCCCCC"><strong>Kode</strong></td>
    <td width="518" bgcolor="#CCCCCC"><strong>Nama Kategori </strong></td>
  </tr>
  
<?php
// Skrip menampilkan data kategori
$mySql 	= "SELECT * FROM kategori ORDER BY kd_kategori ASC";
$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query  salah : ".mysql_error());
$nomor  = 0; 
while ($myData = mysql_fetch_array($myQry)) {
	$nomor++;
?>

  <tr>
	<td> <?php echo $nomor; ?> </td>
	<td> <?php echo $myData['kd_kategori']; ?> </td>
	<td> <?php echo $myData['nm_kategori']; ?> </td>
  </tr>
<?php } ?>  
</table>
<br />
<a href="cetak/kategori.php" target="_blank"><img src="images/btn_print2.png"/>cetak<a>