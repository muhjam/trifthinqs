<?php 
// session
include "assets/section/session.php";
if(isset($_SESSION['level'])){
$wishlist=mysqli_query(koneksi(),"SELECT * FROM wish, produk WHERE produk.id=wish.id_p AND id_u=$id_u");
// shopping cart	
if(isset($_POST['addCart'])){
	if(isset($_COOKIE['shopping_cart'])){
		$cookie_data=stripcslashes($_COOKIE['shopping_cart']);
		$cart_data=json_decode($cookie_data, true);
	}else{
		$cart_data=array();
	}
	$item_id_list= array_column($cart_data, 'code');

if(in_array($_POST['code_c'], $item_id_list)){

	foreach($cart_data as $keys => $product){
		if($cart_data[$keys]['code']== $_POST['code_c']){
			// jumlah barangnya bisa di masukin di sini
		}
	}
	
}else{
	$item_array= array(
		'code'=>$_POST['code_c'],
		'name'=>$_POST['name_c']
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
		if($cart_data[$keys]['code']===$_POST['code_c']){
			$_SESSION['undoCart']= json_encode($cart_data);
			$_SESSION['nameRemove']=$cart_data[$keys]['name'];
			unset($cart_data[$keys]);
			$item_data = json_encode($cart_data);
			setcookie('code', hash('sha256', $item_data), time()+(86400*30),"/");
			setcookie('shopping_cart', $item_data, time()+(86400*30),"/");
		}
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
		<link rel="stylesheet" href="assets/css/wishlist.css" />
	</head>

	<body>
		<!-- awal login form -->
		<?php include 'assets/login/login.php'; ?>
		<!-- akhir login form -->
		<!-- awal isi konten -->
		<!-- awal navbar -->
		<?php include 'assets/section/nav.php'; ?>
		<!-- akhir navbar -->
		<!-- awal isi wishlist -->
		<div class="title">
			<h3>Wishlist</h3>
			<div class="sub-title">
				<a href="index.php">home</a> / <a href="index.php#shop">shop</a> / <a href="#" id="point">wishlist</a>
			</div>
		</div>

		<section class="container">

			<?php if(isset($_SESSION['level'])&&mysqli_fetch_assoc($wishlist)): ?>
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
						if($product['status']==='sell'){
						$code_p1=$product['kode_produk']; 
						$code_p="'".$code_p1."'";
				?>
						<button type="button" id="<?= $btn;?>" onclick="addCart(<?= $product['id'].','.$code_p;?>,this.id)"
							class="cart1 <?php if(strpos($cookie_data, $product['kode_produk'])!==false){echo'd-none';}else{}?>">ADD
							TO
							CART</button>
						<?php $btn++; ?>
						<button type="button" id="<?= $btn;?>" onclick="removeCart(<?= $product['id'].','.$code_p;?>,this.id)"
							class="cart2 <?php if(strpos($cookie_data, $product['kode_produk'])!==false){}else{echo'd-none';}?>">ADD
							TO
							CART</button>
						<?php $btn++; ?>
						<?php }else{; ?>
						<button id="sold">SOLD OUT</button>
						<?php }; ?>
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
		<?php include 'assets/section/footer.php'; ?>
		<!-- akhir footer -->

		<script src="assets/js/wishlist.js"></script>

		<!-- navbar -->
		<script src="assets/js/nav_wish.js"></script>

	</body>

</html>