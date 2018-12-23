<?php
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";

if(isset($_GET['Kode'])) {
	# Baca variabel URL
	$Kode=  $_GET['Kode']; 
	
	// Skrip membaca data Siswa
	$mySql	= "SELECT * FROM siswa WHERE kd_siswa='$Kode'";
	$myQry	= mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$myData = mysql_fetch_array($myQry);
	
		// Menampilkan gambar
		if($myData['foto']=="") { $fileFoto = "noimage.jpg"; }
		else { $fileFoto = $myData['foto']; }
}
else {
	echo "Kode data tidak terbaca";
	exit;
}
?>
<html>
<head>
<title>:: Cetak Data Siswa</title>
<link href="../styles/styles_cetak.css" rel="stylesheet" type="text/css">
</head>
<body>
<h2> CETAK DATA SISWA  </h2>
<table width="100%" cellpadding="4" cellspacing="2" class="table-list">
	<tr>
	  <td width="16%"><strong>Kode</strong></td>
	  <td width="1%"><strong>:</strong></td>
	  <td width="84%"><?php echo $myData['kd_siswa']; ?></td>
	</tr>
	<tr>
      <td><strong>NISN</strong></td>
	  <td><strong>:</strong></td>
	  <td><?php echo $myData['nisn']; ?></td>
  </tr>
	<tr>
	  <td><strong>Nama Siswa </strong></td>
      <td><strong>:</strong></td>
	  <td><?php echo $myData['nm_siswa']; ?></td>
  </tr>
	<tr>
	  <td><strong>Kelamin</strong></td>
      <td><b>:</b></td>
	  <td><?php echo $myData['kelamin']; ?></td>
    </tr>
	<tr>
	  <td><b>Agama</b></td>
      <td><b>:</b></td>
	  <td><?php echo $myData['agama']; ?></td>
    </tr>
	<tr>
	  <td><strong>Tempat &amp; Tgl. Lahir </strong></td>
      <td><b>:</b></td>
	  <td><?php echo $myData['tempat_lahir'].", ".IndonesiaTgl($myData['tanggal_lahir']); ?></td>
    </tr>
	<tr>
	  <td><strong>Alamat</strong></td>
      <td><strong>:</strong></td>
	  <td><?php echo $myData['alamat'];  ?> </td>
    </tr>
	<tr>
	  <td><strong>No. Telepon</strong></td>
      <td><strong>:</strong></td>
	  <td><?php echo $myData['no_telepon']; ?></td>
	</tr>
	<tr>
	  <td><b>Foto</b></td>
      <td><strong>:</strong></td>
	  <td> <img src="../foto/siswa/<?php echo $fileFoto; ?>" height="150">  </td>
    </tr>
</table>
<img src="../images/btn_print.png" height="20" onClick="javascript:window.print()" />
</body>
</html>
