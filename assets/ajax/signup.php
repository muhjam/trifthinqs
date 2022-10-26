<?php 
session_start();
require '../php/functions.php';

$email=$_GET['email'];
$queryEmail="SELECT * FROM users WHERE status='on' AND email='".$email."' OR status='ban' AND email='$email'
				";
$resultEmail= query($queryEmail);
if(!empty($resultEmail)){
 ?>
<!-- email validation -->
<input type="text" id="subValE" value="1">
<style>
#valE {
	display: block !important;
}

#email2 {
	border: 1px solid red !important;
}

#iEmail1 {
	display: inline !important;
}

#iEmail2 {
	display: none !important;
}
</style>
<?php }else if(empty($resultEmail)){ ?>
<input type="text" id="subValE" value="0">
<style>
#valE {
	display: none !important;
}

#email2 {
	border: 1px solid green !important;
}

#iEmail1 {
	display: none !important;
}

#iEmail2 {
	display: inline !important;
}
</style>
<?php } ?>