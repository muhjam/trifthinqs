		<?php 
	session_start();
		require '../php/functions.php';
		if(isset($_COOKIE['shopping_cart'])&&isset($_COOKIE['code'])&&$_COOKIE['code']===hash('sha256', $_COOKIE['shopping_cart'])){
			$cookie=strlen($_COOKIE['shopping_cart']);
			$cookie_data=stripcslashes($_COOKIE['shopping_cart']);
			$cart_data=json_decode($cookie_data, true);
		}
		?>

		<style>
nav ul li#notif-cart a {
	position: relative;
	display: block;
	text-decoration: none;
	margin: 0 10px;

}

nav ul li#notif-cart a .notif {
	position: absolute;
	top: -10px;
	right: -10px;
	background-color: red;
	border-radius: 100%;
	width: 16px;
	height: 16px;
	text-align: center;
	animation: pop 0.3s;
}

@keyframes pop {
	50% {
		transform: scale(1.2);
	}
}
		</style>

		<a href="cart.php">
			<i class="fas fa-cart-arrow-down"></i>
			<?php if(isset($_COOKIE['shopping_cart'])&&isset($_COOKIE['code'])&&$_COOKIE['code']===hash('sha256', $_COOKIE['shopping_cart'])&&strlen($_COOKIE['shopping_cart'])>16): ?>
			<span class="notif"><?= count($cart_data) ; ?></span>
			<?php endif; ?>
		</a>