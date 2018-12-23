<?php
if(isset($_SESSION['SES_LOGIN'])){
# JIKA SUDAH LOGIN, menu di bawah yang dijalankan
?>
<ul>
	<li><a href='?open' title='Halaman Utama'>Home</a></li>
	<li><a href='?open=User-Data' title='User Login'>Data User</a></li>
	<li><a href='?open=Penerbit-Data' title='Penerbit'>Data Penerbit</a></li>
	<li><a href='?open=Kategori-Data' title='Kategori'>Data Kategori</a></li>
	<li><a href='?open=Buku-Data' title='Buku'>Data Buku</a></li>
	<li><a href='?open=Siswa-Data' title='Siswa'>Data Siswa</a> </li>
	<!--<li><a href='?open=Pengadaan-Data' title='Pengadaan'>Data Pengadaan</a> </li>-->
	<li><a href='peminjaman/' title='Peminjaman Buku' target='_blank'>Peminjaman Buku</a> </li>
	<li><a href='pengembalian/' title='Pengembalian' target='_blank'>Pengembalian Buku</a> </li>
	<li><a href='?open=Laporan' title='Laporan'>Laporan</a></li>
	<li><a href="?open=Logout">Logout</a></li>
</ul>


<?php
}
else {
# JIKA BELUM LOGIN (Tidak ada Session yang ditemukan)
?>
<ul>
	<li><a href="?open=Login">Login</a></li>	
</ul>
<?php
} 
?>