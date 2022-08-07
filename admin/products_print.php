<?php

require_once __DIR__ . '/vendor/autoload.php';

// koneksi database
require 'query.php';
$products=query("SELECT * FROM produk ORDER BY id DESC");

ob_clean();


	$mpdf = new \Mpdf\Mpdf();


$html='<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
	<!-- icon -->
	<link rel="icon" href="../assets/icon/icon.png">

	<!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Libre+Bodoni:wght@500&family=Montserrat:wght@300;400;500;600&family=Open+Sans:wght@600&display=swap"
		rel="stylesheet">
    <title>Goturprint.</title>

		<style>
		tr:nth-child(even){
			background-color:#ddd;
		}
		
</style>

</head>
<body>

			<h1 style="text-align: center;font-family: "Libre Bodoni", sans-serif;color: #151e3d;">TrifthinQs Store<span style=" color: red;font-size: 50px;">.</span></h1>
						<i style="text-align: center;font-family: "Libre Bodoni", sans-serif;color: #151e3d;">Products of TrifthinQs Store<span style=" color: red;font-size: 50px;">.</span></i>
			
			<div class="container" style="font-family:sans-serif;">

<table  border="1" cellpadding="10" cellspacing="0">
				<thead>
					<tr style="background-color:black;">
						<th style="color:white;">No</th>
						<th style="color:white;">Image</th>
						<th style="color:white;">Code</th>
						<th style="color:white;">Name</th>
						<th style="color:white;">Type</th>
						<th style="color:white;">Size</th>
						<th style="color:white;">Price</th>
						<th style="color:white;">Description</th>
					</tr>
				</thead>
			';

				$i=1;
foreach($products as $product){
	$html.='<tbody>
	<tr>
	<td>'.$i++.'</td>
	<td><img src="../assets/img/'.$product["gambar"].'" style="width:100px; height:100px; object-fit:cover"/></td>
	<td>'.$product["kode_produk"].'</td>
	<td>'.$product["nama_produk"].'</td>
	<td>'.$product["jenis_produk"].'</td>
	<td>'.$product["ukuran"].'</td>
	<td>'.rupiah($product["harga"]).'</td>
	<td>'.$product["keterangan"].'</td>
	</tr>

</tbody>

	';
}

 $html.= '
					</table>
					</div>
					</body>
					</html>';


$mpdf->WriteHTML($html);
$mpdf->Output('daftar-produk-goturthings.pdf', 'I');

?>