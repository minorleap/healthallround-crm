DROP VIEW IF EXISTS view_enquiries;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `harcrm`.`view_enquiries` AS 
SELECT `enquiries`.`id`, `clients`.`id` AS 'client_id',
concat(`clients`.`first_name`, ' ', `clients`.`last_name`) AS 'client', 
`enquiry_date` AS 'enquiry_date', 
`services`.`description` AS 'service', 
`enquiry_method`.`description` AS 'enquiry_method', 
`enquiry_type`.`description` AS 'enquiry_type', 
`time_spent`.`description` AS 'time_spent',
`details`,
concat('<button type="button" class="btn btn-primary contact_table" onclick="edit_enquiry(',`enquiries`.`id`,')"><i class="fas fa-edit"></i> Edit</button>') AS `action`
FROM `enquiries`
INNER JOIN `clients` ON `enquiries`.`client_id`=`clients`.`id`
INNER JOIN `services` ON `enquiries`.`service_id`=`services`.`id`
INNER JOIN `enquiry_method` ON `enquiries`.`enquiry_method_id`=`enquiry_method`.`id`
INNER JOIN `enquiry_type` ON `enquiries`.`enquiry_type_id`=`enquiry_type`.`id`
INNER JOIN `time_spent` ON `enquiries`.`time_spent_id`=`time_spent`.`id`
ORDER BY `enquiry_date` DESC;