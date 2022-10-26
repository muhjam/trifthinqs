<?php 
session_start();
require '../php/functions.php';

$password=$_GET['password'];
$email=$_SESSION['email'];
$result=mysqli_query(koneksi(), "SELECT * FROM users WHERE email='$email'");
$row=mysqli_fetch_assoc($result);
if(password_verify($password, $row['password'])){
 ?>
<?= $_SESSION['email']; ?>
<input type="text" class="d-none" id="validation" value="0">
<style>
#valPOld {
	display: none !important;
}

.password-hide {
	display: inline;
}

#passwordOld {
	border: 1px solid green !important;
}

#iPassOld1 {
	display: none !important;
}

#iPassOld2 {
	display: inline !important;
}
</style>
<?php }else{ ?>
<input type="text" class="d-none" id="validation" value="1">
<style>
#valPOld {
	display: block !important;
}

#passwordOld {
	border: 1px solid red !important;
}

#iPassOld1 {
	display: inline !important;
}

#iPassOld2 {
	display: none !important;
}
</style>
<?php } ?>