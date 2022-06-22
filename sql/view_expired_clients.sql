DROP VIEW IF EXISTS view_expired_clients;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `unicorn`.`view_expired_clients` AS 
SELECT `clients`.`id` AS `id`,
CONCAT(`unicorn`.`clients`.`first_name`,' ',`unicorn`.`clients`.`last_name`) AS full_name,
concat('<button type="button" class="btn btn-sm btn-danger contact_table" onclick="delete_client(', `clients`.`id`, ')"><i class="fas fa-trash"></i></button>') AS action
FROM `clients`
WHERE `clients`.`id` NOT IN (
  SELECT `clients`.`id`
  FROM `clients`
  INNER JOIN `enquiries` ON `clients`.`id` = `enquiries`.`client_id`
  WHERE DATE(`enquiries`.`enquiry_date`) >= DATE_SUB(CURDATE(),INTERVAL 2 YEAR)
)
AND `clients`.`id` NOT IN (
  SELECT `clients`.`id`
  FROM `clients`
  INNER JOIN `activity_attendance` ON `clients`.`id` = `activity_attendance`.`client_id`
  INNER JOIN `activity_meetings` ON `activity_attendance`.`activity_meeting_id` = `activity_meetings`.`id`
  WHERE DATE(`activity_meetings`.`meeting_date`) >= DATE_SUB(CURDATE(),INTERVAL 2 YEAR)
)