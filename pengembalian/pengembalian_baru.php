<?php
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";
include_once "../library/inc.pilihan.php";

date_default_timezone_set("Asia/Jakarta");

# JIKA TOMBOL SIMPAN TRANSAKSI DIKLIK
if(isset($_POST['btnSimpan'])){
	# Baca variabel form
	$txtNoPinjam	= $_POST['txtNoPinjam'];
	$txtTglKembali 	= InggrisTgl($_POST['txtTglKembali']);
	$txtDenda		= $_POST['txtDenda'];
	
	// Skrip Validasi form
	$pesanError = array();
	if (trim($txtNoPinjam)=="") {
		$pesanError[] = "Data <b>No. Peminjaman</b> tidak terbaca !";		
	}
	if (trim($txtTglKembali)=="--") {
		$pesanError[] = "Data <b>Tanggal Kembali</b> belum diisi, silahkan pilih pada kalender !";		
	}
	if (trim($txtDenda)=="" or ! is_numeric(trim($txtDenda))) {
		$pesanError[] = "Data <b>Denda (Rp)</b> masih kosong, harus diisi angka atau diisi 0 !";
	}

	// Validasi Status Pengembalian, apakah sudah Pernah dikembalikan atau belum
	$cekSql ="SELECT * FROM pengembalian WHERE no_pinjam = '$txtNoPinjam' ";
	$cekQry = mysql_query($cekSql, $koneksidb) or die ("Gagal Query validasi ".mysql_error());
	if (mysql_num_rows($cekQry) >= 1) {
		$pesanError[] = "<b>BUKU SUDAH DIKEMBALIKAN</b>, tidak boleh ada transaksi Pengembalian ganda !";
	}

	# JIKA ADA PESAN ERROR DARI VALIDASI
	if (count($pesanError)>=1 ){
		echo "<div class='mssgBox'>";
		echo "<img src='../images/attention.png'> <br><hr>";
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
		echo "</div> <br>"; 
	}
	else {
		# SIMPAN KE DATABASE
		# Jika jumlah error pesanError tidak ada, maka proses Penyimpanan akan dikalkukan
		
		// Membuat kode Transaksi baru
		$kodeKembali = buatKode("pengembalian", "KB");
				
		// Skrip menyimpan data ke tabel transaksi utama
		$mySql	= "INSERT INTO pengembalian(no_kembali, tgl_kembali, no_pinjam, denda) 
					VALUES ('$kodeKembali', '$txtTglKembali', '$txtNoPinjam', '$txtDenda')";
		mysql_query($mySql, $koneksidb) or die ("Gagal query peminjaman ".mysql_error());
			
		// Update status
		$statusSql = "UPDATE peminjaman SET status='Kembali' WHERE no_pinjam='$txtNoPinjam'";
		mysql_query($statusSql, $koneksidb) or die ("Gagal query status ".mysql_error());

		// Refresh
		echo "<meta http-equiv='refresh' content='0; url=?open=Peminjaman-Tampil'>";
	}	
}

# UNTUK KOTAK FORM PENGEMBALIAN
$noTransaksi 	= buatKode("pengembalian", "KB");
$dataTglKembali	= isset($_POST['txtTglKembali']) ? $_POST['txtTglKembali'] : date('d-m-Y');
$dataDenda		= isset($_POST['txtDenda']) ? $_POST['txtDenda'] : '0';

# TAMPILKAN DATA TRANSAKSI PEMINJAMAN
if(isset( $_GET['Kode'])) {
	$Kode	= $_GET['Kode']; 
	$mySql 	= "SELECT peminjaman.*, siswa.nisn, siswa.nm_siswa FROM peminjaman 
				LEFT JOIN siswa ON peminjaman.kd_siswa = siswa.kd_siswa
				WHERE peminjaman.no_pinjam ='$Kode'";
	$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query ambil data salah : ".mysql_error());
	$myData	= mysql_fetch_array($myQry);
}
else {
	echo "Kode transaksi pinjam tidak terbaca";
	exit;
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>:: Transaksi Pengembalian</title></head>
<body>
<h1>PENGEMBALIAN BUKU </h1>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
  <table class="table-list" width="700" border="0" cellspacing="1" cellpadding="3">
    <tr>
      <td bgcolor="#CCCCCC"><strong>PEMINJAMAN</strong></td>
      <td width="1%">&nbsp;</td>
      <td width="79%">&nbsp;</td>
    </tr>
    <tr>
      <td width="20%"><strong>No. Pinjam </strong></td>
      <td>:</td>
      <td> <?php echo $myData['no_pinjam']; ?> <input name="txtNoPinjam" type="hidden" value="<?php echo $myData['no_pinjam']; ?>" /></td>
    </tr>
    <tr>
      <td><strong>Tgl.  Pinjam </strong></td>
      <td>:</td>
      <td> <?php echo IndonesiaTgl($myData['tgl_pinjam']); ?> </td>
    </tr>
    <tr>
      <td><strong>Siswa</strong></td>
      <td>:</td>
      <td> <?php echo $myData['nisn']."/ ".$myData['nm_siswa']; ?> </td>
    </tr>
    <tr>
      <td><strong> Keterangan </strong></td>
      <td>:</td>
      <td> <?php echo $myData['keterangan']; ?> </td>
    </tr>
    <tr>
      <td><strong>Lama Pinjam </strong></td>
      <td>:</td>
      <td> <?php echo $myData['lama_pinjam']; ?> hari </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#CCCCCC"><strong>PENGEMBALIAN</strong></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>No. Kembali </strong></td>
      <td>:</td>
      <td><input name="textfield" type="text" value="<?php echo $noTransaksi; ?>" size="20" maxlength="20" readonly="readonly"/></td>
    </tr>
    <tr>
      <td><strong>Tgl. Kembali </strong></td>
      <td>:</td>
      <td><input name="txtTglKembali" type="text" class="tcal" value="<?php echo $dataTglKembali; ?>" size="20" /></td>
    </tr>
    <tr>
      <td><strong>Denda (Rp.) </strong></td>
      <td>:</td>
      <td><b>
        <input type="text" name="txtDenda" size="20" maxlength="12" value="<?php echo $dataDenda; ?>"/>
      </b></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input name="btnSimpan" type="submit" style="cursor:pointer;" value=" SIMPAN TRANSAKSI " /></td>
    </tr>
  </table>
 </form>
</body>
</html>
