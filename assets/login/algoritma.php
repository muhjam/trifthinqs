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
			// buat session login dan username
			$_SESSION['username'] = $row['username'];
			$_SESSION['email'] = $email;
			$_SESSION['level'] = $row['level'];
			$_SESSION['id']=$row['id'];
			$_SESSION['status']=$row['status'];
			$_SESSION['login']='1';
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
}else if(substr($email, -10)!='@gmail.com'||substr_count($email, '@')!='1'||strlen($email)<=10){
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
	$_SESSION['ver_username']=$username;
	$_SESSION['ver_email']=$email;
	$_SESSION['ver_password1']=$password;
	$_SESSION['ver_password2']=$password2;
	
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
				// set time
							$datenow=date("H:i:s");
							$minutes2=strtotime($datenow.'+ 2 minutes');
							$_SESSION['now']=date("M d, Y H:i:s", $minutes2);
						 // set cookie
						 setcookie('verification', $email, time()+120,"/");
						 $_SESSION['verificationForm']='1';
						 $_SESSION['signup']='1';
						 unset($_SESSION['forgotPassword']);
							 // header("location:verification.php");
							 // exit;
				} else {
						echo mysqli_error($conn);
				}
     }
}
}
}
// signup terakhir

// forgot awal
if(isset($_POST['forgot'])){
	unset($_POST['cancel']);
	unset($_SESSION['signupExist']);
if(isset($_POST['forgot'])&&isset($_POST['email'])){
$activation_code=gen_uid();
$email=$_POST['email'];
// Cek username sudah ada atau belum
// koneksi ke database
$conn=koneksi();
$result=mysqli_query($conn,"SELECT * FROM users WHERE email='$email' AND status='on'");
$result2=mysqli_query($conn,"SELECT * FROM users WHERE email='$email' AND status='non'");
$result3=mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");

if(mysqli_fetch_assoc($result3)==0){
$_SESSION['warningForgot']="Sorry, this account doesn't exist";
}else if(mysqli_fetch_assoc($result2)){
$_SESSION['warningForgot']="Sorry, this account doesn't exist";
mysqli_query($conn, "DELETE FROM users WHERE `users`.`email` = '$email'");
}else if(mysqli_fetch_assoc($result)){

$username=query("SELECT * FROM users WHERE email='$email' AND status='on'")[0]['username'];

require("assets/php/PHPMailer-master/src/PHPMailer.php");
  require("assets/php/PHPMailer-master/src/SMTP.php");
		$mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->IsSMTP(); // enable SMTP
// Cek username sudah ada atau belum{
	// session
	$_SESSION['activation_code']=$activation_code;
	$_SESSION['ver_username']=$username;
	$_SESSION['ver_email']=$email;
	
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = "trifthinqs@gmail.com";
    $mail->Password = "payxcuknujnvegld";
    $mail->SetFrom("trifthinqs@gmail.com");
    $mail->Subject = "Confirm change password";
    $mail->Body = "Hallo $username, Please change the password using the activation code : <br> <h1 style='text-align:center;'>$activation_code</h1>";
    $mail->AddAddress($email);
		
     if(!$mail->Send()) {
        $_SESSION['error']='Something wrong, please try again!';
     } else {
			if(sendCode($_SESSION)>0){
			// set time
			$datenow=date("H:i:s");
			$minutes2=strtotime($datenow.'+ 2 minutes');
			$_SESSION['now']=date("M d, Y H:i:s", $minutes2);
		 // set cookie
		 setcookie('verification', $email, time()+120,"/");
		 $_SESSION['verificationForm']="1";
			$_SESSION['forgotPassword']="1";
			unset($_SESSION['signup']);
			 // header("location:verification.php");
			 // exit;
				} else {
						echo mysqli_error($conn);
				}

     }
}
}
}
// forgot akhir

