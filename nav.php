<?php
// notif wish
if(isset($_SESSION['level'])){
	$wish=mysqli_query(koneksi(),"SELECT * FROM wish WHERE id_u='$id_u'");
}
// notif cart
if(isset($_COOKIE['shopping_cart'])&&isset($_COOKIE['code'])&&$_COOKIE['code']===hash('sha256', $_COOKIE['shopping_cart'])){
	$cookie=strlen($_COOKIE['shopping_cart']);
	$cookie_data=stripcslashes($_COOKIE['shopping_cart']);
	$cart_data=json_decode($cookie_data, true);
}
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
			<a href="contact.php" id="nav-contact">Contact</a>
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

		<li id="notif-cart">
			<a href="cart.php">
				<i class="fas fa-cart-arrow-down" id="nav-cart"></i>
				<?php if(isset($_COOKIE['shopping_cart'])&&isset($_COOKIE['code'])&&$_COOKIE['code']===hash('sha256', $_COOKIE['shopping_cart'])&&strlen($_COOKIE['shopping_cart'])>16): ?>
				<span class="notif notif-cart"><?= count($cart_data) ; ?></span>
				<?php endif; ?>
			</a>
		</li>

		<?php if(isset($_SESSION['level'])): ?>
		<?php if($_SESSION['level']=='user'||$_SESSION['level']=='admin'): ?>
		<li id="notif-wish">
			<a href="wishlist.php"><i class="fas fa-heart" id="nav-wish"></i>
				<?php if(mysqli_fetch_assoc($wish)): ?>
				<span class="notif notif-wish"><?= mysqli_num_rows($wish); ?></span>
				<?php endif; ?>
			</a>
		</li>


		<li id="profile">
			<a>
				<img id="nav-profile" src="assets/profile/<?=$profile['foto']?>" alt="<?=$profile['username']?>"
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
<script src="assets/js/nav.js"></script>