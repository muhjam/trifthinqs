<?php
// memeriksa sudah login atau belum
session_start();
$levelLogin=$_SESSION['level'];
$usernameLogin=$_SESSION['username'];
$emailLogin=$_SESSION['email'];
$idLogin=$_SESSION['id'];

if(!isset($_SESSION["level"])){
header("location:../logout.php");
exit;
}

if($_SESSION["level"]!='admin'){
	header("location:../index.php");
exit;
} 

if(!isset($_POST['id'])){
	header("location:products.php");
	exit;
}

$id = $_POST["id"];


function koneksi()
{
  $conn = mysqli_connect('localhost', 'root', '', 'goturthings') or die('KONEKSI GAGAL!!');

    return $conn;
}

function query($query) {
   $conn=koneksi();
    
     $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

	<title>GoturthinQs.</title>

</head>

<body>
	<!-- Sweet Alert -->
	<script src='../assets/js/sweetalert2.all.min.js'></script>

	<?php



// Function delete
function delete($id) {
   $conn=koneksi();
    // query mahasiswa berdasarkan id
$produk=query("SELECT * FROM produk WHERE id=$id")[0];

// cek jika gambar default
if($produk["gambar"]!=='nophoto.png'){
    // hapus gambar
    unlink('../assets/img/' . $produk["gambar"]);
}

    mysqli_query($conn, "DELETE FROM produk WHERE `produk`.`id` = '$id'");
    return mysqli_affected_rows($conn);

}



if(!isset($_POST['id'])){
    header('location:products.php');
}


// query data mahasiswa berdasarkan id
$produk= query("SELECT * FROM produk WHERE id=$id")[0]; // supaya ga manggil 0 nya lagi

if(empty($produk)){
	header("location:products.php");
}



if (delete($id) > 0) {
	    echo "
        <script>
			 Swal.fire({
  icon: 'success',
  title: 'Product GoturthinQs.!',
  text: 'Successfully deleted!'
}).then(function(){
document.location.href='products.php';
});
        </script>";
return false;
} else {
  	    echo "
        <script>
			 Swal.fire({
  icon: 'error',
  title: 'Product GoturthinQs.!',
  text: 'Failed to delete!'
}).then(function(){
document.location.href='products.php';
});
        </script>";
return false;
}


?>

</body>

</html>