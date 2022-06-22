<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/security.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/application.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.open.php"); ?>
<?php $pageTitle = "New GAD 07"; ?>

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
				<?php $client_id = $_SESSION['client_id']; ?>
				<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
					<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
						<h1 class="h2"><i class='fas fa-plus'></i> New Measurement</h1>
					</div>
					<div class="card">
						<h5 class="card-header">
							<div class="row align-items-center">
								<div class="col">
									<i class="fas fa-tasks"></i>&nbsp;&nbsp;GAD 07
								</div>
							</div>
						</h5>
						<div class="card-body">
							<!-- Form - Add GAD 07 -->
							<form role="form" id="add_form" name="add_form" method="post">
								<div class="form-group row">
									<label for="client_id" class="col-sm-2 col-form-label col-form-label-sm">Client</label>
									<div class="col-sm-3">
										<input type="hidden" class="form-control form-control-sm" id="client_id" name="client_id" value="<?php echo $client_id;?>">
											<?php
											$sql = "SELECT `first_name`, `last_name` FROM `clients` WHERE `id`=$client_id;";
											$result = $conn->query($sql);
											while($row = $result->fetch_assoc()){
												$client_name = $row['first_name'] . " ". $row['last_name'];
											}
											?>
										<input type="text" class="form-control form-control-sm" id="client_name" name="client_name" value="<?php echo $client_name;?>" readonly>
									</div>
								</div>
								<div class="form-group row">
									<label for="assessment_date" class="col-sm-2 col-form-label col-form-label-sm">Assessment Date</label>
									<div class="col-sm-2">
										<input type="text" class="form-control form-control-sm" id="assessment_date" name="assessment_date" value="<?php echo date("d/m/Y");?>">
									</div>
								</div>
								<h6 class='mt-5'>1: Feeling nervous, anxious or on edge</h6>
								<div class='form-group row ml-3'>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q1' id='q1_na' value='' checked>
									  <label class='form-check-label' for='q1_na'>Not Answered</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q1' id='q1_0' value='0'>
									  <label class='form-check-label' for='q1_0'>0</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q1' id='q1_1' value='1'>
									  <label class='form-check-label' for='q1_1'>1</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q1' id='q1_2' value='2'>
									  <label class='form-check-label' for='q1_2'>2</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q1' id='q1_3' value='3'>
									  <label class='form-check-label' for='q1_3'>3</label>
									</div>
								</div>
								<h6 class='mt-5'>2: Not being able to stop or control worrying</h6>
								<div class='form-group row ml-3'>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q2' id='q2_na' value='' checked>
									  <label class='form-check-label' for='q2_na'>Not Answered</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q2' id='q2_0' value='0'>
									  <label class='form-check-label' for='q2_0'>0</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q2' id='q2_1' value='1'>
									  <label class='form-check-label' for='q2_1'>1</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q2' id='q2_2' value='2'>
									  <label class='form-check-label' for='q2_2'>2</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q2' id='q2_3' value='3'>
									  <label class='form-check-label' for='q2_3'>3</label>
									</div>
								</div>
								<h6 class='mt-5'>3: Worrying too much about different things</h6>
								<div class='form-group row ml-3'>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q3' id='q3_na' value='' checked>
									  <label class='form-check-label' for='q3_na'>Not Answered</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q3' id='q3_0' value='0'>
									  <label class='form-check-label' for='q3_0'>0</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q3' id='q3_1' value='1'>
									  <label class='form-check-label' for='q3_1'>1</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q3' id='q3_2' value='2'>
									  <label class='form-check-label' for='q3_2'>2</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q3' id='q3_3' value='3'>
									  <label class='form-check-label' for='q3_3'>3</label>
									</div>
								</div>
								<h6 class='mt-5'>4: Trouble relaxing</h6>
								<div class='form-group row ml-3'>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q4' id='q4_na' value='' checked>
									  <label class='form-check-label' for='q4_na'>Not Answered</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q4' id='q4_0' value='0'>
									  <label class='form-check-label' for='q4_0'>0</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q4' id='q4_1' value='1'>
									  <label class='form-check-label' for='q4_1'>1</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q4' id='q4_2' value='2'>
									  <label class='form-check-label' for='q4_2'>2</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q4' id='q4_3' value='3'>
									  <label class='form-check-label' for='q4_3'>3</label>
									</div>
								</div>
								<h6 class='mt-5'>5: Being so restless it is hard to sit still</h6>
								<div class='form-group row ml-3'>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q5' id='q5_na' value='' checked>
									  <label class='form-check-label' for='q5_na'>Not Answered</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q5' id='q5_0' value='0'>
									  <label class='form-check-label' for='q5_0'>0</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q5' id='q5_1' value='1'>
									  <label class='form-check-label' for='q5_1'>1</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q5' id='q5_2' value='2'>
									  <label class='form-check-label' for='q5_2'>2</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q5' id='q5_3' value='3'>
									  <label class='form-check-label' for='q5_3'>3</label>
									</div>
								</div>
								<h6 class='mt-5'>6: Becoming easily annoyed or irritable</h6>
								<div class='form-group row ml-3'>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q6' id='q6_na' value='' checked>
									  <label class='form-check-label' for='q6_na'>Not Answered</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q6' id='q6_0' value='0'>
									  <label class='form-check-label' for='q6_0'>0</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q6' id='q6_1' value='1'>
									  <label class='form-check-label' for='q6_1'>1</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q6' id='q6_2' value='2'>
									  <label class='form-check-label' for='q6_2'>2</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q6' id='q6_3' value='3'>
									  <label class='form-check-label' for='q6_3'>3</label>
									</div>
								</div>
								<h6 class='mt-5'>7: Feeling afraid as if something awful might happen</h6>
								<div class='form-group row ml-3'>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q7' id='q7_na' value='' checked>
									  <label class='form-check-label' for='q7_na'>Not Answered</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q7' id='q7_0' value='0'>
									  <label class='form-check-label' for='q7_0'>0</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q7' id='q7_1' value='1'>
									  <label class='form-check-label' for='q7_1'>1</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q7' id='q7_2' value='2'>
									  <label class='form-check-label' for='q7_2'>2</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q7' id='q7_3' value='3'>
									  <label class='form-check-label' for='q7_3'>3</label>
									</div>
								</div>							
							</form>
						</div>
						
						<div class="card-footer">
							 <button type="button" class="btn btn-primary" id="add_form_save_button"><i class='fas fa-save'></i> Save</button>
							 <a href="client.php" class="btn btn-danger"><i class='fas fa-backward'></i> Back</a>
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
						<h5 class="modal-title" id="modal_center_title">Modal Title</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<span id="modal_body"></span>
					</div>
						<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
					</div>
				</div>
			</div>
		</div>		
		
		<?php // Add Scripts
		include("includes/scripts.php"); ?>

		<script>

			$(document).ready(function(){
				$('#assessment_date').datepicker({
    				format: "dd/mm/yyyy",
					   orientation: "left bottom"
				});

				$("form[name='add_form']").validate({
					rules: {
						assessment_date: {required: true, ukdate: true, minlength: 10}
					},
				  messages: {
					  assessment_date: "Please enter a valid date (dd/mm/yyyy)"
				  },
				  submitHandler: function(form) {

					var client_id = $("#client_id").val();
					var assessment_date = $("#assessment_date").val();
					var q1 = $('input[name="q1"]:checked').val();
					var q2 = $('input[name="q2"]:checked').val();
				    var q3 = $('input[name="q3"]:checked').val();
					var q4 = $('input[name="q4"]:checked').val();
					var q5 = $('input[name="q5"]:checked').val();
				    var q6 = $('input[name="q6"]:checked').val();
					var q7 = $('input[name="q7"]:checked').val();


					$.post("ajax/gad07.new.php", {
						client_id:client_id,
						assessment_date:assessment_date,
						q1:q1,
						q2:q2,
						q3:q3,
						q4:q4,
						q5:q5,
						q6:q6,
						q7:q7
						})
						.done(function(data){
							if(data.substring(0, 2)=="OK") {
								$("#modal_center_title").html("Success!");
								$("#modal_body").html("The form was successfully recorded.");
							} else {
								$("#modal_center_title").html("Update Failed!");
								$("#modal_body").html("There was a problem recording the form. [" + data +"]");
							}
							$("#confirm_modal").modal()
						})
				  }
				});

				// Add event to the save button
				$("#add_form_save_button").click(function() {
					$("#add_form").submit()
				});
			});				

		</script>
	</body>
</html>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>