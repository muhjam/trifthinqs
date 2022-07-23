<?php 
require '../php/functions.php';

$id_u=$_GET['id_u'];

$wishlist=mysqli_query(koneksi(), "SELECT * FROM wish, produk WHERE id_p=produk.id AND id_u='$id_u'");


?>

<?php if(mysqli_fetch_assoc($wishlist)): ?>
<table cellpadding="10" cellspacing="0">
	<tr>
		<th></th>
		<th></th>
		<th>Product</th>
		<th>Size</th>
		<th>Price</th>
		<th></th>
	</tr>
	<?php 
			$btn=1;
			?>
	<?php foreach($wishlist as $product): ?>
	<tr>
		<td>
			<?php $setWish=$id_u.','.$product['id']; ?>
			<button type="button" onclick="deleteWish(<?= $setWish?>)">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg"
					viewBox="0 0 16 16">
					<path
						d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
				</svg>
			</button>
		</td>
		<td><img src="assets/img/<?= $product['gambar'];?>"></td>
		<td>
			<a href="product.php?number=<?= $product['id'];?>"><?= $product['nama_produk'];?></a>
		</td>
		<td><?= $product['ukuran'];?></td>
		<td><?= idr($product['harga']);?></td>
		<td>
			<?php 
					$setCart=$id_u.','.$product['id']; 
					$id_p=$product['id'];
					$adaCart=query("SELECT * FROM cart WHERE id_u='$id_u' AND id_p='$id_p'");
					?>
			<button type="button" id="<?= $btn;?>" onclick="addCart(<?= $setCart?>,this.id)"
				class="cart1 <?php if(!empty($adaCart)){echo"d-none";} ?>">ADD TO CART</button>
			<?php $btn++; ?>
			<button type="button" id="<?= $btn;?>" onclick="removeCart(<?= $setCart?>,this.id)"
				class="cart2 <?php if(empty($adaCart)){echo"d-none";} ?>">ADD TO CART</button>
		</td>
	</tr>
	<?php $btn++; ?>
	<?php endforeach; ?>

</table>
<?php else: ?>
<div style="padding:0 0 200px 0;text-align:center;">
	<h1
		style="color:#a9a9a9;font-family: 'Open Sans', sans-serif;margin-top:120px;text-align:center;text-transform:uppercase;font-weight:400;">
		WISHLIST IS EMPTY</h1>
</div>
<?php endif; ?>