<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/security.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/application.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.open.php"); ?>
<?php $pageTitle = "Clients"; ?>
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
						<h1 class="h2"><i class="fas fa-users"></i> Clients</h1>
					</div>
					<div class="card">
						<h5 class="card-header">
							<div class="row align-items-center">
								<div class="col"><i class="fas fa-users"></i> All Clients</div>
							</div>
						</h5>
						<div class="card-body">
							<table class="table table-striped table-sm table-fixed" id="clients_table">
								<thead>
									<tr>
										<th>ID</th>
										<th>Name</th>
										<th>Address</th>
										<th>Telephone</th>
										<th>Mobile</th>
										<th>Email</th>
										<th>D.O.B.</th>
										<th>Action</th>
									</tr>
								</thead>
							</table>
						</div>
						<div class="card-footer text-muted">	
							<a href="client.new.php" class="btn btn-primary"><i class='fas fa-plus'></i> New Client</a>
						</div>
					</div>	
				</main>
			</div>
		</div>
		
		<?php // Add Scripts
		include("includes/scripts.php"); ?>

		<script>

			$(document).ready(function(){
				$('#clients_table').DataTable({
					"processing": true,
        			"serverSide": true,
					"ajax":"ajax/client.list.php",
					"responsive": true,
					"order":[[1,"asc"]],
					"columnDefs": [
						{responsivePriority: 1, targets: [1,2,3,4]},
						{width: 70, targets: [7]},
						{visible: false, targets: [0]}
					]
				});
			});						

			function edit_client(client_id){
				$.post("ajax/client.select.php", {
					client_id:client_id
				})
				.done(function(data){
					window.location.replace("client.php");
				})				
			}
			
		</script>
	</body>
</html>

<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>
