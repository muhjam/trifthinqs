<?php 
// memeriksa sudah login atau belum
session_start();
require 'assets/php/functions.php';

if(isset($_SESSION['level'])){
$level=$_SESSION['level'];
$username=$_SESSION['username'];
$email=$_SESSION['email'];
$id_u=$_SESSION['id'];
}

// jenis produk
$jenisProduk=query("SELECT * FROM jenis_produk");

if(isset($_SESSION['level'])){
// profile
$profile=query("SELECT * FROM users WHERE id='$id_u'")['0'];
}
if(isset($_GET['number'])){
$productSelected=$_GET['number'];
$product=query("SELECT * FROM produk WHERE id='$productSelected'")['0'];
if(isset($_SESSION['level'])){
$adaWish=query("SELECT * FROM wish WHERE id_u='$id_u' AND id_p='$productSelected'");
$adaCart=query("SELECT * FROM cart WHERE id_u='$id_u' AND id_p='$productSelected'");
}
}
if($product['id']==0){
	header("location:index.php#shop");
}
// shopping cart	
if(isset($_POST['addCart'])){

	if(isset($_COOKIE['shopping_cart'])){
		$cookie_data=stripcslashes($_COOKIE['shopping_cart']);
		$cart_data=json_decode($cookie_data, true);
	}else{
		$cart_data=array();
	}
	$item_id_list= array_column($cart_data, 'id');

if(in_array($_POST['id_c'], $item_id_list)){

	foreach($cart_data as $keys => $product){
		if($cart_data[$keys]["id"]== $_POST['id_c']){
			// jumlah barangnya bisa di masukin di sini
		}
	}
	
}else{
	$item_array= array(
		'id'=>$_POST['id_c'],
		'code'=>$_POST['code_c'],
		'name'=>$_POST['name_c'],
		'type'=>$_POST['type_c'],
		'size'=>$_POST['size_c'],
		'price'=>$_POST['price_c'],
		'image'=>$_POST['image_c']
);
$cart_data[]=$item_array;
}
$item_data=json_encode($cart_data);
setcookie('code', hash('sha256', $item_data), time()+(86400*30),"/");
setcookie('shopping_cart', $item_data, time()+(86400*30),"/");
}
if(isset($_POST["removeCart"])){
	$cookie_data=stripcslashes($_COOKIE['shopping_cart']);
	$cart_data=json_decode($cookie_data, true);
	foreach($cart_data as $keys=>$product){
		if($cart_data[$keys]['id']==$_POST['id_c']){
			unset($cart_data[$keys]);
			$item_data = json_encode($cart_data);
			setcookie('code', hash('sha256', $item_data), time()+(86400*30),"/");
			setcookie('shopping_cart', $item_data, time()+(86400*30),"/");
		}
	}
}
 ?>


