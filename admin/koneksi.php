<?php
$host ='localhost';
$user ='root';
$pass ='';
$db ='goturthings';
$koneksi = mysqli_connect($host, $user, $pass,$db);
if(!$koneksi){
    die("cannot connect to database.");
}





?>