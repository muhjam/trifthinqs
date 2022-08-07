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
	
	// cek apakah tombol submit sudah di tekan atau belum
	if(!isset($_SESSION['verificationForm'])){
		// awal login
	if (isset($_POST["login"])) {
	
	$email=$_POST["email"];
	$password=$_POST["password"];

	// Cek Full Name
	$result=mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
	
	// jika akun belum di buat
	if(mysqli_num_rows($result)===0){
	$_SESSION['warningLogin']="Sorry, you don"."'"."t have an account yet!";
	}
	
	if(mysqli_num_rows($result)===1){
		//  memanggil isinya
	$row=mysqli_fetch_assoc($result);
	
	// cek status
		if($row['status']=="non"){
			$_SESSION['warningLogin']="Sorry, you don"."'"."t have an account yet!";
			}else if($row['status']=="ban"){
				$_SESSION['warningLogin']="Sorry, your account has been banned!";
	}else{
	 // Cek password
	if(password_verify($password, $row['password'])){
	
		// cek jika user login sebagai admin
		if($row['level']=="admin"){
	
			// buat session login dan username
			$_SESSION['username'] = $row['username'];
			$_SESSION['email'] = $email;
			$_SESSION['level'] = "admin";
			$_SESSION['id']=$row['id'];
			$_SESSION['status']=$row['status'];
			$_SESSION['login']='1';
		// cek jika user login sebagai user
		}else if($row['level']=="user"){
			// buat session login dan username
			$_SESSION['username'] = $row['username'];
			$_SESSION['email'] = $email;
			$_SESSION['level'] = "user";
			$_SESSION['id']=$row['id'];
			$_SESSION['status']=$row['status'];
			$_SESSION['login']='1';
		}
	}else{
		$_SESSION['warningLogin']="Sorry, wrong password!";
	}
	
	}
	// cek remember me
	if(isset($_POST['remember'])){
		// buat cookie
		setcookie('id', $row['id'], time() + 86400);
		setcookie('key', hash('sha256', $row['id']), time() + 86400);

	}
	}
	}
	// akhir login

	if(isset($_SESSION['level'])){
	$level=$_SESSION['level'];
	$username=$_SESSION['username'];
	$email=$_SESSION['email'];
	$id_u=$_SESSION['id'];
	if(isset($_GET['number'])){
		$productSelected=$_GET['number'];
		$product=query("SELECT * FROM produk WHERE id='$productSelected'")['0'];
			if(isset($_SESSION['level'])){
			$adaWish=query("SELECT * FROM wish WHERE id_u='$id_u' AND id_p='$productSelected'");
			}
		}
	}

// awal signup
if(isset($_POST['signup'])){
	unset($_POST['cancel']);
	unset($_SESSION['signupExist']);
if(isset($_POST['signup'])&&isset($_POST['email'])&&isset($_POST['username'])&&isset($_POST['password'])&&isset($_POST['password2'])){
$_SESSION['signupExist']='1';

$activation_code=gen_uid();
$email=$_POST['email'];
$username=$_POST['username'];
$password=$_POST['password'];
$password2=$_POST['password2'];

// Cek username sudah ada atau belum
// koneksi ke database
$conn=koneksi();
$result=mysqli_query($conn,"SELECT * FROM users WHERE email='$email' AND status='on'");
$result2=mysqli_query($conn,"SELECT * FROM users WHERE email='$email' AND status='non'");

// cek konsfirmasi password
if(mysqli_fetch_assoc($result2)){
mysqli_query($conn, "DELETE FROM users WHERE `users`.`email` = '$email'");
}

if(!preg_match ('/^([a-z A-Z]+)$/', $username)){
	$_SESSION['warningSignup']="Sorry, for name input only characters!";
}else if(mysqli_fetch_assoc($result)){
$_SESSION['warningSignup']="Sorry, this account already exists!";
}else if(substr($email, -10)!='@gmail.com'){
	$_SESSION['warningSignup']="Please use @gmail.com!";
}else if($password !== $password2){
	$_SESSION['warningSignup']="Sorry, the password confirmation doesn"."'"."t match!";
}else{
	require("assets/php/PHPMailer-master/src/PHPMailer.php");
  require("assets/php/PHPMailer-master/src/SMTP.php");
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->IsSMTP(); // enable SMTP
// Cek username sudah ada atau belum{
	// session
	$_SESSION['activation_code']=$activation_code;
	$_SESSION['signup_username']=$username;
	$_SESSION['signup_email']=$email;
	$_SESSION['signup_password1']=$password;
	$_SESSION['signup_password2']=$password2;
	
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = "trifthinqs@gmail.com";
    $mail->Password = "payxcuknujnvegld";
    $mail->SetFrom("trifthinqs@gmail.com");
    $mail->Subject = "Confirm your account TrifthinQs Store";
    $mail->Body = "Welcome to our store $username, please enter the activation code : <br> <h1 style='text-align:center;'>$activation_code</h1>";
    $mail->AddAddress($email);
		
     if(!$mail->Send()) {
        $_SESSION['error']='Something wrong, please try again!';
     } else {
			if(signup($_SESSION)>0){
				$_SESSION['akunbaru']="$email";	
				} else {
						echo mysqli_error($conn);
				}
			// set time
			 $datenow=date("H:i:s");
			 $minutes2=strtotime($datenow.'+ 2 minutes');
			 $_SESSION['now']=date("M d, Y H:i:s", $minutes2);
			// set cookie
			setcookie('verification', $email, time()+120,"/");
			$_SESSION['verificationForm']='1';
				// header("location:verification.php");
				// exit;
     }
}
}
}
// signup terakhir 

// login success
	if(isset($_SESSION['login'])){
	if($_SESSION['login']==='1'){
	echo"
	<script>
	const Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 3000,
		timerProgressBar: true,
		didOpen: (toast) => {
			toast.addEventListener('mouseenter', Swal.stopTimer)
			toast.addEventListener('mouseleave', Swal.resumeTimer)
		}
	})
	Toast.fire({
		icon: 'success',
		title: 'Wellcome, ".$username."'
		})
		</script>
		";
		}
		}
		$_SESSION['login']='0';

		// logic form verification
	}else if(isset($_SESSION['verificationForm'])){

		// verification account
				if(isset($_POST['verification'])){
					if(isset($_SESSION['signup_email'])){
						$email=$_SESSION['signup_email'];
						if(isset($_POST['activation_code'])){
						$activation = query("SELECT kode_aktivasi FROM users WHERE email='$email'")[0]['kode_aktivasi'];
					// untuk dihosting
						if($_POST['activation_code']==$activation){
							activation($_POST);
									echo "
									<script>
								Swal.fire({
						icon: 'success',
						title: 'Success!',
						text: 'Your account has been created successfully!',
					})
							</script>";
				unset($_SESSION['activation_code']);
				unset($_SESSION['signup_username']);
				unset($_SESSION['signup_email']);
				unset($_SESSION['signup_password1']);
				unset($_SESSION['signup_password2']);
							unset($_SESSION['verificationForm']);
						}else{
							// window.history.go(-2);});
							$_SESSION['warningVerification']='Wrong activation code!';
									
						}
		
				}
}else{
	unset($_SESSION['activation_code']);
unset($_SESSION['signup_username']);
unset($_SESSION['signup_email']);
unset($_SESSION['signup_password1']);
unset($_SESSION['signup_password2']);
	unset($_SESSION['verificationForm']);
}
}
// akhir activationform

if(isset($_POST['cancel'])){
	setcookie('verification', null, -99999, '/');
	$email_c=$_SESSION['signup_email'];
	// delete email
	mysqli_query(koneksi(), "DELETE FROM users WHERE `users`.`email` = '$email_c'");
	unset($_SESSION['activation_code']);
	unset($_SESSION['signup_username']);
	unset($_SESSION['signup_email']);
	unset($_SESSION['signup_password1']);
	unset($_SESSION['signup_password2']);
	unset($_SESSION['verificationForm']);
	unset($_SESSION['now']);
}


if(!isset($_COOKIE['verification'])){
		if(isset($_SESSION['signup_email'])){

			if(resetCode($_SESSION)>0){
				$_SESSION['warningVerification']='Expired!';
			} else {
					echo mysqli_error($conn);
			}

			if(isset($_POST['resend'])){
				$activation_code=gen_uid();
				$email=$_SESSION['signup_email'];
				$username=$_SESSION['signup_username'];
				$_SESSION['activation_code']=$activation_code;
				
				require("assets/php/PHPMailer-master/src/PHPMailer.php");
				require("assets/php/PHPMailer-master/src/SMTP.php");
					$mail = new PHPMailer\PHPMailer\PHPMailer();
					$mail->IsSMTP(); // enable SMTP
						$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
						$mail->SMTPAuth = true; // authentication enabled
						$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
						$mail->Host = "smtp.gmail.com";
						$mail->Port = 465; // or 587
						$mail->IsHTML(true);
						$mail->Username = "trifthinqs@gmail.com";
						$mail->Password = "payxcuknujnvegld";
						$mail->SetFrom("trifthinqs@gmail.com");
						$mail->Subject = "Confirm your account TrifthinQs Store";
						$mail->Body = "Welcome to our store $username, please enter the activation code : <br> <h1 style='text-align:center;'>$activation_code</h1>";
						$mail->AddAddress($email);
						
						if(!$mail->Send()) {
							$_SESSION['error']='1';
						} else {
							if(resend($_SESSION)>0){

							} else {
									echo mysqli_error($conn);
							}
							// set time
							$datenow=date("H:i:s");
							$minutes2=strtotime($datenow.'+ 2 minutes');
							$_SESSION['now']=date("M d, Y H:i:s", $minutes2);
							// set cookie
							setcookie('verification', $email, time()+120,"/");
							$_SESSION['verificationForm']='1';
							unset($_SESSION['warningVerification']);
							unset($_POST['resend']);
						}

				}
			}
		}else if(!isset($_SESSION['signup_email'])){
			unset($_SESSION['activation_code']);
			unset($_SESSION['signup_username']);
			unset($_SESSION['signup_email']);
			unset($_SESSION['signup_password1']);
			unset($_SESSION['signup_password2']);
			unset($_SESSION['verificationForm']);
		}
}else if(isset($_COOKIE['verification'])){
if(isset($_SESSION['warningVerification'])){
	if($_SESSION['warningVerification']=='Expired!'){
		unset($_SESSION['warningVerification']);
	}
}
	unset($_POST['resend']);
}

 ?>

