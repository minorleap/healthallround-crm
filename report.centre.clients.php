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
						<h1 class="h2"><i class="fas fa-chart-pie"></i> Number of Clients Using Centre</h1>
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
								<div class="col-2">
									<h6>Start Date</h6>
									<input type="text" class="form-control form-control-sm" id="start_date" name="start_date">
									<br>
									<button type="submit" id="submit_btn" class="btn btn-large btn-primary"><i class="fas fa-search"></i> View</button>
								</div>
								<div class="col-2">
									<h6>End Date</h6>
									<input type="text" class="form-control form-control-sm" id="end_date" name="end_date">
								</div>								
							</div>
						</div>
					</div>
					<br>
					<div class="card">
						<div class="card-header">
							<div class="row">
								<h5>
									<div class="col"><i class="fas fa-database"></i>&nbsp;&nbsp;Results</div>								
								</h5>
							</div>
						</div>
						<div class="card-body">
							<table class="table table-striped table-sm table-fixed" id="clients_table">
								<thead>
									<tr>
										<th>ID</th>											
										<th>Last Name</th>
										<th>First Name</th>									
										<th>Address</th>
										<th>Ethnic Group</th>
										<th>Residency Status</th>
										<th>Number of Times</th>
									</tr>
								</thead>
								<tbody id='table_body'>
									
								</tbody>
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
				document.getElementById('submit_btn').addEventListener("click", function(event){
  					event.preventDefault();
					submit_query();
				});
				
				$('#start_date, #end_date').datepicker({
    				format: "dd/mm/yyyy",
					   orientation: "left bottom"
				});
			
			});	
			
			function submit_query() {
				
				// create arrays of IDs for the checked items in each category
				var start_date = $("#start_date").val();
				var end_date = $("#end_date").val();
				$.post("ajax/report.centre.clients.php", {
					  start_date:start_date,
					  end_date:end_date
					})
					.done(function(data){
						$("#table_body").html(data);
					})
			}
		</script>
	</body>
</html>

<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>
