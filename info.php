<?php
if(isset($_SESSION['SES_LOGIN'])) {
	echo "<h2><br>Selamat datang di SiPusta - Sistem Informasi Perpustakaan SMKN 6 KOTA BEKASI !</br></h2>";
	echo "<h3><b> Anda login sebagai Admin</h3>";
   exit;
}
else {
	echo "<h3>Selamat datang di SiPusta - Sistem Informasi Perpustakaan SMKN 6 KOTA BEKASI !</h3>";
	echo "<b>Anda belum login, silahkan <a href='?open=Login' alt='Login'>login </a>untuk mengakses SISTEM ini  ";
}
?>
<br>
<br>
<br>
<img src="profil/sekolah.jpg" style="float:left;width:auto;height:300px;">

<footer>
<p>Contact information: <a href="mailto:kurniawanrendy53@gmail.com">kurniawanrendy53@gmail.com</a>.</p>
</footer>

<?php
$tanggal= mktime(date("m"),date("d"),date("Y"));
echo "Tanggal : <b>".date("d-M-Y", $tanggal)."</b> ";
date_default_timezone_set('Asia/Jakarta');
$jam=date("H:i:s");
echo "| Pukul : <b>". $jam." "."</b>";
$a = date ("H");
if (($a>=6) && ($a<=11)){
echo "<b>, Selamat Pagi !!</b>";
}
else if(($a>11) && ($a<=15))
{
echo "<b>, Selamat Siang </b>!!";}
else if (($a>15) && ($a<=18)){
echo ",<b> Selamat sore </b>!!";}
else { echo ", <b> Selamat Malam </b>";}
?> 
<br>
<br>
<html> <head> <title>Jam Analog</title>
    </head>
    <body>

    <canvas id="clock" width="99" height="99" style="float: left; width: auto;"></canvas>
    <script type="text/javascript">
    window.onload = function()
    {
    function draw()
    {
    var ctx = document.getElementById('clock').getContext('2d');
    ctx.strokeStyle = "rgba(0, 0, 0, 1)";
    ctx.clearRect(0, 0, 100, 100);
    ctx.beginPath();
    ctx.lineWidth = 1;
    ctx.arc(50, 50, 48, 0, Math.PI * 2, true);
    ctx.stroke();
    var i; for(i=0; i < 360; i+=6)
    {
    ctx.lineWidth = ((i % 30)==0)?3:1;
    ctx.strokeStyle = ((i % 30)==0)?"rgb(200,0,0)":"rgb(0,0,0)";
    var r = i * Math.PI / 180;
    ctx.beginPath();
    ctx.moveTo(50+(45 * Math.sin(r)), 50+(45 * Math.cos(r)));
    ctx.lineTo(50+((((i % 30)==0)?37:40) * Math.sin(r)),
    50+((((i % 30)==0)?37:40) * Math.cos(r)));
    ctx.closePath();
    ctx.stroke();
    }
    ctx.strokeStyle = "rgba(32, 32, 32, 0.6)";
    // hour
    var d = new Date();
    var h = (d.getHours() % 12) + (d.getMinutes() / 60);
    ctx.lineWidth = 4;
    ctx.beginPath();
    ctx.moveTo(50+(25 * Math.sin(h * 30 * Math.PI / 180)),
    50+(-25 * Math.cos(h * 30 * Math.PI / 180)));
    ctx.lineTo(50+(5 * Math.sin((h+6) * 30 * Math.PI / 180)),
    50+(-5 * Math.cos((h+6) * 30 * Math.PI / 180)));
    ctx.closePath(); ctx.stroke();
    //minute
    var m = d.getMinutes() + (d.getSeconds() / 60);
    ctx.strokeStyle = "rgba(32, 32, 62, 0.8)";
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(50+(38 * Math.sin(m * 6 * Math.PI / 180)),
    50+(-38 * Math.cos(m * 6 * Math.PI / 180)));
    ctx.lineTo(50+(3 * Math.sin((m+30) * 6 * Math.PI / 180)),
    50+(-3 * Math.cos((m+30) * 6 * Math.PI / 180)));
    ctx.closePath();
    ctx.stroke();
    //second
    var s = d.getSeconds() + (d.getMilliseconds() / 1000);
    ctx.strokeStyle = "rgba(0, 255, 0, 0.7)";
    ctx.lineWidth = 1;
    ctx.beginPath();
    ctx.moveTo(50+(45 * Math.sin(s * 6 * Math.PI / 180)),
    50+(-45 * Math.cos(s * 6 * Math.PI / 180)));
    ctx.lineTo(50+(10 * Math.sin((s+30) * 6 * Math.PI / 180)),
    50+(-10 * Math.cos((s+30) * 6 * Math.PI / 180)));
    ctx.closePath(); ctx.stroke(); } setInterval(draw, 100); }
    </script>
    </body>
    </html>


