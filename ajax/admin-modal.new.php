<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/security.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/application.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.open.php"); ?>

<?php

$data_error = 0;

$record_type = $_GET['type'];
$record_type = filter_var($record_type, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

$valid_record_types = array('duration', 'activity_frequency', 'enquiry_method', 'enquiry_type', 'enquiry_time', 'ethnic_group', 'gender', 'residency_status', 'services');

// Validate ID
if (!in_array($record_type, $valid_record_types)) {$data_error = 1;}

if ($data_error == 0){
	?>
	<form role="form" id="add_form" name="add_form" method="post">
		<div class="form-group row">
			<label for="description" class="col-sm-2 col-form-label col-form-label-sm">Description</label>
			<div class="col-sm-6">
				<input type="text" class="form-control form-control-sm" id="description" name="description">
			</div>
		</div>
		<?php if ($record_type == 'duration') {?>
		<div class="form-group row">
			<label for="value" class="col-sm-2 col-form-label col-form-label-sm">Value</label>
			<div class="col-sm-6">
				<input type="number" class="form-control form-control-sm" id="value" name="value">
			</div>
		</div>
		<?php }?>
		<div class="form-group row">
			<div class="form-check">
				<div class="col-sm-6">					
					<input class="form-check-input" type="checkbox" id="is_enabled" name="is_enabled">
					<label class="form-check-label" for="is_enabled">Enabled</label>
				</div>
			</div>
		</div>
	</form>
	<?php
} else {
	// Validation of POST data failed, return reason.
	echo "ERROR: $data_error";
}

?>