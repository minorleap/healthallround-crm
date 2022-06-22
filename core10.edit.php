<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/security.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/application.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.open.php"); ?>
<?php $pageTitle = "Edit Measurement"; ?>

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
					<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
						<h1 class="h2"><i class='fas fa-edit'></i> Edit Measurement</h1>
					</div>
          
					<?php

					$data_error = 0;

					// Clean GET values to prevent SQL injection
					$core10_id = $_GET['id'];
					$core10_id = filter_var($core10_id, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

					// Validate ID
					if (!validate_string_isnumber($core10_id)) {$data_error = 1;}

					if ($data_error == 0){
						$sql = "SELECT * FROM `core10` WHERE `ID`=$core10_id";
						$result = $conn->query($sql);
						if ($result->num_rows == 1){
							while($row = $result->fetch_assoc()){
								$client_id = $row['client_id'];
								$assessment_date = date("d/m/Y", strtotime($row['assessment_date']));
								$q1 = $row['q1'];
								$q2 = $row['q2'];
								$q3 = $row['q3'];
								$q4 = $row['q4'];
								$q5 = $row['q5'];
								$q6 = $row['q6'];
								$q7 = $row['q7'];
								$q8 = $row['q8'];
								$q9 = $row['q9'];
								$q10 = $row['q10'];
							}
						} else {
							die();
						}
					}

					?>
					
					<div class="card">
						<h5 class="card-header">
							<div class="row align-items-center">
								<div class="col">
									<i class="fas fa-tasks"></i>&nbsp;&nbsp;Core 10
								</div>
							</div>
						</h5>
						<div class="card-body">
							<!-- Form - Edit Core 10 -->
							<form role="form" id="add_form" name="add_form" method="post">
								<input type="hidden" class="form-control" id="core10_id" value="<?php echo $core10_id; ?>">
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
										<input type="text" class="form-control form-control-sm" id="assessment_date" name="assessment_date" value="<?php echo $assessment_date;?>">
									</div>
								</div>
								<h6 class='mt-5'>1: I have felt tense, anxious or nervous</h6>
								<div class='form-group row ml-3'>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q1 === null? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q1' id='q1_na' value='' <?php echo $checked;?>>
									  <label class='form-check-label' for='q1_na'>Not Answered</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = ($q1 == 0 && $q1 !== null)? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q1' id='q1_0' value='0' <?php echo $checked;?>>
									  <label class='form-check-label' for='q1_0'>0</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q1 == 1? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q1' id='q1_1' value='1' <?php echo $checked;?>>
									  <label class='form-check-label' for='q1_1'>1</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q1 == 2? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q1' id='q1_2' value='2' <?php echo $checked;?>>
									  <label class='form-check-label' for='q1_2'>2</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q1 == 3? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q1' id='q1_3' value='3' <?php echo $checked;?>>
									  <label class='form-check-label' for='q1_3'>3</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q1 == 4? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q1' id='q1_4' value='4' <?php echo $checked;?>>
									  <label class='form-check-label' for='q1_4'>4</label>
									</div>
								</div>
								<h6 class='mt-5'>2: I have felt I have someone to turn to for support when needed</h6>
								<div class='form-group row ml-3'>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q2 === null? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q2' id='q2_na' value='' <?php echo $checked;?>>
									  <label class='form-check-label' for='q2_na'>Not Answered</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = ($q2 == 0 && $q2 !== null)? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q2' id='q2_0' value='0' <?php echo $checked;?>>
									  <label class='form-check-label' for='q2_0'>0</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q2 == 1? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q2' id='q2_1' value='1' <?php echo $checked;?>>
									  <label class='form-check-label' for='q2_1'>1</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q2 == 2? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q2' id='q2_2' value='2' <?php echo $checked;?>>
									  <label class='form-check-label' for='q2_2'>2</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q2 == 3? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q2' id='q2_3' value='3' <?php echo $checked;?>>
									  <label class='form-check-label' for='q2_3'>3</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q2 == 4? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q2' id='q2_4' value='4' <?php echo $checked;?>>
									  <label class='form-check-label' for='q2_4'>4</label>
									</div>
								</div>
								<h6 class='mt-5'>3: I have felt able to cope when things go wrong</h6>
								<div class='form-group row ml-3'>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q3 === null? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q3' id='q3_na' value='' <?php echo $checked;?>>
									  <label class='form-check-label' for='q3_na'>Not Answered</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = ($q3 == 0 && $q3 !== null)? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q3' id='q3_0' value='0' <?php echo $checked;?>>
									  <label class='form-check-label' for='q3_0'>0</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q3 == 1? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q3' id='q3_1' value='1' <?php echo $checked;?>>
									  <label class='form-check-label' for='q3_1'>1</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q3 == 2? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q3' id='q3_2' value='2' <?php echo $checked;?>>
									  <label class='form-check-label' for='q3_2'>2</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q3 == 3? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q3' id='q3_3' value='3' <?php echo $checked;?>>
									  <label class='form-check-label' for='q3_3'>3</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q3 == 4? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q3' id='q3_4' value='4' <?php echo $checked;?>>
									  <label class='form-check-label' for='q3_4'>4</label>
									</div>
								</div>
								<h6 class='mt-5'>4: Talking to people has felt too much for me</h6>
								<div class='form-group row ml-3'>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q4 === null? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q4' id='q4_na' value='' <?php echo $checked;?>>
									  <label class='form-check-label' for='q4_na'>Not Answered</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = ($q4 == 0 && $q4 !== null)? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q4' id='q4_0' value='0' <?php echo $checked;?>>
									  <label class='form-check-label' for='q4_0'>0</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q4 == 1? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q4' id='q4_1' value='1' <?php echo $checked;?>>
									  <label class='form-check-label' for='q4_1'>1</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q4 == 2? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q4' id='q4_2' value='2' <?php echo $checked;?>>
									  <label class='form-check-label' for='q4_2'>2</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q4 == 3? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q4' id='q4_3' value='3' <?php echo $checked;?>>
									  <label class='form-check-label' for='q4_3'>3</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q4 == 4? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q4' id='q4_4' value='4' <?php echo $checked;?>>
									  <label class='form-check-label' for='q4_4'>4</label>
									</div>
								</div>
								<h6 class='mt-5'>5: I have felt panic or terror</h6>
								<div class='form-group row ml-3'>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q5 === null? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q5' id='q5_na' value='' <?php echo $checked;?>>
									  <label class='form-check-label' for='q5_na'>Not Answered</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = ($q5 == 0 && $q5 !== null)? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q5' id='q5_0' value='0' <?php echo $checked;?>>
									  <label class='form-check-label' for='q5_0'>0</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q5 == 1? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q5' id='q5_1' value='1' <?php echo $checked;?>>
									  <label class='form-check-label' for='q5_1'>1</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q5 == 2? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q5' id='q5_2' value='2' <?php echo $checked;?>>
									  <label class='form-check-label' for='q5_2'>2</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q5 == 3? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q5' id='q5_3' value='3' <?php echo $checked;?>>
									  <label class='form-check-label' for='q5_3'>3</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q5 == 4? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q5' id='q5_4' value='4' <?php echo $checked;?>>
									  <label class='form-check-label' for='q5_4'>4</label>
									</div>
								</div>		
								<h6 class='mt-5'>6: I made plans to end my life</h6>
								<div class='form-group row ml-3'>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q6 === null? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q6' id='q6_na' value='' <?php echo $checked;?>>
									  <label class='form-check-label' for='q6_na'>Not Answered</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = ($q6 == 0 && $q6 !== null)? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q6' id='q6_0' value='0' <?php echo $checked;?>>
									  <label class='form-check-label' for='q6_0'>0</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q6 == 1? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q6' id='q6_1' value='1' <?php echo $checked;?>>
									  <label class='form-check-label' for='q6_1'>1</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q6 == 2? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q6' id='q6_2' value='2' <?php echo $checked;?>>
									  <label class='form-check-label' for='q6_2'>2</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q6 == 3? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q6' id='q6_3' value='3' <?php echo $checked;?>>
									  <label class='form-check-label' for='q6_3'>3</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q6 == 4? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q6' id='q6_4' value='4' <?php echo $checked;?>>
									  <label class='form-check-label' for='q6_4'>4</label>
									</div>
								</div>
								<h6 class='mt-5'>7: I have had difficulty getting to sleep or staying asleep</h6>
								<div class='form-group row ml-3'>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q7 === null? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q7' id='q7_na' value='' <?php echo $checked;?>>
									  <label class='form-check-label' for='q7_na'>Not Answered</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = ($q7 == 0 && $q7 !== null)? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q7' id='q7_0' value='0' <?php echo $checked;?>>
									  <label class='form-check-label' for='q7_0'>0</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q7 == 1? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q7' id='q7_1' value='1' <?php echo $checked;?>>
									  <label class='form-check-label' for='q7_1'>1</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q7 == 2? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q7' id='q7_2' value='2' <?php echo $checked;?>>
									  <label class='form-check-label' for='q7_2'>2</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q7 == 3? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q7' id='q7_3' value='3' <?php echo $checked;?>>
									  <label class='form-check-label' for='q7_3'>3</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q7 == 4? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q7' id='q7_4' value='4' <?php echo $checked;?>>
									  <label class='form-check-label' for='q7_4'>4</label>
									</div>
								</div>
								<h6 class='mt-5'>8: I have felt despairing or hopeless</h6>
								<div class='form-group row ml-3'>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q8 === null? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q8' id='q8_na' value='' <?php echo $checked;?>>
									  <label class='form-check-label' for='q8_na'>Not Answered</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = ($q8 == 0 && $q8 !== null)? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q8' id='q8_0' value='0' <?php echo $checked;?>>
									  <label class='form-check-label' for='q8_0'>0</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q8 == 1? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q8' id='q8_1' value='1' <?php echo $checked;?>>
									  <label class='form-check-label' for='q8_1'>1</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q8 == 2? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q8' id='q8_2' value='2' <?php echo $checked;?>>
									  <label class='form-check-label' for='q8_2'>2</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q8 == 3? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q8' id='q8_3' value='3' <?php echo $checked;?>>
									  <label class='form-check-label' for='q8_3'>3</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q8 == 4? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q8' id='q8_4' value='4' <?php echo $checked;?>>
									  <label class='form-check-label' for='q8_4'>4</label>
									</div>
								</div>
								<h6 class='mt-5'>9: I have felt unhappy</h6>
								<div class='form-group row ml-3'>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q9 === null? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q9' id='q9_na' value='' <?php echo $checked;?>>
									  <label class='form-check-label' for='q9_na'>Not Answered</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = ($q9 == 0 && $q9 !== null)? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q9' id='q9_0' value='0' <?php echo $checked;?>>
									  <label class='form-check-label' for='q9_0'>0</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q9 == 1? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q9' id='q9_1' value='1' <?php echo $checked;?>>
									  <label class='form-check-label' for='q9_1'>1</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q9 == 2? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q9' id='q9_2' value='2' <?php echo $checked;?>>
									  <label class='form-check-label' for='q9_2'>2</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q9 == 3? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q9' id='q9_3' value='3' <?php echo $checked;?>>
									  <label class='form-check-label' for='q9_3'>3</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q9 == 4? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q9' id='q9_4' value='4' <?php echo $checked;?>>
									  <label class='form-check-label' for='q9_4'>4</label>
									</div>
								</div>
								<h6 class='mt-5'>10: Unwanted images or memories have been distressing me</h6>
								<div class='form-group row ml-3'>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q10 === null? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q10' id='q10_na' value='' <?php echo $checked;?>>
									  <label class='form-check-label' for='q10_na'>Not Answered</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = ($q10 == 0 && $q10 !== null)? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q10' id='q10_0' value='0' <?php echo $checked;?>>
									  <label class='form-check-label' for='q10_0'>0</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q10 == 1? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q10' id='q10_1' value='1' <?php echo $checked;?>>
									  <label class='form-check-label' for='q10_1'>1</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q10 == 2? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q10' id='q10_2' value='2' <?php echo $checked;?>>
									  <label class='form-check-label' for='q10_2'>2</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q10 == 3? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q10' id='q10_3' value='3' <?php echo $checked;?>>
									  <label class='form-check-label' for='q10_3'>3</label>
									</div>
									<div class='form-check form-check-inline'>
									  <?php $checked = $q10 == 4? "checked" : "";?>
									  <input class='form-check-input' type='radio' name='q10' id='q10_4' value='4' <?php echo $checked;?>>
									  <label class='form-check-label' for='q10_4'>4</label>
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

					var core10_id = $("#core10_id").val();
					var client_id = $("#client_id").val();
					var assessment_date = $("#assessment_date").val();
					var q1 = $('input[name="q1"]:checked').val();
					var q2 = $('input[name="q2"]:checked').val();
				    var q3 = $('input[name="q3"]:checked').val();
					var q4 = $('input[name="q4"]:checked').val();
					var q5 = $('input[name="q5"]:checked').val();
				    var q6 = $('input[name="q6"]:checked').val();
					var q7 = $('input[name="q7"]:checked').val();
					var q8 = $('input[name="q8"]:checked').val();
				    var q9 = $('input[name="q9"]:checked').val();
				    var q10 = $('input[name="q10"]:checked').val();

					$.post("ajax/core10.edit.php", {
						
						core10_id:core10_id,
						client_id:client_id,
						assessment_date:assessment_date,
						q1:q1,
						q2:q2,
						q3:q3,
						q4:q4,
						q5:q5,
						q6:q6,
						q7:q7,
						q8:q8,
						q9:q9,
						q10:q10					
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