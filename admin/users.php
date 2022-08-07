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
								<h1>Users TrifthinQs Store<span style="color:red">.</span></h1>
							</div>
						</div>
					</div><!-- /.container-fluid -->
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12">


								<!-- /.card-header -->
								<div class="card-body">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>No</th>
												<th>Picture</th>
												<th>Level</th>
												<th>Name</th>
												<th>Email</th>
												<th>Notlp</th>
												<th>Gender</th>
												<th>Birth</th>
												<th>Address</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<?php 
				include 'koneksi.php';

if($idLogin=='1'){
		$sql = mysqli_query($koneksi,"SELECT * FROM users WHERE status='ban' AND id!='1' AND id!='$idLogin' OR status='on'AND id!='1' AND id!='$idLogin' ORDER BY username") or die(mysql_error());
}else if($idLogin!='1'){
			$sql = mysqli_query($koneksi,"SELECT * FROM users WHERE status='ban' AND id!='1' AND level!='admin' OR status='on'AND id!='1' AND level!='admin' ORDER BY username") or die(mysql_error());
}

				$no=0;
				while($user = mysqli_fetch_array($sql))
				{
				$no++;
				$id=$user['id'];
					?>

												<td><?= $no; ?></td>
												<td><img src="../assets/profile/<?= $user['foto']?>"
														style="width:50px; height:50px; object-fit:cover"></td>
												<td>
													<?= $user['level']; ?>
												</td>
												<td><?= $user['username']; ?></td>
												<td><?= $user['email']; ?></td>
												<td><?= $user['no_telp']; ?></td>
												<td><?= $user['gender']; ?></td>
												<td><?= $user['lahir']; ?></td>
												<td><?= $user['alamat']; ?></td>
												<td><?php if($user['status']=='ban'){echo"banned";}else{echo"no-banned";} ?></td>
												<td>
													<?php if($user['status']=='ban'): ?>
													<button type="button" class="btn btn-success" title="Heal" data-toggle="modal"
														data-target="#myModal7<?= $id; ?>">Heal</button>
													<?php elseif($user['level']=='user'): ?>
													<button type="button" class="btn btn-primary" title="Banned" data-toggle="modal"
														data-target="#myModal5<?= $id; ?>">Admin</button>

													<button href="#" type="button" class="btn btn-danger" title="Banned" data-toggle="modal"
														data-target="#myModal4<?= $id; ?>">Ban</button>

													<?php elseif($user['level']=='admin'): ?>

													<button type="button" class="btn btn-info" title="Banned" data-toggle="modal"
														data-target="#myModal6<?= $id; ?>">User</button>

													<button href="#" type="button" class="btn btn-danger" title="Banned" data-toggle="modal"
														data-target="#myModal4<?= $id; ?>">Ban</button>
													<?php endif; ?>

												</td>
											</tr>

											<div class="modal fade" id="myModal4<?= $id; ?>" role="dialog">
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
												$kueri = mysqli_query($koneksi,"SELECT * FROM users  WHERE id='$ide'") or die(mysql_error());
												$user = mysqli_fetch_array($kueri);
											?>
															<form role="form" action="users_ban.php" method="POST">
																<div class="form-group">
																	<div class="form-line">
																		<input type="hidden" class="form-control" name="id" value="<?= $user['id']; ?>" />
																		<label> Are you sure to ban <?= $user['username']; ?> ? </label>
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

											<!-- jadi admin -->
											<div class="modal fade" id="myModal5<?= $id; ?>" role="dialog">
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
												$kueri = mysqli_query($koneksi,"SELECT * FROM users  WHERE id='$ide'") or die(mysql_error());
												$user = mysqli_fetch_array($kueri);
											?>
															<form role="form" action="users_admin.php" method="POST">
																<div class="form-group">
																	<div class="form-line">
																		<input type="hidden" class="form-control" name="id" value="<?= $user['id']; ?>" />
																		<label> Are you sure, you want <?= $user['username']; ?> to be admin ? </label>
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


											<!-- jadi user -->
											<div class="modal fade" id="myModal6<?= $id; ?>" role="dialog">
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
												$kueri = mysqli_query($koneksi,"SELECT * FROM users  WHERE id='$ide'") or die(mysql_error());
												$user = mysqli_fetch_array($kueri);
											?>
															<form role="form" action="users_user.php" method="POST">
																<div class="form-group">
																	<div class="form-line">
																		<input type="hidden" class="form-control" name="id" value="<?= $user['id']; ?>" />
																		<label> Are you sure, you want <?= $user['username']; ?> to be user ? </label>
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


											<!-- jadi heal -->
											<div class="modal fade" id="myModal7<?= $id; ?>" role="dialog">
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
												$kueri = mysqli_query($koneksi,"SELECT * FROM users  WHERE id='$ide'") or die(mysql_error());
												$user = mysqli_fetch_array($kueri);
											?>
															<form role="form" action="users_heal.php" method="POST">
																<div class="form-group">
																	<div class="form-line">
																		<input type="hidden" class="form-control" name="id" value="<?= $user['id']; ?>" />
																		<label> Are you sure, you want to heal <?= $user['username']; ?> ? </label>
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