<?php
require_once '../../backend/db.php';
require '../../backend/auth.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- basic -->
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<!-- mobile metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="viewport" content="initial-scale=1, maximum-scale=1" />
	<!-- site metas -->
	<title>Doctor</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;300;400;600;700;800&display=swap" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="icon" href="../../img/favicon.ico" type="image/png" />
	<link rel="stylesheet" href="../styles/bootstrap.min.css" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="../styles/style.css" />
	<link rel="stylesheet" href="../styles/responsive.css" />
	<link rel="stylesheet" href="../styles/bootstrap-select.css" />
	<link rel="stylesheet" href="../styles/perfect-scrollbar.css" />
	<link rel="stylesheet" href="../styles/custom.css" />

	<style>
		.btn-group {
			display: none !important;
		}

		.lab_result {
			display: grid;
			grid-template-columns: repeat(2, 1fr);
			gap: 1rem;
		}

		.lab_result .result-box {
			width: 100%;
			height: 100%;
		}

		/* .lab_result .result-box ul li{
            display: flex;
            align-items: center;
            justify-content: space-between;
        } */
		.lab_result img {
			width: 100%;
		}

		.table-head th {
			background-color: transparent !important;
		}

		.table-head th,
		.table-head td {
			text-transform: capitalize;
		}
	</style>
</head>

