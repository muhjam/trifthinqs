<?php
// session
include "assets/login/session.php";
// navbar if all items on click
if(isset($_GET['home'])){
	unset($_SESSION['search']);
	header("Location: index.php");
}
if(isset($_GET['shop'])){
	unset($_SESSION['search']);
	header("Location: index.php#shop");
}
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

if(isset($_GET['q'])){
if($_GET['q']==""){
	header("location:index.php#shop");
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

		<!-- awal produk -->
		<div id="shop" data-aos="fade-up" style="display:block;">
			<?php if(isset($_GET['q'])||isset($_GET['type'])): ?>
			<div class="title-index" style="margin-top:100px;">
				<?php if(isset($_GET['q'])&&!isset($_GET['type'])): ?>
				<span class="heading">LOOKING FOR</span>
				<?php elseif(!isset($_GET['q'])&&isset($_GET['type'])): ?>
				<span class="heading"><?= $_GET['type']; ?></span>
				<?php endif; ?>
			</div>
			<?php endif; ?>

			<?php if(!isset($_GET['q'])&&!isset($_GET['type'])): ?>
			<div class="title-index">
				<span class="heading fist-heading">NEW ARRIVALS</span>
			</div>
			<?php endif; ?>

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
				<a class="load-more">CLICK TO LOAD MORE</a>
			</div>
			<!-- akhir loadmore -->

		</div>
		<!-- akhir produk -->

		<!-- awal footer -->
		<?php include 'assets/section/footer.php'; ?>
		<!-- akhir footer -->
		<!-- slide -->
		<script src="assets/js/slide.js"></script>
		<script src="assets/js/auto-slide.js"></script>
	</body>

</html>