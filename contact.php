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
$cart=mysqli_query(koneksi(),"SELECT * FROM cart WHERE id_u='$id_u'");
$wish=mysqli_query(koneksi(),"SELECT * FROM wish WHERE id_u='$id_u'");
}


// jenis produk
$jenisProduk=query("SELECT * FROM jenis_produk");


if(isset($_SESSION['level'])){
// profile
$profile=query("SELECT * FROM users WHERE id='$id_u'")['0'];
}


 ?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="GoturthinQs. trifthing shop fashion in Bandung, Indonesia" />
	<meta name="generator" content="Eleventy v1.0.1" />
	<meta name="keywords" content="trifthing, fashion, online shop" />
	<meta name="author" content="Muhamad Jamaludin" />
	<link rel="apple-touch-icon" sizes="180x180" href="assets/img/icon.png" />
	<link rel="shortcut icon" href="assets/img/icon.png" />
	<!-- icon -->
	<link rel="icon" href="assets/icon/icon.png" />

	<title>GoturthinQs.</title>

	<!-- font awesome -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

	<!-- Add icon library -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<!-- my css -->
	<link rel="stylesheet" href="assets/css/contact.css" />
	<link rel="stylesheet" href="assets/css/nav.css" />
	<link rel="stylesheet" href="assets/css/title.css" />
	<!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Libre+Bodoni:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600;1,700&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
		rel="stylesheet">


	<!-- AOS -->
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
</head>

<body>
	<!-- awal isi konten -->

	<!-- awal navbar -->
	<nav>
		<ul class="nav-list">
			<li id="shop-nav">
				<a>Shop</a>
				<ul class="shop nav-dropdown">
					<li>
						<h1>Collections</h1>
					</li>

					<?php foreach($jenisProduk as $jenis): ?>
					<form action="index.php" method="post" id="theForm<?= $jenis['jenis_produk'];?>">
						<input type="hidden" name="type" value="<?=$jenis['jenis_produk'];?>">
						<li><a style="cursor:pointer;"
								onclick=" document.getElementById('theForm<?= $jenis['jenis_produk'];?>').submit();"><?=$jenis['jenis_produk'];?></a>
						</li>
					</form>
					<?php endforeach; ?>
					<form action="index.php#shop" method="post" id='allItems'></form>
					<li><a style="cursor:pointer;" onclick="document.getElementById('allItems').submit();"> All Items</a></li>
				</ul>
			</li>

			<li>
				<a href="contact.php" class="active">Contact</a>
			</li>
			<li>

				<?php if(isset($_SESSION['level'])): ?>
				<?php if($_SESSION['level']=='admin'): ?>
			<li>
				<a href="admin/">Dashboard</a>
			</li>
			<li>
				<?php endif; ?>
				<?php endif; ?>

		</ul>

		<a href="index.php" id="logo">
			<h1>GoturthinQs<span>.</span></h1>
		</a>

		<ul class="right">
			<li>
				<form action="index.php" method="post">
					<input type="search" name="search" id="search" autocomplete="off"
						value="<?php if(isset($_POST['search'])){echo $search;}?>">
					<label class="fas fa-search" for="search"></label>
				</form>
			</li>

			<?php if(isset($_SESSION['level'])): ?>
			<?php if($_SESSION['level']=='user'||$_SESSION['level']=='admin'): ?>
			<li id="notif-cart">
				<a href="cart.php">
					<i class="fas fa-cart-arrow-down"></i>
					<?php if(mysqli_fetch_assoc($cart)): ?>
					<span class="notif"><?= mysqli_num_rows($cart); ?></span>
					<?php endif; ?>
				</a>
			</li>

			<li id="notif-wish">
				<a href="wishlist.php"><i class="fas fa-heart"></i>
					<?php if(mysqli_fetch_assoc($wish)): ?>
					<span class="notif"><?= mysqli_num_rows($wish); ?></span>
					<?php endif; ?>
				</a>
			</li>


			<li id="profile">
				<a>
					<img id="profile" src="assets/profile/<?=$profile['foto']?>" alt="<?=$profile['username']?>"
						title="<?=$profile['username']?>"
						style="width:35px; height:35px; object-fit:cover;border-radius:50%;border:2px solid #d6d6d6;">
				</a>
				<ul class="profile nav-dropdown">
					<li><a href="#!">Profile</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</li>
			<?php endif; ?>
			<?php endif; ?>

			<?php if(!isset($_SESSION['level'])): ?>
			<li id="login">
				<a href="login.php">Login</a>
			</li>
			<?php endif; ?>
		</ul>

	</nav>
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
	<!-- Site footer -->
	<footer class="site-footer">
		<div class="container-top">
			<div class="col">
				<h6>About</h6>
				<p class="text-justify">GoturthinQs<span>.</span> is trifthing shop fashion in Bandung, Indonesia. Our
					product 100% original, no refund. You can buy our product to come to our store or you can order via online.
				</p>
			</div>

			<div class="col">
				<h6>Quick Links</h6>
				<ul class="footer-links">
					<li><a href="index.php#">Home</a></li>
					<li><a href="index.php#container">Product Us</a></li>
					<li><a href="contact.php">Contact Us</a></li>
				</ul>
			</div>
		</div>
		<hr>
		</div>

		<div class="container-bottom">
			<div class="col">
				<p class="copyright-text">Copyright &copy; 2022 All Rights Reserved by
					<a href="https://www.instagram.com/muhamadjamaludinpad/">Muhamad Jamaludin</a>.
				</p>
			</div>

			<div class="col">
				<ul class="social-icons">
					<li><a class="facebook" href="https://www.facebook.com/profile.php?id=100078019380277" target="_blank"><i
								class="fab fa-facebook-f"></i></a></li>
					<li><a class="twitter" href="https://twitter.com/muhjmlpad" target="_blank"><i class="fab fa-twitter"></i></a>
					</li>
					<li><a class="instagram" href="https://www.instagram.com/goturthings/" target="_blank"><i
								class="fab fa-instagram"></i></a>
					</li>
					<li><a class="whatsapp"
							href="https://api.whatsapp.com/send?phone=6283124356686&text=Salam kenal Admin Goturthinqs."
							target="_blank"><i class="fab fa-whatsapp"></i></a></li>
				</ul>
			</div>
		</div>
	</footer>
	<!-- akhir footer -->

	<!-- AOS -->
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
	<script>
	AOS.init();
	</script>

	<!-- jquery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

	<!-- navbar -->
	<script src="assets/js/nav.js"></script>

	<!-- slide -->
	<script src="assets/js/slide.js"></script>
	<script src="assets/js/auto-slide.js"></script>

	<!-- to Top -->
	<script src="assets/js/toTop.js"></script>

	<!-- contact -->
	<script src="assets/js/contact.js"></script>


</body>

</html>