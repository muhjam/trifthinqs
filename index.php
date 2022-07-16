<?php 
// memeriksa sudah login atau belum
session_start();
require 'assets/php/functions.php';

// cek cookie
if(isset($_COOKIE['id'])&&isset($_COOKIE['key'])){
  $idc=$_COOKIE['id'];
  $key=$_COOKIE['key'];

  // ambil username berdasarkan id
  $result= mysqli_query(koneksi(), "SELECT * FROM users WHERE id=$idc");
  $row=mysqli_fetch_assoc($result);

  // cek cookie dan username
  if($key===hash('sha256', $row['id'])){
	$_SESSION['level']=$row['level'];
	$_SESSION['username']=$row['username'];
  $_SESSION['statuls']=$row['status'];
	$_SESSION['email']=$row['email'];	
	$_SESSION['id']=$row['id'];
  }
	
if(isset($_SESSION['level'])){
$level=$_SESSION['level'];
$username=$_SESSION['username'];
$email=$_SESSION['email'];
$id_u=$_SESSION['id'];
}

}

if(isset($_SESSION['level'])){
$level=$_SESSION['level'];
$username=$_SESSION['username'];
$email=$_SESSION['email'];
$id_u=$_SESSION['id'];
// notif cart
$cart=mysqli_query(koneksi(),"SELECT * FROM cart WHERE id_u='$id_u'");
$wish=mysqli_query(koneksi(),"SELECT * FROM wish WHERE id_u='$id_u'");
}

// produk
$goturthings = query("SELECT * FROM jenis_produk INNER JOIN produk ON jenis_produk.jenis_produk=produk.jenis_produk INNER JOIN ukuran ON ukuran.ukuran = produk.ukuran ORDER BY produk.id DESC");
  




// jenis produk
$jenisProduk=query("SELECT * FROM jenis_produk");


if(isset($_SESSION['level'])){
// profile
$profile=query("SELECT * FROM users WHERE id='$id_u'")['0'];
}

