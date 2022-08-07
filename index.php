<?php
// session
include "assets/section/session.php";
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
}
// produk
$trifthinqs = query("SELECT * FROM produk ORDER BY produk.status ASC,id DESC");
// jenis produk
$jenisProduk=query("SELECT * FROM jenis_produk");
if(isset($_SESSION['level'])){
// profile
$profile=query("SELECT * FROM users WHERE id='$id_u'")['0'];
}
if(isset($_POST['search'])){
$trifthinqs=search($_POST['search']);
$search=$_POST['search'];
}
 ?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<!-- awal head -->
		<?php include 'assets/section/head.php'; ?>
		<!-- akhir head -->
		<!-- my css -->
		<link rel="stylesheet" href="assets/css/shop.css" />

		<?php if(!isset($_GET['type'])): ?>
		<style>
		.slideshow-container {
			display: block;
		}

		#map {
			display: block;
		}

		.title-index {
			margin-top: 20px;
		}

		.produk {
			margin-bottom: 50px;
		}
		</style>
		<?php elseif(isset($_GET['type'])): ?>
		<style>
		.slideshow-container {
			display: none;
		}

		#map {
			display: none;
		}

		.title-index {
			margin-top: 100px;
		}

		.produk {
			margin-bottom: 100px;
		}
		</style>
		<?php endif; ?>
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

		<!-- awal isi konten -->

		<!-- awal slide -->
		<div class="slideshow-container" id="slideshow">

			<!-- Full-width images with number and caption text -->
			<div class="mySlides fade">
				<img src="assets/img/slide.png">
				<div class="text">trifthinqs@gmail.com</div>
			</div>

			<div class="mySlides fade">
				<img src="assets/img/slidee.png">
				<div class="text">trifthinqs@gmail.com</div>
			</div>

			<div class="mySlides fade">
				<img src="assets/img/slideee.png">
				<div class="text">trifthinqs@gmail.com</div>
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

			<div class="title-index" style="margin-top:100px;">
				<?php if(!isset($_GET['type'])&&!isset($_POST['search'])): ?>
				<span class="heading">NEW ARRIVALS</span>
				<?php elseif(isset($_GET['type'])): ?>
				<span class="heading"><?= $_GET['type']; ?></span>
				<?php elseif(isset($_POST['search'])): ?>

				<?php if(!empty($_POST['search'])): ?>
				<span class="heading">LOOKING FOR</span>
				<?php elseif(empty($_POST['search'])): ?>
				<span class="heading">NEW ARRIVALS</span>
				<?php endif; ?>

				<?php endif; ?>
			</div>

			<?php if(empty($trifthinqs)): ?>
			<div style="padding:20px 0 200px 0;text-align:center;">
				<h1
					style="color:#a9a9a9;font-family: 'Open Sans', sans-serif;margin-top:120px;text-align:center;text-transform:uppercase;font-weight:400;">
					NO PRODUCT</h1>
			</div>
			<?php endif; ?>

			<div class="produk" data-aos="flip-left" style="margin-bottom:100px;">
				<?php foreach($trifthinqs as $product): ?>
				<a href="product.php?number=<?= $product['id'];?>" class="news-item">
					<input type="hidden" value="<?= $product['id'];?>" name="product">
					<div class="border">
						<img src="assets/img/<?= $product['gambar']?>">
						<div id="label">
							<?php if($product['status']!=='sell'): ?>
							<img src="assets/icon/soldout.png" id="sold">
							<?php endif; ?>
						</div>
					</div>
					<h4><?= $product['nama_produk']; ?></h4>
					<p><?= idr($product["harga"]); ?></p>
				</a>
				<?php endforeach; ?>
			</div>

		</div>
		<!-- akhir produk -->

		<!-- awal produk normal -->
		<?php 
		// produk
		$trifthinqs = query("SELECT * FROM produk ORDER BY produk.status ASC,id DESC");
		
		if(isset($_GET['type'])){
			$typeSearch=$_GET['type'];
			$typeProduct=mysqli_query(koneksi(),"SELECT * FROM jenis_produk WHERE jenis_produk='$typeSearch'");
			if(mysqli_num_rows($typeProduct)>0){
			$trifthinqs=type($_GET["type"]);
			}else{
			$_GET['type']="ALL ITEMS";
			echo"<script>history.back();</script>";
			}

		}
		?>

		<div id="shop" data-aos="fade-up" style="display:block;">

			<div class="title-index">
				<?php if(!isset($_GET['type'])): ?>
				<span class="heading">NEW ARRIVALS</span>
				<?php elseif(isset($_GET['type'])): ?>
				<span class="heading"><?= $_GET['type']; ?></span>
				<?php endif; ?>
			</div>

			<?php if(empty($trifthinqs)): ?>
			<div style="padding:20px 0 200px 0;text-align:center;">
				<h1
					style="color:#a9a9a9;font-family: 'Open Sans', sans-serif;margin-top:120px;text-align:center;text-transform:uppercase;font-weight:400;">
					NO PRODUCT</h1>
			</div>
			<?php endif; ?>

			<div class="produk" data-aos="flip-left">
				<?php foreach($trifthinqs as $product): ?>
				<a href="product.php?number=<?= $product['id'];?>" class="news-items">
					<input type="hidden" value="<?= $product['id'];?>" name="product">
					<div class="border">
						<img src="assets/img/<?= $product['gambar']?>">
						<?php if($product['status']!=='sell'): ?>
						<div id="label">
							<img src="assets/icon/soldout.png" id="sold">
						</div>
						<?php endif; ?>
					</div>
					<h4><?= $product['nama_produk']; ?></h4>
					<p><?= idr($product["harga"]); ?></p>
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
			<!-- <iframe
				src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2601141.170198934!2d106.61469224054412!3d-7.046159555026572!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e43e8ebf7617%3A0x501e8f1fc2974e0!2sCimahi%2C%20Kec.%20Cimahi%20Tengah%2C%20Kota%20Cimahi%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1643875888332!5m2!1sid!2sid"
				width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe> -->
		</div>
		<!-- akhir map -->

		<!-- awal footer -->
		<?php include 'assets/section/footer.php'; ?>
		<!-- akhir footer -->

		<!-- navbar -->
		<script src="assets/js/nav_shop.js"></script>
		<!-- slide -->
		<script src="assets/js/slide.js"></script>
		<script src="assets/js/auto-slide.js"></script>
		<!-- ajax -->
		<script src="assets/js/searchAjax.js"></script>
		<!-- JQuery -->
		<script src="assets/jquery/costum.js"></script>
	</body>

</html>