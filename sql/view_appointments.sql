DROP VIEW IF EXISTS view_appointments;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `harcrm`.`view_appointments` AS 
SELECT `appointments`.`id`,
`clients`.`id` AS 'client_id',
concat(`clients`.`first_name`, ' ', `clients`.`last_name`) AS 'client',
`appointments`.`counsellor_user_id` AS 'counsellor_user_id',
concat(`users`.`first_name`, ' ', `users`.`last_name`) AS 'counsellor',
date_format(`appointments`.`date`,'%d/%m/%Y') AS 'date',
TIME_FORMAT(`appointments`.`time`, "%H:%i") AS 'time',
`appointment_type`.`description` AS 'appointment_type', 
`appointment_status`.`description` AS 'appointment_status', 
`appointments`.`fee` AS 'fee', 
`payment_status`.`description` AS 'payment_status',
`appointments`.`notes` AS 'notes',
concat('<button type="button" class="btn btn-primary contact_table" onclick="edit_appointment(',`harcrm`.`appointments`.`id`,')"><i class="fas fa-edit"></i> Edit</button>') AS `action`
FROM `appointments`
INNER JOIN `clients` ON `appointments`.`client_id`=`clients`.`id`
INNER JOIN `users` ON `appointments`.`counsellor_user_id`=`users`.`id`
INNER JOIN `appointment_status` ON `appointments`.`appointment_status_id`=`appointment_status`.`id`
INNER JOIN `appointment_type` ON `appointments`.`appointment_type_id`=`appointment_type`.`id`
LEFT OUTER JOIN `payment_status` ON `appointments`.`payment_status_id`=`payment_status`.`id`
ORDER BY `appointments`.`date` DESC;