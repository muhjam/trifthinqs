<?php 
// memeriksa sudah login atau belum
session_start();
require 'assets/php/functions.php';

if(isset($_SESSION['level'])){
$level=$_SESSION['level'];
$username=$_SESSION['username'];
$email=$_SESSION['email'];
$id_u=$_SESSION['id'];$id_u=$_SESSION['id'];
// notif cart

$wish=mysqli_query(koneksi(),"SELECT * FROM wish WHERE id_u='$id_u'");
}


// jenis produk
$jenisProduk=query("SELECT * FROM jenis_produk");


if(isset($_SESSION['level'])){
// profile
$profile=query("SELECT * FROM users WHERE id='$id_u'")['0'];
}

// notif cart
if(isset($_COOKIE['shopping_cart'])){
	$cookie=strlen($_COOKIE['shopping_cart']);
	$cookie_data=stripcslashes($_COOKIE['shopping_cart']);
	$cart_data=json_decode($cookie_data, true);
}
 ?>


<!DOCTYPE html>
<html lang="en">

<head>
	<!-- awal head -->
	<?php include 'head.php'; ?>
	<!-- akhir head -->
	<!-- my css -->
	<link rel="stylesheet" href="assets/css/contact.css" />
</head>

<body>
	<!-- awal isi konten -->

	<!-- awal navbar -->
	<?php include 'nav.php'; ?>
	<!-- akhir navbar -->


	<!-- awal isi contact -->

	<div class="title">
		<h3>Contact</h3>
		<div class="sub-title">
			<a href="index.php">home</a> / <a href="index.php#shop">shop</a> / <a href="#" id="point">Contact</a>
		</div>
	</div>

	<section id="contact">

		<div class="alert alert-success d-none">
			<i>Success add message!</i> <a href="#" class="close">&#x2715</a>
		</div>

		<div class="alert alert-failed d-none">
			<i>Failed add message!</i> <a href="#" class="close">&#x2715</a>
		</div>

		<div class="contact">
			<form action="assets/php/send.php" method="post" name="goturthinqs-contact-form">
				<div class="row">
					<div class="col">
						<label for="name"><i class="fas fa-user"></i></label>
						<input type="text" id="name" name="name" placeholder="Name" required onkeyup="inputKeyup()">
					</div>
				</div>

				<div class="row">
					<div class="col">
						<label for="email"><i class="fas fa-envelope"></i></label>
						<input type="email" id="email" name="email" placeholder="Email" required onkeyup="inputKeyup()">
					</div>
				</div>

				<div class="row">
					<div class="col textarea">
						<label for="email"></label>
						<textarea name="message" id="message" placeholder="Send Message for us" required
							onkeyup="inputKeyup()"></textarea>
					</div>
				</div>

				<div class="row">
					<div class="col button">
						<button type="submit" class="btn-kirim">Send</button>
						<button class="buttonload d-none btn-loading" type="button">
							<i class="fa fa-circle-o-notch fa-spin"></i>Loading
						</button>
						<button type="reset" name="cancel" class="cancel d-none" onclick="cancell()">Cancel</button>
					</div>
				</div>
			</form>
		</div>

	</section>
	<!-- akhir isi contact -->


	<!-- awal footer -->
	<?php include 'footer.php'; ?>
	<!-- akhir footer -->



	<!-- jquery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<!-- navbar -->

	<script src="assets/js/nav_contact.js"></script>
	<!-- slide -->
	<script src="assets/js/slide.js"></script>
	<script src="assets/js/auto-slide.js"></script>
	<!-- contact -->
	<script src="assets/js/contact.js"></script>


</body>

</html>