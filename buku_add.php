<?php
include_once "library/inc.seslogin.php";
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

# TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnSimpan'])){
	# Baca Variabel Form
	$txtJudul		= $_POST['txtJudul'];
	$txtIsbn		= $_POST['txtIsbn'];
	$txtPengarang	= $_POST['txtPengarang'];
	$txtHalaman		= $_POST['txtHalaman'];
	$txtJumlah		= $_POST['txtJumlah'];
	$txtTahun		= $_POST['txtTahun'];
	$txtSinopsis	= $_POST['txtSinopsis'];
	$cmbKategori	= $_POST['cmbKategori'];
	$cmbPenerbit	= $_POST['cmbPenerbit'];
	
	# SKRIP VALIDASI FORM, jika kosong sampaikan pesan error
	$pesanError = array();
	if (trim($txtJudul)=="") {
		$pesanError[] = "Data <b>Judul Buku</b> tidak boleh kosong, harus dilengkapi !";		
	}
	if (trim($txtIsbn)=="") {
		$pesanError[] = "Data <b>ISBN</b> tidak boleh kosong, bisa diisi - untuk mengosongkan !";		
	}
	if (trim($txtPengarang)=="") {
		$pesanError[] = "Data <b>Pengarang</b> tidak boleh kosong, bisa diisi - untuk mengosongkan !";		
	}
	if (trim($txtHalaman)=="" or ! is_numeric(trim($txtHalaman))) {
		$pesanError[] = "Data <b>Tebal Halaman</b> masih kosong, harus diisi angka !";
	}
	if (trim($txtJumlah)=="" or ! is_numeric(trim($txtJumlah))) {
		$pesanError[] = "Data <b>Jumlah Koleksi</b> masih kosong, harus diisi angka !";		
	}
	if (trim($txtTahun)=="" or ! is_numeric(trim($txtTahun))) {
		$pesanError[] = "Data <b>Tahun Terbit </b> masih kosong, harus diisi angka !";		
	}
	if (trim($txtSinopsis)=="") {
		$pesanError[] = "Data <b>Sinopsis</b> tidak boleh kosong, bisa diisi - untuk mengosongkan !";		
	}
	if (trim($cmbPenerbit)=="Kosong") {
		$pesanError[] = "Data <b>Penerbit</b> belum ada yang dipilih, silahkan pilih dulu !";		
	}
	if (trim($cmbKategori)=="Kosong") {
		$pesanError[] = "Data <b>Kategori</b> belum ada yang dipilih, silahkan pilih dulu !";		
	}

	# SKRIP MENAMPILKAN ERROR
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
		// Membuat Kode Buku baru
		$kodeBaru	= buatKode("buku", "B");

		# Mengkopi file gambar
		if (! empty($_FILES['txtNamaFile']['tmp_name'])) {
			// Simpan gambar
			$nama_file = $_FILES['txtNamaFile']['name'];
			$nama_file = stripslashes($nama_file);
			$nama_file = str_replace("'","",$nama_file);
			
			$nama_file = $kodeBaru.".".$nama_file;
			copy($_FILES['txtNamaFile']['tmp_name'],"foto/buku/".$nama_file);
		}
		else {
			$nama_file = "";
		}
		
		// Skrip menyimpan data ke tabel buku
		$mySql	= "INSERT INTO buku (kd_buku, judul, isbn, pengarang, halaman, jumlah, th_terbit, gambar, sinopsis, kd_penerbit, kd_kategori) 
						VALUES ('$kodeBaru', 
								'$txtJudul', 
								'$txtIsbn', 
								'$txtPengarang',
								'$txtHalaman',
								'$txtJumlah',
								'$txtTahun',
								'$nama_file',
								'$txtSinopsis',
								'$cmbPenerbit',
								'$cmbKategori')";
		$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?open=Buku-Add'>";
		}
		exit;
	}
} // Penutup POST
		
