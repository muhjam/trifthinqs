<?php 
// memeriksa sudah login atau belum
session_start();
require 'assets/php/functions.php';

if(isset($_SESSION['level'])){
$level=$_SESSION['level'];
$username=$_SESSION['username'];
$email=$_SESSION['email'];
$id_u=$_SESSION['id'];
// notif cart
$cart=mysqli_query(koneksi(),"SELECT * FROM cart WHERE id_u='$id_u'");
}


// jenis produk
$jenisProduk=query("SELECT * FROM jenis_produk");


if(isset($_SESSION['level'])){
// profile
$profile=query("SELECT * FROM users WHERE id='$id_u'")['0'];
}





if(isset($_POST['cart'])){
	$conn=koneksi();	
$id_c=$_POST['cart'];

$ada=mysqli_query($conn,"SELECT * FROM cart WHERE id_u='$id_u' AND id_p='$id_c'");


if(mysqli_fetch_assoc($ada)){


}else{

mysqli_query($conn, "INSERT INTO cart (`id_u`, `id_p`) VALUE ('$id_u', '$id_c') ");

}


}


if(isset($_POST['remove'])){
	$conn=koneksi();	

$id_r=$_POST['remove'];

mysqli_query($conn, "DELETE FROM `wish` WHERE id_u='$id_u' AND id_p='$id_r' ");


}



$wishlist=mysqli_query(koneksi(), "SELECT * FROM wish, produk WHERE id_p=produk.id AND id_u='$id_u'");



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
	<link rel="stylesheet" href="assets/css/nav.css" />
	<link rel="stylesheet" href="assets/css/wishlist.css" />
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

			<li>
				<a href="wishlist.php"><i class="fas fa-heart active"></i>
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



	<!-- awal isi wishlist -->
	<div class="title">
		<h3>Wishlist</h3>
		<div class="sub-title">
			<a href="index.php">home</a> / <a href="index.php#shop">shop</a> / <a href="#" id="point">wishlist</a>
		</div>
	</div>

	<section class="container">

		<?php if(mysqli_fetch_assoc($wishlist)): ?>
		<table cellpadding="10" cellspacing="0">
			<tr>
				<th></th>
				<th></th>
				<th>Product</th>
				<th>Size</th>
				<th>Price</th>
				<th></th>
			</tr>

			<?php foreach($wishlist as $product): ?>
			<tr>
				<td>
					<form action="" method="post" onclick="submit()">
						<input type="hidden" value="<?= $product['id'];?>" name="remove">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg"
							viewBox="0 0 16 16">
							<path
								d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
						</svg>
					</form>
				</td>
				<td><img src="assets/img/<?= $product['gambar'];?>"></td>
				<td>
					<a href="product.php?number=<?= $product['id'];?>"><?= $product['nama_produk'];?></a>
				</td>
				<td><?= $product['ukuran'];?></td>
				<td><?= idr($product['harga']);?></td>
				<td>
					<form action="" method="post" onclick="submit()">
						<input type="hidden" value="<?= $product['id'];?>" name="cart">
						ADD TO CART
					</form>
				</td>
			</tr>
			<?php endforeach; ?>

		</table>
		<?php else: ?>
		<div style="padding:0 0 200px 0;text-align:center;">
			<h1
				style="color:#a9a9a9;font-family: 'Open Sans', sans-serif;margin-top:120px;text-align:center;text-transform:uppercase;font-weight:400;">
				WISHLIST IS EMPTY</h1>
		</div>
		<?php endif; ?>
	</section>

	<!-- akhir isi wishlist -->







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


	<!-- to Top -->
	<script src="assets/js/toTop.js"></script>

	<!-- contact -->
	<script src="assets/js/contact.js"></script>

	<!-- zoomimage -->
	<script src="assets/js/zoomImg.js"></script>

</body>

</html>