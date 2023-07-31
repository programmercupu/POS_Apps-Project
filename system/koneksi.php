<?php
$server ='localhost';
$user   ='root';
$password ='';
$database ='pos_apps';

$mysqli = mysqli_connect($server, $user, $password, $database) or (mysqli_error($mysqli));
if (mysqli_connect_errno()){
    echo 'koneksi ke databese belum berhasil'. mysqli_errno($mysqli);
    
}
 else {
   // echo 'Koneksi Berhasil';
}
?>