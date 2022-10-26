<?php 
// session
include "assets/login/session.php";
if(!isset($_SESSION['level'])){
	header("location:index.php");
	exit;
}

if(isset($_POST["changePhoto"])){
	// cek apakag profile berhasil diedit atau tidak
 if (changePhoto($_POST) > 0) {
		 echo "
		 <script>
		 alert('profile berhasil diubah')
		 document.location.href='profile.php'
		 </script>";
 } else {
		 echo"
		 <script>
		 alert('profile belum diubah')
		 document.location.href='profile.php'
		 </script>";
 }
}

 ?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<!-- awal head -->
		<?php include 'assets/section/head.php'; ?>
		<!-- akhir head -->
		<!-- my css -->
		<link rel="stylesheet" href="assets/css/profile.css" />
		<link rel="stylesheet" href="assets/css/zoomImg.css" />
	</head>

	<body>

		<?php 
// change password awal
if(isset($_POST['changePassword'])){
	$email=$profile['email'];
	$passwordOld=$_POST['passwordOld'];
	$password=$_POST['password'];
	$password2=$_POST['password2'];
	
	// Cek username sudah ada atau belum
	// koneksi ke database
	$conn=koneksi();
	$result=mysqli_query($conn,"SELECT * FROM users WHERE email='$email' AND status='on'");
	$result2=mysqli_query($conn,"SELECT * FROM users WHERE email='$email' AND status='non'");
	$resultOld=mysqli_query(koneksi(), "SELECT * FROM users WHERE email='$email'");
	$row=mysqli_fetch_assoc($resultOld);
	if(password_verify($passwordOld, $row['password'])){
	if($password !== $password2){
		$_SESSION['warningChange']="Sorry, the password confirmation doesn"."'"."t match!";
	}else if($password === $password2){
		$_SESSION['ver_email']=$email;
		$_SESSION['ver_password1']=$password;
		$_SESSION['ver_password2']=$password2;
		if(changepw($_SESSION)>0){
		echo "
		<script>
		Swal.fire({
		icon: 'success',
		title: 'Success!',
		text: 'Your password has been changed successfully!',
		})
		</script>";
unset($_SESSION['ver_email']);
unset($_SESSION['ver_password1']);
unset($_SESSION['ver_password2']);
	}else{
		echo mysqli_error($conn);
	}
	}
}
}
// change password

