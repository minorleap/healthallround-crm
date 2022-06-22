<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/security.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/application.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.open.php"); ?>

<?php

$data_error = 0;

// Clean GET values to prevent SQL injection
$id = $_GET['id'];
$id = filter_var($id, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

$record_type = $_GET['type'];
$record_type = filter_var($record_type, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

$valid_record_types = array('duration', 'activity_frequency', 'enquiry_method', 'enquiry_type', 'enquiry_time', 'ethnic_group', 'gender', 'residency_status', 'services');

// Validate ID
if (!validate_string_isnumber($id)) {$data_error = 1;}
if (!in_array($record_type, $valid_record_types)) {$data_error = 2;}

if ($data_error == 0){
	$sql = "SELECT * FROM `$record_type` WHERE id=$id;";
	$result = $conn->query($sql);
	if ($result->num_rows == 1){
		while($row = $result->fetch_assoc()){
			$description = $row['description'];
			$value = $row['value'];
			$is_enabled = $row['is_enabled'];
		}
		?>
		<form role="form" id="add_form" name="add_form" method="post">
			<input type="hidden" class="form-control" id="record_id" value="<?php echo $id; ?>">
			<div class="form-group row">
				<label for="description" class="col-sm-2 col-form-label col-form-label-sm">Description</label>
				<div class="col-sm-6">
					<input type="text" class="form-control form-control-sm" id="description" name="description" value="<?php echo $description;?>">
				</div>
			</div>
			<?php if ($record_type == 'duration') {?>
			<div class="form-group row">
				<label for="value" class="col-sm-2 col-form-label col-form-label-sm">Value</label>
				<div class="col-sm-6">
					<input type="number" class="form-control form-control-sm" id="value" name="value" value="<?php echo $value;?>">
				</div>
			</div>
			<?php }?>
			<div class="form-group row">
				<div class="form-check">
					<?php $checked = $is_enabled? "checked" : "";?>
					<div class="col-sm-6">					
						<input class="form-check-input" type="checkbox" id="is_enabled" name="is_enabled" <?php echo $checked;?>>
						<label class="form-check-label" for="is_enabled">Enabled</label>
					</div>
				</div>
			</div>
		</form>
		<?php
	} else {
		die();
	}
} else {
	// Validation of POST data failed, return reason.
	echo "ERROR: $data_error";
}

?>