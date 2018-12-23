<?php
include_once "library/inc.seslogin.php";
include_once "library/inc.connection.php";
include_once "library/inc.library.php"; 
// Baca variabel URL browser
$kodeKategori = isset($_GET['kodeKategori']) ? $_GET['kodeKategori'] : 'Semua'; 
// Baca variabel dari Form setelah di Post
$kodeKategori = isset($_POST['cmbKategori']) ? $_POST['cmbKategori'] : $kodeKategori;

// Membuat filter SQL
if ($kodeKategori=="Semua") {
  // Tidak memilih kategori
  $filterSQL  = "";
}
else {
  // Memilih kategori
  $filterSQL  = " WHERE buku.kd_kategori='$kodeKategori'";
}
# UNTUK PAGING (PEMBAGIAN HALAMAN)
$baris	= 50;
$hal 	= isset($_GET['hal']) ? $_GET['hal'] : 1;
$infoSql= "SELECT * FROM buku $filterSQL";
$infoQry= mysql_query($infoSql, $koneksidb) or die ("error paging: ".mysql_error());
$jumlah	= mysql_num_rows($infoQry);
$maks	= ceil($jumlah/$baris);
$mulai	= $baris * ($hal-1); 
?>
<table width="900" border="0" cellpadding="2" cellspacing="1" class="table-border">
  <tr>
    <td colspan="2"><h1><b> DATA BUKU </b></h1></td>
  </tr>
  <tr>
    <td colspan="2">
	<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
  <table width="400" border="0"  class="table-list">
    <tr>
      <td colspan="3" bgcolor="#CCCCCC">
        <strong>FILTER DATA</strong></td>
    </tr>
    <tr>
      <td width="84"><strong> Kategori </strong></td>
      <td width="5"><strong>:</strong></td>
      <td width="397"><select name="cmbKategori">
        <option value="Semua">....</option>
        <?php
		// Skrip menampilkan data Kategori ke dalam List/Menu (Combobox)
	  $bacaSql = "SELECT * FROM kategori ORDER BY kd_kategori";
	  $bacaQry = mysql_query($bacaSql, $koneksidb) or die ("Gagal Query".mysql_error());
	  while ($bacaData = mysql_fetch_array($bacaQry)) {
		if ($bacaData['kd_kategori'] == $kodeKategori) {
			$cek = " selected";
		} else { $cek=""; }
		echo "<option value='$bacaData[kd_kategori]' $cek> $bacaData[nm_kategori]</option>";
	  }
	  ?>
      </select>


      <input name="btnTampilkan" type="submit" value=" Tampilkan  "/> </td>
    </tr>
  </table>

            
  <!--<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
  <table width="500" border="0"  class="table-list">
    <tr>
      <td colspan="3" bgcolor="#F5F5F5"><strong>FILTER DATA </strong></td>
    </tr>
    <tr>
      <td width="84"><strong> Penerbit </strong></td>
      <td width="5"><strong>:</strong></td>
      <td width="397"><select name="cmbPenerbit">
        <option value="Semua">....</option>
        <?php
    // Skrip menampilkan data Penerbit ke dalam List/Menu (Combo)
    $bacaSql = "SELECT * FROM penerbit ORDER BY kd_penerbit";
    $bacaQry = mysql_query($bacaSql, $koneksidb) or die ("Gagal Query".mysql_error());
    while ($bacaData = mysql_fetch_array($bacaQry)) {
    if ($bacaData['kd_penerbit'] == $kodePenerbit) {
      $cek = " selected";
    } else { $cek=""; }
    echo "<option value='$bacaData[kd_penerbit]' $cek>$bacaData[nm_penerbit]</option>";
    }
    ?>
      </select>
      <input name="btnTampilkan" type="submit" value=" Tampilkan  "/></td>
    </tr>
  </table>
-->
</form>	</td>
  </tr>
  <tr>
    <td colspan="2" align="left"><a href="?open=Buku-Add" target="_self"><img src="images/btn_add_data.png" height="30" border="0" /></a></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
	<table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr>
        <th width="21" align="center">No</th>
        <th width="49">Kode</th>
        <th width="513">Judul Buku</th>
        <th width="70">Th Terbit </th>
        <th width="60" align="right">Halaman</th>
        <th width="50" align="right">Jumlah</th>
        <td colspan="3" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
      </tr>
	<?php
	// Skrip menampilkan data Buku ke layar
	$mySql = "SELECT * FROM buku $filterSQL ORDER BY kd_buku ASC LIMIT $mulai, $baris";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = $mulai; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['kd_buku'];

	?>
      <tr>
        <td> <?php echo $nomor; ?> </td>
        <td> <?php echo $myData['kd_buku']; ?> </td>
        <td> <?php echo $myData['judul']; ?> </td>
        <td align="right"> <?php echo $myData['th_terbit']; ?> </td>
        <td align="right"> <?php echo $myData['halaman']; ?> </td>
         <td align="right"> <?php echo $myData['jumlah']; ?> </td>
        <td width="45" align="center"><a href="?open=Buku-Delete&Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA BUKU INI ... ?')">Delete</a></td>
         <td width="45" align="center"><a href="?open=Buku-Edit&Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data">Edit</a></td>
         <td width="45" align="center"><a href="cetak/buku_cetak.php?Kode=<?php echo $Kode; ?>" target="_blank">Cetak</a></td>
      </tr>
      <?php } ?>
    </table></td>
  </tr>

  

  <tr class="selKecil">
    <td width="393"><strong>Jumlah Data :</strong> <?php echo $jumlah; ?> </td>
    <td width="496" align="right"><strong>Halaman ke :</strong>
      <?php
	for ($h = 1; $h <= $maks; $h++) {
		echo " <a href='?open=Buku-Data&hal=$h&kodeKategori=$kodeKategori'>$h</a> ";
	}
	?> </td>
  </tr>
</table>

