DROP VIEW IF EXISTS view_activity_bookings;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `harcrm`.`view_activity_bookings` AS 
SELECT 
`activity_bookings`.`id`,
`activity_bookings`.`activity_id`,
`activity_bookings`.`client_id`,
`activity_bookings`.`active`,
CONCAT(`clients`.`first_name`, ' ', `clients`.`last_name`) AS `client_name`,
`clients`.`postcode`,
`clients`.`date_of_birth` AS 'date_of_birth',
`activities`.`name` AS `activity`,
`activities`.`location` AS `location`,
`activities`.`start_date` AS 'start_date',
`activities`.`end_date` AS 'end_date',
`activities`.`weekday` AS `weekday`,
`activities`.`start_time` AS `start_time`,
`activities`.`duration_hours` AS `duration_hours`,
`activity_frequency`.`description` AS `frequency_description`,
concat("<button type='button' class='btn btn-sm btn-primary' onclick='edit_booking(",`activity_bookings`.`id`, ")'><i class='fas fa-pencil'></i> Edit</button>") AS `action`,
concat("<button type='button' class='btn btn-sm btn-primary' onclick='view_activity(",`activity_bookings`.`activity_id`, ")'><i class='fas fa-search'></i>  View Activity</button>") AS `action_client`
FROM `activity_bookings`
INNER JOIN `activities` ON `activity_bookings`.`activity_id`=`activities`.`id`
INNER JOIN `clients` ON `activity_bookings`.`client_id`=`clients`.`id`
INNER JOIN `activity_frequency` ON `activities`.`frequency_id`=`activity_frequency`.`id`;