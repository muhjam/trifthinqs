		<?php 
		
		require '../php/functions.php';
		
	$id_u=$_GET['id_u'];
	$wish=mysqli_query(koneksi(),"SELECT * FROM wish WHERE id_u='$id_u'");

	
		
		
		?>

		<a href="wishlist.php"><i class="fas fa-heart"></i>
			<?php if(mysqli_fetch_assoc($wish)): ?>
			<span class="notif"><?= mysqli_num_rows($wish); ?></span>
			<?php endif; ?>
		</a>