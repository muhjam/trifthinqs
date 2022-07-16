<?php 

session_start();
require 'assets/php/functions.php';
$_SESSION=[];
session_unset();
session_destroy();

setcookie('email', '', time() - 90000);
setcookie('key', '', time() - 90000);


header("location:index.php");
exit;
 ?>