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
						<form action="index.php" class="search">
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
											<input type="hidden" name="id" value="<?php echo $phone;?>">
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
											<input type="hidden" name="id" value="<?php echo $phone;?>">
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
									if($org == null){
										$org = "Self";
									}else if ($org == "stc"){
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
							$rs = $conn->query($search_sql);
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
									</thead>
									";
							if ($rs) {
								while ($result = $rs->fetch_assoc()) {
									$bp = $result['BP'];
									$pr = $result['PR'];
									$saturation = $result['saturation'];
									$respiratory = $result['respiratory'];
									$temp = $result['temprature'];
									$height = $result['height'];
									$weight = $result['weight'];
									$head = $result['head_circum'];
									$muac = $result['MUAC'];
									$date = $result['date'];
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
													</tr>
												</tbody>
												";
								}
							}

						?>
							</table>
							<div class="center-btn">
								</div>
								<?php
							$pat_det = "SELECT * FROM `pat_detail` WHERE `pat_id` = '$pat_id' ORDER BY `id` DESC";
							$re = $conn->query($pat_det);
							while ($det = $re->fetch_assoc()) {
								// $date = $det['date'];
								// $detail = $det['detail'];
								?>
									<h3>Patient Detail</h3>
								<table class='table'>

									<thead>
										<th>Date</th>
										<td><?php echo @$det['date']; ?></td>
									</thead>
									<thead>
										<th>C/c</th>
										<td><?php echo @$det['cc']; ?></td>
									</thead>
									<thead>
										<th>Duration</th>
										<td><?php echo @$det['dt']; ?></td>
									</thead>
									<thead>
										<th>Major Associated symptoms</th>
										<td><?php echo @$det['sy']; ?></td>
									</thead>
									<thead>
										<th>Other important symptoms</th>
										<td><?php echo @$det['imp']; ?></td>
									</thead>
									<thead>
										<th>Any Taken Medication</th>
										<td><?php echo @$det['md']; ?></td>
									</thead>
									<thead>
										<th>Current Nutrition</th>
										<td><?php echo @$det['cn']; ?></td>
									</thead>
									<thead>
										<th>Previous Similar Cases</th>
										<td><?php echo @$det['pc']; ?></td>
									</thead>
									<thead>
										<th>Vaccination HX</th>
										<td><?php echo @$det['vh']; ?></td>
									</thead>
									<thead>
										<th>Any known Allergy</th>
										<td><?php echo @$det['aka']; ?></td>
									</thead>
									<thead>
										<th>Pertinent Physical Exam</th>
										<td><?php echo @$det['lab']; ?></td>
									</thead>
									<thead>
										<th>Possible DX</th>
										<td><?php echo @$det['dx']; ?></td>
									</thead>
									<thead>
										<th>RX Given</th>
										<td><?php echo @$det['rx']; ?></td>
									</thead>
									<thead>
										<th>Action</th>
										<td><a class="btn mgb" href="edit.php?id=<?php echo @$det['id']; ?>">Edit</a></td>
									</thead>

								</table>

							<?php
							}
							?>
							<div class="action">
								<button class="btn btn-primary" id="btn-lab">Laboratory</button>
								<button class="btn btn-primary" id="btn-detail">Detail</button>
								<?php echo "<a class='btn btn-primary'href='labresu.php?id=$pat_id'>Lab Result</a>" ?>
								<?php echo "<a class='btn btn-primary'href='lab_req.php?id=$pat_id'>Lab Request</a>" ?>
								<?php echo "<a class='btn btn-primary'href='ultraresu.php?id=$pat_id'>Ultrasound Result</a>" ?>
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
												<input type="text" name="cc">
												<label for="dt">Duration</label>
												<input type="text" name="dt">
												<label for="sy">Major Associated symptoms</label>
												<input type="text" name="sy">
												<label for="imp">Other important symptoms</label>
												<input type="text" name="imp">
												<label for="md">Any taken Medication</label>
												<input type="text" name="md">
												<label for="cn">Current Nutrition</label>
												<input type="text" name="cn">


											</div>
											<div class="column">
												<label for="pc">Previous Similar Cases</label>
												<input type="text" name="pc">
												<label for="vh">Vaccination HX</label>
												<input type="text" name="vh">
												<label for="aka">Any known Allergy</label>
												<input type="text" name="aka">
												<label for="lab">Pertinent Physical Exam</label>
												<input type="text" name="lab">
												<label for="dx">Possible DX</label>
												<input type="text" name="dx">
												<label for="rx">RX Given</label>
												<input type="text" name="rx">
												<input type="hidden" name="pat_id" value="<?php echo $pat_id; ?>">
											</div>
											<input type="submit" value="Add Detail" name="submit" class="btn btn-primary" />
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
												<input type="checkbox" id="csf" name="lab[]" value="csf_Felix">
												<label for="csf">CSF Analayzer</label><br>
											</th>
											<th>
												<input type="checkbox" id="liver" name="lab[]" value="liver_viral">
												<label for="liver">Liver Viral Markers</label><br>
											</th>
											<th>
												<input type="checkbox" id="h_pylori" name="lab[]" value="h_pylori">
												<label for="h_pylori">H.Pylori Tests</label><br>
											</th>
											<th>
												<input type="checkbox" id="blood_f" name="lab[]" value="blood_f">
												<label for="blood_f">Blood Film</label><br>
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
												<input type="checkbox" id="abus" name="brands[]" value="Abdominal">
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
												<input type="checkbox" id="trans_fontanelle" name="brands[]" value="Trans_Fontanelle">
												<label for="trans_fontanelle">Trans Fontanelle</label><br>
											</th>
											<th>
												<input type="checkbox" id="other" name="brands[]" value="other">
												<label for="other">Trans Fontanelle</label><br>
											</th>
										</thead>
									</table>
									<div class="ultra-detail">

										<div id="abus-text" class="form-element hide">
											<label for="abdo">Abdominal</label>
											<textarea name="abdo" id="abdo" cols="30" rows="10"></textarea>
										</div>
										<div id="bus-text" class="form-element hide">
											<label for="breast">Breast</label>
											<textarea name="breast" id="breast" cols="30" rows="10"></textarea>
										</div>
										<div id="neck-text" class="form-element hide">
											<label for="neck">Neck</label>
											<textarea name="neck" id="neck" cols="30" rows="10"></textarea>
										</div>
										<div id="scrotal-text" class="form-element hide">
											<label for="scrotal-det">Scrotal</label>
											<textarea name="scrotal_det" id="scrotal-det" cols="30" rows="10"></textarea>
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
											<input type="hidden" name="id" value="<?php echo $phone;?>">
											<textarea name="adm_detail" id="adm-detail" cols="30" rows="10"></textarea>
											<input type="submit" value="Send" name="lab_det" class="btn">
										</form>
									</div>
						<?php
						}
						?>
					</div>
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
</script>