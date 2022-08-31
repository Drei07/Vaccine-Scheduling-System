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
	<title>Settings</title>

</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-baby-carriage' ></i>
			<span class="text">Vaccine System</span>
		</a>
		<ul class="side-menu top">
			<li>
				<a href="home">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-user-account' ></i>
					<span class="text">Admin Info</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-ambulance' ></i>
					<span class="text">Health Center Info</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-baby-carriage' ></i>
					<span class="text">Baby Info</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-user-circle' ></i>
					<span class="text">Parent/User Info</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">Appointment Info</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-wrench' ></i>
					<span class="text">Service Info</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu top">
			<li class="active">
				<a href="">
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
					<h1>Settings</h1>
					<ul class="breadcrumb">
						<li>
							<a class="active" href="home">Home</a>
						</li>
						<li>|</li>
						<li>
							<a href="#">Settings</a>
						</li>
					</ul>
				</div>
			</div>

			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Configuration</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
                    <!-- BODY -->
                    <section class="data-form">
                        <div class="header"></div>
                        <div class="registration">
                            <form action="controller/update-system-config.php" method="POST" class="row gx-5 needs-validation" name="form" onsubmit="return validate()"  novalidate style="overflow: hidden;">
                                <div class="row gx-5 needs-validation">

                                <label class="form-label" style="text-align: left; padding-top: .5rem; padding-bottom: 2rem; font-size: 1rem; font-weight: bold;"><i class='bx bxs-edit'></i> System Configuration <p>Last update: <?php  echo $system_config_last_update  ?></p></label>

                                    <div class="col-md-6">
                                        <label for="sname" class="form-label">System Name<span> *</span></label>
                                        <input type="text" class="form-control" autocapitalize="on" autocomplete="off" name="SName" id="sname" required value="<?php  echo $system_name  ?>">
                                        <div class="invalid-feedback">
                                        Please provide a System Name.
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="cright" class="form-label">System Copyright<span> *</span></label>
                                        <input type="text" class="form-control" autocapitalize="on" autocomplete="off" name="CRight" id="cright" required value="<?php  echo $system_copyright ?>">
                                        <div class="invalid-feedback">
                                        Please provide a System Copyright.
                                        </div>
                                    </div>

                                    <div class="col-md-6" >
                                        <label for="phone_number" class="form-label">Default Phone Number<span> *</span></label>
                                        <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="addon-wrapping">+63</span>
                                        <input type="text" class="form-control numbers"  autocapitalize="off" inputmode="numeric" autocomplete="off" name="PNumber" id="phone_number" minlength="10" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required value="<?php  echo $system_number  ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Default Email<span> *</span></label>
                                        <input type="email" class="form-control" autocapitalize="off" autocomplete="off" name="Email" id="email" required value="<?php  echo $system_email  ?>">
                                        <div class="invalid-feedback">
                                        Please provide a valid Email.
                                        </div>
                                    </div>

                                </div>

                                <div class="addBtn">
                                    <button type="submit" class="btn-primary" name="btn-update" id="btn-update" onclick="return IsEmpty(); sexEmpty();">Update</button>
                                </div>
                            </form>
                        </div>
                    </section>

                    <!-- System Logo  -->

                    <section class="data-form">
                        <div class="header"></div>
                        <div class="registration">
                            <form action="controller/update-logo-controller.php" method="POST" enctype="multipart/form-data" class="row gx-5 needs-validation" name="form" onsubmit="return validate()"  novalidate style="overflow: hidden;">
                                <div class="row gx-5 needs-validation">

                                    <label class="form-label" style="text-align: left; padding-top: .5rem; padding-bottom: 2rem; font-size: 1rem; font-weight: bold;"><i class='bx bxs-edit'></i> Logo Configuration <p>Last update: <?php  echo $system_logo_last_update  ?></p></label>

                                    <div class="col-md-12">
                                        <label for="logo" class="form-label">Upload Logo<span> *</span></label>
                                        <input type="file" class="form-control" name="Logo" id="logo" style="height: 33px ;" required>
                                        <div class="invalid-feedback">
                                        Please provide a Logo.
                                        </div>
                                    </div>

                                </div>

                                <div class="addBtn" style="padding-top: 2rem;">
                                    <button type="submit" class="btn-primary " name="btn-update" id="btn-update" onclick="return IsEmpty(); sexEmpty();">Update</button>
                                </div>
                            </form>
                        </div>
                    </section>

                    <!-- SMTP MAILER -->

                    <section class="data-form">
                        <div class="header"></div>
                        <div class="registration">
                            <form action="controller/update-smtp-email-controller.php" method="POST" class="row gx-5 needs-validation" name="form" onsubmit="return validate()"  novalidate style="overflow: hidden;">
                                <div class="row gx-5 needs-validation">

                                <label class="form-label" style="text-align: left; padding-top: .5rem; padding-bottom: 2rem; font-size: 1rem; font-weight: bold;"><i class='bx bxs-edit'></i> SMTP Email Configuration <p>Last update: <?php  echo $email_config_last_update  ?></p></label>

                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email<span> *</span></label>
                                        <input type="email" class="form-control" autocapitalize="off" autocomplete="off" name="Email" id="email" required placeholder = "<?php  echo $smtp_email  ?>">
                                        <div class="invalid-feedback">
                                        Please provide a valid Email.
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="Gpassword" class="form-label">Generated Password<span> *</span></label>
                                        <input type="text" class="form-control" autocapitalize="on" autocomplete="off" name="GPassword" id="Gpassword" required placeholder ="<?php  echo $smtp_password  ?>">
                                        <div class="invalid-feedback">
                                        Please provide a Generated Password.
                                        </div>
                                    </div>

                                </div>

                                <div class="addBtn">
                                    <button type="submit" class="btn-primary" name="btn-update" id="btn-update" onclick="return IsEmpty(); sexEmpty();">Update</button>
                                </div>
                            </form>
                        </div>
                    </section>

                    <!-- Google reCAPTCHA V3  -->

                    <section class="data-form">
                        <div class="header"></div>
                        <div class="registration">
                            <form action="controller/update-google-recaptcha-controller.php" method="POST" class="row gx-5 needs-validation" name="form" onsubmit="return validate()"  novalidate style="overflow: hidden;">
                                <div class="row gx-5 needs-validation">

                                <label class="form-label" style="text-align: left; padding-top: .5rem; padding-bottom: 2rem; font-size: 1rem; font-weight: bold;"><i class='bx bxs-edit'></i> Google reCAPTCHA API Configuration <p>Last update: <?php  echo $google_recaptcha_api_last_update  ?></p></label>

                                <div class="col-md-6">
                                        <label for="Skey" class="form-label">Site Key<span> *</span></label>
                                        <input type="text" class="form-control" autocapitalize="on" autocomplete="off" name="SKey" id="Skey" required placeholder ="<?php  echo $SKey  ?>">
                                        <div class="invalid-feedback">
                                        Please provide a Site Key.
                                        </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="Sskey" class="form-label">Site Secret Key<span> *</span></label>
                                    <input type="text" class="form-control" autocapitalize="on" autocomplete="off" name="SSKey" id="Sskey" required placeholder ="<?php  echo $SSKey  ?>">
                                    <div class="invalid-feedback">
                                    Please provide a Site Secret Key.
                                    </div>
                                </div>

                                </div>

                                <div class="addBtn">
                                    <button type="submit" class="btn-primary" name="btn-update" id="btn-update" onclick="return IsEmpty(); sexEmpty();">Update</button>
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

	<script>

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