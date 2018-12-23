<?php
# KONTROL MENU PROGRAM
if(isset($_GET['open'])) {
	// Jika mendapatkan variabel URL ?open
	switch($_GET['open']){
        case '' :
			if(!file_exists ("info.php")) die (" wellcome!"); 
			include "info.php";	break;
			
		case 'Halaman-Utama' :
			if(!file_exists ("main.php")) die ("<h2><b>Wellcome!!! Selamat Bekerja</b></h2>");
			include "main.php";	break;
			?>
		  



            <!-- menu tengah -->
            <center>
        ~ Silahkan pilih Panel Dibawah ini ~
        </center>
        </div>
        
		<div class="table_home">
          <table width="100%" height="100%" align="center" cellpadding="2" border="0">
          	<div align="center">
			<img src="profil/sekolah.jpg" align="center" width="400" height="350">
			</div>	
          	<tbody>
            	<tr>
                	<td class="img_home" align="center"><a href="?page=buku"><img src="../image/buku.png" width="100" height="100"></a><br />
                    <center>Data Buku</center></td>
                    <td class="img_home" align="center"><a href="?page=anggota"><img src="../image/anggota.png" width="100" height="100"></a><br /><center>Anggota</center></td>
                    <td class="img_home" align="center"><a href="?page=transaksi"><img src="../image/user.ico" width="100" height="100"></a></a><br /><center>Transaksi</center></td>
                    <td class="img_home" align="center"><a href="?page=laporan"><img src="../image/laporan.png" width="100" height="100"></a><br /><center>Laporan</center></td>
                </tr>

               
			<?php
		echo "";

			
		case 'Login' :
			if(!file_exists ("login.php")) die ("wellcome !"); 
			include "login.php"; break;
			
		case 'Login-Validasi' :
			if(!file_exists ("login_validasi.php")) die ("wellcome  !"); 
			include "login_validasi.php"; break;
			
		case 'Logout' :
			if(!file_exists ("login_out.php")) die ("wellcome !"); 
			include "login_out.php"; break;	



		# USER
		case 'User-Data' :
			if(!file_exists ("user_data.php")) die (" !"); 
			include "user_data.php";	 break;		
		case 'User-Add' :
			if(!file_exists ("user_add.php")) die (" !"); 
			include "user_add.php";	 break;		
		case 'User-Delete' :
			if(!file_exists ("user_delete.php")) die (" !"); 
			include "user_delete.php"; break;		
		case 'User-Edit' :
			if(!file_exists ("user_edit.php")) die (" !"); 
			include "user_edit.php"; break;	

		# PENERBIT
		case 'Penerbit-Data' :
			if(!file_exists ("penerbit_data.php")) die (" !"); 
			include "penerbit_data.php"; break;		
		case 'Penerbit-Add' :
			if(!file_exists ("penerbit_add.php")) die (" !"); 
			include "penerbit_add.php";	break;		
		case 'Penerbit-Delete' :
			if(!file_exists ("penerbit_delete.php")) die (" !"); 
			include "penerbit_delete.php"; break;		
		case 'Penerbit-Edit' :
			if(!file_exists ("penerbit_edit.php")) die (" !"); 
			include "penerbit_edit.php"; break;	

		# KATEGORI 
		case 'Kategori-Data' :
			if(!file_exists ("kategori_data.php")) die (" !"); 
			include "kategori_data.php"; break;		
		case 'Kategori-Add' :
			if(!file_exists ("kategori_add.php")) die (" !"); 
			include "kategori_add.php";	break;		
		case 'Kategori-Delete' :
			if(!file_exists ("kategori_delete.php")) die (" !"); 
			include "kategori_delete.php"; break;		
		case 'Kategori-Edit' :
			if(!file_exists ("kategori_edit.php")) die (" !"); 
			include "kategori_edit.php"; break;	

			
		# BUKU
		case 'Buku-Data' :
			if(!file_exists ("buku_data.php")) die (" !"); 
			include "buku_data.php"; break;		
		case 'Buku-Add' :
			if(!file_exists ("buku_add.php")) die (" !"); 
			include "buku_add.php"; break;		
		case 'Buku-Delete' :
			if(!file_exists ("buku_delete.php")) die ("File tidak ada !"); 
			include "buku_delete.php"; break;		
		case 'Buku-Edit' :
			if(!file_exists ("buku_edit.php")) die ("File tidak ada !"); 
			include "buku_edit.php"; break;
			
		case 'Pencarian-Buku' :
			if(!file_exists ("pencarian_buku.php")) die ("File tidak ada !"); 
			include "pencarian_buku.php"; break;		

		# SISWA
		case 'Siswa-Data' :
			if(!file_exists ("siswa_data.php")) die ("File tidak ada !"); 
			include "siswa_data.php"; break;		
		case 'siswa-Add' :
			if(!file_exists ("siswa_add.php")) die ("File tidak ada !"); 
			include "siswa_add.php"; break;
		case 'Siswa-Delete' :
			if(!file_exists ("siswa_delete.php")) die ("File tidak ada !"); 
			include "siswa_delete.php"; break;
		case 'Siswa-Edit' :
			if(!file_exists ("siswa_edit.php")) die ("File tidak ada !"); 
			include "siswa_edit.php"; break;
			

		# PENGADAAN
		case 'Pengadaan-Data' :
			if(!file_exists ("pengadaan_data.php")) die ("File tidak ada !"); 
			include "pengadaan_data.php"; break;
		case 'Pengadaan-Add' :
			if(!file_exists ("pengadaan_add.php")) die ("File tidak ada !"); 
			include "pengadaan_add.php"; break;
		case 'Pengadaan-Delete' :
			if(!file_exists ("pengadaan_delete.php")) die ("File tidak ada !"); 
			include "pengadaan_delete.php"; break;
		case 'Pengadaan-Edit' :
			if(!file_exists ("pengadaan_edit.php")) die ("File tidak ada !"); 
			include "pengadaan_edit.php"; break;


		# REPORT INFORMASI / LAPORAN DATA
		case 'Laporan' :
				if(!file_exists ("menu_laporan.php")) die ("File tidak ada !"); 
				include "menu_laporan.php"; break;

			# LAPORAN MASTER DATA
			case 'Laporan-User' :
				if(!file_exists ("laporan_user.php")) die ("File tidak ada !"); 
				include "laporan_user.php"; break;
	
			case 'Laporan-Penerbit' :
				if(!file_exists ("laporan_penerbit.php")) die ("File tidak ada !"); 
				include "laporan_penerbit.php"; break;
				
			case 'Laporan-Kategori' :
				if(!file_exists ("laporan_kategori.php")) die ("File tidak ada !"); 
				include "laporan_kategori.php"; break;
				
			case 'Laporan-Buku-Penerbit' :	
				if(!file_exists ("laporan_buku_penerbit.php")) die ("File tidak ada !"); 
				include "laporan_buku_penerbit.php"; break;
				
			case 'Laporan-Buku-Kategori' :	
				if(!file_exists ("laporan_buku_kategori.php")) die ("File tidak ada !"); 
				include "laporan_buku_kategori.php"; break;
			
			case 'Laporan-Siswa' :
				if(!file_exists ("laporan_siswa.php")) die ("File tidak ada !"); 
				include "laporan_siswa.php"; break;
			
			case 'Laporan-Pengadaan' :
				if(!file_exists ("laporan_pengadaan.php")) die ("File tidak ada !"); 
				include "laporan_pengadaan.php"; break;

			# LAPORAN PEMINJAMAN
			case 'Laporan-Peminjaman-Bulan' :
				if(!file_exists ("laporan_peminjaman_bulan.php")) die ("File tidak ada !"); 
				include "laporan_peminjaman_bulan.php"; break;
				
			case 'Laporan-Peminjaman-Periode' :
				if(!file_exists ("laporan_peminjaman_periode.php")) die ("File tidak ada !"); 
				include "laporan_peminjaman_periode.php"; break;
				
			case 'Laporan-Peminjaman-Siswa' :
				if(!file_exists ("laporan_peminjaman_siswa.php")) die ("File tidak ada !"); 
				include "laporan_peminjaman_siswa.php"; break;
					
		default:
			if(!file_exists ("info.php")) die ("file tidak ada !"); 
			include "info.php";						
		break;
	}
}

else {
	// Jika tidak mendapatkan variabel URL : ?page
	if(!file_exists ("info.php")) die ("file tidak ada !"); 
	include "info.php";	
}
?>

