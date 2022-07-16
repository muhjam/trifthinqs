<?php include 'session.php'; ?>
<!DOCTYPE html>
<html>

<head>
	<?php include 'header.php' ?>
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
							<h1>Products GoturthinQs<span style="color:red">.</span></h1>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">

							<div class="card">
								<div class="card-header">
									<a href="products_add.php"><button type="submit" class="btn btn-light"><svg
												xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
												class="bi bi-folder-plus" viewBox="0 0 16 16">
												<path
													d="m.5 3 .04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.683.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z" />
												<path
													d="M13.5 10a.5.5 0 0 1 .5.5V12h1.5a.5.5 0 1 1 0 1H14v1.5a.5.5 0 1 1-1 0V13h-1.5a.5.5 0 0 1 0-1H13v-1.5a.5.5 0 0 1 .5-.5z" />
											</svg> Add</button></a>

									<a href="products_print.php"><button type="submit" class="btn btn-light"><svg
												xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
												class="bi bi-printer-fill" viewBox="0 0 16 16">
												<path
													d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z" />
												<path
													d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
											</svg> Print</button></a>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>No</th>
												<th>Image</th>
												<th>Code</th>
												<th>Name</th>
												<th>Type</th>
												<th>Size</th>
												<th>Price</th>
												<th>Description</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<?php 
				include 'koneksi.php';		

		$sql = mysqli_query($koneksi,"SELECT * FROM produk ORDER BY id DESC") or die(mysql_error());

				$no=0;
				while($product = mysqli_fetch_array($sql))
				{
				$no++;
				$id=$product['id'];
					?>

												<td><?= $no; ?></td>
												<td><img src="../assets/img/<?= $product['gambar']?>"
														style="width:100px; height:100px; object-fit:cover"></td>
												<td>
													<?= $product['kode_produk']; ?>
												</td>
												<td><?= $product['nama_produk']; ?></td>
												<td><?= $product['jenis_produk']; ?></td>
												<td><?= $product['ukuran']; ?></td>
												<td><?= rupiah($product['harga']); ?></td>
												<td><?= $product['keterangan']; ?></td>
												<td>

													<form action="products_edit.php" method="post" style="display:inline-block;">
														<input type="hidden" value="<?= $id; ?>" name="id">
														<button type="submit" class="btn btn-dark"><svg xmlns="http://www.w3.org/2000/svg"
																width="16" height="16" fill="currentColor" class="bi bi-pencil-square"
																viewBox="0 0 16 16">
																<path
																	d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
																<path fill-rule="evenodd"
																	d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
															</svg> Edit</button>
													</form>

													<button type="button" class="btn btn-danger" title="Hapus Data" data-toggle="modal"
														data-target="#myModal4<?php echo $id; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16"
															height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
															<path
																d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
														</svg></button>
												</td>
												</td>
											</tr>

											<div class="modal fade" id="myModal4<?php echo $id; ?>" role="dialog">
												<div class="modal-dialog">
													<!-- Modal content-->
													<div class="modal-content">
														<div class="modal-header">
															<h4 class="modal-title">Confirmation</h4>
														</div>
														<div class="modal-body">
															<?php
												include('koneksi.php');
												$ide = $id;
												$kueri = mysqli_query($koneksi, "SELECT * FROM produk  WHERE id='$ide'") or die(mysql_error());
												$data = mysqli_fetch_array($kueri);
											?>
															<form role="form" action="products_delete_function.php" method="POST">
																<div class="form-group">
																	<div class="form-line">
																		<input type="hidden" class="form-control" name="id"
																			value="<?php echo $data['id']; ?>" />
																		<label> Are you sure to delete <?php echo $data['nama_produk']; ?> ? </label>
																	</div>
																</div>
																<div class="modal-footer">
																	<button type="submit" class="btn btn-success" name="has">Ya</button>
																	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																</div>
															</form>
														</div>
													</div>
												</div>
											</div>


											<?php }; ?>
									</table>
								</div>
								<!-- /.card-body -->
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