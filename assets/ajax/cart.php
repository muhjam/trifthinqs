<?php 
session_start();
require '../php/functions.php';

if(isset($_COOKIE['code'])){
	$code_hash=$_COOKIE['code'];
} 

?>
<?php if(!isset($_GET['undoCart'])&&!isset($_GET['cleanCart'])&&!isset($_GET['voucher'])): ?>
<div class="alert-success">
	<div class="alert-logo">
		<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-circle-fill"
			viewBox="0 0 16 16">
			<path
				d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
		</svg>
	</div>
	<div class="alert-text">"<?= $_SESSION['nameRemove'];?>" removed. <a href="#" onclick="undo()">Undo?</a></div>
	<a class="close" onclick="close_alert('.alert-success')">
		<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-lg"
			viewBox="0 0 16 16">
			<path
				d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
		</svg>
	</a>
</div>
<?php endif; ?>

<?php if(isset($_COOKIE['shopping_cart'])&&isset($_COOKIE['code'])&&$code_hash===hash('sha256', $_COOKIE['shopping_cart'])&&strlen($_COOKIE['shopping_cart'])>16): ?>
<div class="action">
	<button type="button" onclick="clearCart()">CLEAR</button>
	<form action="" method="post" class="voucher">
		<input type="text" placeholder="Voucher Code" name="voucher" maxlength="10" autocomplete="off">
		<button type="submit" name="submit">USE</button>
	</form>
</div>
<?php endif; ?>
<style>
.container {
	animation: slideUp 0.5s;
}

@keyframes slideUp {
	0% {
		transform: translatey(0%)
	}

	30% {
		transform: translatey(10%)
	}
}
</style>
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
				<td><strong><a href="product.php?number=<?= $product['id'];?>"><?= $product['nama_produk']; ?></a></strong>
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
		<p>SUMMARY : </p>
		<span>&bull; <?= count($cart_data) ; ?> Items</span>
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