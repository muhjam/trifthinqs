<?php 
session_start();
require 'functions.php';

if(isset($_SESSION['level'])){
$level=$_SESSION['level'];
$username=$_SESSION['username'];
$email=$_SESSION['email'];
$id_u=$_SESSION['id'];$id_u=$_SESSION['id'];
}

	$conn=koneksi();	
	$id_c=$_POST['cart'];

	$ada=mysqli_query($conn,"SELECT * FROM cart WHERE id_u='$id_u' AND id_p='$id_c'");

	if(mysqli_fetch_assoc($ada)){

		mysqli_query($conn, "DELETE FROM  cart WHERE id_u='$id_u' AND id_p='$id_c' ");

	}else{

	mysqli_query($conn, "INSERT INTO cart (`id_u`, `id_p`) VALUE ('$id_u', '$id_c') ");

	}

	$product=query("SELECT * FROM produk WHERE id='$id_c'")['0'];
	$ada=mysqli_query(koneksi(),"SELECT * FROM cart WHERE id_u='$id_u' AND id_p='$id_c	'");

 ?>