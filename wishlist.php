<?php 
// memeriksa sudah login atau belum
session_start();
require 'assets/php/functions.php';

if(isset($_SESSION['level']))
{
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
$wishlist=mysqli_query(koneksi(), "SELECT * FROM wish, produk WHERE id_p=produk.id AND id_u='$id_u'");


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
		<link rel="stylesheet" href="assets/css/wishlist.css" />
	</head>

	<body>
		<!-- awal isi konten -->

		<!-- awal navbar -->
		<?php include 'nav.php'; ?>
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

			<?php 
			$btn=1;
			?>
			<div class="produk" data-aos="flip-left" style="margin-bottom:100px;">
				<?php foreach($wishlist as $product): ?>
				<div class="news-item">
					<a href="product.php?number=<?= $product['id'];?>">
						<div class="border">
							<img src="assets/img/<?= $product['gambar']?>">
						</div>
						<h4><?= $product['nama_produk']; ?></h4>
						<p><?= idr($product["harga"]); ?></p>
					</a>
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
						<button type="button" id="<?= $btn;?>"
							onclick="addCart(<?= $code_p.','.$product['id'].','.$name_p.','.$type_p.','.$size_p.','.$price_p.','.$image_p;?>,this.id)"
							class="cart1 <?php if(strpos($cookie_data, $product['kode_produk'])!==false){echo'd-none';}else{}?>">ADD
							TO
							CART</button>
						<?php $btn++; ?>
						<button type="button" id="<?= $btn;?>"
							onclick="removeCart(<?= $code_p.','.$product['id'].','.$name_p.','.$type_p.','.$size_p.','.$price_p.','.$image_p;?>,this.id)"
							class="cart2 <?php if(strpos($cookie_data, $product['kode_produk'])!==false){}else{echo'd-none';}?>">ADD
							TO
							CART</button>

						<?php $btn++; ?>

						<?php 
					$setWish=$id_u.','.$product['id']; 
					$id_p=$product['id'];
					$adaWish=query("SELECT * FROM wish WHERE id_u='$id_u' AND id_p='$id_p'");
					?>
						<button type="submit" id="<?= $btn;?>" onclick="addWish(<?= $setWish?>,this.id)"
							class="love1 <?php if(!empty($adaWish)){echo"d-none";} ?>"><i class="fas fa-heart"></i></button>
						<?php $btn++; ?>
						<button type="submit" id="<?= $btn;?>" onclick="removeWish(<?= $setWish?>,this.id)"
							class="love2 <?php if(empty($adaWish)){echo"d-none";} ?>"><i class=" fas fa-heart"></i></button>
						<?php $btn++; ?>
					</div>
				</div>
				<?php endforeach; ?>
			</div>

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
		<?php include 'footer.php'; ?>
		<!-- akhir footer -->

		<script>
		function addWish(id_u, id_w, btn) {
			const scriptURL = "http://localhost/GoturthinQs/assets/php/functions_wishlist.php";
			var love1 = document.getElementById(btn);
			var love2 = document.getElementById(parseInt(btn) + 1);

			fetch(scriptURL, {
					method: "POST",
					body: new URLSearchParams("id_w=" + id_w),
				})
				.then((response) => {
					love1.classList.add("d-none");
					love2.classList.remove("d-none");

					console.log("Success!", response);

				})
				.catch((error) => {
					console.error("Error!", error.message);
				});
		}

		function removeWish(id_u, id_w, btn) {
			const scriptURL = "http://localhost/GoturthinQs/assets/php/functions_wishlist.php";
			var love2 = document.getElementById(btn);
			var love1 = document.getElementById(btn - 1);

			fetch(scriptURL, {
					method: "POST",
					body: new URLSearchParams("id_w=" + id_w),
				})
				.then((response) => {
					love1.classList.remove("d-none");
					love2.classList.add("d-none");

					console.log("Success!", response);

				})
				.catch((error) => {
					console.error("Error!", error.message);
				});
		}


		function addCart(code_c, id_c, name_c, type_c, size_c, price_p, image_c, btn) {
			const scriptURL = "http://localhost/GoturthinQs/wishlist.php";
			const notifCart = document.querySelector("#notif-cart");
			var cart1 = document.getElementById(btn);
			var cart2 = document.getElementById(parseInt(btn) + 1);

			fetch(scriptURL, {
					method: "POST",
					body: new URLSearchParams("addCart&code_c=" + code_c + "&id_c=" + id_c + "&name_c=" + name_c + "&type_c=" +
						type_c + "&size_c=" + size_c + "&price_c=" + price_p + "&image_c=" + image_c),
				})
				.then((response) => {
					cart1.classList.add("d-none");
					cart2.classList.remove("d-none");
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

		function removeCart(code_c, id_c, name_c, type_c, size_c, price_p, image_c, btn) {
			const scriptURL = "http://localhost/GoturthinQs/wishlist.php";
			var cart2 = document.getElementById(btn);
			var cart1 = document.getElementById(btn - 1);
			const notifCart = document.querySelector("#notif-cart");

			fetch(scriptURL, {
					method: "POST",
					body: new URLSearchParams("removeCart&code_c=" + code_c + "&id_c=" + id_c + "&name_c=" + name_c + "&type_c=" +
						type_c + "&size_c=" + size_c + "&price_c=" + price_p + "&image_c=" + image_c),
				})
				.then((response) => {
					cart1.classList.remove("d-none");
					cart2.classList.add("d-none");

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

		// function removeWish(id_u, id_w, btn) {
		// 	const scriptURL = "http://localhost/GoturthinQs/assets/php/functions_wish.php";

		// 	var love2 = document.getElementById(btn);
		// 	var love1 = document.getElementById(btn - 1);
		// 	const notiflove = document.querySelector("#notif-wish");
		// 	fetch(scriptURL, {
		// 			method: "POST",
		// 			body: new URLSearchParams("id_w=" + id_w),
		// 		})
		// 		.then((response) => {
		// 			love1.classList.remove("d-none");
		// 			love2.classList.add("d-none");

		// 			console.log("Success!", response);

		// 			// buat object ajax
		// 			var xhr = new XMLHttpRequest();

		// 			// cek kesiapan ajax
		// 			xhr.onreadystatechange = function() {
		// 				if (xhr.readyState == 4 && xhr.status == 200) {
		// 					notifCart.innerHTML = xhr.responseText;
		// 				}
		// 			};

		// 			// eksekusi ajax
		// 			xhr.open("GET", "assets/ajax/notifcart.php?id_u=" + id_u, true);
		// 			xhr.send();

		// 		})
		// 		.catch((error) => {
		// 			console.error("Error!", error.message);
		// 		});
		// }
		</script>

		<!-- navbar -->
		<script src="assets/js/nav_wish.js"></script>

	</body>

</html>