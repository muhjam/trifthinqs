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
if(isset($_POST["removeCart"])){
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
		<?php include 'head.php'; ?>
		<!-- akhir head -->

		<!-- my css -->
		<link rel="stylesheet" href="assets/css/cart.css" />

	</head>

	<body>
		<!-- awal isi konten -->

		<!-- awal navbar -->
		<?php include 'nav.php'; ?>
		<!-- akhir navbar -->

		<!-- awal isi cart -->
		<div class="title">
			<h3>Shopping Cart</h3>
			<div class="sub-title">
				<a href="index.php">home</a> / <a href="index.php#shop">shop</a> /
				<a href="#" id="point">cart</a>
			</div>
		</div>

		<section id="container">
			<?php if(isset($_COOKIE['code'])){
			$code_hash=$_COOKIE['code'];
		} 
		?>
			<?php if(isset($_COOKIE['shopping_cart'])&&isset($_COOKIE['code'])&&$code_hash===hash('sha256', $_COOKIE['shopping_cart'])&&strlen($_COOKIE['shopping_cart'])>16): ?>
			<div class="action">
				<button type="button" onclick="clearCart()">CLEAR</button>
				<form>
					<input type="text" placeholder="Voucher Code" name="voucher" maxlength="10" autocomplete="off">
					<button>USE</button>
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
						<?php foreach($cart_data as $keys => $product): ?>
						<tr class="tr-product">
							<td><img src="assets/img/<?= $product['image'];?>" width="100px" height="100px"></td>
							<td><strong><a href="product.php?number=<?= $product['id'];?>"><?= $product['name']; ?></a></strong>
								<br>
								<i><?= $product['code']; ?></i>
								<br>
								Type - <strong><?= $product['type']; ?></strong>
								<br>
								Size - <strong><?= $product['size']; ?></strong>
								<br>
								<span id="price-mobile">Price - <strong><?= idr($product['price']);?></strong></span>
								<br>
								<a id="remove-mobile" onclick="removeCart(<?= $product['id'];?>)">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash"
										viewBox="0 0 16 16">
										<path
											d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
										<path fill-rule="evenodd"
											d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
									</svg>
								</a>
							</td>

							<td id="remove-desk"><a onclick="removeCart(<?= $product['id'];?>)">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash"
										viewBox="0 0 16 16">
										<path
											d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
										<path fill-rule="evenodd"
											d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
									</svg>
								</a></td>
							<td id="price-desk"><?= idr($product['price']);?></td>
						</tr>
						<?php $total=$total + $product['price']; ?>
						<?php endforeach; ?>
					</table>
				</div>
				<div class="summary">
					<p>TOTAL :</p>
					<p><?= rupiah($total); ?></p>
					<button>Check Out</button>
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
		<?php include 'footer.php'; ?>
		<!-- akhir footer -->


		<script>
		function removeCart(id_c) {
			const scriptURL = "http://localhost/GoturthinQs/cart.php";
			const container = document.querySelector("#container");

			fetch(scriptURL, {
					method: "POST",
					body: new URLSearchParams("removeCart&id_c=" + id_c),
				})
				.then((response) => {

					// buat object ajax
					var xhr = new XMLHttpRequest();

					// cek kesiapan ajax
					xhr.onreadystatechange = function() {
						if (xhr.readyState == 4 && xhr.status == 200) {
							container.innerHTML = xhr.responseText;
						}
					};

					// eksekusi ajax
					xhr.open("GET", "assets/ajax/cart.php?id_c=" + id_c, true);
					xhr.send();

					console.log("Success!", response);
				})
				.catch((error) => {
					console.error("Error!", error.message);
				});
		}

		function clearCart() {
			const scriptURL = "http://localhost/GoturthinQs/cart.php";
			const container = document.querySelector("#container");
			Swal.fire({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, clear cart!'
			}).then((result) => {
				if (result.isConfirmed) {
					fetch(scriptURL, {
							method: "POST",
							body: new URLSearchParams("clearCart"),
						})
						.then((response) => {
							Swal.fire(
								'Cleaned!',
								'Your cart has been cleaned.',
								'success'
							)
							// buat object ajax
							var xhr = new XMLHttpRequest();

							// cek kesiapan ajax
							xhr.onreadystatechange = function() {
								if (xhr.readyState == 4 && xhr.status == 200) {
									container.innerHTML = xhr.responseText;
								}
							};
							// eksekusi ajax
							xhr.open("GET", "assets/ajax/cart.php?cleanCart", true);
							xhr.send();
						})

				}
			})
		}

		function undo() {
			const scriptURL = "http://localhost/GoturthinQs/cart.php";
			const container = document.querySelector("#container");
			fetch(scriptURL, {
					method: "POST",
					body: new URLSearchParams("undoCart"),
				})
				.then((response) => {
					// buat object ajax
					var xhr = new XMLHttpRequest();

					// cek kesiapan ajax
					xhr.onreadystatechange = function() {
						if (xhr.readyState == 4 && xhr.status == 200) {
							container.innerHTML = xhr.responseText;
						}
					};

					// eksekusi ajax
					xhr.open("GET", "assets/ajax/cart.php?undoCart", true);
					xhr.send();

					console.log("Success!", response);
				})
				.catch((error) => {
					console.error("Error!", error.message);
				});
		}
		</script>

		<!-- navbar -->
		<script src="assets/js/nav_cart.js"></script>


	</body>

</html>