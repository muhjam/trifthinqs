<?php 
session_start();
require '../php/functions.php'; 
if(isset($_SESSION['level']))
{
$level=$_SESSION['level'];
$username=$_SESSION['username'];
$email=$_SESSION['email'];
$id_u=$_SESSION['id'];
}
$wishlist=mysqli_query(koneksi(), "SELECT * FROM wish, produk WHERE id_p=produk.id AND id_u='$id_u'");
?>

<?php if(mysqli_fetch_assoc($wishlist)): ?>
<?php $btn=1;?>
<div class="produk" style="margin-bottom:100px;">
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
					if(isset($_COOKIE['shopping_cart'])){
						$cookie_data=stripcslashes($_COOKIE['shopping_cart']);
						$cart_data=json_decode($cookie_data, true);
						$id_p=$product['id'];
					}
					?>
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
				class="cart1">ADD TO
				CART</button>
			<?php $btn++; ?>
			<?php if(isset($_COOKIE['shopping_cart'])): ?>
			<?php foreach($cart_data as $keys => $id_c): ?>
			<?php if($id_c['id']===$id_p): ?>
			<button type="button" id="<?= $btn;?>"
				onclick="removeCart(<?= $code_p.','.$product['id'].','.$name_p.','.$type_p.','.$size_p.','.$price_p.','.$image_p;?>,this.id)"
				class="cart2">ADD TO
				CART</button>
			<script>
			var cart1 = document.getElementById(<?= $btn;?> - 1);
			cart1.classList.add("d-none");
			</script>
			<?php endif; ?>
			<?php endforeach; ?>
			<?php endif; ?>
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