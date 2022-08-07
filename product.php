<?php 
// session
include "assets/section/session.php";
// product
if(isset($_GET['number'])){
$productSelected=$_GET['number'];
$product=query("SELECT * FROM produk WHERE id='$productSelected'")['0'];
}
if($product['id']==0){
	header("location:index.php#shop");
}
// shopping cart	
if(isset($_POST['addCart'])){
	$id=$_POST['id'];
	$add=query("SELECT * FROM produk WHERE id='$id'")[0];
	$code=$add['kode_produk'];
	$name=$add['nama_produk'];
	if(!empty($code)&&$add['status']!=='sold'){
				if(isset($_COOKIE['shopping_cart'])){
					$cookie_data=stripcslashes($_COOKIE['shopping_cart']);
					$cart_data=json_decode($cookie_data, true);
				}else{
					$cart_data=array();
				}
		$item_id_list= array_column($cart_data, 'code');

					if(in_array($code, $item_id_list)){

						foreach($cart_data as $keys => $product){
							if($cart_data[$keys]["code"]== $code){
								// jumlah barangnya bisa di masukin di sini
							}
						}
					}else{
						$item_array= array(
							'code'=>$code,
							'name'=>$name
					);
					$cart_data[]=$item_array;
					}
		$item_data=json_encode($cart_data);
		setcookie('code', hash('sha256', $item_data), time()+(86400*30),"/");
		setcookie('shopping_cart', $item_data, time()+(86400*30),"/");
				}
	}
if(isset($_POST["removeCart"])){
	$id=$_POST['id'];
	$add=query("SELECT * FROM produk WHERE id='$id'")[0];
	$code=$add['kode_produk'];
	$cookie_data=stripcslashes($_COOKIE['shopping_cart']);
	$cart_data=json_decode($cookie_data, true);
	foreach($cart_data as $keys=>$product){
		if($cart_data[$keys]['code']===$code){
			$_SESSION['undoCart']= json_encode($cart_data);
			$_SESSION['nameRemove']=$cart_data[$keys]['name'];
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
		<?php include 'assets/section/head.php'; ?>
		<!-- akhir head -->
		<!-- my css -->
		<link rel="stylesheet" href="assets/css/product.css" />
	</head>

	<body>

		<!-- awal login form -->
		<?php include 'assets/login/login.php'; ?>
		<!-- akhir login form -->

		<!-- awal isi konten -->
		<!-- awal navbar -->
		<?php include 'assets/section/nav.php'; ?>
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

						<?php if($product['status']==='sell'){?>
						<button type="button" onclick="addCart(<?= $_GET['number'];?>)"
							class="cart1 <?php if(strstr($_COOKIE['shopping_cart'], $product['kode_produk'], true)==true){echo'd-none';}?>">ADD
							TO
							CART</button>
						<button type="button" onclick="removeCart(<?= $_GET['number'];?>)"
							class="cart2 <?php if(strstr($_COOKIE['shopping_cart'], $product['kode_produk'], true)==false){echo'd-none';}?>">ADD
							TO
							CART</button>
						<?php }else{; ?>
						<button id="sold">SOLD OUT</button>
						<?php }; ?>
						<?php if(isset($_SESSION['level'])): ?>
						<form action="" method="post" name="form-wish">
							<input type="hidden" value="<?= $product['id'];?>" name="id_w">
							<button type="submit" class="love1 <?php if(!empty($adaWish)){echo'd-none';}?>"><i
									class="fas fa-heart"></i></button>
							<button type="submit" class="love2 <?php if(empty($adaWish)){echo'd-none';}?>"><i
									class=" fas fa-heart"></i></button>
						</form>
						<?php else: ?>
						<form action="">
							<button onclick="login()" type="button"><i class="fas fa-heart"></i></button>
						</form>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</section>
		<!-- akhir isi produk -->

		<!-- awal footer -->
		<?php include 'assets/section/footer.php'; ?>
		<!-- akhir footer -->

		<!-- jquery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="assets/js/product.js"></script>
		<!-- navbar -->
		<script src="assets/js/nav_shop.js"></script>
		<!-- zoomimage -->
		<script src="assets/js/zoomImg.js"></script>

	</body>

</html>