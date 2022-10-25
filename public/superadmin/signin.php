<?php
include_once __DIR__. '/../../src/API/api.php';
include_once '../../dashboard/superadmin/authentication/superadmin-signin.php';
include_once '../../dashboard/superadmin/controller/select-settings-coniguration-controller.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="../../src/img/<?php echo $logo ?>">
	<link rel="stylesheet" type="text/css" href="../../src/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../src/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../../src/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="../../src/vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="../../src/vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="../../src/css/util.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" type="text/css" href="../../src/css/main.css?v=<?php echo time(); ?>">
	<script src="https://www.google.com/recaptcha/api.js?render=<?php echo $SiteKEY ?>"></script>
    <title>Super-admin | Sign In</title>

</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="../../src/img/img-01.png" alt="IMG">
				</div>

				<form action="../../dashboard/superadmin/authentication/superadmin-signin.php" method="POST" class="login100-form validate-form" novalidate="">
					<span class="login100-form-title">
						Super-admin Signin
					</span>
					<input type="hidden" id="g-token" name="g-token">

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit" name="btn-signin">
							Signin
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="forgot-password">
							Username / Password?
						</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="">
							
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
	<script src="../../src/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="../../src/vendor/bootstrap/js/popper.js"></script>
	<script src="../../src/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="../../src/vendor/select2/select2.min.js"></script>
	<script src="../../src/vendor/tilt/tilt.jquery.min.js"></script>
	<script src="../../src/node_modules/sweetalert/dist/sweetalert.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})

		// CAPTCHA
		grecaptcha.ready(function() {
		grecaptcha.execute('<?php echo $SiteKEY ?>', {action: 'submit'}).then(function(token) {
			document.getElementById("g-token").value = token;
		});
		});
	</script>
	<script src="../../src/js/main.js"></script>

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