<?php
include_once '../../database/dbconfig2.php';
require_once 'authentication/superadmin-class.php';
include_once 'controller/select-settings-coniguration-controller.php';


$superadmin_home = new SUPERADMIN();

if(!$superadmin_home->is_logged_in())
{
 $superadmin_home->redirect('../../public/superadmin/signin');
}

$stmt = $superadmin_home->runQuery("SELECT * FROM superadmin WHERE superadminId=:uid");
$stmt->execute(array(":uid"=>$_SESSION['superadminSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

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
	<title>Add |    Health Center Information</title>

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
					<i class='bx bxs-ambulance' ></i>
					<span class="text">Health Center Info</span>
				</a>
			</li>
			<li>
				<a href="baby">
					<i class='bx bxs-baby-carriage' ></i>
					<span class="text">Baby Info</span>
				</a>
			</li>
			<li>
				<a href="parents">
					<i class='bx bxs-user-circle' ></i>
					<span class="text">Parent/User Info</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu top">
			<li>
				<a href="settings">
					<i class='bx bxs-cog' ></i>
					<span class="text">Settings</span>
				</a>
			</li>
			<li>
				<a href="logs">
					<i class='bx bxs-calendar-event'></i>
					<span class="text">Logs</span>
				</a>
			</li>
			<li>
				<a href="authentication/superadmin-signout" class="logout">
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
				<img src="../../src/img/<?php echo $profile ?>">
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Health Center</h1>
					<ul class="breadcrumb">
						<li>
							<a class="active" href="home">Home</a>
						</li>
						<li>|</li>
						<li>
							<a class="active" href="Health-center">Health Center</a>
						</li>
                        <li>|</li>
                        <li>
							<a href="Health-center">Add</a>
						</li>
					</ul>
				</div>
			</div>

			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Add</h3>
					</div>
                    <!-- BODY -->
                        <section class="data-form">
                        <div class="header"></div>
                        <div class="registration">
                            <form action="controller/add-health-center-controller.php" method="POST" class="row gx-5 needs-validation" enctype="multipart/form-data" name="form" onsubmit="return validate()"  novalidate style="overflow: hidden;">
                                <div class="row gx-5 needs-validation">
                                    <!-- Baby Information -->

                                    <div class="col-md-6">
                                        <label for="HCenter" class="form-label">Name of Health Center<span> *</span></label>
                                        <input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" maxlength="20" autocomplete="off" name="health_center_name" id="HCenter" required>
                                        <div class="invalid-feedback">
                                        Please provide a Name of Health Center.
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                            <label for="email" class="form-label">Email<span> *</span></label>
                                            <input type="email" class="form-control" autocapitalize="off" autocomplete="off" name="Email" id="email" required placeholder="Ex. juan@email.com">
                                            <div class="invalid-feedback">
                                            Please provide a valid Email.
                                            </div>
                                    </div>

                                    <label class="form-label" style="text-align: left; padding-top: .5rem; padding-bottom: 1rem; font-size: 1rem; font-weight: bold;">Add Image</label>

                                    <div class="col-md-12">
                                        <label for="logo" class="form-label">Upload Profile Picture</label>
                                        <input type="file" class="form-control" name="health_center_image" id="logo" style="height: 33px ;">
                                        <div class="invalid-feedback">
                                        Please upload Profile Picture.
                                        </div>
                                    </div>

                                </div>

                                <div class="addBtn">
                                    <button type="submit" class="button" name="btn-register" id="btn-register" onclick="return IsEmpty(); sexEmpty();">Add</button>
                                </div>
                            </form>
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


        //live search---------------------------------------------------------------------------------------//
        $(document).ready(function(){

        load_data(1);

        function load_data(page, query = '')
        {
        $.ajax({
            url:"data-table/parents-data-table.php",
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