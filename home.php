<!DOCTYPE html>
<?php
	require_once "pdo.php";
	
	if($userData["employeeid"]) {
		$activities = getSQLData("Call Get_Supervisor_Activities({$userData['personid']})");
		$userData["studentid"] = 0;
	}
	elseif ($userData["studentid"]) {
		$activities = getSQLData("Call Get_Student_Activities({$userData['studentid']})");
	}
	else {
		$activities = getSQLData("Call Get_Supervisor_Activities({$userData['personid']})");
		$userData["studentid"] = 0;
	}
?>

<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<meta name="robots" content="noindex,nofollow">
		<meta name="description" content="" />
		<meta name="author" content="" />
		<title>Dashboard - reckrds</title>
		<link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
		<link href="/scaleSite/css/styles.css" rel="stylesheet" />
		<link href="/scaleSite/css/scaleStyle.css" rel="stylesheet"/>
		<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
	</head>
	<body class="sb-nav-fixed">
		<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
			<!-- Navbar Brand-->
			<a class="navbar-brand ps-3" href="/">reckrds</a>
			<!-- Sidebar Toggle-->
			<button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
			<!-- Navbar Search-->
			<form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
				<!-- <div class="input-group">
					<input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
					<button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
				</div> -->
			</form>
			<!-- Navbar-->
			<ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
					<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
						<li><a class="dropdown-item" href="#!">Settings</a></li>
						<li><a class="dropdown-item" href="#!">Activity Log</a></li>
						<li><hr class="dropdown-divider" /></li>
						<li><a class="dropdown-item" href="/logout.php">Logout</a></li>
					</ul>
				</li>
			</ul>
		</nav>
		<div id="layoutSidenav">
			<div id="layoutSidenav_nav">
				<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
					<div class="sb-sidenav-menu">
						<div class="nav">
							<div class="sb-sidenav-menu-heading">Home</div>
							<a class="nav-link" href="/scaleSite/home.php">
								<div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
								Home
							</a>
		
							<div class="sb-sidenav-menu-heading">Student Modules</div>
							<a class="nav-link" href="/scaleSite/evaluate.php">
								<div class="sb-nav-link-icon"><i class="fas fa-chalkboard-user"></i></div>
								Teacher Performance
							</a>
							
							<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
								<div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
								Attendance Record
								<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
							</a>

							<!--All modules below should ideally be placed in one expanding module-->
							<div class="sb-sidenav-menu-heading">SCALE Modules</div>
							<a class="nav-link" href="/scaleSite/scale/mySCALE.php">
								<div class="sb-nav-link-icon"><i class="fas fa-chalkboard-user"></i></div>
								My SCALE
							</a>
							<a class="nav-link" href="/scaleSite/scale/scaleFAQ.php">
								<div class="sb-nav-link-icon"><i class="fas fa-chalkboard-user"></i></div>
								SCALE FAQ
							</a>
						</div>
					</div>
					<div class="sb-sidenav-footer">
						<div class="small">Logged in as:</div>
						b2025bigchungus@pshs.edu.ph
					</div>
				</nav>
			</div>
			<div id="layoutSidenav_content">
				<main>
					<!--

					#####################################
					#	We code in this block - Adam	#
					#####################################

					-->
					<div class="container-fluid px-4">
						<h1 class="mt-4">Dashboard</h1>
						<ol class="breadcrumb mb-4">
							<li class="breadcrumb-item active">Dashboard</li>
						</ol>
						<div class="row">
							<div class="col-xl-3 col-md-6">
								<div class="card bg-primary text-white mb-4">
									<div class="card-body">Evaluations</div>
									<div class="card-body">Teaching Performance Evaluations will be made available on 28 May 2024 at 5.00p. Click on the link on the navigation bar when the service is ready.</div>
								</div>
							</div>
						</div>

						<!-- My SCALE (Adult Supervisors)-->
						<ol class="breadcrumb mb-4">
							<li class="breadcrumb-item active">My SCALE</li>
						</ol>

						<div class="row">
							<?php foreach ($activities as $activity) { $activityid = $activity["activityid"]; ?>
								<div class="col-xl-3 col-lg-4 col-md-6">
									<div class="card mb-4 border-dark">
										<div class="card-header bg-primary border-dark">
											<h6 class="card-title align-middle text-white"><?= $activity["activityname"] ?></h6>
										</div>
										<div class="card-body">
											<div class="mb-1">
												<?php
													$activitystrands = getSQLData("Call get_activity_strands($activityid, {$userData['studentid']})");

													foreach($activitystrands as $strand) {
														echo "<span class='badge activityStrandBadge'>".$strand["scalereqshortname"]."</span>";
													}
												?>
											</div>
											<div class="mb-2">
												<?php
												$activitylos = getSQLData("Call get_activity_los($activityid, {$userData['studentid']})");

												foreach($activitylos as $lo) {
													echo "<span class='badge activityLOBadge scale".$lo["scalereqshortname"]."' style='height: 20px; width: 20px;'>".substr($lo["scalereqshortname"], 2)."</span>";
												}
												?>
											</div>
											<div class="row mb-2">
												<span class="badge activityNotification">
													New Submissions
													<span class="activityNotificationDot">New alerts</span>
												</span>
												<span class="badge activityNotification">
													New Applications
													<span class="activityNotificationDot">New alerts</span>
												</span>
												<span class="badge activityNotification">
													Information Edited
													<span class="activityNotificationDot">New alerts</span>
												</span>
											</div>
											<a href="scale/mySCALE.php#<?= $activity["activityname"] ?>Card" type="button" class="btn btn-primary scaleActivityMore">View More</a>
										</div>
									</div>
								</div>

							<?php } ?>
						</div>
						
					</div>
				</main>
				<footer class="py-4 bg-light mt-auto">
					<div class="container-fluid px-4">
						<div class="d-flex align-items-center justify-content-between small">
							<div class="text-muted">Copyright &copy; Philippine Science High School Main Campus</div>
							<div>
								<a href="#">Privacy Policy</a>
								&middot;
								<a href="#">Terms &amp; Conditions</a>
							</div>
						</div>
					</div>
				</footer>
			</div>
		</div>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
		<script src="/scaleSite/js/scripts.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
	</body>
</html>
