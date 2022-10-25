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
$health_center_id = $row["health_center_id"];



$pdoQuery = "SELECT * FROM appointment_list WHERE health_center_id = :health_center_id";
$pdoResult = $pdoConnect->prepare($pdoQuery);
$pdoExec = $pdoResult->execute(array(":health_center_id" => $health_center_id));
$sched_res = [];

foreach($pdoResult->fetchAll(PDO::FETCH_ASSOC) as $schedue_row){
    $schedue_row['sdate'] = date("F d, Y h:i A",strtotime($schedue_row['start_datetime']));
    $schedue_row['edate'] = date("F d, Y h:i A",strtotime($schedue_row['end_datetime']));
    $sched_res[$schedue_row['id']] = $schedue_row;
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="../../src/img/<?php echo $logo ?>">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
	<link rel="stylesheet" href="../../src/fullcalendar/lib/main.min.css">
	<link rel="stylesheet" href="../../src/node_modules/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../src/node_modules/aos/dist/aos.css">
	<link rel="stylesheet" href="../../src/css/admin.css?v=<?php echo time(); ?>">
	<script src="../../src/fullcalendar/lib/main.min.js"></script>
	<title>Home</title>

</head>
<body>
<style>
		.calendar .btn-info.text-light:hover,
		.btn-info.text-light:focus {
			background: #000;
		}
		.calendar table, tbody, td, tfoot, th, thead, tr {
			border-color: #ebe8e8 !important;
			border-style: solid;
			border-width: 1px !important;
		}
	</style>

<!-- Loader -->
<div class="loader"></div>

	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-baby-carriage' ></i>
			<span class="text">Infant</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="appointment">
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
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a class="active" href="home">Home</a>
						</li>
						<li>|</li>
						<li>
							<a href="">Dashboard</a>
						</li>
					</ul>
				</div>
			</div>

			<ul class="box-info">
				<li onclick="location.href='appointment'">
					<i class='bx bxs-calendar'></i>
					<span class="text">
							<?php
								$pdoQuery = "SELECT * FROM appointment_list WHERE health_center_id = :health_center_id";
								$pdoResult1 = $pdoConnect->prepare($pdoQuery);
								$pdoResult1->execute(array(":health_center_id" => $health_center_id ));

								$count = $pdoResult1->rowCount();

								echo
								"
									<h3>$count</h3>
								";
							?>
						<p>Appointment</p>
					</span>
				</li>
				<li onclick="location.href=''">
					<i class='bx bxs-baby-carriage'></i>
					<span class="text">
					<?php
								$pdoQuery = "SELECT * FROM  baby";
								$pdoResult1 = $pdoConnect->prepare($pdoQuery);
								$pdoResult1->execute();

								$count = $pdoResult1->rowCount();

								echo
								"
									<h3>$count</h3>
								";
							?>
						<p>Baby</p>
					</span>
				</li>
			</ul>
				<div class="bg-light calendar">
					<div class="container py-3" id="page-container">
						<div class="row">
							<div class="col-md-12">
								<div id="calendar"></div>
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
			//Schedule
			var scheds = $.parseJSON('<?= json_encode($sched_res) ?>');

			var calendar;
			var Calendar = FullCalendar.Calendar;
			var events = [];
			$(function() {
				if (!!scheds) {
					Object.keys(scheds).map(k => {
						var row = scheds[k]
						events.push({ id: row.id, title: row.title, start: row.start_datetime, end: row.end_datetime });
					})
				}
				var date = new Date()
				var d = date.getDate(),
					m = date.getMonth(),
					y = date.getFullYear()

				calendar = new Calendar(document.getElementById('calendar'), {
					headerToolbar: {
						left: 'prev,next today',
						right: 'dayGridMonth,dayGridWeek,list',
						center: 'title',
					},
					selectable: true,
					themeSystem: 'bootstrap',
					//Random default events
					events: events,
					eventClick: function(info) {
						var _details = $('#event-details-modal')
						var id = info.event.id
						if (!!scheds[id]) {
							_details.find('#title').text(scheds[id].title)
							_details.find('#description').text(scheds[id].description)
							_details.find('#start').text(scheds[id].sdate)
							_details.find('#end').text(scheds[id].edate)
							_details.find('#edit,#delete').attr('data-id', id)
							_details.modal('show')
						} else {
							alert("Event is undefined");
						}
					},
					eventDidMount: function(info) {
						// Do Something after events mounted
					},
					editable: true
				});

				calendar.render();

				// Form reset listener
				$('#schedule-form').on('reset', function() {
					$(this).find('input:hidden').val('')
					$(this).find('input:visible').first().focus()
				})

				// Edit Button
				$('#edit').click(function() {
					var id = $(this).attr('data-id')
					if (!!scheds[id]) {
						var _form = $('#schedule-form')
						console.log(String(scheds[id].start_datetime), String(scheds[id].start_datetime).replace(" ", "\\t"))
						_form.find('[name="id"]').val(id)
						_form.find('[name="title"]').val(scheds[id].title)
						_form.find('[name="description"]').val(scheds[id].description)
						_form.find('[name="start_datetime"]').val(String(scheds[id].start_datetime).replace(" ", "T"))
						_form.find('[name="end_datetime"]').val(String(scheds[id].end_datetime).replace(" ", "T"))
						$('#event-details-modal').modal('hide')
						_form.find('[name="title"]').focus()
					} else {
						alert("Event is undefined");
					}
				})

				// Delete Button / Deleting an Event
				$('#delete').click(function() {
					var id = $(this).attr('data-id')
					if (!!scheds[id]) {
						var _conf = confirm("Are you sure to delete this scheduled event?");
						if (_conf === true) {
							location.href = "./delete_schedule.php?id=" + id;
						}
					} else {
						alert("Event is undefined");
					}
				})
			});

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