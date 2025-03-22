	<?php
	session_start();

	if ($_SESSION["login_admin"] == null) {
		header("location: index.php");
	} else {

		include_once('include/admin_navbar.php');


		?>





		<!-- ------------------------------WIDGETS====================== -->
		<div class="demo">

			<!-- ============================== FIRST ROW ========================== -->

			<div class="row">
				<div class="row-tittle"> <b> Users </b> </div>

				<div class="col-lg-3 col-md-6">

					<div class="panel panel-primary">
						<div class="panel-heading">

							<div class="row">
								<div class="col-xs-3">
									<i class="fa fa-file-text fa-5x"></i>
									<!-- <i class="fas fa-user"></i> -->


									<!-- =======================================Database============= -->
									<?php
										$query = "SELECT count(admin_id) as total FROM admin_tb ";
										$query_run = mysqli_query($connection, $query);
										$row = mysqli_fetch_assoc($query_run);
										$num_rows = $row['total'];
										?>

									<!-- ======================================================== -->

								</div>
								<div class="col-xs-9 text-right">
									<div class='huge'><?php echo $num_rows ?></div>
									<div><b>
											<h4>Admin</h4>
										</b></div>
								</div>
							</div>
						</div>

						<a href="AddAdmin.php">
							<div class="panel-footer">
								<span class="pull-left">View Details</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>

				</div>


				<div class="col-lg-3 col-md-6">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<i class="fa fa-file-text fa-5x"></i>


								</div>

								<!-- =======================================Database============= -->
								<?php
									$query = "SELECT count(teacher_id) as total FROM teacher_tb ";
									$query_run = mysqli_query($connection, $query);
									$row = mysqli_fetch_assoc($query_run);
									$num_rows = $row['total'];
									?>


								<div class="col-xs-9 text-right">
									<div class='huge'> <?php echo $num_rows ?> </div>
									<div><b>
											<h4>Teacher</h4>
										</b></div>
								</div>
							</div>
						</div>
						<a href="AddTeacher.php">
							<div class="panel-footer">
								<span class="pull-left">View Details</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div>

				<div class="col-lg-3 col-md-6">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<i class="fa fa-user fa-5x"></i>

								</div>

								<?php
									$query = "SELECT count(student_id) as total FROM student_tb ";
									$query_run = mysqli_query($connection, $query);
									$row = mysqli_fetch_assoc($query_run);
									$num_rows = $row['total'];
									?>


								<div class="col-xs-9 text-right">
									<div class='huge'><?php echo $num_rows; ?> </div>
									<div><b>
											<h4>Student</h4>
										</b></div>
								</div>
							</div>
						</div>
						<a href="AddStudent.php">
							<div class="panel-footer">
								<span class="pull-left">Details</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div>

				<div class="col-lg-3 col-md-6">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<i class="fa fa-file-text fa-5x"></i>
									<!-- <i class="fas fa-user"></i> -->

								</div>
								<?php
									$query = "SELECT count(parent_id) as total FROM parent_tb ";
									$query_run = mysqli_query($connection, $query);
									$row = mysqli_fetch_assoc($query_run);
									$num_rows = $row['total'];
									?>
								<div class="col-xs-9 text-right">
									<div class='huge'><?php echo $num_rows; ?></div>
									<div><b>
											<h4>Parents</h4>
										</b></div>
								</div>
							</div>
						</div>
						<a href="AddParent.php">
							<div class="panel-footer">
								<span class="pull-left">View Details</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div>





			</div>

			<!-- ========================================Two================================ -->

			<div class="row">
				<div class="row-tittle"> <b> Academics </b></div>
				<div class="line"></div>


				<?php
					$query = "SELECT count(class_id) as total FROM class_tb ";
					$query_run = mysqli_query($connection, $query);
					$row = mysqli_fetch_assoc($query_run);
					$num_rows = $row['total'];
					?>

				<div class="col-lg-3 col-md-6">
					<div class="panel panel-success">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<i class="fa fa-user fa-5x"></i>

								</div>
								<div class="col-xs-9 text-right">
									<div class='huge'><?php echo $num_rows; ?></div>
									<div>
										<h4> Class </h4>
									</div>
								</div>
							</div>
						</div>
						<a href="manageClasses.php">
							<div class="panel-footer">
								<span class="pull-left">View Details</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div>

				<?php
					$query = "SELECT count(class_id) as total FROM section ";
					$query_run = mysqli_query($connection, $query);
					$row = mysqli_fetch_assoc($query_run);
					$num_rows = $row['total'];
					?>
				<div class="col-lg-3 col-md-6">
					<div class="panel panel-success">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<i class="fa fa-file-text fa-5x"></i>
									<!-- <i class="fas fa-user"></i> -->

								</div>
								<div class="col-xs-9 text-right">
									<div class='huge'><?php echo $num_rows; ?></div>
									<div>
										<h4>Section</h4>
									</div>
								</div>
							</div>
						</div>
						<a href="manageSection.php">
							<div class="panel-footer">
								<span class="pull-left">View Details</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div>

				<?php
					$query = "SELECT count(class_id) as total FROM subject_tb ";
					$query_run = mysqli_query($connection, $query);
					$row = mysqli_fetch_assoc($query_run);
					$num_rows = $row['total'];
					?>

				<div class="col-lg-3 col-md-6">
					<div class="panel panel-success">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<i class="fa fa-file-text fa-5x"></i>
									<!-- <i class="fas fa-user"></i> -->

								</div>
								<div class="col-xs-9 text-right">
									<div class='huge'><?php echo $num_rows; ?></div>
									<div>
										<h4>Subject</h4>
									</div>
								</div>
							</div>
						</div>
						<a href="manageSubject.php">
							<div class="panel-footer">
								<span class="pull-left">View Details</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div>

				<div class="col-lg-3 col-md-6">
					<div class="panel panel-success">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<i class="fa fa-file-text fa-5x"></i>
									<!-- <i class="fas fa-user"></i> -->

								</div>
								<div class="col-xs-9 text-right">
									
									<div>
										<h4>Marks</h4>
									</div>
								</div>
							</div>
						</div>
						<a href="ViewMarks.php">
							<div class="panel-footer">
								<span class="pull-left">View Details</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div>


			</div>




			<!-- ==================================THREE================================= -->



			<div class="row">
				<div class="row-tittle"> Three</div>
				<div class="line"></div>



				<div class="col-lg-3 col-md-6">
					<div class="panel panel-danger">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<i class="fa fa-user fa-5x"></i>

								</div>
								<div class="col-xs-9 text-right">
									<div class='huge'>23</div>
									<div> Users</div>
								</div>
							</div>
						</div>
						<a href="users.php">
							<div class="panel-footer">
								<span class="pull-left">View Details</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="panel panel-danger">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<i class="fa fa-file-text fa-5x"></i>
									<!-- <i class="fas fa-user"></i> -->

								</div>
								<div class="col-xs-9 text-right">
									<div class='huge'>12</div>
									<div>Posts</div>
								</div>
							</div>
						</div>
						<a href="posts.php">
							<div class="panel-footer">
								<span class="pull-left">View Details</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="panel panel-danger">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<i class="fa fa-file-text fa-5x"></i>
									<!-- <i class="fas fa-user"></i> -->

								</div>
								<div class="col-xs-9 text-right">
									<div class='huge'>12</div>
									<div>Posts</div>
								</div>
							</div>
						</div>
						<a href="posts.php">
							<div class="panel-footer">
								<span class="pull-left">View Details</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div>

				<div class="col-lg-3 col-md-6">
					<div class="panel panel-danger">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<i class="fa fa-file-text fa-5x"></i>
									<!-- <i class="fas fa-user"></i> -->

								</div>
								<div class="col-xs-9 text-right">
									<div class='huge'>12</div>
									<div>Posts</div>
								</div>
							</div>
						</div>
						<a href="posts.php">
							<div class="panel-footer">
								<span class="pull-left">View Details</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div>


			</div>



			<!-- ========================FOUR======================================= -->




		</div> <!-- DEMO -->



		</div> <!-- CONTENT -->

		</div>





		<!-- jQuery CDN -->
		<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
		<!--  Bootstrap Js CDN -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="style4.css" type="text/css">

		<script type="text/javascript">
			$(document).ready(function() {
				$('#sidebarCollapse').on('click', function() {
					$('#sidebar').toggleClass('active');
				});
			});
		</script>
		</body>

		</html>

	<?php
	} ?>