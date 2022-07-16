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


function koneksi()
{
  $conn = mysqli_connect('localhost', 'root', '', 'goturthings') or die('KONEKSI GAGAL!!');

    return $conn;
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




// Ubah data
function ubah($data) {
   $conn=koneksi();
    $id=htmlspecialchars($data["id"]);
    $jenis_produk =($data["jenis_produk"]);
    $kode_produk= htmlspecialchars($data["kode_produk"]);
    $nama_produk = htmlspecialchars($data["nama_produk"]);
    $ukuran = ($data["ukuran"]);
    $harga = htmlspecialchars($data["harga"]);
    $keterangan = $data["keterangan"];
    $gambarLama=htmlspecialchars($data["gambarLama"]);
    $warna=htmlspecialchars($data["warna"]);

    $kodeProduk= str_replace("'","",$kode_produk);
    $namaProduk= str_replace("'","",$nama_produk);
    $hargaBaru=preg_replace("/[^0-9]/", "", $harga);
    $keteranganBaru= preg_replace("/\r\n|\r|\n/", '<br/>', str_replace("'","",$keterangan));

    // cek apakah user pilih gambar baru atau tidak
if($_FILES['gambar']['error']===4){
    $gambar=$gambarLama;
}else{
    $gambar=upload();

    // cek jika upload gagal
    if(!$gambar){
        return false;
    }    
        // hapus gambar lama
    unlink('../assets/img/' . $gambarLama);
}



    $query = "UPDATE `produk` SET `id`='$id',`jenis_produk`='$jenis_produk',`kode_produk`='$kodeProduk',`nama_produk`='$namaProduk',`ukuran`='$ukuran',`harga`='$hargaBaru',`keterangan`='$keteranganBaru',`gambar`='$gambar',
     `warna`='$warna'
    WHERE `id`='$id';
                ";
    mysqli_query($conn, $query);


    return mysqli_affected_rows($conn);


}

// Function Upload
function upload(){
   // siapkan data gambar
    $filename=$_FILES['gambar']['name'];
    $filetmpname=$_FILES['gambar']['tmp_name'];
    $filesize=$_FILES['gambar']['size'];
    $filetype=pathinfo($filename, PATHINFO_EXTENSION);
    $allowedtype=['jpg', 'jpeg', 'png'];

   $filetype=strtolower($filetype);

    // cek apakah yang diupload bukan gambar
    if(!in_array($filetype, $allowedtype)){
echo "
        	<script>
	Swal.fire({
		icon: 'error',
		title: 'Failed Upload!',
		text: 'What you uploaded is not an image!'
	}).then(function() {
		document.location.href = 'products_add.php';
	});
	</script>";

return false;
    }

    // cek apakah gambar terlalu besar
    if($filesize > 1000000){
    echo "
  <script>
	Swal.fire({
		icon: 'error',
		title: 'Failed Upload!',
		text: 'Image file size is too big!'
	}).then(function() {
		document.location.href = 'products.php';
	});
	</script>";

return false;
 
    }

    // proses upload gambar

    $newfilename = uniqid() . $filename;

    move_uploaded_file($filetmpname, '../assets/img/' . $newfilename);

    return $newfilename;
}



if (ubah($_POST) > 0) {
		    echo "
        <script>
			 Swal.fire({
  icon: 'success',
  title: 'Product GoturthinQs.!',
  text: 'Successfully changed!'
}).then(function(){
document.location.href='products.php';
});
        </script>";
return false;

}else{

	    echo "
        <script>
			 Swal.fire({
  icon: 'warning',
  title: 'Product GoturthinQs.!',
  text: 'Nothing has changed!'
}).then(function(){
document.location.href='products_edit.php';
});
        </script>";
return false;


}


?>

</body>

</html>