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
	$id_w=$_POST['wish'];

	$ada=mysqli_query($conn,"SELECT * FROM wish WHERE id_u='$id_u' AND id_p='$id_w'");

	if(mysqli_fetch_assoc($ada)){

		mysqli_query($conn, "DELETE FROM  wish WHERE id_u='$id_u' AND id_p='$id_w' ");

	}else{

	mysqli_query($conn, "INSERT INTO wish (`id_u`, `id_p`) VALUE ('$id_u', '$id_w') ");

	}

	$product=query("SELECT * FROM produk WHERE id='$id_w'")['0'];
	$ada=mysqli_query(koneksi(),"SELECT * FROM wish WHERE id_u='$id_u' AND id_p='$id_w	'");

 ?>