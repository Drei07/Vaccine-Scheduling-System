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
$first_name     = $row['userFirst_Name'];
$middle_name    = $row['userMiddle_Name'];
$last_name      = $row['userLast_Name'];
$phone_number   = $row['userPhone_Number'];
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
	<title>Baby | Add Baby</title>

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
				<a href="baby">
					<i class='bx bxs-baby-carriage'></i>
					<span class="text">My Baby</span>
				</a>
			</li>
			<li>
				<a href="appointment">
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">Appointmen</span>
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
					<h1>Add Baby</h1>
					<ul class="breadcrumb">
						<li>
							<a class="active" href="home">Home</a>
						</li>
						<li>|</li>
                        <li>
							<a class="active" href="baby">Baby</a>
						</li>
                        <li>|</li>
                        <li>
							<a href="">Add Baby</a>
						</li>
					</ul>
				</div>
			</div>

			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Baby Information</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
                    <!-- BODY -->
                        <section class="data-form">
                        <div class="header"></div>
                        <div class="registration">
                            <form action="controller/add-baby-controller.php" method="POST" class="row gx-5 needs-validation" enctype="multipart/form-data" name="form" onsubmit="return validate()"  novalidate style="overflow: hidden;">
                                <div class="row gx-5 needs-validation">
                                    <!-- Baby Information -->

                                    <div class="col-md-6">
                                        <label for="first_name" class="form-label">First Name<span> *</span></label>
                                        <input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" autocomplete="off" name="FName" id="first_name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" required>
                                        <div class="invalid-feedback">
                                        Please provide a First Name.
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="middle_name" class="form-label">Middle Name</label>
                                        <input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" autocomplete="off" name="MName" id="middle_name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">
                                        <div class="invalid-feedback">
                                        Please provide a Middle Name.
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="last_name" class="form-label">Last Name<span> *</span></label>
                                        <input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" autocomplete="off" name="LName" id="last_name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" required >
                                        <div class="invalid-feedback">
                                        Please provide a Last Name.
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="sex" class="form-label">Sex<span> *</span></label>
                                        <select class="form-select form-control"  name="Sex"  maxlength="6" autocomplete="off" id="sex" required>
                                        <option selected disabled value="">Select...</option>
                                        <option value="MALE">MALE</option>
                                        <option value="FEMALE ">FEMALE</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a valid Sex.
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="birthdate" class="form-label">Birth Date<span> *</span></label>
                                        <input type="date" class="form-control" autocapitalize="off" autocomplete="off" name="BirthDate" id="birthdate" maxlength="10" pattern="^[a-zA-Z0-9]+@gmail\.com$"  required placeholder="Ex: mm/dd/yyyy" onkeyup="getAgeVal(0)" onblur="getAgeVal(0);">
                                        <div class="invalid-feedback">
                                        Please provide a Birth Date.
                                        </div>
                                    </div>

                                    <div class="col-md-6" style="display: none;">
                                        <label for="age" class="form-label">Age<span style="font-size:9px; color:red;">( auto-generated )</span></label>
                                        <input type="number" class="form-control" autocapitalize="off" autocomplete="off"  name="Age" id="age" required >
                                        <div class="invalid-feedback">
                                        Please provide your Age.
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="Pbirth" class="form-label">Place Of Birth<span> *</span></label>
                                        <input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" maxlength="20" autocomplete="off" name="PBirth" id="Pbirth" required>
                                        <div class="invalid-feedback">
                                        Please provide a Place of Birth.
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="NHospital" class="form-label">Name of Hospital<span> *</span></label>
                                        <input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" maxlength="20" autocomplete="off" name="name_hospital" id="NHospital" required>
                                        <div class="invalid-feedback">
                                        Please provide a Name of Hospital.
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="BWeight" class="form-label">Birth Weight<span> *</span></label>
                                        <input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" maxlength="20" autocomplete="off" name="birth_weight" id="BWeight" required>
                                        <div class="invalid-feedback">
                                        Please provide a Birth Weight.
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="BHeight" class="form-label">Birth Height<span> *</span></label>
                                        <input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" maxlength="20" autocomplete="off" name="birth_height" id="BHeight" required>
                                        <div class="invalid-feedback">
                                        Please provide a Birth Height.
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="HCircumference" class="form-label">Head Circumference<span> *</span></label>
                                        <input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" maxlength="20" autocomplete="off" name="head_circumference" id="HCircumference" required>
                                        <div class="invalid-feedback">
                                        Please provide a Head Circumference.
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="CCircumference" class="form-label">Chest Circumference<span> *</span></label>
                                        <input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" maxlength="20" autocomplete="off" name="chest_circumference" id="CCircumference" required>
                                        <div class="invalid-feedback">
                                        Please provide a Chest Circumference.
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="DMarks" class="form-label">Distinguishing Marks</label>
                                        <input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" maxlength="20" autocomplete="off" name="distinguishing_marks" id="DMarks">
                                        <div class="invalid-feedback">
                                        Please provide a Distinguishing Marks.
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="Obste" class="form-label">Obstetrician<span> *</span></label>
                                        <input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" maxlength="20" autocomplete="off" name="obstetrician" id="Obstetrician" required>
                                        <div class="invalid-feedback">
                                        Please provide a Obstetrician.
                                        </div>
                                    </div>

                                    <!-- Mother Information -->
                                    <label class="form-label" style="text-align: left; padding-top: 2rem; padding-bottom: 2rem; font-size: 1rem; font-weight: bold;">Mother Information<span> (maiden name)</span></label>

                                    <div class="col-md-6">
                                        <label for="mother_first_name" class="form-label">First Name<span> *</span></label>
                                        <input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" value="<?php echo $first_name ?>" onkeydown="return false;" autocomplete="off" name="Mother-FName" id="mother_first_name" required onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" >
                                        <div class="invalid-feedback">
                                        Please provide a First Name.
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="mother_middle_name" class="form-label">Middle Name</label>
                                        <input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" value="<?php echo $middle_name ?>" onkeydown="return false;" autocomplete="off" name="Mother-MName" id="mother_middle_name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">
                                        <div class="invalid-feedback">
                                        Please provide a Middle Name.
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="mother_last_name" class="form-label">Last Name<span> *</span></label>
                                        <input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" value="<?php echo $last_name ?>" onkeydown="return false;" autocomplete="off" name="Mother-LName" id="mother_last_name" required onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)"  >
                                        <div class="invalid-feedback">
                                        Please provide a Last Name.
                                        </div>
                                    </div>

                                    <div class="col-md-6" >
                                        <label for="mother_phone_number" class="form-label">Phone Number</label>
                                        <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="addon-wrapping">+63</span>
                                        <input type="text" class="form-control numbers"  autocapitalize="off" inputmode="numeric" value="<?php echo $phone_number ?>" onkeydown="return false;"  autocomplete="off" name="Mother-PNumber" id="mother_phone_number" minlength="10" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  placeholder="10-digit number">
                                        </div>
                                    </div>

                                    <!-- Father Information -->
                                    <label class="form-label" style="text-align: left; padding-top: 2rem; padding-bottom: 2rem; font-size: 1rem; font-weight: bold;">Father Information</label>

                                    <div class="col-md-6">
                                        <label for="father_first_name" class="form-label">First Name</label>
                                        <input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" autocomplete="off" name="Father-FName" id="father_first_name"  onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" >
                                        <div class="invalid-feedback">
                                        Please provide a First Name.
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="father_middle_name" class="form-label">Middle Name</label>
                                        <input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" autocomplete="off" name="Father-MName" id="father_middle_name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">
                                        <div class="invalid-feedback">
                                        Please provide a Middle Name.
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="father_last_name" class="form-label">Last Name</label>
                                        <input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" autocomplete="off" name="Father-LName" id="father_last_name"  onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)"  >
                                        <div class="invalid-feedback">
                                        Please provide a Last Name.
                                        </div>
                                    </div>

                                    <div class="col-md-6" >
                                        <label for="father_phone_number" class="form-label">Phone Number</label>
                                        <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="addon-wrapping">+63</span>
                                        <input type="text" class="form-control numbers"  autocapitalize="off" inputmode="numeric" autocomplete="off" name="Father-PNumber" id="father_phone_number"  minlength="10" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  placeholder="10-digit number">
                                        </div>
                                    </div>

                                    
                                    <label class="form-label" style="text-align: left; padding-top: .5rem; padding-bottom: 1rem; font-size: 1rem; font-weight: bold;">Add Image</label>

                                    <div class="col-md-12">
                                        <label for="logo" class="form-label">Upload Picture of Baby<span> *</span></label>
                                        <input type="file" class="form-control" name="baby_image" id="logo" style="height: 33px ;" required>
                                        <div class="invalid-feedback">
                                        Please upload Picture of Baby.
                                        </div>
                                    </div>

                                    <!-- parentID -->

                                    <div class="col-md-6" style="opacity: 0;">
                                        <label for="parentId" class="form-label" ></label>
                                        <input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" autocomplete="off" name="parentId" id="parentId" value="<?php echo $parentID ?>"  onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)"  >
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>

                                </div>

                                <div class="addBtn">
                                    <button type="submit" class="button" name="btn-register" id="btn-register" onclick="return IsEmpty(); sexEmpty();">Submit</button>
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

		//numbers only
		$('.numbers').keypress(function(e) {
		var x = e.which || e.keycode;
		if ((x >= 48 && x <= 57) || x == 8 ||
			(x >= 35 && x <= 40) || x == 46)
			return true;
		else
			return false;
		});

        //birthdate
        function formatDate(date){
            var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            return [year, month, day].join('-');

        }

        function getAge(dateString){
            var birthdate = new Date().getTime();
            if (typeof dateString === 'undefined' || dateString === null || (String(dateString) === 'NaN')){
            birthdate = new Date().getTime();
            }
            birthdate = new Date(dateString).getTime();
            var now = new Date().getTime();
            var n = (now - birthdate)/1000;
            if (n < 604800){
            var day_n = Math.floor(n/86400);
            if (typeof day_n === 'undefined' || day_n === null || (String(day_n) === 'NaN')){
                return '';
            }else{
                return day_n + '' + (day_n > 1 ? '' : '') + '';
            }
            } else if (n < 2629743){
            var week_n = Math.floor(n/604800);
            if (typeof week_n === 'undefined' || week_n === null || (String(week_n) === 'NaN')){
                return '';
            }else{
                return week_n + '' + (week_n > 1 ? '' : '') + '';
            }
            } else if (n < 31562417){
            var month_n = Math.floor(n/2629743);
            if (typeof month_n === 'undefined' || month_n === null || (String(month_n) === 'NaN')){
                return '';
            }else{
                return month_n + ' ' + (month_n > 1 ? '' : '') + '';
            }
            }else{
            var year_n = Math.floor(n/31556926);
            if (typeof year_n === 'undefined' || year_n === null || (String(year_n) === 'NaN')){
                return year_n = '';
            }else{
                return year_n + '' + (year_n > 1 ? '' : '') + '';
            }
            }
        }
        function getAgeVal(pid){
            var birthdate = formatDate(document.getElementById("birthdate").value);
            var count = document.getElementById("birthdate").value.length;
            if (count=='10'){
            var age = getAge(birthdate);
            var str = age;
            var res = str.substring(0, 1);
            if (res =='-' || res =='0'){
                document.getElementById("birthdate").value = "";
                document.getElementById("age").value = "";
                $('#birthdate').focus();
                return false;
            }else{
                document.getElementById("age").value = age;
            }
            }else{
            document.getElementById("age").value = "";
            return false;
            }
        };


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