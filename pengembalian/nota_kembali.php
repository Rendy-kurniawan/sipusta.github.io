<?php
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";

# SKRIP MEMBACA DATA TRANSAKSI 
if(isset($_GET['Kode'])){
	$Kode = $_GET['Kode'];
	
	// Skrip membaca data dari tabel peminjaman
	$mySql = "SELECT peminjaman.*, user.nm_user, siswa.nm_siswa FROM peminjaman
				LEFT JOIN user ON peminjaman.kd_user=user.kd_user 
				LEFT JOIN siswa ON peminjaman.kd_siswa = siswa.kd_siswa
				WHERE no_pinjam='$Kode'";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$myData = mysql_fetch_array($myQry);
}
else {
	echo "Nomor Pinjam (Kode) tidak ditemukan";
	exit;
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Cetak Nota Pinjam </title>
<link href="../styles/styles_cetak.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
	window.print();
	window.onfocus=function(){ window.close();}
</script>
</head>
<body onLoad="window.print()">

<h2> PERPUSTAKAAN SMKN 6 KOTA BEKASI </h2>
<h3> KOTA BEKASI, BEKASI TIMUR </h3>

<table width="600" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td width="120"><strong>No. Pinjam </strong></td>
    <td width="10">:</td>
    <td width="448"> <?php echo $myData['no_pinjam']; ?></td>
  </tr>
  <tr>
    <td><strong>Tgl. Pinjam </strong></td>
    <td>:</td>
    <td> <?php echo IndonesiaTgl($myData['tgl_pinjam']); ?> </td>
  </tr>
  <tr>
    <td><strong>Siswa</strong></td>
    <td>:</td>
    <td> <?php echo $myData['nm_siswa']; ?> </td>
  </tr>
  <tr>
    <td><strong>Lama Pinjam </strong></td>
    <td>:</td>
    <td> <?php echo $myData['lama_pinjam']; ?> </td>
  </tr>
  <tr>
    <td><strong>Keterangan</strong></td>
    <td>:</td>
    <td> <?php echo $myData['keterangan']; ?> </td>
  </tr>
  <tr>
    <td><strong>Status</strong></td>
    <td>:</td>
    <td> <?php echo $myData['status']; ?> </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<br>
<table width="600" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td width="20" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="40" bgcolor="#CCCCCC"><strong>Kode</strong></td>
    <td width="451" bgcolor="#CCCCCC"><strong>Judul Buku </strong></td>
    <td width="60" bgcolor="#CCCCCC"><strong>Jumlah</strong></td>
  </tr>
<?php
$totalPinjam	= 0;
// Menampilkan daftar Buku pinjaman
$notaSql = "SELECT peminjaman_detil.*, buku.judul FROM peminjaman_detil
			LEFT JOIN buku ON peminjaman_detil.kd_buku = buku.kd_buku 
			WHERE peminjaman_detil.no_pinjam='$Kode'
			ORDER BY buku.kd_buku ASC";
$notaQry = mysql_query($notaSql, $koneksidb)  or die ("Query list salah : ".mysql_error());
$nomor  = 0;  
while ($notaData = mysql_fetch_array($notaQry)) {
	$nomor++;
	$totalPinjam	= $totalPinjam + $notaData['jumlah'];
?>
  <tr>
    <td> <?php echo $nomor; ?> </td>
    <td> <?php echo $notaData['kd_buku']; ?> </td>
    <td> <?php echo $notaData['judul']; ?> </td>
    <td> <?php echo $notaData['jumlah']; ?> </td>
  </tr>
<?php } ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right"><strong>TOTAL : </strong></td>
    <td bgcolor="#CCCCCC"> <?php echo format_angka($totalPinjam); ?> </td>
  </tr>
</table>
</body>
</html>