<?php if(!isset($_SESSION['verificationForm'])): ?>
<!-- awal login form -->
<?php if(!isset($_SESSION['level'])&&!isset($_SESSION['verification'])) :?>
<div class="form-login-float form-login <?php if(!isset($_POST['login'])){echo"d-none";}?>">
	<button class="close close-login" onclick="closeForm()"></button>
	<div class="content" id="login">
		<h1>LOG IN FIRST<span>.</span></h1>
		<?php if(isset($_SESSION["warningLogin"])): ?>
		<?php if($_SESSION["warningLogin"]!=='0'): ?>
		<i style="color:red;"><?= $_SESSION["warningLogin"]; ?></i>
		<?php endif; ?>
		<?php endif; ?>
		<form action="" method="post" name="form-login">
			<div class="email">
				<label for="email">Email</label>
				<input type="email" id="email" name="email" required placeholder="Enter Email">
			</div>
			<div class="password">
				<div class="label">
					<label for="password1">Password</label>
					<i class="fas fa-eye-slash showPassword" onclick="showPassword()"></i>
				</div>
				<input type="password" class="showPassword1" id="password1" name="password" required
					placeholder="Enter Password">
			</div>
			<div class="remember">
				<div class="label">
					<input type="checkbox" class="checkbox" name="remember" id="remember"><label for="remember">Remember
						Me</label>
				</div>
			</div>
			<button type="submit" name="login"><span>CONTINUE</span> <svg xmlns="http://www.w3.org/2000/svg" width="25"
					height="25" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
					<path fill-rule="evenodd"
						d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
				</svg></button>
		</form>
		<a onclick="signup()">sign up?</a> <span>or</span> <a href="forgot.php">forgot?</a>
	</div>
