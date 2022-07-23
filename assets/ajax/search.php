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
            ORDER BY id DESC
					";




$goturthings= query($query);



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




<?php if(empty($goturthings)): ?>
<div style="padding:20px 0 200px 0;text-align:center;">
	<h1
		style="color:#a9a9a9;font-family: 'Open Sans', sans-serif;margin-top:120px;text-align:center;text-transform:uppercase;font-weight:400;">
		NO PRODUCT</h1>
</div>
<?php endif; ?>


<div class="produk" data-aos="flip-left" style="margin-bottom:100px;">
	<?php foreach($goturthings as $goturthing): ?>
	<a href="product.php?number=<?= $goturthing['id'];?>" class="news-item">
		<input type="hidden" value="<?= $goturthing['id'];?>" name="product">
		<div class="border">
			<img src="assets/img/<?= $goturthing['gambar']?>">
		</div>
		<h4><?= $goturthing['nama_produk']; ?></h4>
		<p><?= idr($goturthing["harga"]); ?></p>
	</a>
	<?php endforeach; ?>
</div>


<!-- akhir produk -->