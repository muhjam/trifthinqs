<script>
Swal.fire({
	icon: 'error',
	title: 'Oops...',
	text: 'Something went wrong!',
}).then(function() {
	location.reload();
})
</script>
<?php 
unset($_POST);
unset($_SESSION['error']);
?>