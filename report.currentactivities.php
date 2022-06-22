<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/security.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/application.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.open.php"); ?>
<?php $pageTitle = "Report: Current Activities"; ?>
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
						<h1 class="h2"><i class="fas fa-chart-pie"></i> Reports</h1>
					</div>
					<div class="card">
						<div class="card-header">
							<div class="row align-items-center">
								<h5>
									<div class="col"><i class="fas fa-users"></i> Clients</div>								
								</h5>
							</div>					
						</div>
						<div class="card-body">
							<table class="table table-striped table-sm table-fixed" id="activities_table">
								<thead>
									<tr>
										<th>ID</th>
										<th>Name</th>
										<th>Start Date</th>
										<th>End Date</th>
										<th>Weekday</th>									
										<th>Start Time</th>
										<th>Duration (Hours)</th>
										<th>Organiser</th>
										<th>Capacity</th>
										<th>Frequency</th>
										<th>Contact Details</th>
										<th>Action</th>
									</tr>
								</thead>
							</table>
						</div>
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
			
			$(document).ready(function(){
				
				
				$('#activities_table').DataTable({
					"processing": true,
        			"serverSide": true,
					"ajax":"ajax/report.currentactivities.php",
					"responsive": true,
					"order":[[1,"asc"]],
					"columnDefs": [
						{responsivePriority: 1, targets: [1,2,3,4]},
						{width: 60, targets: [11]},
						{visible: false, targets: [0]}
					],
					
				});

			});						

			function view_activity(activity_id){
				$.post("ajax/activity.select.php", {
					activity_id:activity_id
				})
				.done(function(data){
					window.location.replace("activity.php");
				})				
			}
			
		</script>
	</body>
</html>

<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>
