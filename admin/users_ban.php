<?php

require 'query.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>

	<title>GoturthinQs.</title>

</head>

<body>
	<!-- Sweet Alert -->
	<script src='../assets/js/sweetalert2.all.min.js'></script>

	<?php


$id = $_POST["id"];
if (banLevel($id) > 0) {
		    echo "
        <script>
			 Swal.fire({
  icon: 'success',
  title: 'User GoturthinQs.!',
  text: 'user successfully banned!'
}).then(function(){
document.location.href='users.php';
});
        </script>";
    

return false;

} else{
echo "
        	<script>
	Swal.fire({
		icon: 'error',
		title: 'User GoturthinQs.!',
		text: 'Failed user banned!'
	}).then(function() {
		document.location.href = 'users.php';
	});
	</script>";

return false;
}


?>

</body>

</html>