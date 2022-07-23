<?php 
session_start();
require 'functions.php';

	$id_p=$_POST['id_p'];

	  // buat cookie
		setcookie('key', $id_p, time() + 86400);

 ?>