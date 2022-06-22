<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/security.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/application.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.open.php"); ?>
<?php $pageTitle = "Services"; ?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<title><?php echo $pageTitle; ?></title>
		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.css" rel="stylesheet">
		<!-- Bootstrap Datepicker CSS -->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
		<!-- Datatables CSS -->
		<link href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.css" rel="stylesheet">
		<!-- Application CSS -->
		<link href="css/application.css" rel="stylesheet">
	</head>
	<body>
		<!-- Top Navigation -->
		<?php include("includes/navigation.top.php"); ?>
		<div class="container-fluid">
			<div class="row">
				<!-- Left Navigation -->
				<?php include("includes/navigation.left.php"); ?>
				<!-- Content -->
				<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
					
					<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
						<h1 class="h2"><i class="fas fa-user"></i> Services</h1>
					</div>

					<div class="table-responsive col-12">
						<table class="table table-striped table-sm table-fixed" id="services_table">
							<thead>
								<tr>
									<th>Description</th>
									<th>Enabled</th>
									<th>ACTION</th>
								</tr>
							</thead>
							<tbody>
							<?php
							$sql = "SELECT `id`, `description`, `is_enabled` FROM `services`;";
							$result = $conn->query($sql);
							while($row = $result->fetch_assoc()){
								$id = $row['id'];
								$description = $row['description'];
								$is_enabled = $row['is_enabled'];
								$editBtn = '<button type="button" class="btn btn-sm btn-primary contact_table" onclick="edit_service('. $id . ')"><i class="fas fa-pencil"></i></button>';
								echo "<tr><td>$description</td><td>$is_enabled</td><td>$editBtn</td></tr>";
							}
							?>
							</tbody>
						</table>
					</div>
				</main>
			</div>
		</div>
		
		<!-- jQuery Script -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<!-- Bootstrap Script -->
		<script src="js/bootstrap.js"></script>
    	<!-- jQuery Validate Script -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
		<!-- Bootstrap Datepicker Script -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
		<!-- fontawesome Script -->
		<script src="https://kit.fontawesome.com/251aff9797.js" crossorigin="anonymous"></script>
		<!-- Responsive Datatable Script -->
		<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js" type="text/javascript"></script>
		<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>
		<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js" type="text/javascript"></script>
		<script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js" type="text/javascript"></script>
	
		<script>

			function edit_service(id){
				window.location.replace("service.php?id=" + id);
			}
			
		</script>
	</body>
</html>

<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>
