<?php
include_once '../../database/dbconfig2.php';
require_once 'authentication/admin-class.php';
include_once __DIR__ . '/../superadmin/controller/select-settings-coniguration-controller.php';

$admin_home = new ADMIN();

if (!$admin_home->is_logged_in()) {
	$admin_home->redirect('../../');
}

$stmt = $admin_home->runQuery("SELECT * FROM admin WHERE userId=:uid");
$stmt->execute(array(":uid" => $_SESSION['adminSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$profile_user 	= $row['adminProfile'];
$health_center_id = $row["health_center_id"];

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
	<title>baby Information</title>

</head>

<body>

	<!-- Loader -->
	<div class="loader"></div>

	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-baby-carriage'></i>
			<span class="text">Infant</span>
		</a>
		<ul class="side-menu top">
			<li>
				<a href="home">
					<i class='bx bxs-dashboard'></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="appointment">
					<i class='bx bxs-calendar-check'></i>
					<span class="text">Appointment</span>
				</a>
			</li>
			<li>
				<a href="services">
					<i class='bx bxs-wrench'></i>
					<span class="text">Services</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu top">
			<li>
				<a href="settings">
					<i class='bx bxs-cog'></i>
					<span class="text">Settings</span>
				</a>
			</li>
			<li>
				<a href="authentication/admin-signout" class="logout">
					<i class='bx bxs-log-out-circle'></i>
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
			<i class='bx bx-menu'></i>
			<a href="#" class="nav-link">Categories</a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="#" class="notification">
				<i class='bx bxs-bell'></i>
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
					<h1>Baby </h1>
					<ul class="breadcrumb">
						<li>
							<a class="active" href="home">Home</a>
						</li>
						<li>|</li>
						<li>
							<a href="">Baby </a>
						</li>
					</ul>
				</div>
			</div>

			<div class="info-data">

				<?php

				$pdoQuery = "SELECT * FROM appointment_list WHERE health_center_id = :health_center_id ";
				$pdoResult = $pdoConnect->prepare($pdoQuery);
				$pdoResult->execute(array(":health_center_id" => $health_center_id));

				while ($appointment_data = $pdoResult->fetch(PDO::FETCH_ASSOC)){
					

					$babyID = $appointment_data['baby_id'];

				

				$pdoQuery = "SELECT * FROM baby WHERE babyId = :babyId";
				$pdoResult2 = $pdoConnect->prepare($pdoQuery);
				$pdoResult2->execute(array(":babyId" => $babyID));
				if ($pdoResult2->rowCount() >= 1) {

					while ($baby_data = $pdoResult2->fetch(PDO::FETCH_ASSOC)) {
						
				?>

						<div class="card">
							<div class="head">
								<div class="body" onclick="location.href='baby-profile?Id=<?php echo $baby_data['babyId'] ?>'">
									<img src="../../src/img/<?php echo $baby_data['picture_of_baby']; ?>" alt="baby-profile">

									<h2>
										<?php echo $baby_data['last_name']; ?>,
										<?php echo $baby_data['first_name']; ?>
										<?php
										if ($baby_data['middle_name'] ==  NULL) {
											echo "";
										} else {
											$baby_middle_name = $baby_data['middle_name'];
											echo ($baby_middle_name[0]) . ".";
										}
										?>
										<br>
										<label><?php echo $baby_data['babyId'] ?></label>
									</h2>
								</div>
							</div>
						</div>

					<?php
					}
				} else {
					?>
					<h1 class="no-data">No Baby's Found</h1>
				<?php
				}
			}
			
				?>
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
		// Delete Baby
		$('.delete-baby').on('click', function(e) {
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
		$('.logout').on('click', function(e) {
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

	if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
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