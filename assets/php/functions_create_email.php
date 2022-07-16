<?php

session_start();
require 'functions.php';
  $_SESSION['masuk']="tidak";
if(isset($_POST['email'])){
  $_SESSION['masuk']="masuk";
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
	<link rel="icon" href="../icon/icon.png">



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

</head>

<body style="background-image:url('../background/login.jpg');">
	<!-- Sweet Alert -->
	<script src='../js/sweetalert2.all.min.js'></script>
	<?php

  require("PHPMailer-master/src/PHPMailer.php");
  require("PHPMailer-master/src/SMTP.php");

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->IsSMTP(); // enable SMTP

$email=$_POST['email'];
$username=$_POST['username'];
$kode_aktifasi=$_POST['kode_aktifasi'];
$password=$_POST['password'];
$password2=$_POST['password2'];

// Cek username sudah ada atau belum
// koneksi ke database
$conn=koneksi();
$result=mysqli_query($conn,"SELECT * FROM users WHERE email='$email' AND status='on'");
$result2=mysqli_query($conn,"SELECT * FROM users WHERE email='$email' AND status='non'");



if(mysqli_fetch_assoc($result2)){

mysqli_query($conn, "DELETE FROM users WHERE `users`.`email` = '$email'");



}else if(mysqli_fetch_assoc($result)){
	    echo "
        <script>
			 Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'Sorry, account where you input already exists!'
}).then(function(){
document.location.href='../../signup.php';
});
        </script>";

return false;

} 



if(substr($email, -9)!='gmail.com'){

    echo "
        <script>
			 Swal.fire({
  icon: 'error',
  title: 'Sorry',
  text: 'Please use @gmail.com for creating account GoturthinQs.!'
}).then(function(){
document.location.href='../../signup.php';
});
        </script>";

return false;
}



 // cek konsfirmasi password
    if($password !== $password2){
        echo "
        <script>
			 Swal.fire({
  icon: 'error',
  title: 'Wrong!',
  text: 'Confirm password is wrong !'
}).then(function(){
document.location.href='../../signup.php';
});
        </script>";

return false;

    }







if(isset($_POST['signup'])){
  if(signup($_POST)>0){

    } else {
        echo mysqli_error($conn);
    }
}




$_SESSION['akunbaru']="$email";

//Replace space with %20 for url to understand.
// $username = str_replace(' ', '%20', $users);






    $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = "GoturthinQs@gmail.com";
    $mail->Password = "jprlsaijvuirvabd";
    $mail->SetFrom("GoturthinQs@gmail.com");
    $mail->Subject = "Confirm your account GoturthinQs";
    $mail->Body = "Selamat datang $username ditoko kami, Silahkan masukan kode aktifasinya : <br> <h1 style='text-align:center;'>$kode_aktifasi</h1>";
    $mail->AddAddress($email);

     if(!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
     } else {
        echo "Message has been sent";
				header("location:../../verification.php");
     }
?>

</body>

</html>