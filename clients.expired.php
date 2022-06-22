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
								<div class="col"><i class="fas fa-users"></i> Expired Clients</div>
							</div>
						</h5>
						<div class="card-body">
							<table class="table table-striped table-sm table-fixed" id="expired_clients_table">
								<thead>
									<tr>
										<th>ID</th>
										<th>Name</th>
										<th>Action</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>	
				</main>
			</div>
		</div>
		
		<!-- Confirmation Modal -->		
		<div class="modal fade" id="confirm_modal" tabindex="-1" role="dialog" aria-labelledby="modal_center_title" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modal_center_title">Delete Client</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<span id="modal_body">Are you sure you want to delete this client?</span>
					</div>
						<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
						<button type="button" class="btn btn-danger" id="confirm_del_btn">Delete</a>
					</div>
				</div>
			</div>
		</div>
		
		<?php // Add Scripts
		include("includes/scripts.php"); ?>

		<script>

			$(document).ready(function(){
				$('#expired_clients_table').DataTable({
					"processing": true,
        			"serverSide": true,
					"ajax":"ajax/client.expired.list.php",
					"responsive": true,
					"order":[[1,"asc"]],
					"columnDefs": [
						{responsivePriority: 1, targets: [1,2]},
						{width: 70, targets: [2]},						
						{visible: false, targets: [0]}
					]
				});
			});						

			function delete_client(client_id) {
				$("#confirm_del_btn").off("click");
				$("#confirm_del_btn").click(function() {
					$.post("ajax/client.delete.php", {
						client_id:client_id
					})
					.done(function(data){
						$("#confirm_modal").modal('hide');
					})
				});
				$("#modal_body").html("Are you sure you wish to delete this client?");
				$("#confirm_modal").modal();
			}
			
		</script>
	</body>
</html>

<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>
