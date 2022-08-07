<?php 
// memeriksa sudah login atau belum
session_start();
require 'assets/php/functions.php';
if(isset($_SESSION['level'])){
	$level=$_SESSION['level'];
	$username=$_SESSION['username'];
	$email=$_SESSION['email'];
	$id_u=$_SESSION['id'];
	}

if(isset($_SESSION['email'])){
	$email_u=$_SESSION['email'];
	$status_u=query("SELECT * FROM users WHERE email='$email_u'")[0]['status'];
if($status_u==='non' || $status_u==='ban'){
	header("location:logout.php");
	return false;
}
}
// jenis produk
$jenisProduk=query("SELECT * FROM jenis_produk");
// notif cart
if(isset($_COOKIE['shopping_cart'])){
	$cookie=strlen($_COOKIE['shopping_cart']);
	$cookie_data=stripcslashes($_COOKIE['shopping_cart']);
	$cart_data=json_decode($cookie_data, true);
}

$_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
; ?>