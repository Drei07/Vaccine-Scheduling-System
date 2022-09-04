<?php
include_once '../../database/dbconfig2.php';
require_once 'authentication/user-class.php';
include_once __DIR__ .'/../superadmin/controller/select-settings-coniguration-controller.php';

$user_home = new USER();

if(!$user_home->is_logged_in())
{
 $user_home->redirect('../../');
}

$stmt = $user_home->runQuery("SELECT * FROM user WHERE userId=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$profile_user 	= $row['userProfile'];
$parentID       = $row['uniqueID'];

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
	<title>Baby</title>

</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-baby-carriage' ></i>
			<span class="text">Vaccine</span>
		</a>
		<ul class="side-menu top">
			<li>
				<a href="home">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li class="active">
				<a href="baby">
					<i class='bx bxs-baby-carriage'></i>
					<span class="text">My Baby</span>
				</a>
			</li>
			<li>
				<a href="appointment">
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">Appointment Information</span>
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
				<img src="../../src/img/<?php echo $profile_user  ?>">
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>My Baby</h1>
					<ul class="breadcrumb">
						<li>
							<a class="active" href="home">Home</a>
						</li>
						<li>|</li>
						<li>
							<a href="">My Baby</a>
						</li>
					</ul>
				</div>
			</div>
            <div class="modal-button">
				<button type="button" onclick="location.href='add-baby'" class="btn-primary" class="btn btn-primary"><i class='bx bxs-plus-circle'></i> Add Baby</button>
			</div>
            <div class="info-data">

				<?php

					$pdoQuery = "SELECT * FROM baby WHERE parentId = :parentId AND account_status = :account_status";
					$pdoResult = $pdoConnect->prepare($pdoQuery);
					$pdoResult->execute(array
					( 
						":parentId"			=>$parentID,  
						":account_status"	=> "active" 
					));	
					if($pdoResult->rowCount() >= 1)
					{	
					
						while($baby_data=$pdoResult->fetch(PDO::FETCH_ASSOC)){
							extract($row);
				?>

						<div class="card">
							<div class="head">
								<div class="body" onclick="location.href='baby-profile?Id=<?php echo $baby_data['babyId'] ?>'">
									<img src="../../src/img/<?php echo $baby_data['picture_of_baby']; ?>" alt="baby-profile"> 

									<h2>
										<?php echo $baby_data['last_name']; ?>, 
										<?php echo $baby_data['first_name']; ?>
										<?php 
											if($baby_data['middle_name'] ==  NULL){
												echo "";
											}
											else{
												$baby_middle_name = $baby_data['middle_name'];
												echo ($baby_middle_name[0]).".";
											}
										?>
										<br>
										<label><?php echo $baby_data['babyId'] ?></label>
									</h2>
								</div>
								<a href="controller/delete-baby-controller.php?Id=<?php echo $baby_data['babyId'] ?>" class="delete-baby"><i class='bx bxs-trash icon'></i></a>
							</div>
						</div>				

				<?php
						}
					}
					else{
				?>
					<h1 class="no-data">No Baby's Found</h1>
				<?php
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


	<script>

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