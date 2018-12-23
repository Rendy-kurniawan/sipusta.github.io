<?php
// Koneksi database
include_once "library/inc.seslogin.php";
include_once "library/inc.connection.php";


// Baca variabel URL browser
$kodekategori = isset($_GET['kodekategori']) ? $_GET['kodekategori'] : 'Semua'; 
// Baca variabel dari Form setelah di Post
$kodekategori = isset($_POST['cmbkategori']) ? $_POST['cmbkategori'] : $kodekategori;

// Membuat filter SQL
if ($kodekategori=="Semua") {
  // Tidak memilih user
  $filterSQL  = "";
}
else {
  // Memilih kategori
  $filterSQL  = "where user.kd_kategori='$kodekategori'";
}
# UNTUK PAGING (PEMBAGIAN HALAMAN)
$baris  = 50;
$hal  = isset($_GET['hal']) ? $_GET['hal'] : 1;
$pageSql= "SELECT * FROM kategori";
$pageQry= mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jumlah = mysql_num_rows($pageQry);
$maks = ceil($jumlah/$baris);
$mulai  = $baris * ($hal-1); 

?>
<table width="650" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td><h1>DATA KATEGORI </h1></td>
   </tr>
   <tr>
    <td>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
                 <table width="400" border="0"  class="table-list">
    <tr>
      <td colspan="3" bgcolor="#CCCCCC"><strong>FILTER DATA </strong></td>
    </tr>
    <tr>
      <td width="84"><strong> kategori </strong></td>
      <td width="5"><strong>:</strong></td>
      <td width="397"><select name="cmbkategori">
        <option value="">....</option>
        <?php
    // Skrip menampilkan data kategori ke dalam List/Menu (Combobox)
    $bacaSql = "SELECT * FROM kategori ORDER BY kd_kategori";
    $bacaQry = mysql_query($bacaSql, $koneksidb) or die ("Gagal Query".mysql_error());
    while ($bacaData = mysql_fetch_array($bacaQry)) {
    if ($bacaData['kd_kategori'] == $kodekategori) {
      $cek = " selected";
    } else { $cek=""; }
    echo "<option value='$bacaData[kd_kategori]' $cek> $bacaData[nm_kategori]</option>";
    }
    ?>
      </select>
      <input name="btnTampilkan" type="submit" value=" Tampilkan  "/></td>
    </tr>
  </table>
<?php 
  if (empty($_POST['cmbkategori'])){


  ?>
    <td align="right">
    <a href="?open=Kategori-Add" target="_self"><img src="images/btn_add_data.png" height="30" border="0"  /></a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>

  <tr>
    <td><table class="table-list"  width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <th width="4%">No</th>
        <th width="7%">Kode</th>
        <th width="75%">Nama Kategori</th>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
        </tr>
      
      
              
    
  <?php
  // Skrip menampilkan data kategori
  $mySql = "SELECT * FROM kategori ORDER BY kd_kategori ASC LIMIT $mulai, $baris";
  $myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
  $nomor = 0; 
  while ($myData = mysql_fetch_array($myQry)) {
    $nomor++;
    $Kode = $myData['kd_kategori'];
  ?>
  
   <tr>
        <td> <?php echo $nomor; ?> </td>
        <td> <?php echo $myData['kd_kategori']; ?> </td>
        <td> <?php echo $myData['nm_kategori']; ?> </td>
        <td width="7%" align="center"><a href="?open=Kategori-Delete&Kode=<?php echo $Kode; ?>" target="_self" onclick="return confirm(' YAKIN INGIN MENGHAPUS DATA KATEGORI INI ... ?')">Delete</a></td>
        <td width="7%" align="center"><a href="?open=Kategori-Edit&Kode=<?php echo $Kode; ?>" target="_self">Edit</a></td>
      </tr>
   <?php } ?>

<?php }else { ?>
   <td align="left">
   <a href="?open=User-Add" target="_self"><img src="images/btn_add_data.png" height="30" border="0"  /></a></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
  <table class="table-list"  width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <th width="4%">No</th>
        <th width="7%">Kode</th>
        <th width="75%">Nama Kategori</th>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
        </tr>
      
              
    
   <?php
   // Menampilkan data Kategori
  $mySql = "SELECT * FROM kategori where kd_kategori = '$_POST[cmbkategori]' ORDER BY kd_kategori ASC LIMIT $mulai, $baris";
  $myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
  $nomor = 0; 
  while ($myData = mysql_fetch_array($myQry)) {
    $nomor++;
    $Kode = $myData['kd_kategori'];
  ?>
      <tr>
        <td> <?php echo $nomor; ?> </td>
        <td> <?php echo $myData['kd_kategori']; ?> </td>
        <td> <?php echo $myData['nm_kategori']; ?> </td>
        <td width="9%" align="center"><a href="?open=Kategori-Delete&Kode=<?php echo $Kode; ?>" target="_self" onclick="return confirm(' YAKIN INGIN MENGHAPUS DATA KATEGORI INI ... ?')">Delete</a></td>
        <td width="7%" align="center"><a href="?open=Kategori-Edit&Kode=<?php echo $Kode; ?>" target="_self">Edit</a></td>
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
  echo " <a href='?open=User-Data&hal=".$h."'>".$h."</a> ";
    //echo $h ; kodeUser=$kodeUser 
       // na masalahnya sekarang di kduseer ,.,itu yang membuat error
       // itu pak yg sercing nya kok gk mau ya pak saya klik nama user dia gk mau milih??
      }
  ?> </td>
  </tr>