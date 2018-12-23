<?php
include_once "../library/inc.connection.php"; 
include_once "../library/inc.library.php";

# Status Terpilih
$stts		= isset($_GET['stts']) ? $_GET['stts'] : 'Pinjam';  
$dataStatus = isset($_POST['cmbStatus']) ? $_POST['cmbStatus'] : $stts;  

// Filter Status
if($dataStatus =="Semua") {
	$filterSQL	= "";
}
else {
	$filterSQL	= "WHERE status='$dataStatus'";
}

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$baris	= 50;
$hal 	= isset($_GET['hal']) ? $_GET['hal'] : 1;
$pageSql= "SELECT * FROM peminjaman $filterSQL";
$pageQry= mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jumlah	= mysql_num_rows($pageQry);
$maks	= ceil($jumlah/$baris);
$mulai	= $baris * ($hal-1); 
?>
<table width="800" border="0" cellpadding="2" cellspacing="1" class="table-border">
  <tr>
    <td colspan="2" align="right"><h1><b>DATA PEMINJAMAN </b></h1></td>
  </tr>
  <tr>
    <td colspan="2">

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
  <table width="400" border="0"  class="table-list">
    <tr>
      <td width="130" bgcolor="#CCCCCC"><strong>FILTER DATA </strong></td>
      <td colspan="2">&nbsp;</td>
      </tr>
    <tr>
      <td><strong>Status</strong></td>
      <td width="5"><strong>:</strong></td>
      <td width="351"><select name="cmbStatus">
        <option value="Semua">....</option>
        <?php
		// Skrip menampilkan daftar Pilihan Status ke Combobox(List/Menu)
		  $pilihan	= array("Pinjam", "Kembali");
          foreach ($pilihan as $nilai) {
            if ($nilai == $dataStatus) {
                $cek=" selected";
            } else { $cek = ""; }
            echo "<option value='$nilai' $cek> $nilai</option>";
          }
          ?>
      </select>
        <input name="btnTampil" type="submit" value=" Tampilkan " /></td>
    </tr>
  </table>
</form>

	</td>
  </tr>
  <tr>
    <td colspan="2">
	<table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr>
        <th width="21" align="center">No</th>
        <th width="80">No. Pinjam </th>
        <th width="80">Tgl. Pinjam </th>
        <th width="65">Kode</th>
        <th width="98">NIS</th>
        <th width="250">Nama Siswa </th>
        <th width="64">Status</th>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
      </tr>
      <?php
	  // Skrip menampilkan data Pinjam
	$mySql = "SELECT peminjaman.*, siswa.nisn, siswa.nm_siswa
				FROM peminjaman 
				LEFT JOIN siswa ON peminjaman.kd_siswa = siswa.kd_siswa
				$filterSQL
				ORDER BY peminjaman.no_pinjam DESC LIMIT $mulai, $baris";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = $mulai; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['no_pinjam'];
		
		if($nomor%2==1) { $warna=""; } else {$warna="#F5F5F5";}
	?>
	  <tr bgcolor="<?php echo $warna; ?>">
        <td><?php echo $nomor; ?></td>
        <td><?php echo $myData['no_pinjam']; ?></td>
        <td><?php echo IndonesiaTgl($myData['tgl_pinjam']); ?></td>
        <td><?php echo $myData['kd_siswa']; ?></td>
        <td><?php echo $myData['nisn']; ?></td>
        <td><?php echo $myData['nm_siswa']; ?></td>
        <td><?php echo $myData['status']; ?></td>
        <td width="42" align="center"><a href="nota_pinjam.php?Kode=<?php echo $Kode; ?>" target="_blank">Nota</a></td>
        <td width="42"><a href="?open=Peminjaman-Batal&Kode=<?php echo $Kode; ?>" target="_self" 
            onclick="return confirm('YAKIN INGIN MENGHAPUS DATA PEMINJAMAN INI ... ?')">Batal</a></td>
  </tr>
      <?php } ?>
    </table></td>
  </tr>
  <tr class="selKecil">
    <td width="344"><b>Jumlah Data :</b> <?php echo $jumlah; ?></td>
    <td width="535" align="right"><b>Halaman ke :</b>
    <?php
	for ($h = 1; $h <= $maks; $h++) {
		echo " <a href='?open=Peminjaman-Tampil&hal=$h&stts=$dataStatus'>$h</a> ";
	}
	?></td>
  </tr>
</table>
