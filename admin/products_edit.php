<?php include 'session.php';

if(!isset($_POST['id'])){
	header("location:products.php");
	exit;
}

?>
<!DOCTYPE html>
<html>

	<head>
		<?php include 'header.php' ?>
		<style>
		/* Chrome, Safari, Edge, Opera */
		input::-webkit-outer-spin-button,
		input::-webkit-inner-spin-button {
			-webkit-appearance: none;
			margin: 0;
		}

		/* Firefox */
		input[type=number] {
			-moz-appearance: textfield;
		}
		</style>
	</head>

	<body class="hold-transition sidebar-mini">

		<div class="wrapper">
			<!-- Navbar -->
			<nav class="main-header navbar navbar-expand navbar-white navbar-light">
				<?php include 'nav.php' ?>
			</nav>
			<!-- /.navbar -->

			<!-- Main Sidebar Container -->
			<aside class="main-sidebar sidebar-dark-primary elevation-4">
				<?php include 'sidebar.php' ?>

			</aside>

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<div class="container-fluid">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Edit Product TrifthinQs Store<span style="color:red;">.</span></h1>
							</div>
						</div>
					</div><!-- /.container-fluid -->
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12 col-sm-8">

								<?php 
							$id=$_POST['id'];
							// menghitung jumlah barang
							$product = query("SELECT * FROM produk WHERE id='$id'")[0];
							// jenis produk
							$types=query("SELECT * FROM jenis_produk");
							// ukuran produk
							// mencari ukuran berdasarkan jenisnya
						$sizeProduct=$product['jenis_produk'];

						$query="SELECT * FROM ukuran_jenis_produk
												WHERE
												jenis_produk LIKE '%$sizeProduct%'
											";
						$sizes= query($query);
							?>


								<div class="card">
									<div class="card-header">
										<div class="card card-dark">
											<div class="card-header">
												<h3 class="card-title">Edit The Product</h3>
											</div>
											<!-- /.card-header -->
											<!-- form start -->
											<form action="products_edit_function.php" enctype="multipart/form-data" method="post">
												<div class="card-body">
													<div class="form-group d-none">
														<input type="hidden" name="id" value="<?= $id;?>" required>
														<input type="hidden" name="kode_produk" class="form-control" placeholder="Enter Code"
															id="code" value="<?= $product['kode_produk'];?>" readonly autocomplete="off" required>
													</div>

													<div class="form-group">
														<label for="name">Name</label>
														<input type="text" name="nama_produk" class="form-control" id="name"
															placeholder="Enter Name" autocomplete="off" required maxlength="100"
															value="<?= $product['nama_produk'];?>">
													</div>

													<div class="form-group">
														<label for="type">Type</label>
														<select id="type" class="form-control" name="jenis_produk" required style="cursor:pointer;">
															<option value="">Select Product Type</option>
															<?php foreach($types as $type): ?>
															<option <?php if($type['jenis_produk']==$product['jenis_produk']){echo"selected";
														} ?> value="<?= $type['jenis_produk'];?>">
																<?= $type['jenis_produk']; ?></option>
															<?php endforeach; ?>
														</select>
													</div>

													<div class="form-group " id="colSize">
														<?php if($sizes[0]['ukuran']!=='no'): ?>
														<label for="inputState">Size</label>
														<select id="inputState" class="form-control" name="ukuran" required style="cursor:pointer;">
															<?php foreach($sizes as $size): ?>
															<option value="<?= $size['ukuran'];?>"
																<?php if($size['ukuran']==$product['ukuran']){echo"selected";} ?>>
																<?= $size['ukuran']; ?>
															</option>
															<?php endforeach; ?>
														</select>
														<?php else: ?>
														<label for="inputState">Size</label>
														<select id="inputState" class="form-control" name="ukuran" required style="cursor:pointer;">
															<option value="no">NO SIZE</option>
														</select>
														<?php endif; ?>
													</div>

													<div class="form-group">
														<label for="dengan-rupiah">Price</label>
														<input type="text" name="harga" class="form-control" placeholder="Enter Price"
															id="dengan-rupiah" maxlength="16" required value="<?= rupiah2($product['harga']);?>">
													</div>

													<div class="form-group">
														<label for="color">Color</label>
														<input type="color" name="warna" class="form-control" id="color"
															style="border-radius:10px;width:50%;height:40px;cursor:pointer;"
															value="<?= $product['warna'];?>">
													</div>

													<div class="form-group">
														<label for="image">Image</label>
														<img src="../assets/img/<?= $product['gambar'];?>" class="img-thumbnail mb-2"
															style="width:120px;display:block;" id=img-preview>
														<div class="custom-file">
															<input type="file" class="custom-file-input" id="image" name="gambar"
																aria-describedby="inputGroupFileAddon01" style="cursor:pointer;"
																onchange="previewImage();">
															<input class="form-control form-control-sm" id="gambarLama" type="hidden"
																name="gambarLama" value="<?= $product["gambar"]?>">
															<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
														</div>
													</div>

													<!--Bootstrap classes arrange web page components into columns and rows in a grid -->


													<div class="form-group">
														<label for="desc">Description</label>
														<textarea class="form-control" placeholder="Discribe the product" id="desc"
															style="height: 100px"
															name="keterangan"><?= str_replace("<br/>","&#13",$product['keterangan']) ;?></textarea>
													</div>
												</div>
												<!-- /.card-body -->

												<div class="card-footer">
													<button type="submit" name="submit" class="btn btn-dark">Submit</button>
												</div>
											</form>
										</div>


										<!-- /.card -->
									</div>
									<!-- /.col -->
								</div>
								<!-- /.row -->
							</div>
							<!-- /.container-fluid -->
				</section>
				<!-- /.content -->
			</div>
			<!-- /.content-wrapper -->
			<footer class="main-footer">
				<?php include 'footer.php' ?>
			</footer>

			<!-- Control Sidebar -->
			<aside class="control-sidebar control-sidebar-dark">
				<!-- Control sidebar content goes here -->
			</aside>
			<!-- /.control-sidebar -->
		</div>
		<!-- ./wrapper -->

		<!-- bootstrap -->
		<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

		<script>
		tinymce.init({
			selector: 'textarea#editor',
			skin: 'bootstrap',
			plugins: 'lists, link, image, media',
			toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help',
			menubar: false,
		});
		</script>


		<!-- my javascript -->>
		<script>
		// ambil elemen2 yang dibutuhkan
		var type = document.getElementById("type");
		var colSize = document.getElementById("colSize");

		// tambahkan event ketika keyboard ditulis
		type.addEventListener("change", function() {

			colSize.classList.remove('d-none');

			// buat object ajax
			var xhr = new XMLHttpRequest();

			// cek kesiapan ajax
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4 && xhr.status == 200) {
					colSize.innerHTML = xhr.responseText;
				}
			};

			// eksekusi ajax
			xhr.open("GET", "ajax/products_add.php?type=" + type.value, true);
			xhr.send();

			if (type.value == '') {
				colSize.classList.add('d-none');
			}

		});


		function previewImage() {
			const gambar = document.querySelector("#image");
			const imgPreview = document.querySelector("#img-preview");
			imgPreview.style.display = "block";
			var oFReader = new FileReader();
			oFReader.readAsDataURL(gambar.files[0]);

			oFReader.onload = function(oFREvent) {
				imgPreview.src = oFREvent.target.result;
			};
		}


		/* Dengan Rupiah */
		var dengan_rupiah = document.getElementById('dengan-rupiah');
		dengan_rupiah.addEventListener('keyup', function(e) {
			dengan_rupiah.value = formatRupiah(this.value, 'Rp. ');
		});

		/* Fungsi */
		function formatRupiah(angka, prefix) {
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
				split = number_string.split(','),
				sisa = split[0].length % 3,
				rupiah = split[0].substr(0, sisa),
				ribuan = split[0].substr(sisa).match(/\d{3}/gi);

			if (ribuan) {
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}

			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}
		</script>


		<!-- jQuery -->
		<script src="plugins/jquery/jquery.min.js"></script>
		<!-- Bootstrap 4 -->
		<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		<!-- DataTables -->
		<script src="plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
		<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
		<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
		<!-- AdminLTE App -->
		<script src="dist/js/adminlte.min.js"></script>
		<!-- AdminLTE for demo purposes -->
		<script src="dist/js/demo.js"></script>
		<!-- page script -->
		<script>
		$(function() {
			$("#example1").DataTable({
				"responsive": true,
				"autoWidth": false,
			});
			$('#example2').DataTable({
				"paging": true,
				"lengthChange": false,
				"searching": false,
				"ordering": true,
				"info": true,
				"autoWidth": false,
				"responsive": true,
			});
		});
		</script>
	</body>

</html>