if(isset($_POST['search'])){
	$goturthings=search($_POST['search']);
	$search=$_POST['search'];
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

	<!-- my css -->
	<link rel="stylesheet" href="assets/css/style.css" />
	<link rel="stylesheet" href="assets/css/nav.css" />
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
				<a class="active">Shop</a>
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
				<a href="contact.php">Contact</a>
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



	<!-- awal slide -->
	<div class="slideshow-container" id="slideshow">

		<!-- Full-width images with number and caption text -->
		<div class="mySlides fade">
			<img src="assets/img/slide.png">
			<div class="text">GoturthinQs@gmail.com</div>
		</div>

		<div class="mySlides fade">
			<img src="assets/img/slidee.png">
			<div class="text">GoturthinQs@gmail.com</div>
		</div>

		<div class="mySlides fade">
			<img src="assets/img/slideee.png">
			<div class="text">GoturthinQs@gmail.com</div>
		</div>

		<!-- Next and previous buttons -->
		<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
		<a class="next" onclick="plusSlides(1)">&#10095;</a>
	</div>
	<br>

	<!-- akhir slide -->



	<!-- awal produk live searh -->
	<div id="container" data-aos="fade-up" style="display:none;"></div>
	<!-- akhir produk -->




	<!-- awal produk search -->
	<div id="shop-search" data-aos="fade-up" style="display:none;">

		<div class="title" style="margin-top:100px;">
			<?php if(!isset($_POST['type'])&&!isset($_POST['search'])): ?>
			<span class="heading">NEW ARRIVALS</span>
			<?php elseif(isset($_POST['type'])): ?>
			<span class="heading"><?= $_POST['type']; ?></span>
			<?php elseif(isset($_POST['search'])): ?>
			<?php if(!empty($_POST['search'])): ?>
			<span class="heading">LOOKING FOR</span>
			<?php elseif(empty($_POST['search'])): ?>
			<span class="heading">NEW ARRIVALS</span>
			<?php endif; ?>

			<?php endif; ?>
		</div>



		<?php if(empty($goturthings)): ?>
		<div style="padding:50px 0 200px 0;text-align:center;">
			<h1
				style="color:#a9a9a9;font-family: 'Open Sans', sans-serif;margin-top:120px;text-align:center;text-transform:uppercase;font-weight:400;">
				NO PRODUCT</h1>
		</div>
		<?php endif; ?>


		<div class="produk" data-aos="flip-left" style="margin-bottom:100px;">
			<?php foreach($goturthings as $goturthing): ?>
			<a href="product.php?number=<?= $goturthing['id'];?>" class="news-item">
				<input type="hidden" value="<?= $goturthing['id'];?>" name="product">
				<div class="border">
					<img src="assets/img/<?= $goturthing['gambar']?>">
				</div>
				<h4><?= $goturthing['nama_produk']; ?></h4>
				<p><?= idr($goturthing["harga"]); ?></p>
			</a>
			<?php endforeach; ?>
		</div>

	</div>
	<!-- akhir produk -->






	<!-- awal produk normal -->

	<?php // produk
$goturthings = query("SELECT * FROM jenis_produk INNER JOIN produk ON jenis_produk.jenis_produk=produk.jenis_produk INNER JOIN ukuran ON ukuran.ukuran = produk.ukuran ORDER BY produk.id DESC");
  ;
	
if(isset($_POST['type'])){
$goturthings=type($_POST["type"]);
}
	
	?>


	<?php if(!isset($_POST['type'])): ?>
	<style>
	.slideshow-container {
		display: block;
	}

	#map {
		display: block;
	}

	.title {
		margin-top: 20px;
	}

	.produk {
		margin-bottom: 50px;
	}
	</style>

	<?php elseif(isset($_POST['type'])): ?>
	<style>
	.slideshow-container {
		display: none;
	}

	#map {
		display: none;
	}

	.title {
		margin-top: 100px;
	}

	.produk {
		margin-bottom: 100px;
	}
	</style>

	<?php endif; ?>

	<div id="shop" data-aos="fade-up" style="display:block;">

		<div class="title">
			<?php if(!isset($_POST['type'])): ?>
			<span class="heading">NEW ARRIVALS</span>
			<?php elseif(isset($_POST['type'])): ?>
			<span class="heading"><?= $_POST['type']; ?></span>
			<?php endif; ?>
		</div>



		<?php if(empty($goturthings)): ?>
		<div style="padding:50px 0 200px 0;text-align:center;">
			<h1
				style="color:#a9a9a9;font-family: 'Open Sans', sans-serif;margin-top:120px;text-align:center;text-transform:uppercase;">
				NO PRODUCT</h1>
		</div>
		<?php endif; ?>


		<div class="produk" data-aos="flip-left">
			<?php foreach($goturthings as $goturthing): ?>
			<a href="product.php?number=<?= $goturthing['id'];?>" class="news-items">
				<input type="hidden" value="<?= $goturthing['id'];?>" name="product">
				<div class="border">
					<img src="assets/img/<?= $goturthing['gambar']?>">
				</div>
				<h4><?= $goturthing['nama_produk']; ?></h4>
				<p><?= idr($goturthing["harga"]); ?></p>
			</a>
			<?php endforeach; ?>
		</div>

		<!-- awal loadmore -->
		<div class="loadMore" id="loadMore" data-aos="flip-left">
			<button class="load-more">Load More</button>
		</div>
		<!-- akhir loadmore -->

	</div>
	<!-- akhir produk -->






	<!-- map -->
	<div id="map" class="fh5co-map" data-aos="fade-up" data-aos-offset="300">
		<iframe
			src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2601141.170198934!2d106.61469224054412!3d-7.046159555026572!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e43e8ebf7617%3A0x501e8f1fc2974e0!2sCimahi%2C%20Kec.%20Cimahi%20Tengah%2C%20Kota%20Cimahi%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1643875888332!5m2!1sid!2sid"
			width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
	</div>
	<!-- akhir map -->

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

	<!-- ajax -->
	<script src="assets/js/productAjax.js"></script>

	<!-- jquery -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="assets/jquery/costum.js"></script>

	<!-- admin -->

</body>

</html>