<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/security.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/application.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.open.php"); ?>
<?php $pageTitle = "Activities"; ?>
<!doctype html>
<html lang="en">
	<?php // Add HTML Head with CSS Links
	include("includes/head.php"); ?>
	<body>
		<?php // Add Top Navigation
		include("includes/navigation.top.php"); ?>
		<div class="container-fluid">
			<div class="row">
				<?php // Add Left Navigation
				include("includes/navigation.left.php"); ?>
				
				<!-- Content -->
				<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
					<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
						<h1 class="h2"><i class="fas fa-tasks"></i> Activities</h1>
					</div>
					<div class="card">
						<h5 class="card-header">
							<div class="row align-items-center">
								<div class="col"><i class="fas fa-tasks"></i> Archived Activities</div>
							</div>
						</h5>
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
						<div class="card-footer text-muted">	
							<a href="activities.php" class="btn btn-danger"><i class='fas fa-backward'></i> Back</a>
						</div>
					</div>	
				</main>
			</div>
		</div>
		
		<?php // Add Scripts
		include("includes/scripts.php"); ?>
	
		<script>

			$(document).ready(function(){
				
				
				$('#activities_table').DataTable({
					"processing": true,
        			"serverSide": true,
					"ajax":"ajax/activity.archived.list.php",
					"responsive": true,
					"order":[[0,"desc"]],
					"columnDefs": [
						{responsivePriority: 1, targets: [1,2,3,4]},
						{width: 75, targets: [11]},
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
