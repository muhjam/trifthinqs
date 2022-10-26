<?php 
// session
include "assets/login/session.php";
 ?>


<!DOCTYPE html>
<html lang="en">

	<head>
		<!-- awal head -->
		<?php include 'assets/section/head.php'; ?>
		<!-- akhir head -->
		<!-- my css -->
		<link rel="stylesheet" href="assets/css/contact.css" />
	</head>

	<body>
		<?php if(isset($_SESSION['error'])): ?>
		<?php include 'assets/php/error.php'; ?>
		<?php else: ?>
		<!-- awal login form -->
		<?php include 'assets/login/login.php'; ?>
		<!-- akhir login form -->
		<?php endif; ?>

		<!-- awal isi konten -->
		<!-- awal navbar -->
		<?php include 'assets/section/nav.php'; ?>
		<!-- akhir navbar -->


		<!-- awal isi contact -->
		<div class="title">
			<h3>Contact</h3>
			<div class="sub-title">
				<a href="index.php?home">home</a> / <a href="index.php?shop">shop</a> / <a href="#" id="point">Contact</a>
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
				<form action="assets/php/send.php" method="post" name="TrifthinQs Store-contact-form">

					<div class="section">
						<label for="name">
							<input type="text" id="name" name="name" placeholder="Name" required onkeyup="inputKeyup()">
							<label><i class="fas fa-user"></i></label>
						</label>
					</div>

					<div class="section">
						<label for="email" class="icon-prend">
							<input type="email" id="email" name="email" placeholder="Email" required onkeyup="inputKeyup()">
							<label class="icon-form"><i class="fas fa-envelope" style="color:black;"></i></label>
						</label>
					</div>

					<div class="section">
						<label for="message">
							<textarea name="message" id="message" placeholder="Send Message for us" required
								onkeyup="inputKeyup()"></textarea>
						</label>
					</div>

					<div class="button">
						<button type="submit" class="btn-kirim">Send</button>
						<button class="buttonload d-none btn-loading" type="button">
							<i class="fa fa-circle-o-notch fa-spin"></i>Loading
						</button>
						<button type="reset" name="cancel" class="cancel d-none" onclick="cancell()">Cancel</button>
					</div>
				</form>
			</div>
			<!-- <div class="map" style="width:100%;display:flex;justify-content:center;">
				<iframe
					src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2601141.170198934!2d106.61469224054412!3d-7.046159555026572!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e43e8ebf7617%3A0x501e8f1fc2974e0!2sCimahi%2C%20Kec.%20Cimahi%20Tengah%2C%20Kota%20Cimahi%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1643875888332!5m2!1sid!2sid"
					width="100%" height="100" style="border:0;filter: invert(90%);" allowfullscreen="" loading="lazy"></iframe>
			</div> -->
		</section>
		<!-- akhir isi contact -->
		<!-- awal footer -->
		<?php include 'assets/section/footer.php'; ?>
		<!-- akhir footer -->
		<!-- jquery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

		<!-- navbar -->

		<script src="assets/js/nav_contact.js"></script>
		<!-- contact -->
		<script src="assets/js/contact.js"></script>


	</body>

</html>