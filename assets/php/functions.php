<!-- ANALOGI TEMEN NUNJUKIN BAJU KELUARIN DULU BAJUNYA KEBASKOM BARU TUNJUKIN -->

<!-- RESULT ITU DI ANALOGIKAN LEMARI -->

<?php
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
    $keterangan = htmlspecialchars($data["keterangan"]);
    $warna = $data["warna"];


    $kodeProduk= str_replace("'","",$kode_produk);
    $namaProduk= str_replace("'","",$nama_produk);
    $hargaBaru=preg_replace("/[^0-9]/", "", $harga);
    $keteranganBaru= str_replace("'","",$keterangan);


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
    echo"<script>
    alert('Yang anda upload bukan gambar!');
    </script>";

    return false;
    }

    // cek apakah gambar terlalu besar
    if($filesize > 1000000){
    echo"<script>
    alert('Ukuran gambar terlalu besar!');
    </script>";
    
    return false;
    }

    // proses upload gambar

    $newfilename = uniqid() . $filename;

    move_uploaded_file($filetmpname, '../img/' . $newfilename);

    return $newfilename;
}




// Function Upload profile
function uploadProfile(){
   // siapkan data gambar
    $filename=$_FILES['gambar']['name'];
    $filetmpname=$_FILES['gambar']['tmp_name'];
    $filesize=$_FILES['gambar']['size'];
    $filetype=pathinfo($filename, PATHINFO_EXTENSION);
    $allowedtype=['jpg', 'jpeg', 'png'];

   $filetype=strtolower($filetype);

    // cek apakah yang diupload bukan gambar
    if(!in_array($filetype, $allowedtype)){
    echo"<script>
    alert('Yang anda upload bukan gambar!')
    </script>";

    return false;
    }

    // cek apakah gambar terlalu besar
    if($filesize > 8000000){
    echo"<script>
    alert('Ukuran gambar terlalu besar!')
    </script>";

    return false;
    }

    // proses upload gambar
    $newfilename = uniqid() . $filename;

    move_uploaded_file($filetmpname, '../profile/' . $newfilename);

    return $newfilename;
}




// Function delete
function delete($id) {
   $conn=koneksi();
    // query mahasiswa berdasarkan id
$produk=query("SELECT * FROM produk WHERE id=$id")[0];

// cek jika gambar default
if($produk["gambar"]!=='nophoto.png'){
    // hapus gambar
    unlink('../img/' . $produk["gambar"]);
}

    mysqli_query($conn, "DELETE FROM produk WHERE `produk`.`id` = '$id'");
    return mysqli_affected_rows($conn);

}

// Ubah data
function ubah($data) {
   $conn=koneksi();
    $id=htmlspecialchars($data["id"]);
    $jenis_produk =($data["jenis_produk"]);
    $kode_produk= htmlspecialchars($data["kode_produk"]);
    $nama_produk = htmlspecialchars($data["nama_produk"]);
    $ukuran = ($data["ukuran"]);
    $harga = htmlspecialchars($data["harga"]);
    $keterangan = htmlspecialchars($data["keterangan"]);
    $gambarLama=htmlspecialchars($data["gambarLama"]);
    $warna=htmlspecialchars($data["warna"]);

    $kodeProduk= str_replace("'","",$kode_produk);
    $namaProduk= str_replace("'","",$nama_produk);
    $hargaBaru=preg_replace("/[^0-9]/", "", $harga);
    $keteranganBaru= str_replace("'","",$keterangan);

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
    unlink('../img/' . $gambarLama);


}



    $query = "UPDATE `produk` SET `id`='$id',`jenis_produk`='$jenis_produk',`kode_produk`='$kodeProduk',`nama_produk`='$namaProduk',`ukuran`='$ukuran',`harga`='$hargaBaru',`keterangan`='$keteranganBaru',`gambar`='$gambar',
     `warna`='$warna'
    WHERE `id`='$id';
                ";
    mysqli_query($conn, $query);


    return mysqli_affected_rows($conn);


}




//  Function cari
function search($search){

$query = "SELECT * FROM produk
             WHERE
            nama_produk LIKE '%$search%' OR
            jenis_produk LIKE '%$search%' OR
            ukuran LIKE '%$search%' OR
            harga LIKE '%$search%' OR
            kode_produk LIKE '%$search%' OR
            keterangan LIKE '%$search%'
            ORDER BY id
            ";

              return query ($query);



    
}



//  Function cari
function type($keyword){

$keyword=$_POST['type'];

   $query = "SELECT * FROM produk
              WHERE jenis_produk = '$keyword'
            ";

              return query($query);

    
}

// function kode_aktifasi
function gen_uid($l=6){
    return substr(uniqid(), 7, $l);
} 


// function aktifasi
function aktifasi($data){
   $conn=koneksi();
$kode_aktifasi=$data["kode_aktifasi"];


        $query = "UPDATE `users` SET `status`='on' WHERE `kode_aktifasi`='$kode_aktifasi';
                ";
    mysqli_query($conn, $query);


    return mysqli_affected_rows($conn);

    
} 

// function mengubah kode aktifasi
function updateAktifasi($data){
   $conn=koneksi();
$email=htmlspecialchars($data["email"]);
$kode_aktifasi=$data["kode_aktifasi"];
    
$query = "UPDATE `users` SET `kode_aktifasi`='$kode_aktifasi'WHERE `email`='$email'";
mysqli_query($conn, $query);

 return mysqli_affected_rows($conn);
}

