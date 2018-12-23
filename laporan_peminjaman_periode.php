<?php
include_once "library/inc.connection.php";
include_once "library/inc.library.php";
include_once "library/inc.pilihan.php";

// Membaca data tanggal dari form
$tanggal_1 	= isset($_POST['cmbTanggal_1']) ? $_POST['cmbTanggal_1'] : "01-".date('m-Y');
$tanggal_1	= InggrisTgl($tanggal_1);

$tanggal_2 	= isset($_POST['cmbTanggal_2']) ? $_POST['cmbTanggal_2'] : date('d-m-Y'); 
$tanggal_2	= InggrisTgl($tanggal_2);

// Membuat sub SQL filter data 
$filterSQL = " WHERE ( peminjaman.tgl_pinjam BETWEEN '$tanggal_1' AND '$tanggal_2') ";
?>
<h2>LAPORAN  PEMINJAMAN PER PERIODE </h2>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
  <table width="550" border="0"  class="table-list">
    <tr>
      <td colspan="3" bgcolor="#CCCCCC"><strong>FILTER DATA </strong></td>
    </tr>
    <tr>
      <td width="87"><strong>Periode </strong></td>
      <td width="5"><strong>:</strong></td>
      <td width="444"><input name="cmbTanggal_1" type="text" class="tcal" value="<?php echo $tanggal_1; ?>" />
        s/d
      <input name="cmbTanggal_2" type="text" class="tcal" value="<?php echo $tanggal_2; ?>" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input name="btnTampil" type="submit" value=" Tampilkan " /></td>
    </tr>
  </table>
</form>
<table class="table-list" width="700" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td width="20" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="85" bgcolor="#CCCCCC"><strong>No. Pinjam </strong></td>
    <td width="100" bgcolor="#CCCCCC"><strong>Tgl. Pinjam </strong></td>
    <td width="207" bgcolor="#CCCCCC"><strong>Siswa</strong></td>
    <td width="200" bgcolor="#CCCCCC"><strong>Keterangan</strong></td>
    <td width="45" bgcolor="#CCCCCC"><strong>Status</strong></td>
  </tr>
  
<?php 
// Skrip menampilkan data Peminjaman dengan filter Bulan
$mySql = "SELECT peminjaman.*, siswa.nisn, siswa.nm_siswa FROM peminjaman 
			LEFT JOIN siswa ON peminjaman.kd_siswa = siswa.kd_siswa
			$filterSQL ORDER BY peminjaman.no_pinjam ASC";
$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
$nomor = 0;  
while ($myData = mysql_fetch_array($myQry)) {
	$nomor++;		
?>

  <tr>
    <td> <?php echo $nomor; ?> </td>
    <td> <?php echo $myData['no_pinjam']; ?> </td>
    <td> <?php echo IndonesiaTgl($myData['tgl_pinjam']); ?> </td>
    <td> <?php echo $myData['nisn']."/ ".$myData['nm_siswa']; ?> </td>
    <td> <?php echo $myData['keterangan']; ?> </td>
    <td> <?php echo $myData['status']; ?> </td>
  </tr>

<?php } ?>
</table>