// login success
	if(isset($_SESSION['login'])){
	if($_SESSION['login']==='1'){
	echo"
	<script>
	const Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 2000,
		timerProgressBar: true,
		didOpen: (toast) => {
			toast.addEventListener('mouseenter', Swal.stopTimer)
			toast.addEventListener('mouseleave', Swal.resumeTimer)
		}
	})
	Toast.fire({
		icon: 'success',
		title: 'Welcome, ".$username."'
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
					if(isset($_SESSION['ver_email'])){
						$email=$_SESSION['ver_email'];
						if(isset($_POST['activation_code'])){
						$activation = query("SELECT kode_aktivasi FROM users WHERE email='$email'")[0]['kode_aktivasi'];
					// untuk dihosting
						if($_POST['activation_code']==$activation){
							if(isset($_SESSION['signup'])){
							activation($_POST);
									echo "
									<script>
								Swal.fire({
						icon: 'success',
						title: 'Success!',
						text: 'Your account has been created successfully!',
					})
							</script>";
							session_unset();
							unset($_SESSION['verificationForm']);
							}else if(isset($_SESSION['forgotPassword'])){
								$_SESSION['changeForm']='1';
							}
						}else{
							// window.history.go(-2);});
							$_SESSION['warningVerification']='Wrong activation code!';
									
						}
		
				}
		}else{
			session_unset();
}
}
// akhir activationform

if(isset($_POST['cancel'])){
	setcookie('verification', null, -99999, '/');
	$email_c=$_SESSION['ver_email'];

	if(isset($_SESSION['signup'])){
	// delete email
	mysqli_query(koneksi(), "DELETE FROM users WHERE `users`.`email` = '$email_c'");
}
session_unset();
}


if(!isset($_COOKIE['verification'])){
		if(isset($_SESSION['ver_email'])){

			if(resetCode($_SESSION)>0){
				$_SESSION['warningVerification']='Expired!';
			} else {
					echo mysqli_error($conn);
			}

			if(isset($_POST['resend'])){
				$activation_code=gen_uid();
				$email=$_SESSION['ver_email'];
				$username=$_SESSION['ver_username'];
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
						if(isset($_SESSION['signup'])){
						$mail->Subject = "Confirm your account TrifthinQs Store";
						$mail->Body = "Welcome to our store $username, please enter the activation code : <br> <h1 style='text-align:center;'>$activation_code</h1>";
					}else if(isset($_SESSION['forgotPassword'])){
						$mail->Subject = "Confirm change password";
						$mail->Body = "Hallo $username, Please change the password using the activation code : <br> <h1 style='text-align:center;'>$activation_code</h1>";
					}
						$mail->AddAddress($email);
						
						if(!$mail->Send()) {
							$_SESSION['error']='1';
						} else {
							if(resend($_SESSION)>0){
					// set time
					$datenow=date("H:i:s");
					$minutes2=strtotime($datenow.'+ 2 minutes');
					$_SESSION['now']=date("M d, Y H:i:s", $minutes2);
					// set cookie
					setcookie('verification', $email, time()+120,"/");
					$_SESSION['verificationForm']='1';
							} else {
									echo mysqli_error($conn);
							}
							unset($_SESSION['warningVerification']);
							unset($_POST['resend']);
						}

				}
			}
		}else if(!isset($_SESSION['ver_email'])){
			session_unset();
		}
}else if(isset($_COOKIE['verification'])){
if(isset($_SESSION['warningVerification'])){
	if($_SESSION['warningVerification']=='Expired!'){
		unset($_SESSION['warningVerification']);
	}
}
	unset($_POST['resend']);
}

// change password
if(isset($_SESSION['changeForm'])){
	if(isset($_POST['changePassword'])){
	$email=$_SESSION['ver_email'];
	$password=$_POST['password'];
	$password2=$_POST['password2'];
	
	// Cek username sudah ada atau belum
	// koneksi ke database
	$conn=koneksi();
	$result=mysqli_query($conn,"SELECT * FROM users WHERE email='$email' AND status='on'");
	$result2=mysqli_query($conn,"SELECT * FROM users WHERE email='$email' AND status='non'");
	
	if($password !== $password2){
		$_SESSION['warningChange']="Sorry, the password confirmation doesn"."'"."t match!";
	}else if($password === $password2){
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
		session_unset();
	}else{
		echo mysqli_error($conn);
	}
	}
}
}

 ?>