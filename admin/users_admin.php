<?php

require 'query.php';

?>

<!DOCTYPE html>
<html lang="en">

	<head>

		<title>TrifthinQs.</title>

	</head>

	<body>
		<!-- Sweet Alert -->
		<script src='../assets/js/sweetalert2.all.min.js'></script>

		<?php


$id = $_POST["id"];
if (adminLevel($id) > 0) {
	    echo "
        <script>
			 Swal.fire({
  icon: 'success',
  title: 'User TrifthinQs Store!',
  text: 'User successfully become admin!'
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
		title: 'User TrifthinQs Store!',
		text: 'Failed user to be admin!'
	}).then(function() {
		document.location.href = 'users.php';
	});
	</script>";

return false;
}


?>

	</body>

</html>