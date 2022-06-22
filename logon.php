<?php $pageTitle = "Logon"; ?>
<!doctype html>
<html>
	<?php // Add HTML Head with CSS Links
	include("includes/head.php"); ?>
	<body>
		<div class="container-fluid">
			<div class="row" style="height: 100px">
				<div class="col-md-12">
				</div>
			</div>
			<div class="row text-center">
				<div class="col-md-4">
				</div>
				<div class="col-md-4">
					
				</div>
				<div class="col-md-4">
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
				</div>
				<div class="col-md-4 border border-dark shadow p-3 mb-5 bg-white rounded">
					<form role="form" id="logon_form" name="logon_form" method="post">
						<div class="form-group text-center">
							<img src="images/logo.png?1" height="175" width="175" alt="Logo">
							<br>
							<h3>Health All Round</h3>
						</div>
						<div class="form-group">
							<label for="username">Username</label>
							<input type="text" class="form-control" id="username" />
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" class="form-control" id="password" />
						</div>
						<button type="submit" class="btn btn-dark">
							Logon
						</button>
					</form>
				</div>
				<div class="col-md-4">
				</div>
			</div>
		</div>

		<?php // Add Scripts
		include("includes/scripts.php"); ?>
		
		<script>

			$(document).ready(function(){

				$("form[name='logon_form']").validate({
					rules: {
						username: {
							required: true,
							maxlength: 100},
						password: {
							required: true,
							maxlength: 100}          
					},
					messages: {
						username: "Please enter a username",
						password: "Please enter a password"
					},
					submitHandler: function(form) {
						var username = $("#username").val();
						var password = $("#password").val();  

						$.post("ajax/logon.php", {
							username:username,
							password:password
						})
						.done(function(data){
							if(data.substring(0, 5)=="ERROR") {
								$("#username").removeClass("valid");
								$("#password").removeClass("valid");
								$("#username").addClass("error");
								$("#password").addClass("error");
								$("#username").css("border-color", "rgb(185, 74, 72)");
								$("#password").css("border-color", "rgb(185, 74, 72)");
								$("#logon_result").remove();
								$("<span id='logon_result' class='help-block form-error'>Your credentials are incorrect.</span>" ).insertAfter( "#password" );
							} else {
								window.location.replace("index.php");
							};	
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




