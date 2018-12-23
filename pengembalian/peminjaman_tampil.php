<?php
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";
include_once "../library/inc.pilihan.php";

date_default_timezone_set("Asia/Jakarta");

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$baris	= 50;
$hal 	= isset($_GET['hal']) ? $_GET['hal'] : 1;
$infoSql= "SELECT * FROM peminjaman WHERE status='Pinjam'";
$infoQry= mysql_query($infoSql, $koneksidb) or die ("error paging: ".mysql_error());
$jumlah	= mysql_num_rows($infoQry);
$maks	= ceil($jumlah/$baris);
$mulai	= $baris * ($hal-1); 
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>:: DATA PEMINJAMAN</title>
</head>
<body>
<h1>TAMPIL DATA PEMINJAMAN </h1>

<table  class="table-list" width="700" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td width="20" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="75" bgcolor="#CCCCCC"><strong>Tgl. Pinjam </strong></td>
    <td width="80" bgcolor="#CCCCCC"><strong>No. Pinjam </strong></td>
    <td width="60" bgcolor="#CCCCCC"><strong>NIS</strong></td>
    <td width="247" bgcolor="#CCCCCC"><strong>Nama Siswa </strong></td>
    <td width="70" bgcolor="#CCCCCC"><strong>Lama Pjm </strong></td>
    <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
  </tr>
<?php
// Skrip menampilkan data Pinjam
$mySql = "SELECT peminjaman.*, siswa.nisn, siswa.nm_siswa FROM peminjaman 
		LEFT JOIN siswa ON peminjaman.kd_siswa = siswa.kd_siswa
		WHERE peminjaman.status='Pinjam'
		ORDER BY peminjaman.no_pinjam DESC LIMIT $mulai, $baris";
$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
$nomor = $mulai; 
while ($myData = mysql_fetch_array($myQry)) {
	$nomor++;
	$Kode = $myData['no_pinjam'];
?>

  <tr>
    <td> <?php echo $nomor; ?> </td>
    <td> <?php echo IndonesiaTgl($myData['tgl_pinjam']); ?> </td>
    <td> <?php echo $myData['no_pinjam']; ?> </td>
    <td> <?php echo $myData['nisn']; ?> </td>
    <td> <?php echo $myData['nm_siswa']; ?> </td>
    <td> <?php echo $myData['lama_pinjam']; ?> </td>
    <td width="40"><a href="../peminjaman/nota_pinjam.php?Kode=<?php echo $Kode; ?>" target="_blank">Cetak</a></td>
    <td width="51"><a href="?open=Pengembalian-Baru&Kode=<?php echo $Kode; ?>" target="_self">Kembali</a></td>
  </tr>
  
<?php } ?>
  <tr>
    <td colspan="4"><strong>Jumlah Data : </strong> <?php echo $jumlah; ?></td>
    <td colspan="4" align="right"><strong>Halaman Ke : </strong> 
	<?php
	for ($h = 1; $h <= $maks; $h++) {
		echo " <a href='?open=Peminjaman-Tampil&hal=$h'>$h</a> ";
	}
	?></td>
  </tr>
</table>
 </body>
</html>
