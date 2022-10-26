<?php 
require '../query.php';

$type=$_GET["type"];

if($type!=''){
$query="SELECT * FROM ukuran_jenis_produk
             WHERE
            jenis_produk LIKE '%$type%'
					";
$sizes= query($query);
}

?>

<?php if($sizes[0]['ukuran']!=='no'): ?>
<label for="inputState">Size</label>
<select id="inputState" class="form-control" name="ukuran" required style="cursor:pointer;">
	<option value="">Select Product Size</option>
	<?php foreach($sizes as $size): ?>
	<option value="<?= $size['ukuran'];?>"><?= $size['ukuran']; ?></option>
	<?php endforeach; ?>
</select>
<?php else: ?>
<label for="inputState">Size</label>
<select id="inputState" class="form-control" name="ukuran" required style="cursor:pointer;">
	<option value="no">NO SIZE</option>
</select>
<?php endif; ?>