# VARIABEL DATA UNTUK  FORM
$dataKode		= buatKode("buku", "B");
$dataJudul		= isset($_POST['txtJudul']) ? $_POST['txtJudul'] : '';
$dataIsbn		= isset($_POST['txtIsbn']) ? $_POST['txtIsbn'] : '';
$dataPengarang	= isset($_POST['txtPengarang']) ? $_POST['txtPengarang'] : '';
$dataHalaman	= isset($_POST['txtHalaman']) ? $_POST['txtHalaman'] : '';
$dataJumlah		= isset($_POST['txtJumlah']) ? $_POST['txtJumlah'] : '';
$dataTahun		= isset($_POST['txtTahun']) ? $_POST['txtTahun'] : '';
$dataSinopsis	= isset($_POST['txtSinopsis']) ? $_POST['txtSinopsis'] : '';
$dataPenerbit	= isset($_POST['cmbPenerbit']) ? $_POST['cmbPenerbit'] : '';
$dataKategori	= isset($_POST['cmbKategori']) ? $_POST['cmbKategori'] : '';
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="form1" target="_self">
  <table  class="table-list" width="100%" border="0" cellspacing="1" cellpadding="3">
    <tr>
      <th colspan="3" scope="col">TAMBAH DATA BUKU </th>
    </tr>
    <tr>
      <td width="16%"><strong>Kode</strong></td>
      <td width="1%"><strong>:</strong></td>
      <td width="83%"><input name="textfield" value="<?php echo $dataKode; ?>" size="14" maxlength="10" readonly="readonly"/></td>
    </tr>
    <tr>
      <td><strong>Judul Buku </strong></td>
      <td><strong>:</strong></td>
      <td><input name="txtJudul" value="<?php echo $dataJudul; ?>" size="80" maxlength="100" /></td>
    </tr>
    <tr>
      <td><strong>ISBN</strong></td>
      <td><strong>:</strong></td>
      <td><input name="txtIsbn" id="txtIsbn" value="<?php echo $dataIsbn; ?>" size="30" maxlength="30" /></td>
    </tr>
    <tr>
      <td><strong>Pengarang</strong></td>
      <td><strong>:</strong></td>
      <td><input name="txtPengarang" value="<?php echo $dataPengarang; ?>" size="80" maxlength="200" /></td>
    </tr>
    <tr>
      <td><strong>Halaman</strong></td>
      <td><strong>:</strong></td>
      <td><input name="txtHalaman" value="<?php echo $dataHalaman; ?>" size="10" maxlength="4"/></td>
    </tr>
    <tr>
      <td><strong>Jumlah</strong></td>
      <td><strong>:</strong></td>
      <td><input name="txtJumlah" value="<?php echo $dataJumlah; ?>" size="10" maxlength="4"/></td>
    </tr>
    <tr>
      <td><strong>Tahun Terbit</strong></td>
      <td><strong>:</strong></td>
      <td><input name="txtTahun" value="<?php echo $dataTahun; ?>" size="10" maxlength="4"/></td>
    </tr>
    <tr>
      <td><b>Gambar</b></td>
      <td><b>:</b></td>
      <td><input name="txtNamaFile" type="file" id="txtNamaFile" size="40" /></td>
    </tr>
    <tr>
      <td><b>Sinopsis</b></td>
      <td><b>:</b></td>
      <td><textarea name="txtSinopsis" cols="50" rows="4"><?php echo $dataSinopsis; ?></textarea></td>
    </tr>
    <tr>
      <td><b>Penerbit</b></td>
      <td><b>:</b></td>
      <td><b>
        <select name="cmbPenerbit">
          <option value="Kosong">....</option>
          <?php
		// Skrip menampilkan data Penerbit ke dalam ComboBox (List/Menu)
	  $bacaSql = "SELECT * FROM penerbit ORDER BY kd_penerbit";
	  $bacaQry = mysql_query($bacaSql, $koneksidb) or die ("Gagal Query".mysql_error());
	  while ($bacaData = mysql_fetch_array($bacaQry)) {
		if ($bacaData['kd_penerbit'] == $dataPenerbit) {
			$cek = " selected";
		} else { $cek=""; }
		echo "<option value='$bacaData[kd_penerbit]' $cek> $bacaData[nm_penerbit]</option>";
	  }
	  ?>
        </select>
      </b></td>
    </tr>
    <tr>
      <td><strong>Kategori</strong></td>
      <td><strong>:</strong></td>
      <td><select name="cmbKategori">
          <option value="Kosong">....</option>
          <?php
		// Skrip menampilkan data Kategori ke dalam ComboBox (List/Menu)
	  $bacaSql = "SELECT * FROM kategori ORDER BY kd_kategori";
	  $bacaQry = mysql_query($bacaSql, $koneksidb) or die ("Gagal Query".mysql_error());
	  while ($bacaData = mysql_fetch_array($bacaQry)) {
		if ($bacaData['kd_kategori'] == $dataKategori) {
			$cek = " selected";
		} else { $cek=""; }
		echo "<option value='$bacaData[kd_kategori]' $cek> $bacaData[nm_kategori]</option>";
	  }
	  ?>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="submit" name="btnSimpan" value=" SIMPAN " style="cursor:pointer;"></td>
    </tr>
  </table>
</form>
