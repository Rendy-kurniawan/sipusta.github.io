<?php
// Koneksi database
include_once "library/inc.seslogin.php";
include_once "library/inc.connection.php";

# Tombol Simpan diklik
if(isset($_POST['btnSimpan'])){		
	# BACA DATA DALAM FORM, masukkan datake variabel
	$txtNama	= $_POST['txtNama'];
	$txtUsername= $_POST['txtUsername'];
	$txtPassword= $_POST['txtPassword'];

	# VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
	$pesanError = array();
	if (trim($txtNama)=="") {
		$pesanError[] = "Data <b>Nama User</b> tidak boleh kosong !";		
	}
	if (trim($txtUsername)=="") {
		$pesanError[] = "Data <b>Username</b> tidak boleh kosong !";		
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
 		// Cek Password baru
		if (trim($txtPassword)=="") {
			$txtPassLama= $_POST['txtPassLama'];
			$passwSQL = ", password='$txtPassLama'";
		}
		else {
			$passwSQL = ",  password ='".md5($txtPassword)."'";
		}
		
		// Membaca Kode dari Form Hidden
		$Kode	= $_POST['txtKode']; 
		 
		// Skrip menyimpan data kembali ke database
		$mySql  = "UPDATE user SET nm_user='$txtNama', username='$txtUsername'
					$passwSQL
					WHERE kd_user='$Kode'";
		$myQry=mysql_query($mySql, $koneksidb) or die ("Gagal query coy $mySql ".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?open=User-Data'>";
		}
		exit;
	}
}

# MEMBUAT VARIABEL KOTAK FORM 
$Kode	= $_GET['Kode']; 
$mySql	= "SELECT * FROM user WHERE kd_user='$Kode'";
$myQry	= mysql_query($mySql, $koneksidb)  or die ("Query ambil data salah : ".mysql_error());
$myData = mysql_fetch_array($myQry);

	// Data Variabel Temporary (sementara)
	$dataKode		= $myData['kd_user'];
	$dataNama		= isset($_POST['txtNama']) ? $_POST['txtNama'] : $myData['nm_user'];
	$dataUsername	= isset($_POST['txtUsername']) ? $_POST['txtUsername'] : $myData['username']; 

?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" id="form1">
  <table class="table-list" width="650" border="0" cellspacing="1" cellpadding="3">
    <tr>
      <td colspan="3" bgcolor="#CCCCCC"><strong>UBAH  DATA USER </strong></td>
    </tr>
    <tr>
      <td width="132">Kode</td>
      <td width="3">:</td>
      <td width="493"><input name="textfield" type="text" value="<?php echo $dataKode; ?>" size="10" maxlength="6" readonly="readonly"/>
      <input name="txtKode" type="hidden" value="<?php echo $dataKode; ?>" /></td>
    </tr>
    <tr>
      <td>Nama User </td>
      <td>:</td>
      <td><input name="txtNama" type="text" value="<?php echo $dataNama; ?>" size="60" maxlength="100" /></td>
    </tr>
    <tr>
      <td>Username</td>
      <td>:</td>
      <td><input name="txtUsername" type="text"  value="<?php echo $dataUsername; ?>" size="30" maxlength="20" /></td>
    </tr>
    <tr>
      <td>Password</td>
      <td>:</td>
      <td><input name="txtPassword" type="password"  size="30" maxlength="20" />
      <input name="txtPassLama" type="hidden" value="<?php echo $myData['password']; ?>" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="submit" name="btnSimpan" value=" Simpan " /></td>
    </tr>
  </table>
</form>
