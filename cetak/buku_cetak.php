<?php
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";
	
if(isset($_GET['Kode'])) {
	$Kode	= $_GET['Kode']; 
	$mySql 	= "SELECT buku.*, kategori.nm_kategori, penerbit.nm_penerbit FROM buku 
				LEFT JOIN kategori ON buku.kd_kategori = kategori.kd_kategori
				LEFT JOIN penerbit ON buku.kd_penerbit = penerbit.kd_penerbit
				WHERE buku.kd_buku='$Kode'";
	$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query ambil data salah : ".mysql_error());
	$myData	= mysql_fetch_array($myQry);
	
		// Menampilkan gambar
		if($myData['gambar']=="") { $fileGambar = "noimage.jpg"; }
		else { $fileGambar = $myData['gambar']; }
}
else {
	echo "Data Kode tidak terbaca";
	exit;
}
?>
<html>
<head>
<title>:: Cetak Data Buku </title>
<link href="../styles/styles_cetak.css" rel="stylesheet" type="text/css">
</head>
<body>
<h2> CETAK DATA BUKU  </h2>
  <table  class="table-list" width="100%" border="0" cellspacing="1" cellpadding="3">
    <tr>
      <th colspan="3" scope="col">VIEW BUKU </th>
    </tr>
    <tr>
      <td width="16%"><strong>Kode</strong></td>
      <td width="1%"><strong>:</strong></td>
      <td width="83%"><?php echo $myData['kd_buku']; ?></td>
    </tr>
    <tr>
      <td><strong>Judul Buku </strong></td>
      <td><strong>:</strong></td>
      <td><?php echo $myData['judul']; ?></td>
    </tr>
    <tr>
      <td><strong>ISBN</strong></td>
      <td><strong>:</strong></td>
      <td><?php echo $myData['isbn']; ?></td>
    </tr>
    <tr>
      <td><strong>Pengarang</strong></td>
      <td><strong>:</strong></td>
      <td><?php echo $myData['pengarang']; ?></td>
    </tr>
    <tr>
      <td><strong>Halaman</strong></td>
      <td><strong>:</strong></td>
      <td><?php echo $myData['halaman']; ?></td>
    </tr>
    <tr>
      <td><strong>Jumlah</strong></td>
      <td><strong>:</strong></td>
      <td><?php echo $myData['jumlah']; ?></td>
    </tr>
    <tr>
      <td><strong>Tahun Terbit</strong></td>
      <td><strong>:</strong></td>
      <td><?php echo $myData['th_terbit']; ?></td>
    </tr>
    
    <tr>
      <td><strong>Kategori</strong></td>
      <td><strong>:</strong></td>
      <td><?php echo $myData['nm_kategori']; ?></td>
    </tr>
    <tr>
      <td><b>Penerbit</b></td>
      <td><b>:</b></td>
      <td><?php echo $myData['nm_penerbit']; ?></td>
    </tr>
    <tr>
      <td><b>Sinopsis</b></td>
      <td><b>:</b></td>
      <td><?php echo $myData['sinopsis']; ?></td>
    </tr>
    <tr>
      <td><b>Gambar</b></td>
      <td><b>:</b></td>
      <td> <img src="../foto/buku/<?php echo $fileGambar; ?>" height="200"> </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
<img src="../images/btn_print.png" height="20" onClick="javascript:window.print()" />
</body>
</html>