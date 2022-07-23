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

$wish=mysqli_query(koneksi(),"SELECT * FROM wish WHERE id_u='$id_u'");
}

// jenis produk
$jenisProduk=query("SELECT * FROM jenis_produk");

if(isset($_SESSION['level'])){
// profile
$profile=query("SELECT * FROM users WHERE id='$id_u'")['0'];
}

$shoppingCart=mysqli_query(koneksi(), "SELECT * FROM cart, produk WHERE id_p=produk.id AND id_u='$id_u'");

$total=query("SELECT SUM(produk.harga) as total FROM cart, produk WHERE id_p=produk.id AND id_u='$id_u'")[0]['total'];
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

	<link rel="stylesheet" href="assets/css/cart.css" />
	

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
					<input type="search" name="search" id="search" autocomplete="off">
					<label class="fas fa-search" for="search"></label>
				</form>
			</li>

			<?php if(isset($_SESSION['level'])): ?>
			<?php if($_SESSION['level']=='user'||$_SESSION['level']=='admin'): ?>
			<li id="notif-cart">
				<a href="cart.php">
					<i class="fas fa-cart-arrow-down active"></i>
				</a>
			</li>

			<li>
				<a href="wishlist.php"><i class="fas fa-heart "></i>
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

	<!-- awal isi cart -->
	<div class="title">
		<h3>Shopping Cart</h3>
		<div class="sub-title">
			<a href="index.php">home</a> / <a href="index.php#shop">shop</a> / <a href="#" id="point">cart</a>
		</div>
	</div>

	<section id="container">
		<?php if(mysqli_fetch_assoc($shoppingCart)): ?>
		<table>
			<?php foreach($shoppingCart as $product): ?>
			<tr class="tr-product">
				<td><img src="assets/img/<?= $product['gambar'];?>" width="100px" height="100px"></td>
				<td><strong><a href="product.php?number=<?= $product['id'];?>"><?= $product['nama_produk']; ?></a></strong>
					<br>
					<i><?= $product['kode_produk']; ?></i>
					<br>
					Type - <strong><?= $product['jenis_produk']; ?></strong>
					<br>
					Size - <strong><?= $product['ukuran']; ?></strong>
				</td>
				<?php 
					$valueCart=$id_u.','.$product['id']; 
					?>
				<td><a onclick="removeCart(<?= $valueCart;?>)">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash"
							viewBox="0 0 16 16">
							<path
								d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
							<path fill-rule="evenodd"
								d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
						</svg>
					</a></td>
				<td><?= idr($product['harga']);?></td>
			</tr>
			<?php endforeach; ?>
			<tr class="tr-summary">
				<td colspan="3">TOTAL</td>
				<td>
					<?= rupiah($total); ?>
					<br>
					<button>Check Out</button>
				</td>
			</tr>
		</table>
		<?php else: ?>
		<div style="padding:0 0 200px 0;text-align:center;">
			<h1
				style="color:#a9a9a9;font-family: 'Open Sans', sans-serif;margin-top:120px;text-align:center;text-transform:uppercase;font-weight:400;">
				ITMES SHOPPING CART IS EMPTY</h1>
		</div>
		<?php endif; ?>
	</section>
	<!-- akhir isi wishlist -->




	


	<!-- jquery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<script>
	function removeCart(id_u, id_c) {
		const scriptURL = "http://localhost/GoturthinQs/assets/php/functions_cart.php";

		const container = document.querySelector("#container");

		fetch(scriptURL, {
				method: "POST",
				body: new URLSearchParams("id_c=" + id_c),
			})
			.then((response) => {


				console.log("Success!", response);

				// buat object ajax
				var xhr = new XMLHttpRequest();

				// cek kesiapan ajax
				xhr.onreadystatechange = function() {
					if (xhr.readyState == 4 && xhr.status == 200) {
						container.innerHTML = xhr.responseText;
					}
				};

				// eksekusi ajax
				xhr.open("GET", "assets/ajax/tablecart.php?id_u=" + id_u, true);
				xhr.send();

			})
			.catch((error) => {
				console.error("Error!", error.message);
			});
	}
	</script>

	<!-- navbar -->

	<!-- to Top -->
	<script src="assets/js/toTop.js"></script>


</body>

</html>