<?php
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";
include_once "../library/inc.pilihan.php";

date_default_timezone_set("Asia/Jakarta");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>:: TRANSAKSI PENGEMBALIAN</title>
<link rel="stylesheet" type="text/css" href="../styles/style.css" />
<link rel="stylesheet" type="text/css" href="../plugins/tigra_calendar/tcal.css" />

<script type="text/javascript" src="../plugins/tigra_calendar/tcal.js"></script> 
<script type="text/javascript" src="../plugins/js.popupWindow.js"></script>
</head>
<body>
<table width="500" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td><h1> TRANSAKSI PENGEMBALIAN</h1></td>
  </tr>
  <tr>
    <td><a href="?open=Peminjaman-Tampil" target="_self">Data Peminjaman</a> | <a href="?open=Pengembalian-Tampil" target="_self">Data Pengembalian</a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
 <?php 
# KONTROL MENU PROGRAM
if(isset($_GET['open'])) {
	// Jika mendapatkan variabel URL ?open
	switch($_GET['open']){				
		case 'Pengembalian-Baru' :
			if(!file_exists ("pengembalian_baru.php")) die ("File tidak ada !"); 
			include "pengembalian_baru.php";	break;
		case 'Pengembalian-Tampil' :
			if(!file_exists ("pengembalian_tampil.php")) die ("File tidak ada !"); 
			include "pengembalian_tampil.php";	break;
		case 'Peminjaman-Tampil' :
			if(!file_exists ("peminjaman_tampil.php")) die ("File tidak ada !"); 
			include "peminjaman_tampil.php";	break;
		case 'Pengembalian-Batal' :
			if(!file_exists ("pengembalian_batal.php")) die ("File tidak ada !"); 
			include "pengembalian_batal.php";	break;
	}
}
else {
	include "peminjaman_tampil.php";
}
?>
</body>
</html>
