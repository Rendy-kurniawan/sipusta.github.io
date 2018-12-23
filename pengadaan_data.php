<!--<?php
include_once "library/inc.seslogin.php";
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$baris	= 50;
$hal 	= isset($_GET['hal']) ? $_GET['hal'] : 1;
$infoSql= "SELECT * FROM pengadaan";
$infoQry= mysql_query($infoSql, $koneksidb) or die ("error paging: ".mysql_error());
$jumlah	= mysql_num_rows($infoQry);
$maks	= ceil($jumlah/$baris);
$mulai	= $baris * ($hal-1); 
?><table width="800" border="0" cellpadding="2" cellspacing="1" class="table-border">
  <tr>
    <td colspan="2"><h1><b> DATA PENGADAAN </b></h1></td>
  </tr>
  <tr>
    <td colspan="2" align="right"><a href="?open=Pengadaan-Add" target="_self"><img src="images/btn_add_data.png" height="30" border="0" /></a></td>
  </tr>
  
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
	<table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr>
        <th width="20" align="center">No</th>
        <th width="40">Kode</th>
        <th width="85">Tanggal </th>
        <th width="297">Judul Buku </th>
        <th width="175">Asal Buku </th>
        <th width="52">Jumlah</th>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
      </tr>
	<?php
	// Skrip menampilkan data Pengadaan ke layar
	$mySql = "SELECT pengadaan.*, buku.judul FROM pengadaan 
				LEFT JOIN buku ON pengadaan.kd_buku = buku.kd_buku 
				ORDER BY no_pengadaan ASC LIMIT $mulai, $baris";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = $mulai; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['no_pengadaan'];
	?>
      <tr>
        <td> <?php echo $nomor; ?> </td>
        <td> <?php echo $myData['no_pengadaan']; ?> </td>
        <td> <?php echo IndonesiaTgl($myData['tgl_pengadaan']); ?> </td>
        <td> <?php echo $myData['judul']; ?> </td>
        <td> <?php echo $myData['asal_buku']; ?> </td>
         <td> <?php echo $myData['jumlah']; ?> </td>
        <td width="42" align="center"><a href="?open=Pengadaan-Delete&Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA INI ... ?')">Delete</a></td>
        <td width="42" align="center"><a href="?open=Pengadaan-Edit&Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data">Edit</a></td>
      </tr>
      <?php } ?>
    </table></td>
  </tr>
  <tr class="selKecil">
    <td width="308"><b>Jumlah Data :</b> <?php echo $jumlah; ?> </td>
    <td width="481" align="right"><strong>Halaman ke :</strong>
    <?php
	for ($h = 1; $h <= $maks; $h++) {
		echo " <a href='?open=Pengadaan-Data&hal=$h'>$h</a> ";
	}
	?> </td>
  </tr>
</table>
