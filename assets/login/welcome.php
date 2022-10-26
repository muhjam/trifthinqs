<?php 
if(isset($_SESSION['level'])){

	if(isset($_POST['logout'])){
	$_SESSION=[];
	session_unset();
	session_destroy();
	setcookie('email', '', time() - 90000);
	setcookie('key', '', time() - 90000);
	header("Refresh:0");
	exit;
	}
	
		// notif wish
		$wish=mysqli_query(koneksi(),"SELECT * FROM wish WHERE id_u='$id_u'");
		// profile
		$profile=query("SELECT * FROM users WHERE id='$id_u'")['0'];
	}
?>