<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/security.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/application.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.open.php"); ?>
<?php $pageTitle = "New DASS 21"; ?>

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
									<i class="fas fa-tasks"></i>&nbsp;&nbsp;DASS 21
								</div>
							</div>
						</h5>
						<div class="card-body">
							<!-- Form - Add DASS 21 -->
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
								<h6 class='mt-5'>1: I found it hard to wind down</h6>
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
								<h6 class='mt-5'>2: I was aware of dryness of my mouth</h6>
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
								<h6 class='mt-5'>3: I couldn't seem to experience any positive feeling at all</h6>
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
								<h6 class='mt-5'>4: I experienced breathing difficulty (eg, excessively rapid breathing,
breathlessness in the absence of physical exertion)</h6>
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
								<h6 class='mt-5'>5: I found it difficult to work up the initiative to do things</h6>
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
								<h6 class='mt-5'>6: I tended to over-react to situations</h6>
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
								<h6 class='mt-5'>7: I experienced trembling (e.g. in the hands)</h6>
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
								<h6 class='mt-5'>8: I felt that I was using a lot of nervous energy</h6>
								<div class='form-group row ml-3'>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q8' id='q8_na' value='' checked>
									  <label class='form-check-label' for='q8_na'>Not Answered</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q8' id='q8_0' value='0'>
									  <label class='form-check-label' for='q8_0'>0</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q8' id='q8_1' value='1'>
									  <label class='form-check-label' for='q8_1'>1</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q8' id='q8_2' value='2'>
									  <label class='form-check-label' for='q8_2'>2</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q8' id='q8_3' value='3'>
									  <label class='form-check-label' for='q8_3'>3</label>
									</div>
								</div>
								<h6 class='mt-5'>9: I was worried about situations in which I might panic and make
a fool of myself</h6>
								<div class='form-group row ml-3'>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q9' id='q9_na' value='' checked>
									  <label class='form-check-label' for='q9_na'>Not Answered</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q9' id='q9_0' value='0'>
									  <label class='form-check-label' for='q9_0'>0</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q9' id='q9_1' value='1'>
									  <label class='form-check-label' for='q9_1'>1</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q9' id='q9_2' value='2'>
									  <label class='form-check-label' for='q9_2'>2</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q9' id='q9_3' value='3'>
									  <label class='form-check-label' for='q9_3'>3</label>
									</div>
								</div>
								<h6 class='mt-5'>10: I felt that I had nothing to look forward to</h6>
								<div class='form-group row ml-3'>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q10' id='q10_na' value='' checked>
									  <label class='form-check-label' for='q10_na'>Not Answered</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q10' id='q10_0' value='0'>
									  <label class='form-check-label' for='q10_0'>0</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q10' id='q10_1' value='1'>
									  <label class='form-check-label' for='q10_1'>1</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q10' id='q10_2' value='2'>
									  <label class='form-check-label' for='q10_2'>2</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q10' id='q10_3' value='3'>
									  <label class='form-check-label' for='q10_3'>3</label>
									</div>
								</div>
								<h6 class='mt-5'>11: I found myself getting agitated</h6>
								<div class='form-group row ml-3'>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q11' id='q11_na' value='' checked>
									  <label class='form-check-label' for='q11_na'>Not Answered</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q11' id='q11_0' value='0'>
									  <label class='form-check-label' for='q11_0'>0</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q11' id='q11_1' value='1'>
									  <label class='form-check-label' for='q11_1'>1</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q11' id='q11_2' value='2'>
									  <label class='form-check-label' for='q11_2'>2</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q11' id='q11_3' value='3'>
									  <label class='form-check-label' for='q11_3'>3</label>
									</div>
								</div>
								<h6 class='mt-5'>12: I found it difficult to relax</h6>
								<div class='form-group row ml-3'>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q12' id='q12_na' value='' checked>
									  <label class='form-check-label' for='q12_na'>Not Answered</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q12' id='q12_0' value='0'>
									  <label class='form-check-label' for='q12_0'>0</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q12' id='q12_1' value='1'>
									  <label class='form-check-label' for='q12_1'>1</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q12' id='q12_2' value='2'>
									  <label class='form-check-label' for='q12_2'>2</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q12' id='q12_3' value='3'>
									  <label class='form-check-label' for='q12_3'>3</label>
									</div>
								</div>
								<h6 class='mt-5'>13: I felt down-hearted and blue</h6>
								<div class='form-group row ml-3'>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q13' id='q13_na' value='' checked>
									  <label class='form-check-label' for='q13_na'>Not Answered</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q13' id='q13_0' value='0'>
									  <label class='form-check-label' for='q13_0'>0</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q13' id='q13_1' value='1'>
									  <label class='form-check-label' for='q13_1'>1</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q13' id='q13_2' value='2'>
									  <label class='form-check-label' for='q13_2'>2</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q13' id='q13_3' value='3'>
									  <label class='form-check-label' for='q13_3'>3</label>
									</div>
								</div>
								<h6 class='mt-5'>14: I was intolerant of anything that kept me from getting on with
