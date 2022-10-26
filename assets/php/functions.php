<!-- ANALOGI TEMEN NUNJUKIN BAJU KELUARIN DULU BAJUNYA KEBASKOM BARU TUNJUKIN -->

<!-- RESULT ITU DI ANALOGIKAN LEMARI -->

<?php
function koneksi()
{
  $conn = mysqli_connect('localhost', 'root', '', 'trifthinqs') or die('KONEKSI GAGAL!!');

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
   kode_produk LIKE '%$search%' 
   ORDER BY status ASC,id DESC
   ";


// $query = "SELECT * FROM produk
//              WHERE
//             nama_produk LIKE '%$search%' OR
//             jenis_produk LIKE '%$search%' OR
//             ukuran LIKE '%$search%' OR
//             harga LIKE '%$search%' OR
//             kode_produk LIKE '%$search%' OR
//             keterangan LIKE '%$search%'
//             ORDER BY status ASC,id DESC
//             ";

              return query ($query);



    
}



//  Function cari
function type($keyword){

$keyword=$_GET['type'];

   $query = "SELECT * FROM produk
              WHERE jenis_produk = '$keyword'
              ORDER BY status ASC,id DESC
            ";

              return query($query);
}

// function kode_aktivasi
function gen_uid($l=6){
    return substr(uniqid(), 7, $l);
} 


// function aktifasi
function activation($data){
   $conn=koneksi();
$kode_aktivasi=$data["activation_code"];
        $query = "UPDATE `users` SET `status`='on' WHERE `kode_aktivasi`='$kode_aktivasi';
                ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
} 

// function mengubah kode aktifasi
function updateAktifasi($data){
   $conn=koneksi();
$email=htmlspecialchars($data["email"]);
$kode_aktivasi=$data["kode_aktivasi"];
    
$query = "UPDATE `users` SET `kode_aktivasi`='$kode_aktivasi'WHERE `email`='$email'";
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
    $kode_aktivasi=$data["kode_aktivasi"];


        $query = "UPDATE `users` SET `status`='on' WHERE `kode_aktivasi`='$kode_aktivasi';
                ";
    mysqli_query($conn, $query);


    return mysqli_affected_rows($conn);
} 



// Signup
function signup($data){
   $conn=koneksi();

    $username= htmlspecialchars(stripslashes($data["ver_username"]));
    $email=htmlspecialchars($data["ver_email"]);
    $password= mysqli_real_escape_string($conn, $data["ver_password1"]);
    $password2= mysqli_real_escape_string($conn,$data["ver_password2"]);
    $kode_aktivasi=$data["activation_code"];

    // enkriosi password
$password=password_hash($password, PASSWORD_DEFAULT);   

// tambahkan user baru ke database
mysqli_query($conn, "INSERT INTO `users`(`username`,`email`, `password`,  `level`, `kode_aktivasi`) VALUES ('$username','$email','$password','user','$kode_aktivasi')");

return mysqli_affected_rows($conn);

}

// forgot password
function sendCode($data){
    $conn=koneksi();
 
     $email=htmlspecialchars($data["ver_email"]);
     $kode_aktivasi=$data["activation_code"];
 // tambahkan user baru ke database
 mysqli_query($conn, "UPDATE users SET kode_aktivasi='$kode_aktivasi' WHERE email='$email'");
 
 return mysqli_affected_rows($conn);
 
 }

// resend
function resend($data){
    $conn=koneksi();

     $email=htmlspecialchars($data["ver_email"]);
     $kode_aktivasi=$data["activation_code"];
 // tambahkan user baru ke database
 mysqli_query($conn, "UPDATE users SET kode_aktivasi='$kode_aktivasi' WHERE email='$email'");
 
 return mysqli_affected_rows($conn);
 
 }

 // reset code
function resetCode($data){
    $conn=koneksi();
 
     $email=htmlspecialchars($data["ver_email"]);
     $kode_aktivasi=gen_uid();
 // tambahkan user baru ke database
 mysqli_query($conn, "UPDATE users SET kode_aktivasi='$kode_aktivasi' WHERE email='$email'");
 
 return mysqli_affected_rows($conn);
 
 }

// Change Password
// Change
function changepw($data){
   $conn=koneksi();

    $email=htmlspecialchars($data["ver_email"]);
    $password= mysqli_real_escape_string($conn, $data["ver_password1"]);
    $password2= mysqli_real_escape_string($conn,$data["ver_password2"]);
    
    // enkriosi password
$password=password_hash($password2, PASSWORD_DEFAULT);   

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
function changePhoto($data){
$conn=koneksi();
    $id=htmlspecialchars($data["id"]);
    $gambarLama=htmlspecialchars($data["gambarLama"]);
    // cek apakah user pilih gambar baru atau tidak
if($_FILES['gambar']['error']===4){
    $gambar=$gambarLama;
}else if($gambarLama=='default.png'){
    $gambar=uploadPhoto();
    // cek jika upload gagal
    if(!$gambar){
        return false;
    }    
}else{
      $gambar=uploadPhoto();
    // cek jika upload gagal
    if(!$gambar){
        return false;
    }    
        // hapus gambar lama
    unlink('assets/profile/' . $gambarLama);
}
$query = "UPDATE `users` SET `foto`='$gambar' WHERE `id`='$id'; ";
    mysqli_query($conn, $query);
return mysqli_affected_rows($conn);

}
// Function Upload profile
function uploadPhoto(){
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
     if($filesize > 10000000){
     echo"<script>
     alert('Ukuran gambar terlalu besar!')
     </script>";
 
     return false;
     }
 
     // proses upload gambar
     $newfilename = uniqid() . $filename;
 
     move_uploaded_file($filetmpname, 'assets/profile/' . $newfilename);
     return $newfilename;
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