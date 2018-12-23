<?php
// Koneksi database
include_once "library/inc.seslogin.php";
include_once "library/inc.connection.php";
include_once "library/inc.library.php"; 

// Baca variabel URL browser
$kodepenerbit = isset($_GET['kodepenerbit']) ? $_GET['kodepenerbit'] : 'Semua'; 
// Baca variabel dari Form setelah di Post
$kodepenerbit = isset($_POST['cmbpenerbit']) ? $_POST['cmbpenerbit'] : $kodepenerbit;

// Membuat filter SQL
if ($kodepenerbit=="Semua") {
  // Tidak memilih user
  $filterSQL  = "";
}
else {
  // Memilih penerbit
  $filterSQL  = "where user.kd_penerbit='$kodepenerbit'";
}


?>
<table width="650" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td><h1>DATA PENERBIT </h1></td>
   </tr>
   <tr>
    <td>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
                 <table width="400" border="0"  class="table-list">
    <tr>
      <td colspan="3" bgcolor="#CCCCCC"><strong>FILTER DATA </strong></td>
    </tr>
    <tr>
      <td width="84"><strong> penerbit </strong></td>
      <td width="5"><strong>:</strong></td>
      <td width="397"><select name="cmbpenerbit">
        <option value="">....</option>-->




       <?php
		// Skrip menampilkan data user ke dalam List/Menu (Combobox)
	  $bacaSql = "SELECT * FROM penerbit ORDER BY kd_penerbit";
	  $bacaQry = mysql_query($bacaSql, $koneksidb) or die ("Gagal Query".mysql_error());
	  while ($bacaData = mysql_fetch_array($bacaQry)) {
		if ($bacaData['kd_penerbit'] == $kodepenerbit) {
			$cek = " selected";
		} else { $cek=""; }
		echo "<option value='$bacaData[kd_penerbit]' $cek> $bacaData[nm_penerbit]</option>";
	  }
	  ?>
      </select>
      <input name="btnTampilkan" type="submit" value=" Tampilkan  "/></td>
    </tr>
  </table>
<?php 
  if (empty($_POST['cmbpenerbit'])){


  ?>
    <td align="right">
    <a href="?open=Penerbit-Add" target="_self"><img src="images/btn_add_data.png" height="30" border="0"  /></a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>

  <tr>
    <td><table class="table-list"  width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <th width="4%">No</th>
        <th width="7%">Kode</th>
        <th width="75%">Nama Penerbit</th>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
        </tr>
      
      
              
		
	<?php
	// Skrip menampilkan data Penerbit
	$mySql 	= "SELECT * FROM penerbit ORDER BY kd_penerbit ASC";
	$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query  salah : ".mysql_error());
	$nomor  = 0; 
	while ($myData = mysql_fetch_array($myQry)) { // itu tutup kurawalnya dimana ?
		                                           // iyy dmna y pak? kamu pakai notepad++ lah soalnya ga kedeteksi antara awal dan tutup
		$nomor++;
		$Kode = $myData['kd_penerbit'];
	?>
	
	  <tr>
        <td> <?php echo $nomor; ?> </td>
        <td> <?php echo $myData['kd_penerbit']; ?> </td>
        <td> <?php echo $myData['nm_penerbit']; ?> </td>
        <td width="7%" align="center"><a href="?open=Penerbit-Delete&Kode=<?php echo $Kode; ?>" target="_self" onclick="return confirm('YAKIN INGIN MENGHAPUS DATA PENERBIT INI ... ?')">Delete</a></td>
        <td width="7%" align="center"><a href="?open=Penerbit-Edit&Kode=<?php echo $Kode; ?>" target="_self">Edit</a></td>
	 <?php } ?>

<?php }else { ?>
   <td align="left">
   <a href="?open=User-Add" target="_self"><img src="images/btn_add_data.png" height="30" border="0"  /></a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>

  <tr>
    <td><table class="table-list"  width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <th width="4%">No</th>
        <th width="7%">Kode</th>
        <th width="75%">Nama Penerbit</th>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
        </tr>
      
              
		
	 <?php
	  // Menampilkan data Penerbit
	$mySql = "SELECT * FROM penerbit where kd_penerbit = '$_POST[cmbpenerbit]' ORDER BY kd_penerbit ASC";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['kd_penerbit'];
	?>
	
	  <tr>
        <td> <?php echo $nomor; ?> </td>
        <td> <?php echo $myData['kd_penerbit']; ?> </td>
        <td> <?php echo $myData['nm_penerbit']; ?> </td>
        <td width="7%" align="center"><a href="?open=Penerbit-Delete&Kode=<?php echo $Kode; ?>" target="_self" onclick="return confirm('YAKIN INGIN MENGHAPUS DATA PENERBIT INI ... ?')">Delete</a></td>
        <td width="7%" align="center"><a href="?open=Penerbit-Edit&Kode=<?php echo $Kode; ?>" target="_self">Edit</a></td>
	 <?php } } ?>


	  </tr>
	 <tr class="selKecil">
    <!--<td width="393"><strong>Jumlah Data :</strong> <?php echo $jumlah; ?> </td>
    <td width="496" align="right"><strong>Halaman ke :</strong>
      <?php // ini coding kamu yang tambahin ?? fungsinha buat apa ??
            // buat filter data user serccing gtu pak?
              // kamu yang coding ??
            //  y   ak,.hahah pantes.,.gooling murni ya,.,
            // sebagian pakk..
       //// kamu searching kok pake looping ,.itu masalanya ,., 
	for ($h = 1; $h <= $maks; $h++) {
	echo " <a href='?open=User-Data&hal=".$h."'>".$h."</a> ";
		//echo $h ; kodeUser=$kodeUser 
	     // na masalahnya sekarang di kduseer ,.,itu yang membuat error
	     // itu pak yg sercing nya kok gk mau ya pak saya klik nama user dia gk mau milih??
      }
	?> </td>
  </tr>1