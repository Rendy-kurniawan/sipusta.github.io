<?php
// Koneksi database
include_once "library/inc.seslogin.php";
include_once "library/inc.connection.php";

# MEMBACA TOMBOL SIMPAN
if(isset($_POST['btnSimpan'])){
	# Baca Variabel Form
	$txtNama		= $_POST['txtNama'];
	$txtNisn		= $_POST['txtNisn'];
	$cmbKelamin		= $_POST['cmbKelamin'];
	$cmbAgama		= $_POST['cmbAgama'];
	$txtAlamat		= $_POST['txtAlamat'];
	$txtNoTelepon	= $_POST['txtNoTelepon'];

	$txtTempatLhr	= $_POST['txtTempatLhr'];
	$cmbTanggalLhr	= $_POST['cmbTanggalLhr'];
	$cmbBulanLhr	= $_POST['cmbBulanLhr'];
	$cmbTahunLhr	= $_POST['cmbTahunLhr'];
	
	// menggabung Tanggal (Y-m-d)
	$tanggalLahir	= $cmbTahunLhr."-".$cmbBulanLhr."-".$cmbTanggalLhr;
	
	# Validasi form, jika kosong sampaikan pesan error
	$pesanError = array();
	if (trim($txtNama)=="") {
		$pesanError[] = "Data <b>Nama Siswa</b> tidak boleh kosong, harus dilengkapi !";		
	}
	if (trim($txtNisn)=="") {
		$pesanError[] = "Data <b>NISN</b> tidak boleh kosong, bisa diisi - untuk mengosongkan !";		
	}
	if (trim($cmbKelamin)=="Kosong") {
		$pesanError[] = "Data <b>Kelamin</b> belum ada yang dipilih, silahkan pilih dulu !";		
	}
	if (trim($cmbAgama)=="Kosong") {
		$pesanError[] = "Data <b>Agama</b> belum ada yang dipilih, silahkan pilih dulu !";		
	}
	if (trim($txtTempatLhr)=="") {
		$pesanError[] = "Data <b>Tempat Lahir</b> masih kosong, silahkan dilengkapi !";		
	}
	if (trim($cmbTanggalLhr)=="Kosong") {
		$pesanError[] = "Data <b>Tanggal. Lahir</b> masih kosong, pilih pada Combo !";		
	}
	if (trim($cmbBulanLhr)=="Kosong") {
		$pesanError[] = "Data <b>Bulan. Lahir</b> masih kosong, pilih pada Combo !";		
	}
	if (trim($cmbTahunLhr)=="Kosong") {
		$pesanError[] = "Data <b>Tahun. Lahir</b> masih kosong, pilih pada Combo !";		
	}
	if (trim($txtAlamat)=="") {
		$pesanError[] = "Data <b>Alamat</b> tidak boleh kosong, silahkan dilengkapi !";		
	}
	if (trim($txtNoTelepon)=="") {
		$pesanError[] = "Data <b>No. Telepon</b> masih kosong, silahkan dilengkapi !";
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
		# SIMPAN DATA KE DATABASE. // Jika tidak menemukan error, simpan data ke database
		
		// Membuat Kode Siswa baru
		$kodeBaru	= buatKode("siswa", "S");

		# SKRIP UPLOAD FOTO
		// Skrip membaca file gambar
		if (! empty($_FILES['txtNamaFile']['tmp_name'])) {
			// Jika file foto tidak kosong (ada foto yang dipilih)
			$nama_file = $_FILES['txtNamaFile']['name'];
			$nama_file = stripslashes($nama_file);
			$nama_file = str_replace("'","",$nama_file);
			
			// Proses kopi foto (menyimpan) ke folder
			$nama_file = $kodeBaru.".".$nama_file;
			copy($_FILES['txtNamaFile']['tmp_name'],"foto/siswa/".$nama_file);
		}
		else {
			// Jika file foto tidak dipilih, maka simpan data kosong
			$nama_file = "";
		}
		
		// Skrip menyimpan data Siswa baru ke database
		$mySql	= "INSERT INTO siswa (kd_siswa, nm_siswa, nisn, kelamin, agama, tempat_lahir, tanggal_lahir, alamat, no_telepon, foto) 
						VALUES ('$kodeBaru', 
								'$txtNama', 
								'$txtNisn', 
								'$cmbKelamin',
								'$cmbAgama',
								'$txtTempatLhr',
								'$tanggalLahir',
								'$txtAlamat',
								'$txtNoTelepon',
								'$nama_file')";
		$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?open=Siswa-Add'>";
		}
		exit;
	}
}

