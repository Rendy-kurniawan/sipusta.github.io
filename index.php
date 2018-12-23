<?php
session_start();
include_once "library/inc.connection.php";
include_once "library/inc.library.php";
include_once "library/inc.pilihan.php";
include_once "library/inc.tanggal.php";

// Baca Jam pada Komputer
date_default_timezone_set("Asia/Jakarta");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title> :: SiPusta - Sistem Informasi Database Buku pada Perpustakaan Sekolah SMK N 6 KOTA BEKASI </title>

<link href="styles/style.css?v=1.1" rel="stylesheet" type="text/css">

<link rel="stylesheet" type="text/css" href="plugins/tigra_calendar/tcal.css"/>

<script type="text/javascript" src="plugins/tigra_calendar/tcal.js"></script>

</head>
<div id="wrap">
    

                
<body>
<table width="100%" class="table-main">
  <tr>
    <td height="100" colspan="2"><a href="?open"> <div id="header"><img src="images/logo.png" padding="4"border="0" botom="50%"/><html> <head> <title>Jam Analog</title>
    </head>
    <body>

    <canvas id="clock" width="99" height="99"></canvas>
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
    </html></div> </a></td>
  </tr>
    
  <tr valign="top">
    <td width="15%"  style="border-right:5px solid #008000;"><div style="margin:5px; padding:5px;"><?php include "menu.php"; ?></div></td>
    <td width="69%" height="550"><div style="margin:5px; padding:5px;"><?php include "buka_file.php";?></div></td>
  </tr>

</div>
</table>
<script src="js/script.js"></script>
</body>
</div>
</div>
</div>
</html>

