<?php
if(isset($_SESSION['level'])){

if(isset($_POST['logout'])){
$_SESSION=[];
session_unset();
session_destroy();


setcookie('email', '', time() - 90000);
setcookie('key', '', time() - 90000);

header("Refresh:0");
exit;
}

	// notif wish
	$wish=mysqli_query(koneksi(),"SELECT * FROM wish WHERE id_u='$id_u'");
	// profile
		$profile=query("SELECT * FROM users WHERE id='$id_u'")['0'];
}
// notif cart
if(isset($_COOKIE['shopping_cart'])&&isset($_COOKIE['code'])&&$_COOKIE['code']===hash('sha256', $_COOKIE['shopping_cart'])){
	$cookie=strlen($_COOKIE['shopping_cart']);
	$cookie_data=stripcslashes($_COOKIE['shopping_cart']);
	$cart_data=json_decode($cookie_data, true);
}
// jenis produk
$jenisProduk=query("SELECT * FROM jenis_produk");
?>
<link rel="stylesheet" href="assets/css/title.css" />
<link rel="stylesheet" href="assets/css/nav.css" />
<nav>
	<ul class="nav-list">
		<li id="shop-nav">
			<a id="nav-shop" class="">Shop</a>
			<ul class="shop nav-dropdown">
				<li>
					<h1>Collections</h1>
				</li>
				<?php foreach($jenisProduk as $jenis): ?>
				<li><a href="index.php?type=<?= $jenis['jenis_produk'];?>"><?= $jenis['jenis_produk']; ?></a></li>
				<?php endforeach; ?>
				<li><a href="index.php#shop">All Items</a></li>
			</ul>
		</li>

		<li>
			<a href="contact.php" id="nav-contact">Contact</a>
		</li>

		<li>
			<a id="nav-contact">Location</a>
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
			<form action="index.php" method="post" id="form-search">
				<input type="search" name="search" id="search" autocomplete="off"
					value="<?php if(isset($_POST['search'])){echo $search;}?>">
				<label class="fas fa-search" for="search"></label>
			</form>
		</li>

		<li id="notif-cart">
			<a href="cart.php">
				<i class="fas fa-cart-arrow-down" id="nav-cart"></i>
				<?php if(isset($_COOKIE['shopping_cart'])&&isset($_COOKIE['code'])&&$_COOKIE['code']===hash('sha256', $_COOKIE['shopping_cart'])&&strlen($_COOKIE['shopping_cart'])>16): ?>
				<span class="notif notif-cart"><?= count($cart_data) ; ?></span>
				<?php endif; ?>
			</a>
		</li>

		<li id="notif-wish">
			<a href="wishlist.php"><i class="fas fa-heart" id="nav-wish"></i>
				<?php if(isset($_SESSION['level'])&&mysqli_fetch_assoc($wish)): ?>
				<span class="notif notif-wish"><?= mysqli_num_rows($wish); ?></span>
				<?php endif; ?>
			</a>
		</li>

		<?php if(isset($_SESSION['level'])): ?>
		<?php if($_SESSION['level']=='user'||$_SESSION['level']=='admin'): ?>

		<li id="profile">
			<a>
				<img id="nav-profile" src="assets/profile/<?=$profile['foto']?>" alt="<?=$profile['username']?>"
					title="<?=$profile['username']?>" style="width:30px; height:30px; object-fit:cover;border-radius:50%;">
			</a>
			<ul class="profile nav-dropdown">
				<li><a href="#!">Profile</a></li>
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
			<a onclick="login()">login</a>
		</li>
		<?php endif; ?>
	</ul>

</nav>
<script src="assets/js/nav.js"></script>