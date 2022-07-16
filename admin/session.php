<?php 
// memeriksa sudah login atau belum
session_start();
require 'query.php';
$levelLogin=$_SESSION['level'];
$usernameLogin=$_SESSION['username'];
$emailLogin=$_SESSION['email'];
$idLogin=$_SESSION['id'];

if(!isset($_SESSION["level"])){
header("location:../logout.php");
exit;
}

if($_SESSION["level"]!='admin'){
	header("location:../index.php");
exit;
} ?>