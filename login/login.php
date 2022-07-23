<?php
// cek udah login apa belum
session_start();

require 'assets/php/functions.php';

if(isset($_SESSION['akunbaru'])){
$email=$_SESSION['akunbaru'];
// koneksi ke database
$conn=koneksi();
mysqli_query($conn, "DELETE FROM users WHERE `users`.`email` = '$email'");
}

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

	<!-- awal php -->
	<?php 


$conn=koneksi();



// cek cookie
if(isset($_COOKIE['id'])&&isset($_COOKIE['key'])){
  $id=$_COOKIE['id'];
  $key=$_COOKIE['key'];

  // ambil username berdasarkan id
  $result= mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
  $row=mysqli_fetch_assoc($result);

  // cek cookie dan username
  if($key===hash('sha256', $row['email'])){
	$_SESSION['level']=$row['level'];
	$_SESSION['username']=$row['username'];
  $_SESSION['status']=$row['status'];
	$_SESSION['email']=$row['email'];	
	$_SESSION['id']=$row['id'];
  }
}


if(isset($_COOKIE['level'])){
  if($_COOKIE['level']=='true'){
    $_SESSION['level']=$row['level'];
		$_SESSION['username']=$row['username'];
		$_SESSION['status']=$row['status'];
		$_SESSION['email']=$row['email'];
		$_SESSION['id']=$row['id'];
  }
}

// cek apakah sudah login
if(isset($_SESSION["level"])){

if($_SESSION['level']=="admin"){
	header("location:index.php");
exit;
}else if($_SESSION['level']=="user"){
	header("location:index.php");
exit;
}

}






// cek apakah tombol submit sudah di tekan atau belum
if (isset($_POST["login"])) {

$email=$_POST["email"];
$password=$_POST["password"];


// Cek Full Name
$result=mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

// jika akun belum di buat
if(mysqli_num_rows($result)===0){
	    echo "
        <script>
				 Swal.fire({
  icon: 'warning',
  title: 'Oops...',
  text: 'Sorry, you dont have an account yet!'
}).then(function(){
document.location.href='login.php'
});
        </script>";
	return false;	
}

if(mysqli_num_rows($result)===1){
  //  memanggil isinya
$row=mysqli_fetch_assoc($result);

// cek status
	if($row['status']=="non"){
	    echo "
        <script>
			 Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'Sorry, you dont have an account yet!'
}).then(function(){
document.location.href='login.php'
});
        </script>";
	return false;
		}else if($row['status']=="ban"){
	    echo "
        <script>
        Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'Sorry, your account has been banned',
}).then(function(){
document.location.href='login.php'
});
        </script>";
					return false;
}

 // Cek password
if(password_verify($password, $row['password'])){



	// cek jika user login sebagai admin
	if($row['level']=="admin"){

		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['email'] = $email;
		$_SESSION['level'] = "admin";
		$_SESSION['id']=$row['id'];
		$_SESSION['status']=$row['status'];

		// alihkan ke halaman admin
		header("location:index.php");

	// cek jika user login sebagai user
	}else if($row['level']=="user"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['email'] = $email;
		$_SESSION['level'] = "user";
		$_SESSION['id']=$row['id'];
		$_SESSION['status']=$row['status'];
			// alihkan ke halaman user
		header("location:index.php");
	}




}else{
		$error=true;
}




// cek remember me
if(isset($_POST['remember'])){
  // buat cookie
  setcookie('id', $row['id'], time() + 86400);
  setcookie('key', hash('sha256', $row['id']), time() + 86400);

// cek status
	if($row['status']=="non"){
	    echo "
        <script>
        Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'Sorry, you dont have an account yet!',
}).then(function(){
document.location.href='login.php'
});
        </script>";
	return false;
		}else if($row['status']=="ban"){
		    echo "
        <script>
        Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'Sorry, your account has been banned',
}).then(function(){
document.location.href='login.php'
});	
        </script>";
		return false;
		}



		// cek jika user login sebagai admin
	if($row['level']=="admin"){

		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['email'] = $email;
		$_SESSION['level'] = "admin";
		$_SESSION['id']=$row['id'];
		$_SESSION['status']=$row['status'];
		// alihkan ke halaman dashboard admin
		header("location:index.php");

	// cek jika user login sebagai pegawai
	}else if($row['level']=="user"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['email'] = $email;
		$_SESSION['level'] = "user";
		$_SESSION['id']=$row['id'];
		$_SESSION['status']=$row['status'];
		// alihkan ke halaman dashboard pegawai
		header("location:index.php");

	}
}


}





}


; ?>
	<!-- akhir php -->





	<!-- loading -->
	<!-- <div id='preloader'></div> -->

	<div class="container-fluid">

		<div class="logo">
			<h1>Goturloqin<span>.</span></h1>
			<h6 class="subtitle">tempat trifthingnya bandung</h6>
		</div>
		<div class="konten">

			<form action="" method="post" class="px-4 py-3">
				<div class="mb-3">

					<?php if (isset($error)) : ?>
					<p>The password you entered is wrong!</p>
					<?php endif; ?>

					<label for="exampleDropdownFormEmail1" class="form-label">Email</label>
					<input type="email" name="email" class="form-control" id="exampleDropdownFormEmail1"
						placeholder="Input your email" required>
				</div>
				<div class="mb-3">
					<label for="exampleDropdownFormPassword1" class="form-label">Password</label>
					<input type="checkbox" onclick="showPassword()" class="checkbox showpassword form-check-input">
					<input type="password" name="password" class="form-control" id="exampleDropdownFormPassword1"
						placeholder="Input your password" required>
				</div>
				<div class="mb-3">
					<div class="form-check">
						<input type="checkbox" class="form-check-input checkbox" id="dropdownCheck" name="remember">
						<label class="form-check-label" for="dropdownCheck">
							Remember me
						</label>
					</div>
				</div>
				<button type="submit" class="btn btn-outline-danger" name="login">Sign in</button>
			</form>
			<div class="ig" style="text-align:right;">
			</div>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="signup.php">New around here? Sign up</a>
			<a class="dropdown-item" href="forgot.php">Forgot password?</a>
			<a class="dropdown-item" href="index.php">Back to shopping</a>
		</div>
	</div>

	<script type="text/javascript">
	$(window).load(function() {
		$("#preloader").delay(300).fadeOut("slow");
	})
	</script>



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