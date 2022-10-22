<?php
include_once '../../database/dbconfig2.php';
require_once 'authentication/admin-class.php';
include_once __DIR__ .'/../superadmin/controller/select-settings-coniguration-controller.php';

$admin_home = new ADMIN();

if(!$admin_home->is_logged_in())
{
 $admin_home->redirect('../../');
}

$stmt = $admin_home->runQuery("SELECT * FROM admin WHERE userId=:uid");
$stmt->execute(array(":uid"=>$_SESSION['adminSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$profile_user 	= $row['adminProfile'];
$health_ID		= $row['health_center_id'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="../../src/img/<?php echo $logo ?>">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="../../src/node_modules/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../src/node_modules/aos/dist/aos.css">
	<link rel="stylesheet" href="../../src/css/admin.css?v=<?php echo time(); ?>">
	<title>Appointment</title>

</head>
<body>

<!-- Loader -->
<div class="loader"></div>

	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-baby-carriage' ></i>
			<span class="text">Infant</span>
		</a>
		<ul class="side-menu top">
			<li>
				<a href="home">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li class="active">
				<a href="">
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">Appointment</span>
				</a>
			</li>
			<li>
				<a href="services">
                    <i class='bx bxs-wrench' ></i>
					<span class="text">Services</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="settings">
					<i class='bx bxs-cog' ></i>
					<span class="text">Settings</span>
				</a>
			</li>
			<li>
				<a href="authentication/admin-signout" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Signout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<a href="#" class="nav-link">Categories</a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a>
			<a href="profile" class="profile" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Profile">
				<img src="../../src/img/<?php echo $profile_user  ?>">
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Appointment</h1>
					<ul class="breadcrumb">
						<li>
							<a class="active" href="home">Home</a>
						</li>
						<li>|</li>
						<li>
							<a href="">Appointment</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="modal-button">
				<button type="button" data-bs-toggle="modal" data-bs-target="#classModal" class="button"><i class='bx bxs-plus-circle'></i> Add Appointment</button>
			</div>

			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Schedule</h3>
					</div>
                    <!-- BODY -->
                    <section class="data-table">
                        <div class="searchBx">
                            <input type="input" placeholder="search . . . . . ." class="search" name="search_box" id="search_box"><button class="searchBtn"><i class="bx bx-search icon"></i></button>
                        </div>

                        <div class="table">
                        <div id="dynamic_content">
                        </div>

                    </section>
				</div>
			</div>

			<!-- MODALS -->

			<div class="class-modal">
				<div class="modal fade" id="classModal" tabindex="-1" aria-labelledby="classModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-lg">
						<div class="modal-content">
						<div class="header"></div>
							<div class="modal-header">
								<h5 class="modal-title" id="classModalLabel">Add Appointment</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<form action="controller/add-appointment-controller.php" method="POST" id="schedule-form" class="row gx-5 needs-validation" name="form" onsubmit="return validate()"  novalidate style="overflow: hidden;">
									<div class="row gx-5 needs-validation">
										<!-- Appointment Information -->
										
										<div class="col-md-12">
											<label for="services" class="form-label">Services<span> *</span></label>
											<select type="text" class="form-select form-control"  name="services" id="services"  required>
											<option selected disabled value="">Select Services</option>
												<?php
													$pdoQuery = "SELECT * FROM services ";
													$pdoResult1 = $pdoConnect->prepare($pdoQuery);
													$pdoResult1->execute();
													
														while($services=$pdoResult1->fetch(PDO::FETCH_ASSOC)){
															?>
															<option value="<?php echo $services['services_id']; ?> " >
															<?php echo $services['services'];  ?></option>
															<?php
														}
												?>
											</select>
											<div class="invalid-feedback">
												Please select a Services.
											</div>
										</div>

										<div class="col-md-12	">
											<label for="Description" class="form-label">Add Description</label>
											<input type="text"  class="form-control" autocomplete="off" name="description" id="description">
											<div class="invalid-feedback">
											Please provide a Description.
											</div>
										</div>

										<div class="col-md-12">
											<label for="baby" class="form-label">Select Baby<span> *</span></label>
											<select type="text" class="form-select form-control"  name="baby" id="baby"  required>
											<option selected disabled value="">Select Baby</option>
												<?php
													$pdoQuery = "SELECT * FROM baby ";
													$pdoResult2 = $pdoConnect->prepare($pdoQuery);
													$pdoResult2->execute();
													
														while($baby=$pdoResult2->fetch(PDO::FETCH_ASSOC)){
															?>
															<option value="<?php echo $baby['babyId']; ?> " >
															<?php echo "BABY - ".$baby['last_name'].", ".$baby['first_name']  ?></option>
															<?php
														}
												?>
											</select>
											<div class="invalid-feedback">
												Please select a Baby.
											</div>
										</div>

										<div class="col-md-12" style="display: none;">
											<label for="health_center" class="form-label"><span> *</span></label>
											<input type="text"  class="form-control" autocomplete="off" name="health_center" id="health_center" value="<?php echo $health_ID ?>" required>
											<div class="invalid-feedback">
											Please provide a .
											</div>
										</div>

										<div class="col-md-12">
											<label for="start_datetime" class="form-label">From<span> *</span></label>
											<input type="datetime-local"  class="form-control"  autocomplete="off" name="start_datetime" id="start_datetime" required>
											<div class="invalid-feedback">
											Please provide a Start Date.
											</div>
										</div>

										<div class="col-md-12">
											<label for="end_datetime" class="form-label">To<span> *</span></label>
											<input type="datetime-local"  class="form-control"  autocomplete="off" name="end_datetime" id="end_datetime" required>
											<div class="invalid-feedback">
											Please provide a End Date.
											</div>
										</div>


									</div>

									<div class="addBtn">
										<button class="button-cancel" type="reset" form="schedule-form">Reset</button>
										<button type="submit" class="button" name="btn-register" id="btn-register" onclick="return IsEmpty(); sexEmpty();">Save</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	
	<script src="../../src/node_modules/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../../src/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	<script src="../../src/node_modules/jquery/dist/jquery.min.js"></script>
	<script src="../../src/js/tooltip.js"></script>
	<script src="../../src/js/admin.js"></script>
	<script src="../../src/js/loader.js"></script>


	<script>

		
        //live search---------------------------------------------------------------------------------------//
        $(document).ready(function(){

			load_data(1);

			function load_data(page, query = '')
			{
			$.ajax({
				url:"data-table/appointment-data-table.php",
				method:"POST",
				data:{page:page, query:query},
				success:function(data)
				{
				$('#dynamic_content').html(data);
				}
			});
			}

			$(document).on('click', '.page-link', function(){
			var page = $(this).data('page_number');
			var query = $('#search_box').val();
			load_data(page, query);
			});

			$('#search_box').keyup(function(){
			var query = $('#search_box').val();
			load_data(1, query);
			});

			});

			// Form reset listener
			$('#schedule-form').on('reset', function() {
				$(this).find('input:hidden').val('')
				$(this).find('input:visible').first().focus()
			});
// ------------------------------------------------------------------------------------------------------------------------
		// Form
		(function () {
		'use strict'
		var forms = document.querySelectorAll('.needs-validation')
		Array.prototype.slice.call(forms)
		.forEach(function (form) {
			form.addEventListener('submit', function (event) {
			if (!form.checkValidity()) {
				event.preventDefault()
				event.stopPropagation()
			}

			form.classList.add('was-validated')
			}, false)
			})
		})();

		// Delete Baby
		$('.delete-baby').on('click', function(e){
		e.preventDefault();
		const href = $(this).attr('href')

				swal({
				title: "Remove?",
				text: "Are you sure do you want to remove this baby?",
				icon: "info",
				buttons: true,
				dangerMode: true,
			})
			.then((willSignout) => {
				if (willSignout) {
				document.location.href = href;
				}
			});
		})


		// Signout
		$('.logout').on('click', function(e){
		e.preventDefault();
		const href = $(this).attr('href')

				swal({
				title: "Signout?",
				text: "Are you sure do you want to signout?",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willSignout) => {
				if (willSignout) {
				document.location.href = href;
				}
			});
		})

	</script>

		<!-- SWEET ALERT -->
		<?php

		if(isset($_SESSION['status']) && $_SESSION['status'] !='')
		{
		?>
		<script>
			swal({
			title: "<?php echo $_SESSION['status_title']; ?>",
			text: "<?php echo $_SESSION['status']; ?>",
			icon: "<?php echo $_SESSION['status_code']; ?>",
			button: false,
			timer: <?php echo $_SESSION['status_timer']; ?>,
			});
		</script>
		<?php
		unset($_SESSION['status']);
		}
		?>
</body>
</html>