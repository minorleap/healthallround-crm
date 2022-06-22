DROP VIEW IF EXISTS view_activity_bookings;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `unicorn`.`view_activity_bookings` AS 
SELECT 
`activity_bookings`.`id`,
`activity_bookings`.`activity_id`,
`activity_bookings`.`client_id`,
CONCAT(`clients`.`first_name`, ' ', `clients`.`last_name`) AS `client_name`,
`clients`.`postcode`,
date_format(`clients`.`date_of_birth`,'%d/%m/%Y') AS 'date_of_birth',
`activities`.`name` AS `activity`,
concat('<button type="button" class="btn btn-sm btn-primary contact_table" onclick="edit_booking(',`unicorn`.`activity_bookings`.`id`,')"><i class="fas fa-pencil"></i> Edit</button>') AS `action`
FROM `activity_bookings`
INNER JOIN `activities` ON `activity_bookings`.`activity_id`=`activities`.`id`
INNER JOIN `clients` ON `activity_bookings`.`client_id`=`clients`.`id`;