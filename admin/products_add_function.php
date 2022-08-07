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


// if(!isset($_POST['kode_produk'])||!isset($_POST['nama_produk'])||!isset($_POST['jenis_produk'])||!isset($_POST['ukuran'])||!isset($_POST['harga'])||!isset($_POST['warna'])||!isset($_POST['gambar'])||!isset($_POST['keterangan'])){
//     	header("location:products.php");
// return false;
// }


function koneksi()
{
  $conn = mysqli_connect('localhost', 'root', '', 'trifthinqs') or die('KONEKSI GAGAL!!');

    return $conn;
}
?>

<!DOCTYPE html>
<html lang="en">

	<head>

		<title>TrifthinQs.</title>

	</head>

	<body>
		<!-- Sweet Alert -->
		<script src='../assets/js/sweetalert2.all.min.js'></script>

		<?php


// TAMBAH
function tambah($data) {
   $conn=koneksi();

// cek apakah user tidak mengupload gambar
if($_FILES["gambar"]["error"]===4){
    $gambar='nophoto.png';
}else{
    // jalankan fungsi upload
    $gambar=upload();
    // cek jika upload gagal
    if(!$gambar){
        return false;
    }
}


    $jenis_produk =($data["jenis_produk"]);
    $kode_produk= htmlspecialchars($data["kode_produk"]);
    $nama_produk = htmlspecialchars($data["nama_produk"]);
    $ukuran = ($data["ukuran"]);
    $harga = htmlspecialchars($data["harga"]);
    $keterangan =$data["keterangan"];
    $warna = $data["warna"];


    $kodeProduk= str_replace("'","",$kode_produk);
    $namaProduk= str_replace("'","",$nama_produk);
    $hargaBaru=preg_replace("/[^0-9]/", "", $harga);
    $keteranganBaru= preg_replace("/\r\n|\r|\n/", '<br/>', str_replace("'","",$keterangan));

    // query insert data
    $query ="INSERT INTO `produk`(`jenis_produk`, `kode_produk`, `nama_produk`, `ukuran`, `harga`, `keterangan`, `gambar`,`warna`) VALUES ('$jenis_produk','$kodeProduk','$namaProduk','$ukuran','$hargaBaru','$keteranganBaru','$gambar','$warna');";

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
		document.location.href = 'products_add.php';
	});
	</script>";

return false;
 
    }

    // proses upload gambar

    $newfilename = uniqid() . $filename;

    move_uploaded_file($filetmpname, '../assets/img/' . $newfilename);

    return $newfilename;
}

if (tambah($_POST) > 0) {
		    echo "
        <script>
			 Swal.fire({
  icon: 'success',
  title: 'Product TrifthinQs Store!',
  text: 'Successfully Added!'
}).then(function(){
document.location.href='products.php';
});
        </script>";
return false;

} 


?>

	</body>

</html>