</div>

<!-- signup -->
<div class="form-login-float form-signup <?php if(isset($_POST['login'])||!isset($_POST['signup'])){echo"d-none";}?>">
	<button class="close close-signup" onclick="closeForm()"></button>
	<div class="content">
		<h1>SIGN UP<span>.</span></h1>
		<?php if(isset($_SESSION["warningSignup"])): ?>
		<?php if($_SESSION["warningSignup"]!=='0'): ?>
		<i style="color:red;"><?= $_SESSION["warningSignup"]; ?></i>
		<?php endif; ?>
		<?php endif; ?>
		<form action="" method="get" onsubmit="loadingBtn()" name="form-signup">
			<div class="username">
				<label for="username">Name</label>
				<input type="text" id="username" name="username" maxlength="50" autocomplete="off" pattern="[a-zA-Z\s]+"
					minlength="2" title="Only characters and spaces" placeholder="*Only characters" required
					value="<?php if(isset($_SESSION['signupExist'])){echo"$username";}?>">
			</div>
			<div class="email">
				<label for="email2">Email</label>
				<input type="email" id="email2" name="email" maxlength="50" placeholder="*@gmail.com" required
					value="<?php if(isset($_SESSION['signupExist'])){echo"$email";}?>">
			</div>
			<div class="password">
				<div class="label">
					<label for="password2">Password</label>
				</div>
				<input type="password" class="showPassword2" id="password2" name="password" pattern="[^' ']+" minlength="8"
					placeholder="*Min-length 8" title="No spaces" autocomplete="off" required
					value="<?php if(isset($_SESSION['signupExist'])){echo"$password";}?>">
			</div>
			<div class="password" id="confirm-password">
			</div>
			<button type="submit" name="signup"><span><i class="fa fa-circle-o-notch fa-spin d-none"></i>CONTINUE</span> <svg
					xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-right"
					viewBox="0 0 16 16">
					<path fill-rule="evenodd"
						d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
				</svg></button>
		</form>
		<a onclick="login()">have an account?</a> <span>or</span> <a href="forgot.php">forgot?</a>
	</div>
