<?php 
// session
include "assets/login/session.php";
// cart
if(isset($_POST["removeCart"])){
	$cookie_data=stripcslashes($_COOKIE['shopping_cart']);
	$cart_data=json_decode($cookie_data, true);
	foreach($cart_data as $keys=>$product){
		if($cart_data[$keys]['code']==$_POST['code_c']){
			$_SESSION['undoCart']= json_encode($cart_data);
			$_SESSION['nameRemove']=$cart_data[$keys]['name'];
			unset($cart_data[$keys]);
			$item_data = json_encode($cart_data);
			setcookie('code', hash('sha256', $item_data), time()+(86400*30),"/");
			setcookie('shopping_cart', $item_data, time()+(86400*30),"/");
		}
	}
}
if(isset($_POST["sold"])){
	$cookie_data=stripcslashes($_COOKIE['shopping_cart']);
	$cart_data=json_decode($cookie_data, true);
	foreach($cart_data as $keys=>$product){
		if($cart_data[$keys]['id']==$_POST['id_c']){
			$_SESSION['undoCart']= json_encode($cart_data);
			$_SESSION['nameRemove']=$cart_data[$keys]['name'];
			unset($cart_data[$keys]);
			$item_data = json_encode($cart_data);
			setcookie('code', hash('sha256', $item_data), time()+(86400*30),"/");
			setcookie('shopping_cart', $item_data, time()+(86400*30),"/");
		}
	}
}
if(isset($_POST['clearCart'])){
	setcookie('code', '', time()-(9000000*30),"/");
	setcookie('shopping_cart', '', time()-(9000000*30),"/");
}
if(isset($_POST["undoCart"])){
	$item_data=$_SESSION['undoCart'];
	setcookie('code', hash('sha256', $item_data), time()+(86400*30),"/");
	setcookie('shopping_cart', $item_data, time()+(86400*30),"/");
}
 ?>

<!DOCTYPE html>
<html lang="en">

	<head>
		<!-- awal head -->
		<?php include 'assets/section/head.php'; ?>
		<!-- akhir head -->
		<!-- my css -->
		<link rel="stylesheet" href="assets/css/cart.css" />
	</head>

	<body>

		<!-- awal isi konten -->
		<!-- awal navbar -->
		<?php include 'assets/section/nav.php'; ?>
		<!-- akhir navbar -->

		<!-- awal isi cart -->
		<div class="title">
			<h3>Shopping Cart</h3>
			<div class="sub-title">
				<a href="index.php?home">home</a> / <a href="index.php?shop">shop</a> /
				<a href="#" id="point">cart</a>
			</div>
		</div>

		<section id="container">
			<?php if(isset($_POST['submit'])): ?>
			<div class="alert-info">
				<div class="alert-logo">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
						class="bi bi-info-circle-fill" viewBox="0 0 16 16">
						<path
							d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
					</svg>
				</div>
				<div class="alert-text">The code voucher "<?= $_POST['voucher'];?>" doesn't exist.</div>
				<a class="close" onclick="close_alert('.alert-info')">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-lg"
						viewBox="0 0 16 16">
						<path
							d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
					</svg>
				</a>
			</div>
			<?php endif; ?>


			<?php if(isset($_COOKIE['code'])){
			$code_hash=$_COOKIE['code'];
			} 
			?>
			<?php if(isset($_COOKIE['shopping_cart'])&&isset($_COOKIE['code'])&&$code_hash===hash('sha256', $_COOKIE['shopping_cart'])&&strlen($_COOKIE['shopping_cart'])>16): ?>
			<div class="action">
				<button type="button" onclick="clearCart()">CLEAR</button>
				<form action="" method="post" class="voucher" name="form-voucher">
					<input type="text" placeholder="Voucher Code" name="voucher" maxlength="10" autocomplete="off" required>
					<button type="submit" name="submit">USE</button>
				</form>
			</div>
			<?php endif; ?>
			<div class="container">
				<div class="content">
					<?php if(isset($_COOKIE['shopping_cart'])&&isset($_COOKIE['code'])&&$code_hash===hash('sha256', $_COOKIE['shopping_cart'])&&strlen($_COOKIE['shopping_cart'])>16): ?>
					<?php 
					$total=0; 
					$cookie_data=stripcslashes($_COOKIE['shopping_cart']);
					$cart_data=json_decode($cookie_data, true);
					?>
					<table>
						<?php foreach($cart_data as $keys => $products): ?>
						<?php 
						$code=$products['code'];
						$product=query("SELECT * FROM produk WHERE kode_produk='$code'")[0]; 
						$code_p="'".$product['kode_produk']."'";
						?>
						<tr class="tr-product">
							<td><img src="assets/img/<?= $product['gambar'];?>" width="100px" height="100px"></td>
							<td><strong><a
										href="product.php?number=<?= $product['id'];?>"><?= $product['nama_produk']; ?></a></strong>
								<br>
								<i><?= $product['kode_produk']; ?></i>
								<br>
								Type - <strong><?= $product['jenis_produk']; ?></strong>
								<br>
								Size - <strong><?= $product['ukuran']; ?></strong>
								<br>
								<span id="price-mobile">Price - <strong><?= idr($product['harga']);?></strong></span>
								<br>
								<a id="remove-mobile" onclick="removeCart(<?= $code_p;?>)">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash"
										viewBox="0 0 16 16">
										<path
											d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
										<path fill-rule="evenodd"
											d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
									</svg>
								</a>
							</td>

							<td id="remove-desk">
								<a onclick="removeCart(<?= $code_p;?>)">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash"
										viewBox="0 0 16 16">
										<path
											d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
										<path fill-rule="evenodd"
											d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
									</svg>
								</a>
							</td>

							<td id="price-desk"><?= idr($product['harga']);?></td>
						</tr>
						<?php $total=$total + $product['harga']; ?>
						<?php endforeach; ?>
					</table>
				</div>
				<div class="summary">
					<p>
						SUMMARY :
						<span>&bull; <?= count($cart_data) ; ?> Items</span>
						<span>(<i>Not including shipping</i>)</span>
					</p>
					<p>TOTAL :</p>
					<p><?= rupiah($total); ?></p>
					<?php if(isset($_SESSION['level'])): ?>
					<button>Check Out</button>
					<?php else: ?>
					<button onclick="login()">Check Out</button>
					<?php endif; ?>
				</div>
				<?php else: ?>
			</div>
			<style>
			.container .content {
				overflow: none;
				width: auto;
				height: auto;
			}
			</style>
			<div style="padding:0 0 200px 0;text-align:center;">
				<h1
					style="color:#a9a9a9;font-family: 'Open Sans', sans-serif;margin-top:120px;text-align:center;text-transform:uppercase;font-weight:400;">
					ITMES SHOPPING CART IS EMPTY</h1>
			</div>
			<?php endif; ?>
		</section>
		<!-- akhir isi cart -->
		<!-- awal footer -->
		<?php include 'assets/section/footer.php'; ?>
		<!-- akhir footer -->
		<!-- my js -->
		<script src="assets/js/cart.js"></script>
		<!-- voucher -->
		<!-- <script src="assets/jquery/voucher.js"></script> -->
	</body>

</html>