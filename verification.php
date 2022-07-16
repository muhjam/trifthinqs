<?php 
session_start();
require 'assets/php/functions.php';
if(!isset($_SESSION['masuk'])=="masuk"){
	header("location:logout.php");
	exit;
}

if(!isset($_SESSION['akunbaru'])){
		header("location:logout.php");
	exit;
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="Tempat trifthingnya Bandung" />
	<meta name="keywords"
		content="GoturthinQs, toko online, trifthing, jual barang bekas fashion, toko online bandung, toko online di bandung, goturthings, got your things, GBI, trifthing bandung" />
	<meta name="author" content="Muhamad Jamaludin" />


	<!--icon  -->
	<link rel="icon" href="assets/icon/icon.png">



	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<!-- Font-Awessome -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

	<!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Libre+Bodoni:wght@500&family=Montserrat:wght@300;400;500;600&family=Open+Sans:wght@600&display=swap"
		rel="stylesheet">
	<title>GoturthinQs.</title>

	<!-- Styles -->
	<style>
	html,
	body {
		background-color: #fff;
		color: #636b6f;
		font-family: "Raleway", sans-serif;
		font-weight: 100;
		height: 100vh;
		margin: 0;
	}

	.full-height {
		height: 100vh;
	}

	.flex-center {
		align-items: center;
		display: flex;
		justify-content: center;
	}

	.position-ref {
		position: relative;
	}

	.content {
		text-align: center;
	}

	.title {
		font-size: 36px;
		padding: 20px;
	}
	</style>

</head>

<body>
	<!-- Sweet Alert -->
	<script src='assets/js/sweetalert2.all.min.js'></script>

	<?php 

$email=$_SESSION['akunbaru'];


if(isset($_POST['aktifasi'])){
	$aktifasi = query("SELECT kode_aktifasi FROM users WHERE email='$email'")[0]['kode_aktifasi'];

	if($_POST['kode_aktifasi']==$aktifasi){
		aktifasi($_POST);
		
$_SESSION=[];
session_unset();
session_destroy();

		     echo "
        <script>
       Swal.fire({
  icon: 'success',
  title: 'Success!',
  text: 'your account was created successfully!',
}).then(function(){
document.location.href='login.php'});
        </script>";
	}else{
        echo "
        <script>
Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'Wrong activation code!',
})
        </script>";
	}
}

?>


	<div class="flex-center position-ref full-height">
		<div class="content">
			<div class="title text-center">
				Check your email to verification.
				<form action="" method="post">

					<input type="text" name="kode_aktifasi" class="form-control"
						placeholder="Please input your code activation in here!" style="text-align: center" required maxlength="6"
						autocomplete="off">
					<button type="submit" class="btn btn-dark mt-1" name="aktifasi">Activation</button>
				</form>
			</div>
		</div>
	</div>
	</div>

</body>

</html>