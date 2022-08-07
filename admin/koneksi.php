<?php
$host ='localhost';
$user ='root';
$pass ='';
$db ='trifthinqs';
$koneksi = mysqli_connect($host, $user, $pass,$db);
if(!$koneksi){
    die("cannot connect to database.");
}





?>