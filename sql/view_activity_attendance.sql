SELECT `activity_bookings`.`id` AS 'id',
`activity_attendance`.`id` AS 'attendance_id',
`activity_meetings`.`id` AS 'meeting_id',
DATE_FORMAT(`activity_meetings`.`meeting_date`, "%d/%m/%Y") AS 'meeting_date',
`activities`.`id` AS 'activity_id',
`activities`.`name` AS 'activity',
concat(`clients`.`first_name`, ' ', `clients`.`last_name`) AS 'client',
`clients`.`id` AS 'client_id',
(CASE WHEN `activity_attendance`.`id` IS NOT NULL THEN concat('<input type="checkbox" id="attendance-checkbox-', `unicorn`.`clients`.`id`, '" class="contact_table" onclick="toggle_attendance(',`unicorn`.`clients`.`id`, ',', `unicorn`.`activity_meetings`.`id`,')" checked />') ELSE concat('<input type="checkbox" id="attendance-checkbox-', `unicorn`.`clients`.`id`,'" class="contact_table" onclick="toggle_attendance(',`unicorn`.`clients`.`id`, ',', `unicorn`.`activity_meetings`.`id`,')" />') END) as 'action'
FROM `activity_bookings`
INNER JOIN `activities` ON `activity_bookings`.`activity_id`=`activities`.`id`
INNER JOIN `activity_meetings` ON `activity_meetings`.`activity_id`=`activities`.`id`
LEFT OUTER JOIN `activity_attendance` ON `activity_attendance`.`client_id`=`activity_bookings`.`client_id`
INNER JOIN `clients` ON `clients`.`id` = `activity_bookings`.`client_id`;