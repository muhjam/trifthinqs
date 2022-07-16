		<?php 
		
		require '../php/functions.php';
		
	$id_u=$_GET['id_u'];
	$cart=mysqli_query(koneksi(),"SELECT * FROM cart WHERE id_u='$id_u'");

	
		
		
		?>

		<a href="cart.php">
			<i class="fas fa-cart-arrow-down"></i>
			<?php if(mysqli_fetch_assoc($cart)): ?>
			<span class="notif"><?= mysqli_num_rows($cart); ?></span>
			<?php endif; ?>
		</a>