// function aktifasi
function updateEmail($data){
   $conn=koneksi();
     $username= htmlspecialchars(stripslashes($data["username"]));
    $email=htmlspecialchars($data["email"]);
    $password= mysqli_real_escape_string($conn, $data["password"]);
    $password2= mysqli_real_escape_string($conn,$data["password2"]);
    $kode_aktifasi=$data["kode_aktifasi"];


        $query = "UPDATE `users` SET `status`='on' WHERE `kode_aktifasi`='$kode_aktifasi';
                ";
    mysqli_query($conn, $query);


    return mysqli_affected_rows($conn);
} 



// Signup
function signup($data){
   $conn=koneksi();

    $username= htmlspecialchars(stripslashes($data["username"]));
    $email=htmlspecialchars($data["email"]);
    $password= mysqli_real_escape_string($conn, $data["password"]);
    $password2= mysqli_real_escape_string($conn,$data["password2"]);
    $kode_aktifasi=$data["kode_aktifasi"];


    // cek konsfirmasi password
    if($password !== $password2){
        echo "
        <script>
        alert('konfirmasi password tidak sesuai!');
        document.location.href='signup.php'
        </script>
        ";
        
        return false;
    }


    // enkriosi password
$password=password_hash($password, PASSWORD_DEFAULT);   

    // tambahkan user baru ke database
mysqli_query($conn, "INSERT INTO `users`(`username`,`email`, `password`,  `level`, `kode_aktifasi`) VALUES ('$username','$email','$password','user','$kode_aktifasi')");

return mysqli_affected_rows($conn);

}





// Change Password
// Change
function changepw($data){
   $conn=koneksi();

    $email=htmlspecialchars($data["email"]);
    $password= mysqli_real_escape_string($conn, $data["password"]);
    $password2= mysqli_real_escape_string($conn,$data["password2"]);



    // enkriosi password
$password=password_hash($password, PASSWORD_DEFAULT);   

// tambahkan user baru ke database
mysqli_query($conn, "UPDATE users SET password='$password' WHERE email='$email'");


return mysqli_affected_rows($conn);




}




//rupiah
function rupiah($harga){
	global $conn;

	$hasil_rupiah = "Rp. " . number_format($harga,2,',','.');
	return $hasil_rupiah;
 




}



//rupiah
function idr($harga){
	global $conn;

	$hasil_rupiah = "IDR " . number_format($harga,0,',','.');
	return $hasil_rupiah;
 
}


// profile
function editFoto($data){
$conn=koneksi();

     $id=htmlspecialchars($data["id"]);
    $gambarLama=htmlspecialchars($data["gambarLama"]);

    // cek apakah user pilih gambar baru atau tidak
if($_FILES['gambar']['error']===4){
    $gambar=$gambarLama;
}else if($gambarLama=='default.png'){
    $gambar=uploadProfile();

    // cek jika upload gagal
    if(!$gambar){
        return false;
    }    



}else{
      $gambar=uploadProfile();

    // cek jika upload gagal
    if(!$gambar){
        return false;
    }    

        // hapus gambar lama
    unlink('../profile/' . $gambarLama);
}


$query = "UPDATE `users` SET `foto`='$gambar' WHERE `id`='$id'; ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);

}





function edit($data){

$conn=koneksi();

    $id=htmlspecialchars($data["id"]);
    $username =htmlspecialchars(stripslashes($data["username"]));
    $email= htmlspecialchars($data["email"]);
    $noTelp = ($data["no_telp"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $gender = htmlspecialchars($data["gender"]);
    $lahir=htmlspecialchars($data["lahir"]);

    $emaillama=$_SESSION['email'];




if($email==$emaillama){
$query = "UPDATE `users` SET `username`='$username',`no_telp`='$noTelp',`gender`='$gender',`alamat`='$alamat',`lahir`='$lahir' WHERE `id`='$id'; ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}



// Cek username sudah ada atau belum
    $result=mysqli_query($conn,"SELECT email FROM users WHERE email='$email'");

if(mysqli_fetch_assoc($result)){
echo"
<script>
alert('Email sudah terdaftar!')
document.location.href='profile-edit.php'
</script>
";

return false;
}

// username nya tidak ada yang sama


  // cek apakah user pilih gambar baru atau tidak

if($emaillama!=$email){

$query = "UPDATE `users` SET `username`='$username',`no_telp`='$noTelp',`gender`='$gender',`alamat`='$alamat',`lahir`='$lahir' WHERE `id`='$id'; ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}




}



// Function ubah level
function ubahLevel($id) {
   $conn=koneksi();

    mysqli_query($conn, "UPDATE users SET level='admin' WHERE `users`.`id` = '$id'");
    return mysqli_affected_rows($conn);
}


// Function ban
function banLevel($id) {
   $conn=koneksi();

    mysqli_query($conn, "UPDATE users SET status='ban' WHERE `users`.`id` = '$id'");
    return mysqli_affected_rows($conn);
}


// Function heal
function healLevel($id) {
   $conn=koneksi();

    mysqli_query($conn, "UPDATE users SET status='on' WHERE `users`.`id` = '$id'");
    return mysqli_affected_rows($conn);
}


?>