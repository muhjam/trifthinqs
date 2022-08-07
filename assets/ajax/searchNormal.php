<?php 
require '../php/functions.php';

$query="SELECT * FROM produk ORDER BY produk.status ASC,id DESC
					";

$trifthinqs= query($query);
// mengaharhkan ke normal page
// if($keyword===''){
// header("Refresh:0; url=index.php");
// exit;
// }
?>