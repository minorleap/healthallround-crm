DROP VIEW IF EXISTS view_activities;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `harcrm`.`view_activities` AS 
SELECT `activities`.`id`,
`activities`.`name` AS 'name',
`activities`.`location` AS 'location',
`start_date` AS 'start_date',
`end_date` AS 'end_date',
`activities`.`weekday` AS 'weekday',
`activities`.`start_time` AS 'start_time',
`activities`.`duration_hours` AS 'duration_hours',
`activities`.`organiser` AS 'organiser',
`activities`.`capacity` AS 'capacity',
`activity_frequency`.`description` AS 'frequency',
`activities`.`has_anonymous_attendees` AS 'has_anonymous_attendees',
`activities`.`is_archived` AS 'is_archived',
`activities`.`contact_details` AS 'contact_details', 
concat('<button type="button" class="btn btn-sm btn-primary contact_table" onclick="view_activity(',`activities`.`id`,')"><i class="fas fa-search"></i> View</button>') AS `action`
FROM `activities`
INNER JOIN `activity_frequency` ON `activities`.`frequency_id`=`activity_frequency`.`id`;