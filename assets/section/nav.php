<?php
// algoritma login
include "assets/login/algoritma.php";

// get url
$link="http://localhost".$_SERVER['PHP_SELF'];

include "assets/login/welcome.php";

// notif cart
if(isset($_COOKIE['shopping_cart'])&&isset($_COOKIE['code'])&&$_COOKIE['code']===hash('sha256', $_COOKIE['shopping_cart'])){
	$cookie=strlen($_COOKIE['shopping_cart']);
	$cookie_data=stripcslashes($_COOKIE['shopping_cart']);
	$cart_data=json_decode($cookie_data, true);
}
// jenis produk
$jenisProduk=query("SELECT * FROM jenis_produk");

// search
if(isset($_GET['q'])){
	$trifthinqs=search($_GET['q']);
}

// active nav
$active=$_SERVER['PHP_SELF'];
?>
<link rel="stylesheet" href="assets/css/title.css" />
<link rel="stylesheet" href="assets/css/nav.css" />
<nav>
	<ul class="nav-list">
		<li id="shop-nav">
			<a id="nav-shop"
				class="<?php if(strrpos($active, "/index.php")||strrpos($active, "/product.php")){echo"active";}?>">Shop</a>
			<ul class="shop nav-dropdown">
				<li>
					<h1>Collections</h1>
				</li>
				<?php foreach($jenisProduk as $jenis): ?>
				<li><a href="index.php?type=<?= $jenis['jenis_produk'];?>"><?= $jenis['jenis_produk']; ?></a></li>
				<?php endforeach; ?>
				<li><a href="index.php?shop">All Items</a></li>
			</ul>
		</li>

		<li>
			<a href="contact.php" id="nav-contact"
				class="<?php if(strrpos($active, "/contact.php")){echo"active";}?>">Contact</a>
		</li>

		<li>
			<a href="https://goo.gl/maps/Gyjo18mUM7QDzFK27" target="_blank" id="nav-contact">Location</a>
		</li>

		<?php if(isset($_SESSION['level'])): ?>
		<?php if($_SESSION['level']=='admin'): ?>
		<li>
			<a href="admin/">Dashboard</a>
		</li>
		<?php endif; ?>
		<?php endif; ?>

	</ul>
	<ul id="logo">
		<a href="index.php">
			<img src="assets/icon/logo.png" width="50%">
		</a>
	</ul>

	<ul class="right">
		<li>
			<form action="index.php" method="get" id="form-search">
				<input type="search" name="q" id="search" autocomplete="off"
					value="<?php if(isset($_GET['q'])){echo $_GET['q'];}?>">
				<label class="fas fa-search" for="search"></label>
				<div id="livesearch"></div>
			</form>
		</li>

		<li id="notif-cart">
			<a href="cart.php">
				<i class="fa-solid fa-cart-shopping <?php if(strrpos($active, "/cart.php")){echo"active";}?>" id="nav-cart"></i>
				<?php if(!strrpos($active, "/cart.php")):?>
				<?php if(isset($_COOKIE['shopping_cart'])&&isset($_COOKIE['code'])&&$_COOKIE['code']===hash('sha256', $_COOKIE['shopping_cart'])&&strlen($_COOKIE['shopping_cart'])>16): ?>
				<span class="notif notif-cart"><?= count($cart_data) ; ?></span>
				<?php endif; ?>
				<?php endif; ?>
			</a>
		</li>

		<li id="notif-wish">
			<a href="wishlist.php"><i class="fas fa-heart <?php if(strrpos($active, "/wishlist.php")){echo"active";}?>"
					id="nav-wish"></i>
				<?php if(!strrpos($active, "/wishlist.php")):?>
				<?php if(isset($_SESSION['level'])&&mysqli_fetch_assoc($wish)): ?>
				<span class="notif notif-wish"><?= mysqli_num_rows($wish); ?></span>
				<?php endif; ?>
				<?php endif; ?>
			</a>
		</li>

		<?php if(isset($_SESSION['level'])): ?>
		<?php if($_SESSION['level']=='user'||$_SESSION['level']=='admin'): ?>

		<li id="profile-nav">
			<a class="<?php if(strrpos($active, '/profile.php')){echo'active';}?>">
				<img id="nav-profile" src="assets/profile/<?=$profile['foto']?>" alt="<?=$profile['username']?>"
					title="<?=$profile['username']?>" style="<?php if(strrpos($active, '/profile.php')){echo'opacity:1;';}?>">
			</a>
			<ul class="profile nav-dropdown">
				<li><a href="profile.php">Profile</a></li>
				<li>
					<form action="" method="post" style="display:inline-block;">
						<input type='hidden' hidden name='logout'>
						<a onclick="$(this).closest('form').submit();">Logout</a>
					</form>
				</li>
			</ul>
		</li>
		<?php endif; ?>
		<?php endif; ?>

		<?php if(!isset($_SESSION['level'])): ?>
		<li id="login">
			<a onclick="login()" class="overlay">login</a>
		</li>
		<?php endif; ?>
	</ul>
</nav>