<?php 
// session
include "assets/section/session.php";
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
		<!-- awal login form -->
		<?php include 'assets/login/login.php'; ?>
		<!-- akhir login form -->

		<!-- awal isi konten -->
		<!-- awal navbar -->
		<?php include 'assets/section/nav.php'; ?>
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
				<form action="assets/php/send.php" method="post" name="TrifthinQs Store-contact-form">
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