<body class="dashboard dashboard_1">
	<div class="full_container">
		<div class="inner_container">
			<!-- Sidebar  -->
			<nav id="sidebar">
				<div class="sidebar_blog_1">
					<div class="sidebar-header">
						<div class="logo_section">
							<a href="index.html"><img class="logo_icon img-responsive" src="../../img/logo.png" alt="#" /></a>
						</div>
					</div>
					<div class="sidebar_user_info">
						<div class="icon_setting"></div>
						<div class="user_profle_side">
							<div class="user_img">
								<img class="img-responsive" src="../../img/logo.png" alt="#" />
							</div>
							<div class="user_info">
								<?php
								$phone_doc = $_SESSION['user'];
								$sql = "SELECT * FROM `users` WHERE `phone` = '$phone_doc'";
								$res = $conn->query($sql);
								while ($row = mysqli_fetch_assoc($res)) {
									$name = $row['name'];
									$id = $row['id'];
								}
								?>
								<h6>
									<?php
									echo $name;
									?>
								</h6>
							</div>
						</div>
					</div>
				</div>
				<div class="sidebar_blog_2">
					<?php
					include './side_nav.php';
					?>
				</div>
			</nav>
			<!-- end sidebar -->

			<!-- right content -->
			<div id="content">
				<!-- topbar -->
				<div class="topbar">
					<nav class="navbar navbar-expand-lg navbar-light">
						<div class="full">
							<button type="button" id="sidebarCollapse" class="sidebar_toggle">
								<i class="fa-solid fa-bars"></i>
							</button>
							<div class="right_topbar"></div>
						</div>
					</nav>
				</div>
				<!-- end topbar -->

				<!-- dashboard inner -->
				<div class="midde_cont">
					<div class="container-fluid">
						<div id="feedback">
							<?php
							@$msg = $_REQUEST['msg'];
							echo "<p>$msg</p>"
							?>
						</div>
						<form action="search.php" class="search">
							<h3>Search For Patient</h3>
							<div class="search-form">
								<input type="number" name="search" id="search" min="0" required placeholder="Phone or Card Number" />
								<input type="submit" name="searching" value="Search" class="btn btn-primary" />
							</div>
						</form>
						<?php
						if (isset($_GET['searching'])) {
							$phone = $_GET['search'];
							$search_sql = "SELECT * FROM `patient` WHERE `phone`='$phone' OR `id` = '$phone'";
							$rs = $conn->query($search_sql);
							$adm = "SELECT * FROM `admission` WHERE `pat_id` = '$phone' OR `pat_phone` = '$phone'";
							$r = $conn->query($adm);
							if ($r->num_rows > 0) {
								while ($rows = $r->fetch_assoc()) {
									$date = $rows['date'];
								}
								echo "
								<div class='center-btn'>
								<h2>In Admission Since $date</h2>
								</div>
								";
						?>
								<div class="messages">
									<!-- <div class="adm-detail">
										<form action="../../backend/adm_detail.php" method="post">
											<h3 class="center">Admission Detail</h3>
											<input type="hidden" name="id" value="<?php echo $phone; ?>">
											<textarea name="adm_detail" id="adm-detail" cols="30" rows="10"></textarea>
											<input type="submit" value="Send" name="adm_det" class="btn">
										</form>
									</div> -->

								<?php
							} else {
								echo "
								<div class='center-btn'>
								<a class='btn' id='center' href='../../backend/admission.php?id=$phone&doc=$phone_doc'>Send to Admission</a>
								</div>
								";
							}
								?>
								<div class="adm-detail">
									<form action="../../backend/nurse_message.php" method="post">
										<h3 class="center">Message To Nurse</h3>
										<input type="hidden" name="id" value="<?php echo $phone; ?>">
										<textarea name="adm_detail" id="adm-detail" cols="30" rows="10"></textarea>
										<input type="submit" value="Send" name="adm_det" class="btn">
									</form>
								</div>
								</div>
							<?php
							echo "
									<table class='table'>
									<thead>
										<th>SNo</th>
										<th>Name</th>
										<th>Age</th>
										<th>Sex</th>
										<th>Card No</th>
										<th>Phone</th>
										<th>Organization</th>
										<th>Action</th>
									</thead>
									";
							if ($rs) {
								while ($result = $rs->fetch_assoc()) {
									$card = $result['id'];
									$pt_name = $result['name'];
									$pt_phone = $result['phone'];
									$age = $result['age'];
									$sex = $result['sex'];
									$org = $result['org'];
									if ($org == null) {
										$org = "Self";
									} else if ($org == "stc") {
										$org = "Save The Children";
									}
									echo "	
												<tbody>
													<tr>
														<td data-label='SNo'>$card</td>
														<td data-label='Name'>$pt_name</td>
														<td data-label='Age'>$age</td>
														<td data-label='Sex'>$sex</td>
														<td data-label='Card No'>$card</td>
														<td data-label='Phone'>$pt_phone</td>						
														<td data-label='Organization'>$org</td>						
														<td data-label='Action'><a href='./edit_pat.php?id=$card'>Edit</a></td>						
													</tr>
												</tbody>
												";
								}
							}
						}
							?>
							<?php
							if (isset($_GET['searching'])) {
								$pat_id = $card;
								$search_sql = "SELECT * FROM `nurse_exam` WHERE `patient_id` = '$pat_id' ORDER BY `date` DESC";
								$rsss = $conn->query($search_sql);
								echo "
									<table class='table'>
									<thead>
										<th>BP</th>
										<th>PR</th>
										<th>Saturation</th>
										<th>Respiratory</th>
										<th>Temperature</th>
										<th>Height</th>
										<th>Weight</th>
										<th>Head</th>
										<th>MUAC</th>
										<th>Date</th>
										<th>Action</th>
									</thead>
									";
								if ($rsss) {
									while ($rowss = $rsss->fetch_assoc()) {
										$nurse_id = $rowss['id'];
										$bp = $rowss['BP'];
										$pr = $rowss['PR'];
										$saturation = $rowss['saturation'];
										$respiratory = $rowss['respiratory'];
										$temp = $rowss['temprature'];
										$height = $rowss['height'];
										$weight = $rowss['weight'];
										$head = $rowss['head_circum'];
										$muac = $rowss['MUAC'];
										$date = $rowss['date'];
										echo "	
												<tbody>
													<tr>
													<td data-label='BP'>$bp</td>
													<td data-label='PR'>$pr</td>
													<td data-label='Saturation'>$saturation</td>
													<td data-label='Respiratory'>$respiratory</td>
													<td data-label='Temperature'>$temp</td>
													<td data-label='Height'>$height</td>
													<td data-label='Weight'>$weight</td>
													<td data-label='Head'>$head</td>
													<td data-label='MUAC'>$muac</td>
													<td data-label='Date'>$date</td>
													<td class='actions' data-label='Action'><a href='./edit_nurse.php?id=$pat_id&exam_id=$nurse_id'>Edit</a> <span><a href='../../backend/delete_nurse.php?rn=$nurse_id&id=$pat_id'>X</a></span></td>
													</tr>
												</tbody>
												";
									}
								}

							?>
								</table>
								<div class="d-flex items-center justify-content-around">
									<select class="px-4 py-1 fs-5" name="selectDate" id="selectDate" onchange="fetchResult()">

									</select>
									<input type="hidden" name="" id="pat_id" value="<?php echo $pat_id; ?>">
									<!-- <p id="dateCont"></p> -->
									<button class="btn" id="btnPrint">Print</button>
								</div>

								<div class="details-page mt-0" id="lab_result">

								</div>

								<div class="action">
									<button class="btn btn-primary" id="btn-lab">Laboratory</button>
									<button class="btn btn-primary" id="btn-detail">Detail</button>
									<?php echo "<a class='btn btn-primary'href='labresu.php?id=$pat_id'>Lab Result</a>" ?>
									<?php echo "<a class='btn btn-primary'href='lab_req.php?id=$pat_id'>Lab Request</a>" ?>
									<?php echo "<a class='btn btn-primary'href='ultrareq.php?id=$pat_id'>Ultrasound Request</a>" ?>
									<?php echo "<a class='btn btn-primary'href='ultraresu.php?id=$pat_id'>Ultrasound Result</a>" ?>
									<?php echo "<a class='btn btn-primary'href='prescription.php?id=$pat_id'>Prescription</a>" ?>
									<!-- <button class="btn btn-primary" id="btn-radio">
									Ultrasound
								</button> -->
									<!-- <button class="btn btn-primary" id="btn-pres">Prescribe</button> -->
								</div>

								<div class="detail hide" id="patient-detail">
									<h3>Write Detail</h3>
									<div class="lab-res">
										<form action="../../backend/add_detail.php" method="POST" class="add-detail">
											<div class="form">

												<div class="column">

													<label for="C/c">C/C</label>
													<label class="input-sizer stacked">
														<textarea name="cc" oninput="this.parentNode.dataset.value = this.value" rows="2"></textarea>
													</label>
													<label for="dt">Duration</label>
													<label class="input-sizer stacked">
														<textarea name="dt" oninput="this.parentNode.dataset.value = this.value" rows="2"></textarea>
													</label>
													<label for="sy">Major Associated symptoms</label>
													<label class="input-sizer stacked">
														<textarea name="sy" oninput="this.parentNode.dataset.value = this.value" rows="2"></textarea>
													</label>
													<label for="imp">Other important symptoms</label>
													<label class="input-sizer stacked">
														<textarea name="imp" oninput="this.parentNode.dataset.value = this.value" rows="2"></textarea>
													</label>
													<label for="md">Any taken Medication</label>
													<label class="input-sizer stacked">
														<textarea name="md" oninput="this.parentNode.dataset.value = this.value" rows="2"></textarea>
													</label>
													<label for="cn">Current Nutrition</label>
													<label class="input-sizer stacked">
														<textarea name="cn" oninput="this.parentNode.dataset.value = this.value" rows="2"></textarea>
													</label>
													<label for="plan">Plan</label>
													<label class="input-sizer stacked">
														<textarea name="plan" oninput="this.parentNode.dataset.value = this.value" rows="2"></textarea>
													</label>


												</div>
												<div class="column">
													<label for="pc">Previous Similar Cases</label>
													<label class="input-sizer stacked">
														<textarea name="pc" oninput="this.parentNode.dataset.value = this.value" rows="2"></textarea>
													</label>
													<label for="vh">Vaccination HX</label>
													<label class="input-sizer stacked">
														<textarea name="vh" oninput="this.parentNode.dataset.value = this.value" rows="2"></textarea>
													</label>
													<label for="aka">Any known Allergy</label>
													<label class="input-sizer stacked">
														<textarea name="aka" oninput="this.parentNode.dataset.value = this.value" rows="2"></textarea>
													</label>
													<label for="lab">Pertinent Physical Exam</label>
													<label class="input-sizer stacked">
														<textarea name="lab" oninput="this.parentNode.dataset.value = this.value" rows="2"></textarea>
													</label>
													<label for="dx">Possible DX</label>
													<label class="input-sizer stacked">
														<textarea name="dx" oninput="this.parentNode.dataset.value = this.value" rows="2"></textarea>
													</label>
													<label for="rx">RX Given</label>
													<label class="input-sizer stacked">
														<textarea name="rx" oninput="this.parentNode.dataset.value = this.value" rows="2"></textarea>
													</label>
													<input type="hidden" name="pat_id" value="<?php echo $pat_id; ?>">
													<input type="submit" value="Add Detail" name="submit" class="btn btn-primary" />
												</div>
											</div>
										</form>
									</div>
								</div>

								<div class="lab-order" id="lab">
									<form class="lab_req_form" action="../../backend/lab_cart2.php" method="POST">
										<table>
											<h3>Laboratory</h3>
											<thead>
												<th>
													<input type="checkbox" id="CBC" name="lab[]" value="CBC">
													<label for="CBC">CBC</label><br>
												</th>
												<th>
													<input type="checkbox" id="Blood Group" name="lab[]" value="Blood_Group">
													<label for="Blood Group">Blood Group</label><br>
												</th>
												<th>
													<input type="checkbox" id="ESR" name="lab[]" value="ESR">
													<label for="ESR">ESR</label><br>
												</th>
												<th>
													<input type="checkbox" id="Stool" name="lab[]" value="STOOL">
													<label for="Stool">Stool</label><br>
												</th>
												<th>
													<input type="checkbox" id="Urinalysis" name="lab[]" value="Urinalysis">
													<label for="Urinalysis">Urinalysis</label><br>
												</th>
												<th>
													<input type="checkbox" id="fbs" name="lab[]" value="FBS_RBS">
													<label for="fbs">FBS/RBS</label><br>
												</th>
												<th>
													<input type="checkbox" id="Uric_Acid" name="lab[]" value="Uric_Acid">
													<label for="Uric_Acid">Uric Acid</label><br>
												</th>
												<th>
													<input type="checkbox" id="let" name="lab[]" value="LET">
													<label for="let">Liver Enzymatic Test</label><br>
												</th>
												<th>
													<input type="checkbox" id="lft" name="lab[]" value="LFT">
													<label for="lft">Liver Function Test</label><br>
												</th>
												<th>
													<input type="checkbox" id="rft" name="lab[]" value="RFT">
													<label for="rft">Renal Function Test</label><br>
												</th>
												<th>
													<input type="checkbox" id="serum" name="lab[]" value="Serum">
													<label for="serum">Serum Electrolytes</label><br>
												</th>
												<th>
													<input type="checkbox" id="crp" name="lab[]" value="CRP">
													<label for="crp">CRP</label><br>
												</th>
												<th>
													<input type="checkbox" id="tft" name="lab[]" value="TFT">
													<label for="tft">Thyroid Function Test</label><br>
												</th>
												<th>
													<input type="checkbox" id="coagulation" name="lab[]" value="Coagulation_Profile">
													<label for="coagulation">Coagulation Profile</label><br>
												</th>
												<th>
													<input type="checkbox" id="gram" name="lab[]" value="Gram_Stain">
													<label for="gram">Gram Stain</label><br>
												</th>
												<th>
													<input type="checkbox" id="afb" name="lab[]" value="AFB_Sputum">
													<label for="afb">AFB SPUTUM</label><br>
												</th>
												<th>
													<input type="checkbox" id="pict" name="lab[]" value="PICT">
													<label for="pict">PICT</label><br>
												</th>
												<th>
													<input type="checkbox" id="vdrl" name="lab[]" value="VDRL">
													<label for="vdrl">VDRL</label><br>
												</th>
												<th>
													<input type="checkbox" id="rpr" name="lab[]" value="RPR">
													<label for="rpr">RPR</label><br>
												</th>
												<th>
													<input type="checkbox" id="Widal" name="lab[]" value="Widal_H">
													<label for="Widal">Widal H</label><br>
												</th>
												<th>
													<input type="checkbox" id="Widal_o" name="lab[]" value="Widal_O">
													<label for="Widal_o">Widal O</label><br>
												</th>
												<th>
													<input type="checkbox" id="weil" name="lab[]" value="Weil_Felix">
													<label for="weil">Weil Felix</label><br>
												</th>
												<th>
													<input type="checkbox" id="csf" name="lab[]" value="csf_analysis">
													<label for="csf">CSF Analysis</label><br>
												</th>
												<th>
													<input type="checkbox" id="liver" name="lab[]" value="liver_viral">
													<label for="liver">Liver Viral Markers</label><br>
												</th>
												<th>
													<input type="checkbox" id="h_pylori_ag" name="lab[]" value="h_pylori_ag">
													<label for="h_pylori_ag">H.Pylori_Ag </label><br>
												</th>
												<th>
													<input type="checkbox" id="h_pylori_ab" name="lab[]" value="h_pylori_ab">
													<label for="h_pylori_ab">H.Pylori_Ab </label><br>
												</th>
												<th>
													<input type="checkbox" id="blood_f" name="lab[]" value="blood_f">
													<label for="blood_f">Blood Film</label><br>
												</th>
												<th>
													<input type="checkbox" id="body_fluid" name="lab[]" value="body_fluid">
													<label for="body_fluid">Body Fluid Analysis</label><br>
												</th>
											</thead>
										</table>
										<div align="center">
											<input type="text" class="hide" name="pat" id="pat" value="<?php echo $pat_id; ?>">
											<input type="submit" name="submit" id="submit_button" class="btn btn-primary" value="Order" data-toggle="modalss" data-target="#exampleModalCenter" />
										</div>
									</form>
									<form method="post" class="lab_req_form" id="insert_form " action="../../backend/ultra_cart.php">
										<h3>Ultrasound</h3>
										<table>
											<thead>
												<th>
													<input type="checkbox" id="/*  */
												abus" name="brands[]" value="Abdominal">
													<label for="abus">Abdominal US</label><br>
												</th>
												<th>
													<input type="checkbox" id="chest" name="brands[]" value="Chest">
													<label for="chest">Chest</label><br>
												</th>
												<th>
													<input type="checkbox" id="neck" name="brands[]" value="Neck">
													<label for="neck">Neck US</label><br>
												</th>
												<th>
													<input type="checkbox" id="normal_brain" name="brands[]" value="normal_brain">
													<label for="normal_brain">Normal Brain</label><br>
												</th>
												<th>
													<input type="checkbox" id="other" name="brands[]" value="other">
													<label for="other">Other</label><br>
												</th>
											</thead>
										</table>
										<div class="ultra-detail">

											<div id="abus-text" class="form-element hide">
												<label for="abdo">Abdominal</label>
												<textarea name="abdo" id="abdo" cols="30" rows="10"></textarea>
											</div>
											<div id="bus-text" class="form-element hide">
												<label for="chest">Chest</label>
												<textarea name="chest" id="chest" cols="30" rows="10"></textarea>
											</div>
											<div id="neck-text" class="form-element hide">
												<label for="neck">Neck</label>
												<textarea name="neck" id="neck" cols="30" rows="10"></textarea>
											</div>
											<div id="nb-text" class="form-element hide">
												<label for="nb_det">Normal Brain</label>
												<textarea name="nb_det" id="nb_det" cols="30" rows="10"></textarea>
											</div>
											<div id="other-text" class="form-element hide">
												<label for="other_det">Other</label>
												<textarea name="other_det" id="other_det" cols="30" rows="10"></textarea>
											</div>
										</div>
										<div align="center">
											<input type="text" class="hide" name="pat" id="pat" value="<?php echo $pat_id; ?>">
											<input type="submit" name="submit" id="submit_button" class="btn btn-primary" value="Order" data-toggle="modalss" data-target="#exampleModalCenter" />
										</div>
									</form>
									<form method="post" class="lab_req_form" id="insert_form " action="../../backend/procedure.php">
										<h3>Procedure</h3>


										<div style="display: grid; place-items: center;">
											<div style="display: flex; flex-direction: row;">
												<label style="margin-right: 1rem;" for="proc">Price</label>
												<input type="number" name="proc" id="proc">
											</div>
										</div>
										<div align="center">
											<input type="text" class="hide" name="pat" id="pat" value="<?php echo $pat_id; ?>">
											<input type="submit" name="submit" id="submit_button" class="btn btn-primary" value="Order" data-toggle="modalss" data-target="#exampleModalCenter" />
										</div>
									</form>
								</div>
								<div class="adm-detail">
									<form action="../../backend/lab_message.php" method="post">
										<h3 class="center">Message To Laboratory</h3>
										<input type="hidden" name="id" value="<?php echo $phone; ?>">
										<textarea name="adm_detail" id="adm-detail" cols="30" rows="10"></textarea>
										<input type="submit" value="Send" name="lab_det" class="btn">
									</form>
								</div>
							<?php
							}
							?>
					</div>
				</div>
				<div class="lab-header mx-auto">
					<img src="../../img/lab_header.png" alt="">
				</div>
				<div class="lab-footer">
					<img src="../../img/pharmacyFooter.jpg" alt="">
				</div>
				<!-- footer -->
			</div>
			<!-- end dashboard inner -->
		</div>
	</div>
	</div>
	<!-- jQuery -->
	<script src="../js/jquery.min.js"></script>
	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<!-- wow animation -->
	<script src="../js/animate.js"></script>
	<!-- select country -->
	<script src="../js/bootstrap-select.js"></script>
	<!-- nice scrollbar -->
	<script src="../js/perfect-scrollbar.min.js"></script>
	<script>
		var ps = new PerfectScrollbar("#sidebar");
	</script>
	<!-- custom js -->
	<script src="../js/custom.js"></script>
	<script src="../js/doctor.js"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
