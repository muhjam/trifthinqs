<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="description" content="TrifthinQs Store trifthing shop fashion in Bandung, Indonesia" />
<meta name="generator" content="Eleventy v1.0.1" />
<meta name="keywords" content="trifthing, fashion, online shop" />
<meta name="author" content="Muhamad Jamaludin" />
<link rel="apple-touch-icon" sizes="180x180" href="assets/img/icon.png" />
<link rel="shortcut icon" href="assets/img/icon.png" />
<!-- icon -->
<link rel="icon" href="assets/icon/icon.png" />
<title>TrifthinQs.</title>
<!-- font awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
	href="https://fonts.googleapis.com/css2?family=Libre+Bodoni:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600;1,700&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
	rel="stylesheet">
<!-- login css -->
<link rel="stylesheet" href="assets/css/login.css">
<!-- AOS -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
<!-- loading -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Sweet Alert -->
<script src='assets/js/sweetalert2.all.min.js'></script>

<?php 
if(isset($_COOKIE['shopping_cart'])&&isset($_COOKIE['code'])&&$_COOKIE['code']!==hash('sha256', $_COOKIE['shopping_cart'])){
	setcookie('code', '', time()-(9000000*30),"/");
	setcookie('shopping_cart', '', time()-(9000000*30),"/");
}

if(isset($_COOKIE['shopping_cart'])&&!isset($_COOKIE['code'])||!isset($_COOKIE['shopping_cart'])&&isset($_COOKIE['code'])){
	setcookie('code', '', time()-(9000000*30),"/");
	setcookie('shopping_cart', '', time()-(9000000*30),"/");
}
?>