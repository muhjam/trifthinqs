<?php 
// memeriksa sudah login atau belum
session_start();
require 'assets/php/functions.php';
if(!isset($_SESSION['aktifasi'])){
	header("location:logout.php");
	exit;
}

// membuat session forgot
$_SESSION['forgot']="forgot";

// cek apakah sudah login
if(isset($_SESSION["level"])){

if($_SESSION['level']=="admin"){
	header("location:index.php");
exit;
}else if($_SESSION['level']=="user"){
	header("location:index.php");
exit;
}else if(!isset($_SESSION['akun'])){
	header("location:lougout.php");
}

}

if(!isset($_SESSION['masuk'])=="masuk"){
	header("location:logout.php");
	exit;
}



$email=$_SESSION['akun'];



 ?>
<!DOCTYPE html>
<html>

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

	<!-- link my css -->
	<link rel="stylesheet" href="assets/css/login.css">

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>

</head>


<body>


	<!-- Sweet Alert -->
	<script src='assets/js/sweetalert2.all.min.js'></script>

	<?php 


if(isset($_POST["change"])){
$password=$_POST['password'];
$password2=$_POST['password2'];

 // cek konsfirmasi password
if($password !== $password2){
        echo "
        <script>
			 Swal.fire({
  icon: 'error',
  title: 'Wrong!',
  text: 'Confirm password is wrong !'
}).then(function(){
document.location.href='change_password.php';});
        </script>";
				return false;

    }elseif($password === $password2){
		
	if(changepw($_POST)>0){
					     echo "
        <script>
       Swal.fire({
  icon: 'success',
  title: 'Success!',
  text: 'your account was created successfully!',
}).then(function(){
document.location.href='login.php';});
        </script>";
					return false;
    } else {
        echo mysqli_error($conn);
    }

		}
  }
?>




	<div class="container-fluid">

		<div class="logo">
			<h1>Goturpassword<span>.</span></h1>
			<h6 class="subtitle">Buat password baru disini</h6>
		</div>

		<div class="konten">
			<form action="" method="post" class="px-4 py-3">
				<input type="hidden" name="email" id="email" value="<?= $email;?>" required>

				<div class="mb-3">
					<?php if (isset($error)) : ?>
					<p>Konfirmasi password tidak sesuai</p>
					<?php endif; ?>

					<label for="exampleDropdownFormPassword1" class="form-label">New Password</label>
					<input type="checkbox" onclick="showPassword()" class="checkbox showpassword form-check-input">
					<input type="password" name="password" class="form-control" id="exampleDropdownFormPassword1"
						placeholder="Create new password" required minlength="8">
				</div>
				<div class="mb-3">
					<label for="exampleDropdownFormPassword2" class="form-label">Confirm Password</label>
					<input type="password" name="password2" class="form-control" id="exampleDropdownFormPassword2"
						placeholder="Confirm new password" required minlength="8">
				</div>
				<button type="submit" class="btn btn-outline-danger " name="change">Change</button>

			</form>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="login.php">Are you got account? Lets Login</a>
			<a class="dropdown-item" href="index.php">Back to shopping</a>
		</div>
	</div>



	<!-- my javascript -->
	<script src="assets/js/login.js"></script>


	<!-- Optional JavaScript; choose one of the two! -->

	<!-- Option 1: Bootstrap Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
	</script>

	<!-- Option 2: Separate Popper and Bootstrap JS -->
	<!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>

<!-- selesai -->