// change password akhir; ?>
		<!-- awal isi konten -->
		<!-- awal navbar -->
		<?php include 'assets/section/nav.php'; ?>
		<!-- akhir navbar -->
		<!-- awal isi wishlist -->
		<div class="title">
			<h3>Profile</h3>
			<div class="sub-title">
				<a href="index.php?home">home</a> / <a href="index.php?shop">shop</a> / <a href="#"
					id="point"><?= $level; ?></a>
			</div>
		</div>

		<section id="profile">
			<div class="container">
				<div class="biodata-left">
					<div class="profile-photo">
						<img id="myImg" src="assets/profile/<?= $profile['foto'];?>">
						<!-- zoom -->
						<div id="myModal" class="modal">
							<img class="modal-content" id="img01" />
						</div>
						<div class="button">
							<button type="button" id="choose-photo">Choose Photo</button>
						</div>
						<p>File size: maximum 10,000,000 bytes (10 Megabytes). Allowed file extensions: .JPG .JPEG .PNG
						</p>
					</div>
				</div>
				<div class="biodata-right">
					<p>Change Bio</p>
					<div class="contain">
						<span>Name</span>
						<span><?= $profile['username']; ?></span>
						<a href="">Change</a>
					</div>
					<div class="contain">
						<span>Date of Birth</span>
						<span><?= $profile['lahir']; ?></span>
						<a href="">Change</a>
					</div>
					<div class="contain">
						<span>Gender</span>
						<span><?= $profile['gender']; ?></span>
						<a href="">Change</a>
					</div>
					<p>Change Contact</p>
					<div class="contain">
						<span>Email</span>
						<span><?= $profile['email']; ?></span>
						<a href="">Change</a>
					</div>
					<div class="contain">
						<span>Phone</span>
						<span><?= $profile['no_telp']; ?></span>
						<a href="">Change</a>
					</div>
					<p>Change Address <a href=""><i class="fa-solid fa-gear"></i></a></p>
					<div class="contain">
						<span>Address</span>
						<?php if($profile['alamat']==''||$profile['alamat']=='-'):?>
						<span class="not-registered">Not-Registered</span>
						<?php else: ?>
						<span class="registered">Registered</span>
						<?php endif; ?>
						<span></span>
					</div>
					<div class="button">
						<button type="button" id="btnChangePassword"><i class="fa-solid fa-key"></i>Change
							Password</button>
					</div>
					<form action="" method="post">
						<div class="button">
							<button type="submit" name="logout" class="logout"><i class="fa-solid fa-right-from-bracket"></i>
								Logout</button>
						</div>
					</form>
				</div>
			</div>
		</section>

		<form action="" method="post" enctype="multipart/form-data">
			<input hidden class="form-control form-control-sm" id="foto" type="file" name="gambar"
				onchange="this.form.submit()">
			<input type="hidden" name="gambarLama" value="<?= $profile["foto"];?>">
			<input name="id" type="text" class="form-control" placeholder="-" hidden value="<?= $profile['id']; ?>">
			<input hidden type="text" name="changePhoto">
		</form>


		<!-- Change Password awal -->
		<div id="containChangePass"><input type="text" class="d-none" id="validation" value="1"></div>
		<div id="formChangePassword" class="form-login-float form-verification d-none">
			<button class="close close-activation" onclick="closeForm()"></button>
			<div class="content content-medium">
				<h1>CHANGE PW<span>.</span></h1>
				<?php if(isset($_SESSION["warningChange"])): ?>
				<i style="color:red;"><?= $_SESSION["warningChange"]; ?></i>
				<?php endif; ?>
				<form action="" method="post" name="form-change">
					<div class="password">
						<div class="label">
							<label for="passwordOld">Old Password</label>
							<i class="fas fa-eye-slash showPassword" onclick="showPassword()"></i>
						</div>
						<section class="input">
							<input type="password" class="showPassword1" id="passwordOld" name="passwordOld"
								placeholder="Input Old Password" autocomplete="off"
								value="<?php if(isset($_SESSION['signupExist'])){echo"$password";}?>">
							<div class="i">
								<i class="fa-regular fa-circle-xmark d-none" id="iPassOld1"></i>
								<i class="fa-regular fa-circle-check d-none" id="iPassOld2"></i>
							</div>
						</section>
						<i class="validation" id="valPOld">Please input your password</i>
					</div>
					<div class="password password-hide" id="new-password">
						<div class="label">
							<label for="password2">New Password</label>
						</div>
						<section class="input">
							<input type="password" class="showPassword2" id="password2" name="password" placeholder="Create Password"
								autocomplete="off" value="<?php if(isset($_SESSION['signupExist'])){echo"$password";}?>">
							<div class="i">
								<i class="fa-regular fa-circle-xmark d-none" id="iPass1"></i>
								<i class="fa-regular fa-circle-check d-none" id="iPass2"></i>
							</div>
						</section>
						<i class="validation" id="valP1">Please creat your password</i>
					</div>
					<div class="password password-hide">
						<section id="confirm-password"></section>
						<div class="label">
							<label for="password3">Confirm Password</label>
						</div>
						<section class="input">
							<input type="password" class="showPassword3" id="password3" class="password3" name="password2"
								placeholder="Confirm New Password" autocomplete="off">
							<div class="i">
								<i class="fa-regular fa-circle-xmark d-none" id="iPassC1"></i>
								<i class="fa-regular fa-circle-check d-none" id="iPassC2"></i>
							</div>
						</section>
						<i class="validation" id="valP2">Please confirm your password</i>
					</div>
					<button type="submit" name="changePassword"><span><i
								class="fa fa-circle-o-notch fa-spin fa-spin-signup d-none"></i>CONTINUE</span> <svg
							xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-right"
							viewBox="0 0 16 16">
							<path fill-rule="evenodd"
								d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
						</svg></button>
				</form>
			</div>
		</div>
		<!-- <script src="assets/js/verification.js"></script> -->
		<!-- change password akhir -->

		<!-- akhir isi wishlist -->
		<!-- awal footer -->
		<script src="assets/js/functions.js"></script>
		<?php include 'assets/section/footer.php'; ?>
		<!-- akhir footer -->
		<!-- zoomimage -->
		<script src="assets/js/zoomImg.js"></script>
		<!-- profile -->
		<script src="assets/js/profile.js"></script>

	</body>

</html>