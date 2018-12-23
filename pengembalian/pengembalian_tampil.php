<?php
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";
include_once "../library/inc.pilihan.php";

date_default_timezone_set("Asia/Jakarta");

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$baris	= 50;
$hal 	= isset($_GET['hal']) ? $_GET['hal'] : 1;
$infoSql= "SELECT * FROM pengembalian";
$infoQry= mysql_query($infoSql, $koneksidb) or die ("error paging: ".mysql_error());
$jumlah	= mysql_num_rows($infoQry);
$maks	= ceil($jumlah/$baris);
$mulai	= $baris * ($hal-1); 
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>:: DATA PENGEMBALIAN</title>
</head>
<body>
<h1>TAMPIL DATA PENGEMBALIAN </h1>

<table class="table-list" width="700" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td width="20" align="center" bgcolor="#CCCCCC"><strong>No </strong></td>
    <td width="79" bgcolor="#CCCCCC"><strong>No. Pinjam </strong></td>
    <td width="79" bgcolor="#CCCCCC"><strong>Tgl. Pinjam </strong></td>
    <td width="90" bgcolor="#CCCCCC"><strong>Tgl. Kembali </strong></td>
    <td width="55" bgcolor="#CCCCCC"><strong>NIS</strong></td>
    <td width="156" bgcolor="#CCCCCC"><strong>Nama Siswa </strong></td>
    <td width="85" align="right" bgcolor="#CCCCCC"><strong>Denda (Rp) </strong></td>
    <td colspan="2" bgcolor="#CCCCCC"><strong>Tools</strong></td>
  </tr>
<?php
 // Skrip menampilkan data Pengembalian
$mySql = "SELECT peminjaman.*, pengembalian.tgl_kembali, pengembalian.denda, siswa.nisn, siswa.nm_siswa
			FROM pengembalian 
			LEFT JOIN peminjaman ON pengembalian.no_pinjam = peminjaman.no_pinjam
			LEFT JOIN siswa ON peminjaman.kd_siswa = siswa.kd_siswa 
			ORDER BY peminjaman.no_pinjam DESC LIMIT $mulai, $baris";
$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
$nomor = 0; 
while ($myData = mysql_fetch_array($myQry)) {
	$nomor++;
	$Kode = $myData['no_pinjam'];
?>
  <tr>
    <td> <?php echo $nomor; ?> </td>
    <td> <?php echo $myData['no_pinjam']; ?> </td>
    <td> <?php echo IndonesiaTgl($myData['tgl_pinjam']); ?> </td>
    <td> <?php echo IndonesiaTgl($myData['tgl_kembali']); ?> </td>
    <td> <?php echo $myData['nisn']; ?> </td>
    <td> <?php echo $myData['nm_siswa']; ?> </td>
    <td align="right"> <?php echo format_angka($myData['denda']); ?> </td>
    <td width="37" align="right"><a href="nota_kembali.php?Kode=<?php echo $Kode; ?>" target="_blank">Cetak</a></td>
    <td width="35"><a href="?open=Pengembalian-Batal&Kode=<?php echo $Kode; ?>" target="_self" 
						onclick="return confirm('YAKIN INGIN MENGHAPUS DATA PENGEMBALIAN INI ... ?')">Batal</a></td>
  </tr>
<?php } ?> 
  <tr>
    <td colspan="4"><strong>Jumlah Data : </strong> <?php echo $jumlah; ?></td>
    <td colspan="5" align="right"><strong>Halaman Ke :
      <?php
	for ($h = 1; $h <= $maks; $h++) {
		echo " <a href='?open=Pengembalian-Tampil&hal=$h'>$h</a> ";
	}
	?>
</strong> </td>
  </tr>
</table>
</body>
</html>