# VARIABEL DATA UNTUK KOTAK FORM
$dataKode		= buatKode("siswa", "S");
$dataNama		= isset($_POST['txtNama']) ? $_POST['txtNama'] : '';
$dataNisn		= isset($_POST['txtNisn']) ? $_POST['txtNisn'] : '';
$dataKelamin	= isset($_POST['cmbKelamin']) ? $_POST['cmbKelamin'] : '';
$dataAgama		= isset($_POST['cmbAgama']) ? $_POST['cmbAgama'] : '';
$dataAlamat		= isset($_POST['txtAlamat']) ? $_POST['txtAlamat'] : '';
$dataNoTelepon	= isset($_POST['txtNoTelepon']) ? $_POST['txtNoTelepon'] : '';
$dataTempatLhr	= isset($_POST['txtTempatLhr']) ? $_POST['txtTempatLhr'] : '';
$dataTanggalLhr	= isset($_POST['cmbTanggalLhr']) ? $_POST['cmbTanggalLhr'] : '';
$dataBulanLhr	= isset($_POST['cmbBulanLhr']) ? $_POST['cmbBulanLhr'] : '';
$dataTahunLhr	= isset($_POST['cmbTahunLhr']) ? $_POST['cmbTahunLhr'] : '';
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="form1" target="_self" id="form1">
  <table class="table-list" width="800" border="0" cellspacing="1" cellpadding="3">
    <tr>
      <td colspan="3" bgcolor="#CCCCCC"><strong>TAMBAH DATA SISWA </strong></td>
    </tr>
    <tr>
      <td width="21%">Kode</td>
      <td width="1%">:</td>
      <td width="78%"><input name="textfield" value="<?php echo $dataKode; ?>" size="14" maxlength="5" readonly="readonly"/></td>
    </tr>
    <tr>
      <td>NISN</td>
      <td>:</td>
      <td><input name="txtNisn" id="txtNisn" value="<?php echo $dataNisn; ?>" size="20" maxlength="20" /></td>
    </tr>
    <tr>
      <td>Nama Siswa </td>
      <td>:</td>
      <td><input name="txtNama" value="<?php echo $dataNama; ?>" size="80" maxlength="100" /></td>
    </tr>

    <tr>
      <td>Kelamin</td>
      <td>:</td>
      <td>
	<select name="cmbKelamin">
	  <option value="Kosong">....</option>
	  <?php
	  $pilihan	= array("L"=> "Laki-laki", "P" => "Perempuan");
	  foreach ($pilihan as  $indeks => $nilai) {
		if ($dataKelamin==$indeks) {
			$cek=" selected";
		} else { $cek = ""; }
		echo "<option value='$indeks' $cek>$nilai</option>";
	  }
	  ?>
	</select>      </td>
    </tr>
    <tr>
      <td>Agama</td>
      <td>:</td>
      <td><select name="cmbAgama">
        <option value="Kosong">....</option>
        <?php
		  $pilihan	= array("Islam", "Kristen", "Katolik", "Hindu", "Budha");
          foreach ($pilihan as  $nilai) {
            if ($dataAgama==$nilai) {
                $cek=" selected";
            } else { $cek = ""; }
            echo "<option value='$nilai' $cek> $nilai</option>";
          }
          ?>
      </select></td>
    </tr>
    <tr>
      <td>Tempat &amp; Tgl. Lahir </td>
      <td>:</td>
      <td><input name="txtTempatLhr"  value="<?php echo $dataTempatLhr; ?>" size="40" maxlength="100"/>
      , 
	<select name="cmbTanggalLhr">
	  <option value="Kosong">....</option>
	  <?php
	  for($tanggal = 1; $tanggal <= 31; $tanggal++) {
		// Skrip membuat angka 2 digit (1-9)
		if($tanggal < 10) { $tggl = "0".$tanggal;} else { $tggl = $tanggal; }
		
		// Skrip tanggal terpilih
		if($tggl == $dataTanggalLhr) { $cek=" selected"; } else { $cek = ""; }
		
		echo "<option value='$tggl' $cek> $tggl </option>";
	  }
	  ?>
	</select>
        <select name="cmbBulanLhr">
          <option value="Kosong">....</option>
          <?php
		  for($bulan = 1; $bulan <= 12; $bulan++) {
		  	// Skrip membuat angka 2 digit (1-9)
		  	if($bulan < 10) { $bln = "0".$bulan; } else { $bln = $bulan; }
			
            if ($bln == $dataBulanLhr) { $cek=" selected"; } else { $cek = ""; }
			
            echo "<option value='$bln' $cek> $listBulan[$bln] </option>";
          }
          ?>
        </select>
        <select name="cmbTahunLhr">
          <option value="Kosong">....</option>
          <?php
			$thmuda	= date('Y') - 25;
			$thtua	= date('Y') - 10;
		  for($tahun = $thmuda; $tahun <= $thtua; $tahun++) {
		  	// Skrip tahun terpilih
            if ($tahun == $dataTahunLhr) {  $cek=" selected"; } else { $cek = ""; }
			
            echo "<option value='$tahun' $cek> $tahun </option>";
          }
          ?>
        </select></td>
    </tr>
    <tr>
      <td>Alamat</td>
      <td>:</td>
      <td><input name="txtAlamat" value="<?php echo $dataAlamat; ?>" size="80" maxlength="200" /></td>
    </tr>
    <tr>
      <td>No. Telepon</td>
      <td>:</td>
      <td><input name="txtNoTelepon" value="<?php echo $dataNoTelepon; ?>" size="30" maxlength="20"/></td>
    </tr>
    <tr>
      <td>Foto</td>
      <td>:</td>
      <td><input name="txtNamaFile" type="file" id="txtNamaFile" size="40" maxlength="200" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="submit" name="btnSimpan" value=" SIMPAN " style="cursor:pointer;" /></td>
    </tr>
  </table>
</form>