</body>

</html>
<script>
	document.getElementById("btnPrint").onclick = function() {
		window.print();
	}
	$(document).ready(function() {
		$("#authors").change(function() {
			var aid = $("#authors").val();
			$.ajax({
				url: 'data.php',
				method: 'post',
				data: 'aid=' + aid
			}).done(function(books) {
				books = JSON.parse(books);
				$('#books').empty();
				books.forEach(function(book) {
					//$('#books').append('<option>Hello</option>')
					$('#books').val(book.price)
				})
			})
		})
	})
	const feedback = document.getElementById("feedback");
	setTimeout(() => {
		feedback.style.display = "none";
	}, 3000)


	const url = "<?php echo $url; ?>"

	document.addEventListener('DOMContentLoaded', () => {
		fetchYears();
	})

	function fetchYears() {
		const id = document.getElementById("pat_id").value;
		fetch(`${url}/getDetailYear.php?id=${id}`)
			.then(response => response.json())
			.then(data => {
				let yearDropDown = document.getElementById('selectDate')
				// yearDropDown.innerHTML = '<option value="" selected default disabled>Please Select Year</option>';
				// const yearDropDown = document.createElement('select');
				data.forEach(year => {
					const option = document.createElement('option');
					option.value = year;
					option.textContent = year;
					yearDropDown.appendChild(option);
				})
				let selectedYear = document.getElementById('selectDate').value;
				if (!selectedYear) {
					selectedYear = new Date().getFullYear();
					yearDropDown.value = selectedYear
				}
				const container = document.getElementById('lab_result');
				container.innerHtml = '';
				fetchResults(selectedYear, id)
			})
			.catch(error => console.log(error))
	}

	function fetchResults(date, id) {
		let columns = {
			'cc': 'C/c',
			'dt': 'Duration',
			'sy': 'Major Associated Symptoms',
			'imp': 'Other Important Symptoms',
			'md': 'Any Taken Medication',
			'cn': 'Current Nutrition',
			'pc': 'Previous Similar Cases',
			'vh': 'Vaccination HX',
			'aka': 'Any Known Allergy',
			'lab': 'Pertinent Physical Exam',
			'dx': 'Possible DX',
			'rx': 'RX Given',
			'plan': 'Plan'
		}
		const dateCont = document.getElementById("dateCont");
		// dateCont.innerText = date
		const container = document.getElementById('lab_result');
		fetch(`${url}/getDetail.php?id=${id}&year=${date}`)
			.then(response => response.json())
			.then(data => {
				// const container = document.getElementById('lab_result');
				container.innerHtml = '';

				// Check if data is an object
				if (typeof data === 'object' && data !== null) {
					// Loop through the data object
					for (const table in data) {
						if (Object.prototype.hasOwnProperty.call(data, table)) { // Check if property is an own property
							// Get results object for the current table
							const resultsObject = data[table];
							// Generate HTML for the results
							container.innerHtml = '';
							let ul;

							ul = `
    <table class='table mt-0'>
        <thead>
            <th>Test</th>
            <th>Result</th>
        </thead>
        <tbody class='table-head'>
            ${Object.keys(resultsObject)
                .filter(key => !['id', 'date', 'table_name', 'pat_id'].includes(key))
                .map(key => `
                    <tr>
                        <th>${columns[key]}</th>
                        <td>${resultsObject[key]}</td>
                    </tr>
                `).join('') /* Use join('') to convert array to string */
            }
            <tr>
                <th>Actions</th>
                <td class='d-flex items-center justify-content-around' data-label='Action'>
                    <a class="btn mgb" href='./edit.php?id=${resultsObject.id}'>Edit</a> 
                    <span>
                        <a class="btn mgb" href='../../backend/delete_det.php?id=${resultsObject.id}&pat_id=${resultsObject.pat_id}'>X</a>
                    </span>
                </td>
            </tr>
        </tbody>
    </table>
`;

							// Now 'ul' contains the HTML string with edit and delete links, where the 'id' parameter is dynamically added based on the 'resultsObject.id'.



							const html = `
                        <div class="" id='result_box'>
                            <h3 class="text-center" id="result_name">${table}</h3>
                            ${ul}
                        </div>
                    `;
							// Append the HTML to the container
							container.innerHTML += html;
						}
					}
				} else {
					console.error('Invalid data format:', data);
				}
			})
			.catch(error => console.log(error))
	}

	function fetchResult() {
		const id = document.getElementById("pat_id").value;
		const date = document.getElementById("selectDate").value;
		const container = document.getElementById('lab_result');
		container.innerHTML = '';
		fetchResults(date, id)
	}
</script>
