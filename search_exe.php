     <?php
    include "connect.php";
    $name= $_POST['name']; //get the nama value from form
    $q = "SELECT * from tb_data_siswa where name like '%$name%' "; //query to get the search result
    $result = mysql_query($q); //execute the query $q
    echo "<center>";
    echo "<h2> Hasil Searching </h2>";
    echo "<table border='1' cellpadding='5' cellspacing='8'>";
    echo "
    <tr bgcolor='orange'>
    <td>No</td>
    <td>Nama siswa</td>
    <td>Alamat</td>
    </tr>";
    while ($data = mysql_fetch_array($result)) {  //fetch the result from query into an array
    echo "
    <tr>
    <td>".$data['no']."</td>
    <td>".$data['name']."</td>
    <td>".$data['address']."</td>
    </tr>";
    }
    echo "</table>";
    ?>