<?php
// Koneksi database
include_once "library/inc.seslogin.php";
include_once "library/inc.connection.php";

#  TOMBOL SIMPAN TRANSAKSI DIKLIK
if(isset($_POST['btnSimpan'])){
	# Baca data form
	$txtTanggal 	= InggrisTgl($_POST['txtTanggal']);
	$cmbBuku		= $_POST['cmbBuku'];
	$txtAsalBuku	= $_POST['txtAsalBuku'];
	$txtJumlah		= $_POST['txtJumlah'];
	$txtKeterangan	= $_POST['txtKeterangan'];

	// Skrip Validasi form
	$pesanError = array();
	if (trim($txtTanggal)=="--") {
		$pesanError[] = "Data <b>Tanggal</b> belum diisi, silahkan pilih pada kalender !";		
	}
	if (trim($cmbBuku)=="Kosong") {
		$pesanError[] = "Data <b>Buku</b> belum dipilih, silahkan pilih pada Combo !";		
	}
	if (trim($txtAsalBuku)=="") {
		$pesanError[] = "Data <b>Asal Buku</b> tidak boleh kosong, silahkan dilengkapi !";		
	}
	if (trim($txtJumlah)=="" or ! is_numeric(trim($txtJumlah))) {
		$pesanError[] = "Data <b>Jumlah</b> masih kosong, harus diisi angka !";
	}

	# JIKA ADA PESAN ERROR DARI VALIDASI
	if (count($pesanError)>=1 ){
		echo "<div class='mssgBox'>";
		echo "<img src='images/attention.png'> <br><hr>";
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
		echo "</div> <br>"; 
	}
	else {
# SIMPAN DATA KE DATABASE
		
// Membuat kode Transaksi baru
$kodePinjam = buatKode("pengadaan", "PB");
		
// Skrip menyimpan data ke tabel transaksi utama
$mySql	= "INSERT INTO pengadaan(no_pengadaan, tgl_pengadaan, kd_buku, asal_buku, jumlah, keterangan) 
			VALUES ('$kodePinjam', '$txtTanggal', '$cmbBuku', '$txtAsalBuku', '$txtJumlah', '$txtKeterangan')";
$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query pengadaan ".mysql_error());

// Refresh form
if($myQry){
	echo "<meta http-equiv='refresh' content='0; url=?open=Pengadaan-Add'>";
}
exit;
	}
}

# MEMBUAT VARIABEL UNTUK KOTAK FORM 
$noTransaksi 	= buatKode("pengadaan", "PB");
$dataTanggal 	= isset($_POST['txtTanggal']) ? $_POST['txtTanggal'] : date('d-m-Y');
$dataKategori	= isset($_POST['cmbKategori']) ? $_POST['cmbKategori'] : '';
$dataBuku		= isset($_POST['cmbBuku']) ? $_POST['cmbBuku'] : '';
$dataAsalBuku	= isset($_POST['txtAsalBuku']) ? $_POST['txtAsalBuku'] : '';
$dataJumlah		= isset($_POST['txtJumlah']) ? $_POST['txtJumlah'] : '';
$dataKeterangan	= isset($_POST['txtKeterangan']) ? $_POST['txtKeterangan'] : '';
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" id="form1">
  <table class="table-list" width="700" border="0" cellspacing="1" cellpadding="3">
    <tr>
      <td colspan="3" bgcolor="#CCCCCC"><strong>TAMBAH DATA PENGADAAN </strong></td>
    </tr>
    <tr>
      <td width="20%">No. Pengadaan </td>
      <td width="1%">:</td>
      <td width="79%"><input name="txtNomor" value="<?php echo $noTransaksi; ?>" size="20" maxlength="20" readonly="readonly"/></td>
    </tr>
    <tr>
      <td>Tgl.  Pengadaan </td>
      <td>:</td>
      <td><input name="txtTanggal" type="text" class="tcal" value="<?php echo $dataTanggal; ?>" size="18" maxlength="20" /></td>
    </tr>
    <tr>
      <td>Kategori </td>
      <td>:</td>
      <td>
	<select name="cmbKategori">
	<option value="Kosong">....</option>
	<?php
	  // Skrip menampilkan data Kategori ke ComboBo (ListMenu)
	$bacaSql = "SELECT * FROM kategori ORDER BY kd_kategori";
	$bacaQry = mysql_query($bacaSql, $koneksidb) or die ("Gagal Query".mysql_error());
	while ($bacaData = mysql_fetch_array($bacaQry)) {
	if ($bacaData['kd_kategori'] == $dataKategori) {
		$cek = " selected";
	} else { $cek=""; }
	
	echo "<option value='$bacaData[kd_kategori]' $cek> $bacaData[nm_kategori]</option>";
	}
	?>
	</select>
	<input type="submit" name="Submit" value="Pilih" /></td>
    </tr>
    <tr>
      <td>Buku</td>
      <td>:</td>
      <td><select name="cmbBuku">
        <option value="Kosong">....</option>
        <?php
		  // Skrip menampilkan data Buku ke ComboBo (ListMenu)
	  $bacaSql = "SELECT * FROM buku WHERE kd_kategori='$dataKategori' ORDER BY kd_buku";
	  $bacaQry = mysql_query($bacaSql, $koneksidb) or die ("Gagal Query".mysql_error());
	  while ($bacaData = mysql_fetch_array($bacaQry)) {
		if ($bacaData['kd_buku'] == $dataBuku) {
			$cek = " selected";
		} else { $cek=""; }
		
		echo "<option value='$bacaData[kd_buku]' $cek> $bacaData[kd_buku] - $bacaData[judul]</option>";
	  }
	  ?>
      </select></td>
    </tr>
    <tr>
      <td> Asal Buku </td>
      <td>:</td>
      <td><input name="txtAsalBuku" value="<?php echo $dataAsalBuku; ?>" size="70" maxlength="100" /></td>
    </tr>
    <tr>
      <td>Jumlah</td>
      <td>:</td>
      <td><b>
        <input name="txtJumlah" value="<?php echo $dataJumlah; ?>" size="4" maxlength="2"/>
      </b></td>
    </tr>
    <tr>
      <td> Keterangan </td>
      <td>:</td>
      <td><input name="txtKeterangan" value="<?php echo $dataKeterangan; ?>" size="70" maxlength="100" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="submit" name="btnSimpan" value=" SIMPAN " style="cursor:pointer;" /></td>
    </tr>
  </table>
</form>
