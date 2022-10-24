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

$uniqueID = $_GET["uniqueID"];


$pdoQuery = "SELECT * FROM user WHERE uniqueID = :uniqueID";
$pdoResult = $pdoConnect->prepare($pdoQuery);
$pdoExec = $pdoResult->execute(array(":uniqueID" => $uniqueID));
$parent = $pdoResult->fetch(PDO::FETCH_ASSOC);

$UId 		            =        $parent['userId'];
$first_name             =        $parent["userFirst_Name"];
$middle_name            =        $parent["userMiddle_Name"];
$last_name              =        $parent["userLast_Name"];
$sex                    =        $parent["userSex"];
$birth_date             =        $parent["userBirthDate"];
$age                    =        $parent["userAge"];
$civil_status           =        $parent["userCivilStatus"];
$religion               =        $parent["userReligion"];
$phone_number           =        $parent["userPhone_Number"];
$email                  =        $parent["userEmail"];
$province               =        $parent["userProvince"];
$city                   =        $parent["userCity"];
$barangay               =        $parent["userBarangay"];
$street                 =        $parent["userStreet"];
$profile_user			=        $parent["userProfile"];
$created_at             =        $parent["created_at"];
$updated_at             =        $parent["updated_at"];

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
	<title>Parents Information</title>

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
				<a href="health-center">
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
			<li class="active">
				<a href="">
					<i class='bx bxs-user-circle' ></i>
					<span class="text">Parent/User Info</span>
				</a>
			</li>
			<li>
				<a href="services">
					<i class='bx bxs-wrench' ></i>
					<span class="text">Services</span>
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
					<h1>Parents</h1>
					<ul class="breadcrumb">
						<li>
							<a class="active" href="home">Home</a>
						</li>
						<li>|</li>
						<li>
							<a href="#">Parents</a>
						</li>
					</ul>
				</div>
			</div>

			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Profile </h3>
					</div>
                    <!-- BODY -->
                    <section class="profile-form">
                        <div class="header"></div>
                        <div class="profile">
                            <div class="profile-img">
                                <img src="../../src/img/<?php echo $profile_user ?>" alt="logo">

                                <a href="controller/delete-profile-controller.php?userId=<?php echo $UId ?>" class="delete"><i class='bx bxs-trash'></i></a>

                            </div>
                            
                            <div id="Edit" >
							<form action="controller/update-student-data-controller.php?id=<?php echo $student_Id ?>" method="POST" class="row gx-5 needs-validation" name="form" onsubmit="return validate()"  novalidate style="overflow: hidden;">
								<div class="row gx-5 needs-validation">

								<label class="form-label" style="text-align: left; padding-top: .5rem; padding-bottom: 1rem; font-size: 1rem; font-weight: bold;"><i class='bx bxs-edit'></i> Parent Information<p>Last update: <?php  echo $updated_at ?></p></label>

									<div class="col-md-6">
										<label for="first_name" class="form-label">First Name<span> *</span></label>
										<input type="text"  onkeyup="this.value = this.value.toUpperCase();" class="form-control" value="<?php echo $first_name ?>" autocapitalize="on" maxlength="15" autocomplete="off" name="FName" id="first_name"  required>
										<div class="invalid-feedback">
										Please provide a First Name.
										</div>
									</div>

									<div class="col-md-6">
										<label for="middle_name" class="form-label">Middle Name</label>
										<input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" value="<?php echo $middle_name ?>" autocapitalize="on" maxlength="15" autocomplete="off" name="MName" id="middle_name" >
										<div class="invalid-feedback">
										Please provide a Middle Name.
										</div>
									</div>

									<div class="col-md-6">
										<label for="last_name" class="form-label">Last Name<span> *</span></label>
										<input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" value="<?php echo $last_name ?>" autocapitalize="on" maxlength="15" autocomplete="off" name="LName" id="last_name"  required >
										<div class="invalid-feedback">
										Please provide a Last Name.
										</div>
									</div>

									<div class="col-md-6">
										<label for="sex" class="form-label">Sex<span> *</span></label>
										<select class="form-select form-control"  name="Sex"  autocapitalize="on" maxlength="6" autocomplete="off" id="sex" required>
										<option selected value="<?php echo $sex ?>"><?php echo $sex ?></option>
										<option value="MALE">MALE</option>
										<option value="FEMALE ">FEMALE</option>
										</select>
										<div class="invalid-feedback">
											Please select a valid Sex.
										</div>
									</div>

									<div class="col-md-6">
										<label for="birthdate" class="form-label">Birth Date<span> *</span></label>
										<input type="date" class="form-control" value="<?php echo $birth_date ?>" autocapitalize="off" autocomplete="off" name="BirthDate" id="birthdate" maxlength="10" pattern="^[a-zA-Z0-9]+@gmail\.com$"  required placeholder="Ex: mm/dd/yyyy" onkeyup="getAgeVal(0)" onblur="getAgeVal(0);">
										<div class="invalid-feedback">
										Please provide a Birth Date.
										</div>
									</div>

									<div class="col-md-6" style="display: none;">
										<label for="age" class="form-label">Age<span style="font-size:9px; color:red;">( auto-generated )</span></label>
										<input type="number" class="form-control" value="<?php echo $age ?>" autocapitalize="off" autocomplete="off"  name="Age" id="age" required >
										<div class="invalid-feedback">
										Please provide your Age.
										</div>
									</div>

									<div class="col-md-6">
										<label for="CivilStatus" class="form-label">Civil Status<span> *</span></label>
										<select class="form-select form-control"  name="CStatus"  autocapitalize="on" maxlength="6" autocomplete="off" id="CivilStatus" required>
										<option selected value="<?php echo $civil_status ?>" ><?php echo $civil_status ?></option>
										<option value="SINGLE">SINGLE</option>
										<option value="MARRIED">MARRIED</option>
										<option value="SEPERATED">SEPERATED</option>
										<option value=">WIDOW/WIDOWER">WIDOW/WIDOWER</option>
										<option value="ANULLED">ANULLED</option>
										<option value="SOLO PARENT">SOLO PARENT</option>
										</select>
										<div class="invalid-feedback">
											Please select a valid Civil Status.
										</div>
									</div>

									<div class="col-md-6">
										<label for="religion" class="form-label">Religion<span> *</span></label>
										<select class="form-select form-control"  name="Religion"  autocapitalize="on" maxlength="6" autocomplete="off" id="religion" required>
										<option selected value="<?php echo $religion ?>"><?php echo $religion ?></option>
										<option value="ROMAN CATHOLIC">Roman Catholic</option>
										<option value="INC">INC</option>
										<option value="CHRISTIAN">Christian</option>
										<option value="ISLAM">Islam</option>
										<option value="BUDDHISM">Buddhism</option>
										<option value="PROTESTANT">Protestant</option>
										<option value="METHODIST">Methodist</option>
										<option value="ADVENTIST">Adventist</option>
										<option value="INDEPENDENT">independent</option>
										<option value="EVANGELICAL">Evangelical</option>
										<option value="JENOVAH'S-WINESSES">Jehovah's-Witnesses</option>
										<option value="JIL">JIL</option>
										<option value="LUTHERAN">Lutheran</option>
										<option value="ORTHODOX">Orthodox</option>
										<option value="PENTECOSTAL">Pentecostal</option>
										<option value="PRESBYTERIANISM">Presbyterianism</option>
										<option value="LATTER-DAY">Latter-Day</option>
										<option value="UCCP">UCCP</option>
										<option value="KJC">KJC</option>
										<option value="BAPTIST">Baptist</option>
										<option value="ANGELICAN-EPISCOPALIAN">Angelican-Episcopalian</option>
										<option value="OTHERS">Others</option>
										</select>
										<div class="invalid-feedback">
											Please select a valid Religion.
										</div>
									</div>

									<div class="col-md-6" >
										<label for="phone_number" class="form-label">Phone Number</label>
										<div class="input-group flex-nowrap">
										<span class="input-group-text" id="addon-wrapping">+63</span>
										<input type="text" class="form-control numbers" value="<?php echo $phone_number ?>"  autocapitalize="off" inputmode="numeric" autocomplete="off" name="PNumber" id="phone_number" minlength="10" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  placeholder="10-digit number">
										</div>
									</div>
									
									<div class="col-md-6">
										<label for="email" class="form-label">Email</label>
										<input type="email" class="form-control" value="<?php echo $email ?>" autocapitalize="off" autocomplete="off" name="Email" id="email" placeholder="Ex. juan@email.com">
										<div class="invalid-feedback">
										Please provide a valid Email.
										</div>
									</div>
									<!-- Residential Address -->
									<label class="form-label" style="text-align: left; padding-top: 2rem; padding-bottom: 2rem; font-size: 1rem; font-weight: bold;">Residential Address</label>
									
									<div class="col-md-6">
										<label for="province" class="form-label">Province<span> *</span></label>
										<input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" value="<?php echo $province ?>" autocapitalize="on"  autocomplete="off" name="Province" id="province" required>
										<div class="invalid-feedback">
											Please select a valid Province.
										</div>
									</div>

									<div class="col-md-6">
										<label for="city" class="form-label">City/Municipality<span> *</span></label>
										<input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" value="<?php echo $city ?>" autocapitalize="on"  autocomplete="off" name="City" id="city" required>
										<div class="invalid-feedback">
											Please select a valid City.
										</div>
									</div>

									<div class="col-md-6">
										<label for="barangay" class="form-label">Barangay<span> *</span></label>
										<input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" value="<?php echo $barangay ?>" autocapitalize="on"  autocomplete="off" name="Barangay" id="barangay" required>
										<div class="invalid-feedback">
											Please select a valid Barangay.
										</div>
									</div>

									<div class="col-md-6">
										<label for="street" class="form-label">Street</label>
										<input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" value="<?php echo $street ?>"  autocomplete="off" name="Street" id="street" >
										<div class="invalid-feedback">
											Please select a valid Street.
										</div>
									</div>

								</div>

								<div class="addBtn">
									<button type="button" onclick="location.href='parents'" class="back">Back</button>
								</div>
							</form>
                            </div>

                            <div id="avatar" style="display: none;">
                            <form action="controller/update-profile-avatar-controller.php?UID=<?php echo $UId ?>" method="POST" enctype="multipart/form-data" class="row gx-5 needs-validation" name="form" onsubmit="return validate()"  novalidate style="overflow: hidden;">
                                <div class="row gx-5 needs-validation">

                                    <label class="form-label" style="text-align: left; padding-top: .5rem; padding-bottom: 1rem; font-size: 1rem; font-weight: bold;"><i class='bx bxs-user'></i> Change Avatar<p>Last update: <?php  echo $updated_at  ?></p></label>

                                    <div class="col-md-12">
                                        <label for="logo" class="form-label">Upload Logo<span> *</span></label>
                                        <input type="file" class="form-control" name="Logo" id="logo" style="height: 33px ;" required>
                                        <div class="invalid-feedback">
                                        Please provide a Logo.
                                        </div>
                                    </div>

                                    <div class="col-md-12" style="opacity: 0;">
                                        <label for="email" class="form-label">Default Email<span> *</span></label>
                                        <input type="email" class="form-control" autocapitalize="off" autocomplete="off" name="" id="email" required value="<?php  echo $system_email  ?>">
                                        <div class="invalid-feedback">
                                        Please provide a valid Email.
                                        </div>
                                    </div>

                                    <div class="col-md-12" style="opacity: 0; padding-bottom: 1.3rem;">
                                        <label for="sname" class="form-label">Old Password<span> *</span></label>
                                        <input type="text" class="form-control" autocapitalize="on" autocomplete="off" name="SName" id="sname" required value="<?php  echo $system_name  ?>">
                                        <div class="invalid-feedback">
                                        Please provide a Old Password.
                                        </div>
                                    </div>

                                </div>

                                <div class="addBtn">
                                    <button type="submit" class="primary" name="btn-update" id="btn-update" onclick="return IsEmpty(); sexEmpty();">Update</button>
                                </div>
                            </form>
                            </div>

                            <div id="password" style="display: none;">
                            <form action="controller/update-password-controller.php?id=<?php echo $UId ?>" method="POST" class="row gx-5 needs-validation" name="form" onsubmit="return validate()"  novalidate style="overflow: hidden;">
                                <div class="row gx-5 needs-validation">

                                    <label class="form-label" style="text-align: left; padding-top: .5rem; padding-bottom: 1rem; font-size: 1rem; font-weight: bold;"><i class='bx bxs-key'></i> Change Password<p>Last update: <?php  echo $updated_at  ?></p></label>

                                    <div class="col-md-12">
                                        <label for="old_pass" class="form-label">Old Password<span> *</span></label>
                                        <input type="password" class="form-control" autocapitalize="on" autocomplete="off"  name="Old" id="old_pass" required>
                                        <div class="invalid-feedback">
                                        Please provide a Old Password.
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="new_pass" class="form-label">New Password<span> *</span></label>
                                        <input type="text" class="form-control" autocapitalize="on" autocomplete="off" name="New" id="new_pass" required>
                                        <div class="invalid-feedback">
                                        Please provide a New Password.
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="confirm_pass" class="form-label">Confirm Password<span> *</span></label>
                                        <input type="text" class="form-control" autocapitalize="on" autocomplete="off" name="Confirm" id="confirm_pass" required>
                                        <div class="invalid-feedback">
                                        Please provide a Confirm Password.
                                        </div>
                                    </div>

                                </div>

                                <div class="addBtn">
                                    <button type="submit" class="button" name="btn-update-password" id="btn-update-password" onclick="return IsEmpty(); sexEmpty();">Update</button>
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