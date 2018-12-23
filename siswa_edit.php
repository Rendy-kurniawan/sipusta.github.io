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
		
		// Membaca Kode dari form Hidden
		$Kode	= $_POST['txtKode']; 

		# SKRIP UPLOAD FOTO
		// Periksa keberadaan file baru
		if (empty($_FILES['txtNamaFile']['tmp_name'])) {
			// jika tidak ada file foto baru, maka baca foto lama
			$nama_file = $_POST['txtFileSembunyi'];
		}
		else  {
			// Jika file foto lama ada, akan dihapus
			$txtFileSembunyi = $_POST['txtFileSembunyi'];
			if(file_exists("foto/siswa/$txtFileSembunyi")) {
				unlink("foto/siswa/$txtFileSembunyi");	
			}
			
			// Membaca file foto baru
			$nama_file = $_FILES['txtNamaFile']['name'];
			$nama_file = stripslashes($nama_file);
			$nama_file = str_replace("'","",$nama_file);
			
			// Mengkopi file foto baru ke folder
			$nama_file = $Kode.".".$nama_file;
			copy($_FILES['txtNamaFile']['tmp_name'],"foto/siswa/".$nama_file);					
		}
		
		// Skrip simpan data ke tabel database
		$mySql	= "UPDATE siswa SET nm_siswa	= '$txtNama',
								nisn		= '$txtNisn',
								kelamin		= '$cmbKelamin',
								agama		= '$cmbAgama',
								tempat_lahir= '$txtTempatLhr',
								tanggal_lahir= '$tanggalLahir',
								alamat		= '$txtAlamat',
								no_telepon	= '$txtNoTelepon',
								foto		= '$nama_file'
						WHERE kd_siswa ='$Kode'";
		$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?open=Siswa-Data'>";
		}
		exit;
	}
}

# VARIABEL DATA UNTUK KOTAK FORM
# TAMPILKAN DATA UNTUK DIEDIT
$Kode	= $_GET['Kode']; 
$mySql 	= "SELECT * FROM siswa WHERE kd_siswa='$Kode'";
$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query ambil data salah : ".mysql_error());
$myData	= mysql_fetch_array($myQry);

	// Membaca data, lalu disimpan dalam variabel data
	$dataKode		=  $myData['kd_siswa'];
	$dataNama		= isset($_POST['txtNama']) ? $_POST['txtNama'] : $myData['nm_siswa'];
	$dataNisn		= isset($_POST['txtNisn']) ? $_POST['txtNisn'] : $myData['nisn'];
	$dataKelamin	= isset($_POST['cmbKelamin']) ? $_POST['cmbKelamin'] : $myData['kelamin'];
	$dataAgama		= isset($_POST['cmbAgama']) ? $_POST['cmbAgama'] : $myData['agama'];
	$dataAlamat		= isset($_POST['txtAlamat']) ? $_POST['txtAlamat'] : $myData['alamat'];
	$dataNoTelepon	= isset($_POST['txtNoTelepon']) ? $_POST['txtNoTelepon'] : $myData['no_telepon'];
	$dataTempatLhr	= isset($_POST['txtTempatLhr']) ? $_POST['txtTempatLhr'] :  $myData['tempat_lahir'];
	$dataTanggalLhr	= isset($_POST['txtTanggalLhr']) ? $_POST['txtTanggalLhr'] :  substr($myData['tanggal_lahir'], 9, 2);
	$dataBulanLhr	= isset($_POST['txtBulanLhr']) ? $_POST['txtBulanLhr'] : substr($myData['tanggal_lahir'], 5, 2);
	$dataTahunLhr	= isset($_POST['txtTahunLhr']) ? $_POST['txtTahunLhr'] : substr($myData['tanggal_lahir'], 0, 4);
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="form1" target="_self" id="form1">
  <table class="table-list" width="800" border="0" cellspacing="1" cellpadding="3">
    <tr>
      <td colspan="3" bgcolor="#CCCCCC"><strong>UBAH  DATA SISWA </strong></td>
    </tr>
    <tr>
      <td width="21%">Kode</td>
      <td width="1%">:</td>
      <td width="78%"><input name="textfield" value="<?php echo $dataKode; ?>" size="14" maxlength="5" readonly="readonly"/>
      <input name="txtKode" type="hidden" value="<?php echo $dataKode; ?>" /></td>
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
      <td><input name="txtNamaFile" type="file" id="txtNamaFile" size="40" maxlength="200" />
      <input name="txtFileSembunyi" type="hidden" value="<?php echo $myData['foto']; ?>" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="submit" name="btnSimpan" value=" SIMPAN " style="cursor:pointer;" /></td>
    </tr>
  </table>
</form>