what I was doing</h6>
								<div class='form-group row ml-3'>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q14' id='q14_na' value='' checked>
									  <label class='form-check-label' for='q14_na'>Not Answered</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q14' id='q14_0' value='0'>
									  <label class='form-check-label' for='q14_0'>0</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q14' id='q14_1' value='1'>
									  <label class='form-check-label' for='q14_1'>1</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q14' id='q14_2' value='2'>
									  <label class='form-check-label' for='q14_2'>2</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q14' id='q14_3' value='3'>
									  <label class='form-check-label' for='q14_3'>3</label>
									</div>
								</div>
								<h6 class='mt-5'>15: I felt I was close to panic</h6>
								<div class='form-group row ml-3'>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q15' id='q15_na' value='' checked>
									  <label class='form-check-label' for='q15_na'>Not Answered</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q15' id='q15_0' value='0'>
									  <label class='form-check-label' for='q15_0'>0</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q15' id='q15_1' value='1'>
									  <label class='form-check-label' for='q15_1'>1</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q15' id='q15_2' value='2'>
									  <label class='form-check-label' for='q15_2'>2</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q15' id='q15_3' value='3'>
									  <label class='form-check-label' for='q15_3'>3</label>
									</div>
								</div>
								<h6 class='mt-5'>16: I was unable to become enthusiastic about anything</h6>
								<div class='form-group row ml-3'>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q16' id='q16_na' value='' checked>
									  <label class='form-check-label' for='q16_na'>Not Answered</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q16' id='q16_0' value='0'>
									  <label class='form-check-label' for='q16_0'>0</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q16' id='q16_1' value='1'>
									  <label class='form-check-label' for='q16_1'>1</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q16' id='q16_2' value='2'>
									  <label class='form-check-label' for='q16_2'>2</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q16' id='q16_3' value='3'>
									  <label class='form-check-label' for='q16_3'>3</label>
									</div>
								</div>
								<h6 class='mt-5'>17: I felt I wasn't worth much as a person</h6>
								<div class='form-group row ml-3'>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q17' id='q17_na' value='' checked>
									  <label class='form-check-label' for='q17_na'>Not Answered</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q17' id='q17_0' value='0'>
									  <label class='form-check-label' for='q17_0'>0</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q17' id='q17_1' value='1'>
									  <label class='form-check-label' for='q17_1'>1</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q17' id='q17_2' value='2'>
									  <label class='form-check-label' for='q17_2'>2</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q17' id='q17_3' value='3'>
									  <label class='form-check-label' for='q17_3'>3</label>
									</div>
								</div>
								<h6 class='mt-5'>18: I felt that I was rather touchy</h6>
								<div class='form-group row ml-3'>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q18' id='q18_na' value='' checked>
									  <label class='form-check-label' for='q18_na'>Not Answered</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q18' id='q18_0' value='0'>
									  <label class='form-check-label' for='q18_0'>0</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q18' id='q18_1' value='1'>
									  <label class='form-check-label' for='q18_1'>1</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q18' id='q18_2' value='2'>
									  <label class='form-check-label' for='q18_2'>2</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q18' id='q18_3' value='3'>
									  <label class='form-check-label' for='q18_3'>3</label>
									</div>
								</div>
								<h6 class='mt-5'>19: I was aware of the action of my heart in the absence of physical
exertion (e.g. sense of heart rate increase, heart missing a beat)</h6>
								<div class='form-group row ml-3'>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q19' id='q19_na' value='' checked>
									  <label class='form-check-label' for='q19_na'>Not Answered</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q19' id='q19_0' value='0'>
									  <label class='form-check-label' for='q19_0'>0</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q19' id='q19_1' value='1'>
									  <label class='form-check-label' for='q19_1'>1</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q19' id='q19_2' value='2'>
									  <label class='form-check-label' for='q19_2'>2</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q19' id='q19_3' value='3'>
									  <label class='form-check-label' for='q19_3'>3</label>
									</div>
								</div>
								<h6 class='mt-5'>20: I felt scared without any good reason</h6>
								<div class='form-group row ml-3'>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q20' id='q20_na' value='' checked>
									  <label class='form-check-label' for='q20_na'>Not Answered</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q20' id='q20_0' value='0'>
									  <label class='form-check-label' for='q20_0'>0</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q20' id='q20_1' value='1'>
									  <label class='form-check-label' for='q20_1'>1</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q20' id='q20_2' value='2'>
									  <label class='form-check-label' for='q20_2'>2</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q20' id='q20_3' value='3'>
									  <label class='form-check-label' for='q20_3'>3</label>
									</div>
								</div>
								<h6 class='mt-5'>21: I felt that life was meaningless</h6>
								<div class='form-group row ml-3'>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q21' id='q21_na' value='' checked>
									  <label class='form-check-label' for='q21_na'>Not Answered</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q21' id='q21_0' value='0'>
									  <label class='form-check-label' for='q21_0'>0</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q21' id='q21_1' value='1'>
									  <label class='form-check-label' for='q21_1'>1</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q21' id='q21_2' value='2'>
									  <label class='form-check-label' for='q21_2'>2</label>
									</div>
									<div class='form-check form-check-inline'>
									  <input class='form-check-input' type='radio' name='q21' id='q21_3' value='3'>
									  <label class='form-check-label' for='q21_3'>3</label>
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
					var q8 = $('input[name="q8"]:checked').val();
				    var q9 = $('input[name="q9"]:checked').val();
				    var q10 = $('input[name="q10"]:checked').val();
					var q11 = $('input[name="q11"]:checked').val();
					var q12 = $('input[name="q12"]:checked').val();
				    var q13 = $('input[name="q13"]:checked').val();
					var q14 = $('input[name="q14"]:checked').val();
					var q15 = $('input[name="q15"]:checked').val();
				    var q16 = $('input[name="q16"]:checked').val();
					var q17 = $('input[name="q17"]:checked').val();
					var q18 = $('input[name="q18"]:checked').val();
				    var q19 = $('input[name="q19"]:checked').val();
				    var q20 = $('input[name="q20"]:checked').val();
				    var q21 = $('input[name="q21"]:checked').val();			


					$.post("ajax/dass21.new.php", {
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
						q10:q10,
						q11:q11,
						q12:q12,
						q13:q13,
						q14:q14,
						q15:q15,
						q16:q16,
						q17:q17,
						q18:q18,
						q19:q19,
						q20:q20,
						q21:q21
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