<?php
require '../php/functions.php';
//get the q parameter from URL
$keyword=$_GET["q"];
$query="SELECT * FROM produk
             WHERE
            nama_produk LIKE '%$keyword%' OR
            kode_produk LIKE '%$keyword%'
            ORDER BY produk.status ASC,id DESC
					";
$products= query($query);
$show=1;
if(!empty($keyword)){

if(empty($products)){

?>
<p>NO SUGGESTION</p>
<?php }else{; ?>
<?php foreach($products as $product){ ?>
<?php if($show < 4): ?>
<a href="product.php?number=<?= $product['id'];?>"><?= $product['nama_produk']; ?></a>
<?php endif; ?>
<?php $show++; }; ?>
<?php if($show > 4): ?>
<a class="moreResult" onclick="$(this).closest('form').submit();">MORE RESULT</a>
<?php endif; ?>
<?php }; ?>
<?php }; ?>

<script>
// moreResult
$(".search-item").slice(0, 3).show();
</script>