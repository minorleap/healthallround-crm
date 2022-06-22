<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/security.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/application.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.open.php"); ?>
<?php $pageTitle = "Report"; ?>
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
					<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
						<h1 class="h2"><i class="fas fa-chart-pie"></i> Client List Report</h1>
					</div>
					<div class="card">
						<div class="card-header">
							<div class="row">
								<h5>
									<div class="col"><i class="fas fa-filter"></i>&nbsp;&nbsp;Filter</div>								
								</h5>
							</div>
						</div>
						<div class="card-body">
							<div class="row">								
								<div class="col-3">
									<h6>Ethnicity</h6>
									<?php
									$sql = "SELECT `id`, `description` FROM `ethnic_group` WHERE `is_enabled`=1 ORDER BY `id`;";
									$result = $conn->query($sql);
									while($row = $result->fetch_assoc()){
										$id = $row['id'];
										$description = $row['description'];
										echo "
										<div class='form-check'>
											<input class='form-check-input' type='checkbox' id='ethnicity_id_$id' name='ethnicity_id'>
											<label class='form-check-label' for='ethnicity_id_$id'>$description</label>
										</div>
										";
									}
									?>
									<br>
								</div>						
								<div class="col-3">
									<h6>Gender</h6>
									<?php
									$sql = "SELECT `id`, `description` FROM `gender` WHERE `is_enabled`=1 ORDER BY `id`;";
									$result = $conn->query($sql);
									while($row = $result->fetch_assoc()){
										$id = $row['id'];
										$description = $row['description'];
										echo "
										<div class='form-check'>
											<input class='form-check-input' type='checkbox' id='gender_id_$id'>
											<label class='form-check-label' for='gender_id_$id'>$description</label>
										</div>
										";
									}
									?>											
								</div>
								<div class="col-3">
									<h6>Residency Status</h6>
									<?php
									$sql = "SELECT `id`, `description` FROM `residency_status` WHERE `is_enabled`=1 ORDER BY `id`;";
									$result = $conn->query($sql);
									while($row = $result->fetch_assoc()){
										$id = $row['id'];
										$description = $row['description'];
										echo "
										<div class='form-check'>
											<input class='form-check-input' type='checkbox' id='residency_status_id_$id'>
											<label class='form-check-label' for='residency_status_id_$id'>$description</label>
										</div>
										";
									}
									?>											
								</div>									
							</div>
							<div class="row">
								<div class="col-3">
									<button type="button" id="submit_btn" class="btn btn-primary"><i class="fas fa-search"></i> View</button>
								</div>
							</div>	
						</div>
					</div>
					<br>
					<div class="card">
						<div class="card-header">
							<div class="row align-items-center">
								<h5>
									<div class="col"><i class="fas fa-database"></i>&nbsp;&nbsp;Results</div>								
								</h5>
							</div>
						</div>
						<div class="card-body">
							<table class="table table-striped table-sm table-fixed" id="clients_table">
								<thead>
									<tr>
										<th>Last Name</th>
										<th>First Name</th>
										<th>ID</th>										
										<th>Address</th>								
										<th>Telephone</th>
										<th>Date of Birth</th>
										<th>Gender</th>
										<th>Ethnicity</th>
										<th>Residency Status</th>
									</tr>
								</thead>
								<tbody id='table_body'>
								</tbody>
							</table>
						</div>
					</div>
					<br>
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
			
			$(document).ready(function(){
				document.getElementById('submit_btn').addEventListener("click", function(event){
  					event.preventDefault();
					submit_query();
				});
			});	
			
			function submit_query() {
				
				// create arrays of IDs for the checked items in each category
				var fields = {}
				fields['ethnicity'] = $('[id^=ethnicity_id]:checked').toArray().map(function(e){return e.id.split('_')[2];}).toString();
				fields['gender'] = $('[id^=gender_id]:checked').toArray().map(function(e){return e.id.split('_')[2];}).toString();;
				fields['residency_status'] = $('[id^=residency_status]:checked').toArray().map(function(e){return e.id.split('_')[3];}).toString();
				$.post("ajax/report.clients.php", fields)
					.done(function(data){
						$("#table_body").html(data);
					})
			}
		</script>
	</body>
</html>

<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>
