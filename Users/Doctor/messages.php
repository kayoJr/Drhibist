<?php
require_once "../../backend/db.php";
require '../../backend/auth.php';
@$status = @$_GET['status'];
if ($status) {
	$sql = $conn->query("UPDATE `nurse_message` SET `status` = 1");
}
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
	<link rel="stylesheet" href="../styles/style.css" />
	<link rel="stylesheet" href="../styles/responsive.css" />
	<link rel="stylesheet" href="../styles/bootstrap-select.css" />
	<link rel="stylesheet" href="../styles/perfect-scrollbar.css" />
	<link rel="stylesheet" href="../styles/custom.css" />
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
								$phone = $_SESSION['user'];
								$sql = "SELECT * FROM `users` WHERE `phone` = '$phone'";
								$res = $conn->query($sql);
								while ($row = mysqli_fetch_assoc($res)) {
									$name = $row['name'];
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
						<h2 class="center">Messages To Nurses</h2>
					</div>
					<form class="mgb" action="messages.php" method="GET">
						<div class="form-elements">
							<input type="date" name="date" id="date">
							<input type="submit" value="Search" name="search" class="btn mgt btn-primary">
						</div>
					</form>
					<?php
					if (isset($_GET['search'])) {
						$date = $_GET['date'];
						// if ($date == '') {
						// 	$date = date("Y-m-d");
						// }

					?>
						<div class="doc_message">
							<?php
							$sql = $conn->query("SELECT * FROM `nurse_message` WHERE `date` = '$date' ORDER BY `id` DESC");
							if ($sql) {
								while ($row = $sql->fetch_assoc()) {
									$msg_id = $row['id'];
									$id = $row['patient_id'];
									$detail = $row['detail'];
									$date = $row['date'];
									$adm_status = "Waiting Patient";
									$adm = $conn->query("SELECT * FROM `admission` WHERE `pat_id`='$id'");
									while ($row2 = $adm->fetch_assoc()) {
										$adm_pat = $row2['pat_id'];

										if ($id == $adm_pat) {
											$adm_status = "Admitted Patient";
										} else {
											$adm_status = "Waiting Patient";
										}
									}
									$info = $conn->query("SELECT * FROM `patient` WHERE `id` = '$id'");
									while ($infoo = $info->fetch_assoc()) {
										$name = $infoo['name'];
							?>

										<div class='message_element'>
											<div class='info'>
												<h4><?php echo $name; ?></h4>
												<h4>Card No:<?php echo $id; ?></h4>
												<h4><?php echo $date; ?></h4>
												<h4><?php echo $adm_status; ?></h4>
											</div>
											<div class='message_detail'>
												<!-- <p><?php echo $detail; ?>
											</p> -->
												<textarea type="text" readonly name="msg_det" id="msg_det" value=""><?php echo $detail; ?> </textarea>
											</div>
											<div class="actions">
												<p class="hidden" id="msg_id"><?php echo $msg_id; ?></p>
												<button id="delete" class="delete">Delete</button>
												<button id="edit" class="edit">edit</button>
											</div>
										</div>

							<?php
									}
								}
							}
							?>
						</div>

					<?php
					} else {
					?>
						<div class="doc_message">
							<?php
							$date = date("Y-m-d");
							$sql = $conn->query("SELECT * FROM `nurse_message` WHERE `date` = '$date' ORDER BY `id` DESC");
							if ($sql) {
								while ($row = $sql->fetch_assoc()) {
									$msg_id = $row['id'];
									$id = $row['patient_id'];
									$detail = $row['detail'];
									$date = $row['date'];
									$adm_status = "Waiting Patient";
									$adm = $conn->query("SELECT * FROM `admission` WHERE `pat_id`='$id'");
									while ($row2 = $adm->fetch_assoc()) {
										$adm_pat = $row2['pat_id'];

										if ($id == $adm_pat) {
											$adm_status = "Admitted Patient";
										} else {
											$adm_status = "Waiting Patient";
										}
									}
									$info = $conn->query("SELECT * FROM `patient` WHERE `id` = '$id'");
									while ($infoo = $info->fetch_assoc()) {
										$name = $infoo['name'];
							?>

										<div class='message_element'>
											<div class='info'>
												<h4><?php echo $name; ?></h4>
												<h4>Card No:<?php echo $id; ?></h4>
												<h4><?php echo $date; ?></h4>
												<h4><?php echo $adm_status; ?></h4>
											</div>
											<div class='message_detail'>
												<!-- <p><?php echo $detail; ?>
											</p> -->
												<textarea type="text" readonly name="msg_det" id="msg_det" value=""><?php echo $detail; ?> </textarea>
											</div>
											<div class="actions">
												<p class="hidden" id="msg_id"><?php echo $msg_id; ?></p>
												<button id="delete" class="delete">Delete</button>
												<button id="edit" class="edit">edit</button>
											</div>
										</div>
							<?php
									}
								}
							}
							?>
						</div>

					<?php
					}
					?>
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script>
		const deleteBtn = document.querySelectorAll('.delete');
		const editBtn = document.querySelectorAll('.edit');
		const editField = document.getElementById('msg_det');
		const msg_id = document.getElementById('msg_id');

		// editField.style.height = 'auto';
		const scrollHeight = editField.scrollHeight;
		editField.setAttribute('rows', Math.floor(scrollHeight / 40))
		editField.addEventListener('input', () => {
			const scrollHeight = editField.scrollHeight;
			editField.setAttribute('rows', Math.ceil(scrollHeight / 50))
			editField.style.height = scrollHeight + 'px';
		})

		deleteBtn.forEach(deleteItem => {
			deleteItem.addEventListener('click', () => {
				const msgId = deleteItem.parentNode.querySelector('#msg_id').textContent;
				$.ajax({
					url: 'https://drhibistpedriatician.com/backend/delMsg.php?id=' + msgId,
					type: 'GET',
					success: (res) => {
						window.location.reload();
					},
					error: (error) => {
						console.log(error);
					}
				})
			})
		})
		editBtn.forEach(editItem => {
			editItem.addEventListener('click', () => {
				const messageContent = editItem.parentElement.previousElementSibling;
				const textarea = messageContent.querySelector('#msg_det')
				textarea.removeAttribute('readonly')
				if (!textarea.hasAttribute('readonly')) {
					textarea.focus()
					editItem.classList.add('msg_field')
					editItem.innerText = 'Update'
				}
				const msg_field = document.querySelector('.msg_field');
				const msgId = editItem.parentNode.querySelector('#msg_id').textContent;
				msg_field.addEventListener('click', () => {
					$.ajax({
						url: 'https://drhibistpedriatician.com/backend/updMsg.php?id=' + msgId,
						type: 'POST',
						data: {
							id: msgId,
							detail: textarea.value
						},
						success: (res) => {
							window.location.reload();
						},
						error: (error) => {
							console.log(error);
						}
					})
				})

			})
		})

		// editBtn.addEventListener('click', () => {
		// 	editField.removeAttribute('readonly')
		// 	if (!editField.hasAttribute('readonly')) {
		// 		editField.focus()
		// 		editBtn.classList.add('msg_field')
		// 		editBtn.innerText = 'Update'
		// 	}
		// 	const msg_field = document.querySelector('.msg_field');
		// 	msg_field.addEventListener('click', () => {
		// 		$.ajax({
		// 			url: 'http://localhost/drhibist/backend/updMsg.php?id=' + msg_id.textContent,
		// 			type: 'POST',
		// 			data: {
		// 				id: msg_id.textContent,
		// 				detail: editField.value
		// 			},
		// 			success: (res) => {
		// 				window.location.reload();
		// 			},
		// 			error: (error) => {
		// 				console.log(error);
		// 			}
		// 		})
		// 	})
		// })
	</script>
</body>

</html>