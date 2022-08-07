<?php 
require '../php/functions.php';

$keyword=$_GET["search"];

$query="SELECT * FROM produk
             WHERE
            nama_produk LIKE '%$keyword%' OR
            jenis_produk LIKE '%$keyword%' OR
            ukuran LIKE '%$keyword%' OR
            harga LIKE '%$keyword%' OR
            kode_produk LIKE '%$keyword%' OR
            keterangan LIKE '%$keyword%'
            ORDER BY produk.status ASC,id DESC
					";
$products= query($query);
// mengaharhkan ke normal page
// if($keyword===''){
// header("Refresh:0; url=index.php");
// exit;
// }
?>

<!-- awal produk -->

<div class="title-index" style="margin-top:100px;">
	<span>LOOKING FOR</span>
</div>




<?php if(empty($products)): ?>
<div style="padding:20px 0 200px 0;text-align:center;">
	<h1
		style="color:#a9a9a9;font-family: 'Open Sans', sans-serif;margin-top:120px;text-align:center;text-transform:uppercase;font-weight:400;">
		NO PRODUCT</h1>
</div>
<?php endif; ?>


<div class="produk" data-aos="flip-left" style="margin-bottom:100px;">
	<?php foreach($products as $product): ?>
	<a href="product.php?number=<?= $product['id'];?>" class="news-item">
		<input type="hidden" value="<?= $product['id'];?>" name="product">
		<div class="border">
			<img src="assets/img/<?= $product['gambar']?>">
			<div id="label">
				<?php if($product['status']!=='sell'): ?>
				<img src="assets/icon/soldout.png" id="sold">
				<?php endif; ?>
			</div>
		</div>
		<h4><?= $product['nama_produk']; ?></h4>
		<p><?= idr($product["harga"]); ?></p>
	</a>
	<?php endforeach; ?>
</div>
<!-- akhir produk -->