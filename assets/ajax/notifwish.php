		<?php 
		
		require '../php/functions.php';
		
	$id_u=$_GET['id_u'];
	$wish=mysqli_query(koneksi(),"SELECT * FROM wish WHERE id_u='$id_u'");

	
		
		
		?>

		<style>
nav ul li#notif-wish a {
	position: relative;
	display: block;
	text-decoration: none;
	margin: 0 10px;

}

nav ul li#notif-wish a .notif {
	position: absolute;
	top: -10px;
	right: -10px;
	background-color: red;
	border-radius: 100%;
	width: 16px;
	height: 16px;
	text-align: center;
	animation: pop 0.3s;
}

@keyframes pop {
	50% {
		transform: scale(1.2);
	}
}
		</style>

		<a href="wishlist.php"><i class="fas fa-heart"></i>
			<?php if(mysqli_fetch_assoc($wish)): ?>
			<span class="notif"><?= mysqli_num_rows($wish); ?></span>
			<?php endif; ?>
		</a>