<!DOCTYPE html>
<html lang="en">

	<head>
		<!-- awal head -->
		<?php include 'head.php'; ?>
		<!-- akhir head -->
		<!-- my css -->
		<link rel="stylesheet" href="assets/css/product.css" />
	</head>


	<body>

		<!-- awal isi konten -->


		<!-- awal navbar -->
		<?php include 'nav.php'; ?>
		<!-- akhir navbar -->


		<!-- awal isi produk -->
		<div class="title">
			<h3>Product</h3>
			<div class="sub-title">
				<a href="index.php">home</a> / <a href="index.php#shop">shop</a> / <a href="#"
					id="point"><?= $product['jenis_produk'];?></a>
			</div>
		</div>

		<section class="container">
			<div class="card-product">
				<div class="img-product">
					<img id="myImg" src="assets/img/<?= $product['gambar'];?>" />

					<!-- zoom -->
					<div id="myModal" class="modal">
						<img class="modal-content" id="img01" />
					</div>

				</div>
				<div class="dec-product">
					<h1><?= $product['nama_produk']; ?></h1>
					<h2><?= rupiah($product["harga"]);; ?></h2>
					<table>
						<tr>
							<td>
								Code
							</td>
							<td>
								:
							</td>
							<td>
								<?= $product['kode_produk'];; ?>
							</td>
						</tr>
						<tr>
							<td>Type</td>
							<td>:</td>
							<td><?= $product['jenis_produk']; ?></td>
						</tr>
						<tr>
							<td>Size</td>
							<td>:</td>
							<td><?= $product['ukuran']; ?></td>
						</tr>
						<tr>
							<td>Color</td>
							<td>:</td>
							<td>
								<div
									style="width:20px;height:20px;border:1px solid black;border-radius:100%;background-color:<?= $product['warna'];?>;"
									id="color">
								</div>
							</td>
						</tr>
					</table>
					<p>Description :</p>
					<span><?= $product['keterangan']; ?></span>
					<div class="button">

						<?php 
					$code_p1=$product['kode_produk']; 
					$code_p="'".$code_p1."'";
					$name_p1=$product['nama_produk']; 
					$name_p="'".$name_p1."'";
					$type_p1=$product['jenis_produk']; 
					$type_p="'".$type_p1."'";
					$size_p1=$product['ukuran']; 
					$size_p="'".$size_p1."'";
					$price_p1=$product['harga']; 
					$price_p="'".$price_p1."'";
					$image_p1=$product['gambar']; 
					$image_p="'".$image_p1."'";
				?>

						<button type="button"
							onclick="addCart(<?= $code_p.','.$product['id'].','.$name_p.','.$type_p.','.$size_p.','.$price_p.','.$image_p;?>)"
							class="cart1 <?php if(strstr($_COOKIE['shopping_cart'], $product['kode_produk'], true)==true){echo'd-none';}?>">ADD
							TO
							CART</button>
						<button type="button"
							onclick="removeCart(<?= $code_p.','.$product['id'].','.$name_p.','.$type_p.','.$size_p.','.$price_p.','.$image_p;?>)"
							class="cart2 <?php if(strstr($_COOKIE['shopping_cart'], $product['kode_produk'], true)==false){echo'd-none';}?>">ADD
							TO
							CART</button>
						<?php if(isset($_SESSION['level'])): ?>
						<form action="" method="post" name="form-wish">
							<input type="hidden" value="<?= $product['id'];?>" name="id_w">
							<input type="hidden" value="<?= $id_u;?>" id="id_uw">
							<button type="submit" class="love1 <?php if(!empty($adaWish)){echo'd-none';}?>"><i
									class="fas fa-heart"></i></button>
							<button type="submit" class="love2 <?php if(empty($adaWish)){echo'd-none';}?>"><i
									class=" fas fa-heart"></i></button>
						</form>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</section>

		<!-- akhir isi produk -->

		<!-- awal footer -->
		<?php include 'footer.php'; ?>
		<!-- akhir footer -->

		<!-- jquery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

		<script>
		const scriptURLw =
			"http://localhost/GoturthinQs/assets/php/functions_wishlist.php";
		const formw = document.forms["form-wish"];

		const love1 = document.querySelector(".love1");
		const love2 = document.querySelector(".love2");
		const notifWish = document.querySelector("#notif-wish");
		const id_uw = document.querySelector("#id_uw");

		formw.addEventListener("submit", (e) => {
			e.preventDefault();

			fetch(scriptURLw, {
					method: "POST",
					body: new FormData(formw),
				})
				.then((response) => {
					love1.classList.toggle("d-none");
					love2.classList.toggle("d-none");

					// rest form
					formw.reset();
					console.log("Success!", response);

					// buat object ajax
					var xhr = new XMLHttpRequest();

					// cek kesiapan ajax
					xhr.onreadystatechange = function() {
						if (xhr.readyState == 4 && xhr.status == 200) {
							notifWish.innerHTML = xhr.responseText;
						}
					};

					// eksekusi ajax
					xhr.open("GET", "assets/ajax/notifwish.php?id_u=" + id_uw.value, true);
					xhr.send();
				})
				.catch((error) => {
					// rest form
					formw.reset();
					console.error("Error!", error.message);
				});
		});

		function addCart(code_c, id_c, name_c, type_c, size_c, price_p, image_c) {
			const scriptURL = "http://localhost/GoturthinQs/product.php";
			const cart1 = document.querySelector(".cart1");
			const cart2 = document.querySelector(".cart2");
			const notifCart = document.querySelector("#notif-cart");

			fetch(scriptURL, {
					method: "POST",
					body: new URLSearchParams("addCart&code_c=" + code_c + "&id_c=" + id_c + "&name_c=" + name_c + "&type_c=" +
						type_c + "&size_c=" + size_c + "&price_c=" + price_p + "&image_c=" + image_c),
				})
				.then((response) => {
					cart1.classList.toggle("d-none");
					cart2.classList.toggle("d-none");

					// buat object ajax
					var xhr = new XMLHttpRequest();

					// cek kesiapan ajax
					xhr.onreadystatechange = function() {
						if (xhr.readyState == 4 && xhr.status == 200) {
							notifCart.innerHTML = xhr.responseText;
						}
					};

					// eksekusi ajax
					xhr.open("GET", "assets/ajax/notifcart.php", true);
					xhr.send();

					console.log("Success!", response);
				})
				.catch((error) => {
					console.error("Error!", error.message);
				});
		}

		function removeCart(code_c, id_c, name_c, type_c, size_c, price_p, image_c) {
			const scriptURL = "http://localhost/GoturthinQs/product.php";
			const cart1 = document.querySelector(".cart1");
			const cart2 = document.querySelector(".cart2");
			const notifCart = document.querySelector("#notif-cart");

			fetch(scriptURL, {
					method: "POST",
					body: new URLSearchParams("removeCart&code_c=" + code_c + "&id_c=" + id_c + "&name_c=" + name_c + "&type_c=" +
						type_c + "&size_c=" + size_c + "&price_c=" + price_p + "&image_c=" + image_c),
				})
				.then((response) => {
					cart1.classList.toggle("d-none");
					cart2.classList.toggle("d-none");

					// buat object ajax
					var xhr = new XMLHttpRequest();

					// cek kesiapan ajax
					xhr.onreadystatechange = function() {
						if (xhr.readyState == 4 && xhr.status == 200) {
							notifCart.innerHTML = xhr.responseText;
						}
					};

					// eksekusi ajax
					xhr.open("GET", "assets/ajax/notifcart.php", true);
					xhr.send();

					console.log("Success!", response);
				})
				.catch((error) => {
					console.error("Error!", error.message);
				});
		}
		</script>



		<!-- <script src="assets/js/formcartwish1.js"></script> -->

		<!-- formwish -->
		<!-- <script src="assets/js/formcartwish.js"></script> -->

		<!-- navbar -->

		<script src="assets/js/nav_shop.js"></script>
		<!-- zoomimage -->
		<script src="assets/js/zoomImg.js"></script>


	</body>

</html>