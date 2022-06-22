<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/security.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/application.php"); ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.open.php"); ?>
<?php $pageTitle = "Dashboard"; ?>
<?php $statistic_year = "2020"; ?>
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
						<h1 class="h2"><i class="fas fa-home"></i> Home</h1>
					</div>
					<div class="card">
						<div class="card-body">
							<div id='script-warning'>
								Cannot load calendar data.
							</div>
							<div id='loading'>loading...</div>
							<div id='calendar'></div>
						</div>
					</div>	
				</main>
				
			</div>
		</div>
	
		<?php // Add Scripts
		include("includes/scripts.php"); ?>

		<script>
			document.addEventListener('DOMContentLoaded', function() {
				var calendarEl = document.getElementById('calendar');
				var calendar = new FullCalendar.Calendar(calendarEl, {
					eventTimeFormat: {
					hour: '2-digit',
					minute: '2-digit',
					meridiem: 'short'
					},
					themeSystem: 'bootstrap',
					firstDay: 1,
					headerToolbar: {
						left: 'prev,next today',
						center: 'title',
						right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
					},
					initialDate: new Date(),
					timeZone: 'local',
					editable: true,
					navLinks: true, 
					dayMaxEvents: true,
					events: {
						url: 'ajax/calendar.events.php',
						failure: function() {
							document.getElementById('script-warning').style.display = 'block'
						}
					},
					loading: function(bool) {
						document.getElementById('loading').style.display = bool ? 'block' : 'none';
					},
					eventClick: function(info) {
						info.jsEvent.preventDefault();
						$.post("ajax/activity.select.php", {
							activity_id:info.event.url
						})
						.done(function(data){
							window.location.replace("activity.php");
						})				
					}					
				});
				calendar.render();
			});
		</script>
	</body>
</html>

<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/database.close.php"); ?>
