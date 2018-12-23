<?php
include_once "library/inc.seslogin.php";
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

// Baca variabel URL browser
$kodesiswa = isset($_GET['kodesiswa']) ? $_GET['kodesiswa'] : 'Semua'; 
// Baca variabel dari Form setelah di Post
$kodesiswa = isset($_POST['cmbsiswa']) ? $_POST['cmbsiswa'] : $kodesiswa;

// Membuat filter SQL
if ($kodesiswa=="Semua") {
  // Tidak memilih siswa
  $filterSQL  = "";
}
else {
  // Memilih siswa
  $filterSQL  = "where siswa.kd_siswa='$kodesiswa'";
}

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$baris	= 50;
$hal 	= isset($_GET['hal']) ? $_GET['hal'] : 1;
$infoSql= "SELECT * FROM siswa";
$infoQry= mysql_query($infoSql, $koneksidb) or die ("error paging: ".mysql_error());
$jumlah	= mysql_num_rows($infoQry);
$maks	= ceil($jumlah/$baris);
$mulai	= $baris * ($hal-1); 
?><table width="900" border="0" cellpadding="2" cellspacing="1" class="table-border">
  <tr>
    <td colspan="2"><h1><b> DATA SISWA </b></h1></td>
  </tr>
  <tr>
  <td>
  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
                 <table width="400" border="0"  class="table-list">
    <tr>
      <td colspan="3" bgcolor="#CCCCCC"><strong>FILTER DATA </strong></td>
    </tr>
    <tr>
      <td width="100"><strong> SISWA </strong></td>
      <td width="3"><strong>:</strong></td>
      <td width="398"><select name="cmbsiswa">
        <option value="">....</option>
        <?php
    // Skrip menampilkan data siswa ke dalam List/Menu (Combobox)
    $bacaSql = "SELECT * FROM siswa ORDER BY kd_siswa";
    $bacaQry = mysql_query($bacaSql, $koneksidb) or die ("Gagal Query".mysql_error());
    while ($bacaData = mysql_fetch_array($bacaQry)) {
    if ($bacaData['kd_siswa'] == $kodesiswa) {
      $cek = " selected";
    } else { $cek=""; }
    echo "<option value='$bacaData[kd_siswa]' $cek> $bacaData[nm_siswa]</option>";
    }
    ?>
      </select>
      <input name="btnTampilkan" type="submit" value=" Tampilkan  "/></td>
    </tr>
  </table>
<?php 
  if (empty($_POST['cmbsiswa'])){


  ?>
   <td align="right">
    <a href="?open=siswa-Add" target="_self"><img src="images/btn_add_data.png" height="30" border="0"  /></a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>

  <tr>
    <td><table class="table-list"  width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <th width="22" align="center">No</th>
        <th width="43">Kode</th>
        <th width="69">NISN</th>
        <th width="170">Nama Siswa</th>
        <th width="34">L/P </th>
        <th width="280">Alamat</th>
        <th width="104">No. Telepon </th>
        <td colspan="3" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
      </tr>
   <?php
  // Skrip menampilkan data Siswa ke layar
  $mySql = "SELECT * FROM siswa ORDER BY kd_siswa ASC LIMIT $mulai, $baris";
  $myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
  $nomor  = $mulai; 
  while ($myData = mysql_fetch_array($myQry)) {
    $nomor++;
    $Kode = $myData['kd_siswa'];
  ?>
      <tr>
        <td> <?php echo $nomor; ?> </td>
        <td> <?php echo $myData['kd_siswa']; ?> </td>
        <td> <?php echo $myData['nisn']; ?> </td>
        <td> <?php echo $myData['nm_siswa']; ?> </td>
        <td> <?php echo $myData['kelamin']; ?> </td>
        <td> <?php echo $myData['alamat']; ?> </td>
         <td> <?php echo $myData['no_telepon']; ?> </td>
        <td width="40" align="center"><a href="?open=Siswa-Delete&Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA SISWA INI ... ?')">Delete</a></td>
         <td width="41" align="center"><a href="?open=Siswa-Edit&Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data">Edit</a></td>
         <td width="40" align="center"><a href="cetak/siswa_cetak.php?Kode=<?php echo $Kode; ?>" target="_blank">Cetak</a></td>
      </tr>
      <?php } ?>
    </table></td>

<?php }else { ?>

   <a href="?open=user-Add" target="_self"><img src="images/btn_add_data.png" height="30" border="0"  /></a></td>
  </tr>
  <tr>
    <td colspan="2">
  <table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr>
        <th width="22" align="center">No</th>
        <th width="43">Kode</th>
        <th width="69">NISN</th>
        <th width="170">Nama Siswa</th>
        <th width="34">L/P </th>
        <th width="280">Alamat</th>
        <th width="104">No. Telepon </th>
        <td colspan="3" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
      </tr>
              
    
  <?php
  // Skrip menampilkan data Siswa ke layar
  $mySql = "SELECT * FROM siswa where kd_siswa = '$_POST[cmbsiswa]' ORDER BY kd_siswa ASC LIMIT $mulai, $baris";
  $myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
  $nomor  = $mulai; 
  while ($myData = mysql_fetch_array($myQry)) {
    $nomor++;
    $Kode = $myData['kd_siswa'];
  ?>
      <tr>
        <td> <?php echo $nomor; ?> </td>
        <td> <?php echo $myData['kd_siswa']; ?> </td>
        <td> <?php echo $myData['nisn']; ?> </td>
        <td> <?php echo $myData['nm_siswa']; ?> </td>
        <td> <?php echo $myData['kelamin']; ?> </td>
        <td> <?php echo $myData['alamat']; ?> </td>
         <td> <?php echo $myData['no_telepon']; ?> </td>
        <td width="40" align="center"><a href="?open=Siswa-Delete&Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA SISWA INI ... ?')">Delete</a></td>
         <td width="41" align="center"><a href="?open=Siswa-Edit&Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data">Edit</a></td>
         <td width="40" align="center"><a href="cetak/siswa_cetak.php?Kode=<?php echo $Kode; ?>" target="_blank">Cetak</a></td>
      </tr>
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
  echo " <a href='?open=SISWA-Data&hal=".$h."'>".$h."</a> ";
    //echo $h ; kodeUser=$kodeUser 
       // na masalahnya sekarang di kduseer ,.,itu yang membuat error
       // itu pak yg sercing nya kok gk mau ya pak saya klik nama user dia gk mau milih??
      }
  ?> </td>
  </tr>1