<?php
// Koneksi database
include_once "library/inc.seslogin.php";
include_once "library/inc.connection.php";

# Tombol Simpan diklik
if(isset($_POST['btnSimpan'])){
	# Baca Variabel Form
	$txtNama	= $_POST['txtNama'];
	
	# Validasi form, jika kosong sampaikan pesan error
	$pesanError = array();
	if (trim($txtNama)=="") {
		$pesanError[] = "Data <b>Nama Penerbit</b> tidak boleh kosong !";		
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
		$txtKode= $_POST['txtKode']; 
		$mySql	= "UPDATE penerbit SET nm_penerbit='$txtNama' WHERE kd_penerbit ='$txtKode'";
		$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?open=Penerbit-Data'>";
		}
		exit;	
	}
}

# MEMBACA DATA UNTUK DIEDIT
$Kode	 = $_GET['Kode']; 
$mySql	 = "SELECT * FROM penerbit WHERE kd_penerbit='$Kode'";
$myQry	 = mysql_query($mySql, $koneksidb)  or die ("Query ambil data salah : ".mysql_error());
$myData	 = mysql_fetch_array($myQry);

	// Variabel untuk kotak Form isian, data dari form dan database
	$dataKode	= $myData['kd_penerbit']; 
	$dataNama	= isset($_POST['txtNama']) ? $_POST['txtNama'] : $myData['nm_penerbit'];
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" id="form1">
  <table class="table-list" width="650" border="0" cellspacing="1" cellpadding="3">
    <tr>
      <th colspan="3" scope="col">UBAH DATA PENERBIT </th>
    </tr>
    <tr>
      <td width="134">Kode</td>
      <td width="3">:</td>
      <td width="491"><input name="textfield" type="text" value="<?php echo $dataKode; ?>" size="10" maxlength="4" />
      <input name="txtKode" type="hidden" id="txtKode" value="<?php echo $dataKode; ?>" /></td>
    </tr>
    <tr>
      <td>Nama Penerbit </td>
      <td>:</td>
      <td><input name="txtNama" value="<?php echo $dataNama; ?>" size="70" maxlength="100" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="submit" name="btnSimpan" value=" SIMPAN " /></td>
    </tr>
  </table>
</form>
