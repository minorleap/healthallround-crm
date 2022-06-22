<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/security.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/application.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.open.php"); ?>
<?php $pageTitle = "Reports"; ?>
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
						<h1 class="h2"><i class="fas fa-chart-pie"></i> Reports</h1>
					</div>
					
					<div class="container-fluid m-0 p-0">
						
						<div class="row">
							<div class="col-4">
									
							</div>
							<div class="col-4">
								
							</div>
							<div class="col-4">

							</div>
						</div>
					</div>
					
					
					
				</main>
			</div>
		</div>
		
		<?php // Add Scripts
		include("includes/scripts.php"); ?>
	
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
