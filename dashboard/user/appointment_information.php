<?php
include_once '../../database/dbconfig2.php';
require_once 'authentication/user-class.php';
include_once "../superadmin/controller/select-settings-coniguration-controller.php";


$user_home = new USER();

if(!$user_home->is_logged_in())
{
 $user_home->redirect('../../');
}

$stmt = $user_home->runQuery("SELECT * FROM user WHERE userId=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$parent = $stmt->fetch(PDO::FETCH_ASSOC);

$profile_user				=$parent["userProfile"];




// APPOINTMENT

$APMTID = $_GET["id"];

$pdoQuery = "SELECT * FROM appointment_list WHERE appointment_id = :appointment_id";
$pdoResult4 = $pdoConnect->prepare($pdoQuery);
$pdoExec = $pdoResult4->execute(array(":appointment_id" => $APMTID));
$appointment_data = $pdoResult4->fetch(PDO::FETCH_ASSOC);

$Sdate                      = $appointment_data['start_datetime'];
$Edate                      = $appointment_data['end_datetime'];
$services                   = $appointment_data["title"];
$description                = $appointment_data["description"];	

$StartDate = date("F d, Y h:i A",strtotime($appointment_data['start_datetime']));
$EndDate = date("F d, Y h:i A",strtotime($appointment_data['start_datetime']));

$appointment_updated_at     = $appointment_data["updated_at"];

// BABY

$babyID                     = $appointment_data["baby_id"];

$pdoQuery = "SELECT * FROM baby WHERE babyid = :baby_id";
$pdoResult2 = $pdoConnect->prepare($pdoQuery);
$pdoExec = $pdoResult2->execute(array(":baby_id" => $babyID));
$baby_data = $pdoResult2->fetch(PDO::FETCH_ASSOC);

$baby_picture  = $baby_data["picture_of_baby"];
$baby_name     = $baby_data["first_name"]." ".$baby_data["last_name"];
$baby_id		= $baby_data["babyId"];

// HEALTH CENTER

$health_center_id	            = $appointment_data["health_center_id"];

$pdoQuery = "SELECT * FROM admin WHERE health_center_id = :health_center_id";
$pdoResult3 = $pdoConnect->prepare($pdoQuery);
$pdoExec = $pdoResult3->execute(array(":health_center_id" => $health_center_id));
$health_center_data = $pdoResult3->fetch(PDO::FETCH_ASSOC);

$health_center_name = $health_center_data["health_center_name"];
$health_centerId	= $health_center_data["health_center_id"];

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
	<title>Profile</title>

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
			<li>
				<a href="baby">
					<i class='bx bxs-baby-carriage'></i>
					<span class="text">My Baby</span>
				</a>
			</li>
			<li>
				<a href="appointment">
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">Appointment</span>
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
				<a href="authentication/user-signout" class="logout">
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
				<img src="../../src/img/<?php echo $profile_user ?>">
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
							<a class="active" href="appointment">Appointment</a>
						</li>
                        <li>|</li>
                        <li>
							<a href="">Information</a>
						</li> 
					</ul>
				</div>
			</div>

			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Information</h3>
					</div>
                    <!-- BODY -->
                    <section class="profile-form">
                        <div class="header"></div>
                        <div class="profile">
                            <div class="profile-img">
                                <img src="../../src/img/<?php echo $baby_picture ?>" alt="logo">

                                <button class="btn-success change" onclick="overview()"><i class='bx bxs-calendar '></i> Overview</button>

								<?php
								
								$pdoQuery = "SELECT * FROM appointment_list WHERE appointment_id = :appointment_id";
								$pdoResult5 = $pdoConnect->prepare($pdoQuery);
								$pdoExec = $pdoResult5->execute(array(":appointment_id" => $APMTID));
								$appointment_status = $pdoResult5->fetch(PDO::FETCH_ASSOC);

								$status = $appointment_status['status'];

								if($status == "pending")
									{
									?>
										<a href="controller/accept-appointment-controller.php?APMTID=<?php echo $APMTID ?>" class="accept-appointment action-btn"><button class="btn-success"><i class='bx bxs-message-alt-check'></i> Accept</button></a>
										<a href="controller/decline-appointment-controller.php?APMTID=<?php echo $APMTID ?>" class="decline-appointment action-btn"><button class="btn-danger"><i class='bx bxs-message-alt-x' ></i> Decline</button></a>
									<?php
									}
								?>

                            </div>
                            
                            <div id="overview" >
							<form action="" method="POST" class="row gx-5 needs-validation">
								<div class="row gx-5 needs-validation">

								<label class="form-label" style="text-align: left; padding-top: .5rem; padding-bottom: 1rem; font-size: 1rem; font-weight: bold;"><i class='bx bxs-edit'></i> Appointment Information<p>Last update: <?php  echo $appointment_updated_at ?></p></label>

									<div class="col-md-12">
										<label for="first_name" class="form-label" >Baby:</label>
                                        <h1><?php echo $baby_name  ?></h1>
									</div>

									<div class="col-md-12">
										<label for="middle_name" class="form-label" >Services: </label>
                                        <h1><?php echo $services  ?></h1>
									</div>

									<div class="col-md-12">
										<label for="last_name" class="form-label" >Description: </label>
                                        <h1><?php echo $description  ?></h1>
									</div>

                                    <div class="col-md-12">
										<label for="last_name" class="form-label" >Start Date: </label>
                                        <h1><?php echo $StartDate  ?></h1>
									</div>

                                    <div class="col-md-12">
										<label for="last_name" class="form-label" >End Date: </label>
                                        <h1><?php echo $EndDate  ?></h1>
									</div>

								</div>

								<div class="addBtn">
									<button type="button" onclick="location.href='appointment'" class="back">Back</button>
								</div>
							</form>
                            </div>						
                        </div>
                    </section>
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

			// Form reset listener
			$('#schedule-form').on('reset', function() {
			$(this).find('input:hidden').val('')
			$(this).find('input:visible').first().focus()
			});

        
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


        //Accept
		$('.accept-appointment').on('click', function(e){
		e.preventDefault();
		const href = $(this).attr('href')

				swal({
				title: "Accept?",
				text: "Do you want to Accept this appointment?",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
				document.location.href = href;
				}
			});
		})

		//Decline
		$('.decline-appointment').on('click', function(e){
		e.preventDefault();
		const href = $(this).attr('href')

				swal({
				title: "Accept?",
				text: "Do you want to Accept this appointment?",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
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