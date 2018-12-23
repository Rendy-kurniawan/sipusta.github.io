<?php
include_once "library/inc.seslogin.php";
include_once "library/inc.connection.php";
include_once "library/inc.library.php"; 

// Baca variabel URL browser
$kodeuser = isset($_GET['kodeuser']) ? $_GET['kodeuser'] : 'Semua'; 
// Baca variabel dari Form setelah di Post
$kodeuser = isset($_POST['cmbuser']) ? $_POST['cmbuser'] : $kodeuser;

// Membuat filter SQL
if ($kodeuser=="Semua") {
  // Tidak memilih user
  $filterSQL  = "";
}
else {
  // Memilih user
  $filterSQL  = "where user.kd_user='$kodeuser'";
}


# UNTUK PAGING (PEMBAGIAN HALAMAN)
$baris	= 50;
$hal 	= isset($_GET['hal']) ? $_GET['hal'] : 1;
$infoSql= "SELECT * FROM user $filterSQL";
$infoQry= mysql_query($infoSql, $koneksidb) or die ("error paging: ".mysql_error());
$jumlah	= mysql_num_rows($infoQry);
$maks	= ceil($jumlah/$baris);
$mulai	= $baris * ($hal-1);

?>
<table width="650" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td><h1>DATA USER </h1></td>
   </tr>
   <tr>
    <td>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
                 <table width="400" border="0"  class="table-list">
    <tr>
      <td colspan="3" bgcolor="#CCCCCC"><strong>FILTER DATA </strong></td>
    </tr>
    <tr>
      <td width="84"><strong> user </strong></td>
      <td width="5"><strong>:</strong></td>
      <td width="397"><select name="cmbuser">
        <option value="">....</option>
        <?php
		// Skrip menampilkan data user ke dalam List/Menu (Combobox)
	  $bacaSql = "SELECT * FROM user ORDER BY kd_user";
	  $bacaQry = mysql_query($bacaSql, $koneksidb) or die ("Gagal Query".mysql_error());
	  while ($bacaData = mysql_fetch_array($bacaQry)) {
		if ($bacaData['kd_user'] == $kodeuser) {
			$cek = " selected";
		} else { $cek=""; }
		echo "<option value='$bacaData[kd_user]' $cek> $bacaData[nm_user]</option>";
	  }
	  ?>
      </select>
      <input name="btnTampilkan" type="submit" value=" Tampilkan  "/></td>
    </tr>
  </table>
<?php 
  if (empty($_POST['cmbuser'])){


  ?>
    <td align="right">
    <a href="?open=User-Add" target="_self"><img src="images/btn_add_data.png" height="30" border="0"  /></a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>

  <tr>
    <td><table class="table-list"  width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="4%" bgcolor="#CCCCCC"><strong>No</strong></td>
        <td width="7%" bgcolor="#CCCCCC"><strong>Kode</strong></td>
        <td width="54%" bgcolor="#CCCCCC"><strong>Nama User </strong></td>
        <td width="19%" bgcolor="#CCCCCC"><strong>Username</strong></td>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
        </tr>

      
              
		
	<?php
	// Skrip menampilkan data User
	$mySql 	= "SELECT * FROM user ORDER BY kd_user ASC";
	$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query  salah : ".mysql_error());
	$nomor  = 0; 
	while ($myData = mysql_fetch_array($myQry)) { // itu tutup kurawalnya dimana ?
		                                           // iyy dmna y pak? kamu pakai notepad++ lah soalnya ga kedeteksi antara awal dan tutup
		$nomor++;
		$Kode = $myData['kd_user'];
	?>
	
	  <tr>
		<td> <?php echo $nomor; ?> </td>
		<td> <?php echo $myData['kd_user']; ?> </td>
		<td> <?php echo $myData['nm_user']; ?> </td>
		<td> <?php echo $myData['username']; ?> </td>
		<td width="8%"><a href="?open=User-Delete&Kode=<?php echo $Kode; ?>" target="_self" 
					onclick="return confirm('YAKIN AKAN MENGHAPUS DATA USER INI ... ?')">Delete</a></td>
	     <td width="8%"><a href="?open=User-Edit&Kode=<?php echo $Kode; ?>" target="_self">Edit</a></td>
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
        <td width="4%" bgcolor="#CCCCCC"><strong>No</strong></td>
        <td width="7%" bgcolor="#CCCCCC"><strong>Kode</strong></td>
        <td width="54%" bgcolor="#CCCCCC"><strong>Nama User </strong></td>
        <td width="19%" bgcolor="#CCCCCC"><strong>Username</strong></td>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
        </tr>

      
              
		
	<?php
	// Skrip menampilkan data User
	$mySql 	= "SELECT * FROM user where kd_user = '$_POST[cmbuser]' ORDER BY kd_user ASC";
	$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query  salah : ".mysql_error());
	$nomor  = 0; 
	while ($myData = mysql_fetch_array($myQry)) { 
        $nomor++;
		$Kode = $myData['kd_user'];
	?>
	
	  <tr>
		<td> <?php echo $nomor; ?> </td>
		<td> <?php echo $myData['kd_user']; ?> </td>
		<td> <?php echo $myData['nm_user']; ?> </td>
		<td> <?php echo $myData['username']; ?> </td>
		<td width="8%"><a href="?open=User-Delete&Kode=<?php echo $Kode; ?>" target="_self" 
					onclick="return confirm('YAKIN AKAN MENGHAPUS DATA USER INI ... ?')">Delete</a></td>
	     <td width="8%"><a href="?open=User-Edit&Kode=<?php echo $Kode; ?>" target="_self">Edit</a></td>
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
  </tr>
</table>