</div>
<!-- login -->
<script src="assets/js/login.js"></script>
<?php 
$_SESSION["warningLogin"]="0"; 
$_SESSION["warningSignup"]="0";
unset($_SESSION['signupExist']);
unset($_SESSION['verificationPage']);
?>
<?php endif; ?>
<?php elseif(isset($_SESSION['verificationForm'])): ?>
<div class="form-login-float form-verification">
	<button class="close close-activation" onclick="closeForm()"></button>
	<div class="content content-verification">
		<h1>VERIFICATION<span>.</span></h1>
		<?php if(isset($_SESSION["warningVerification"])): ?>
		<?php if($_SESSION["warningVerification"]!=='0'): ?>
		<i style="color:red;"><?= $_SESSION["warningVerification"]; ?></i>
		<?php endif; ?>
		<?php endif; ?>
		<form action="" method="post" name="form-verificaton">
			<div class="verification">
				<input type="text" name="activation_code" required placeholder="*Check email" maxlength="6" autocomplete="off">
			</div>
			<button type="submit" name="verification"><span>CONTINUE</span> <svg xmlns="http://www.w3.org/2000/svg" width="25"
					height="25" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
					<path fill-rule="evenodd"
						d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
				</svg></button>
		</form>
		<form action="" method="post" style="display:inline-block;">
			<input type="hidden" hidden name="cancel">
			<a onclick="$(this).closest('form').submit();">cancel?</a>
		</form>
		<span>or</span>
		<form action="" method="post" style="display:inline-block;" onsubmit="loadingBtn()">
			<span id="demo"><i class='fa fa-circle-o-notch fa-spin' style='color:black;'></i></span>
			<input type="hidden" hidden name="resend">
		</form>
	</div>
</div>
<script>
// Set the date we're counting down to
// 1. JavaScript
// var countDownDate = new Date("Sep 5, 2018 15:37:25").getTime();
// 2. PHP
var countDownDate = <?php echo strtotime($_SESSION['now']); ?> * 1000;
var now = <?php  echo time() ?> * 1000;

// Update the count down every 1 second
var x = setInterval(function() {

	// Get todays date and time
	// 1. JavaScript
	// var now = new Date().getTime();
	// 2. PHP
	now = now + 1000;

	// Find the distance between now an the count down date
	var distance = countDownDate - now;

	// Time calculations for days, hours, minutes and seconds
	var days = Math.floor(distance / (1000 * 60 * 60 * 24));
	var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
	var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
	var seconds = Math.floor((distance % (1000 * 60)) / 1000);

	// Output the result in an element with id="demo"
	document.getElementById("demo").innerHTML = ('0' + minutes).slice(-2) + ":" + ('0' + seconds).slice(-2);

	// If the count down is over, write some text 
	if (distance < 0) {
		clearInterval(x);
		document.getElementById("demo").innerHTML =
			"<i class='fa fa-circle-o-notch fa-spin d-none' style='color:black;'></i><a  class='resend-form' onclick=" +
			"$(this).closest('form').submit();" +
			">resend?</a>";
	}
}, 1000);
</script>

<!-- login -->
<script src="assets/js/verification.js"></script>
<?php
unset($_SESSION['signupExist']);
$_SESSION["warningVerification"]="0"; 
?>
<?php endif; ?>