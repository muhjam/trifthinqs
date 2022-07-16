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
							<h1>Users Data</h1>
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
									<a href="mahasiswa_tambah.php"><button type="submit" class="btn btn-primary">Tambah</button><a>

								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>No</th>
												<th>Name</th>
												<th>Email</th>
												<th>Notlp</th>
												<th>Gender</th>
												<th>Date of birth</th>
												<th>Address</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<?php 
				include 'koneksi.php';
				$sql = mysqli_query($koneksi,"SELECT * FROM users ORDER BY username") or die(mysql_error());
				$no=0;
				while($user = mysqli_fetch_array($sql))
				{
				$no++;
				$id=$user['id'];
					?>

												<td><?= $no; ?></td>
												<td><?= $user['username']; ?></td>
												<td><?= $user['email']; ?></td>
												<td><?= $user['no_telp']; ?></td>
												<td><?= $user['gender']; ?></td>
												<td><?= $user['lahir']; ?></td>
												<td><?= $user['alamat']; ?></td>
												<td>
													<a href="mahasiswa_edit.php<?= '?id=' . $id; ?>"><button type="submit"
															class="btn btn-warning">Edit</button><a>
															<a href="#" type="button" class="btn btn-danger" title="Hapus Data" data-toggle="modal"
																data-target="#myModal4<?= $id; ?>">Hapus</a>
												</td>
											</tr>

											<div class="modal fade" id="myModal4<?= $id; ?>" role="dialog">
												<div class="modal-dialog">
													<!-- Modal content-->
													<div class="modal-content">
														<div class="modal-header">
															<h4 class="modal-title">Konfirmasi</h4>
														</div>
														<div class="modal-body">
															<?php
												include('koneksi.php');
												$ide = $id;
												$kueri = mysqli_query($koneksi,"SELECT * FROM users  WHERE id='$ide'") or die(mysql_error());
												$user = mysqli_fetch_array($kueri);
											?>
															<form role="form" action="mahasiswa_hapus_proses.php" method="POST">
																<div class="form-group">
																	<div class="form-line">
																		<input type="hidden" class="form-control" name="id" value="<?= $user['id']; ?>" />
																		<label> Yakin ingin menghapus Mahasiswa <?= $user['name']; ?> ? </label>
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