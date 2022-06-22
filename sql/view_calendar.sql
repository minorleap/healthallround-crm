
DROP VIEW IF EXISTS view_calendar;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `unicorn`.`view_calendar` AS 
SELECT `activities`.`name` AS `title`,
CONCAT(date_format(`activity_meetings`.`meeting_date`,'%Y-%m-%d'), date_format(`activity_meetings`.`meeting_time`,' %H:%i:00')) AS start,
DATE_ADD(CONCAT(date_format(`activity_meetings`.`meeting_date`,'%Y-%m-%d'), date_format(`activity_meetings`.`meeting_time`,' %H:%i:00')), INTERVAL `activities`.`duration_hours` HOUR) AS `end`,
`activities`.`id` AS `url`
FROM `activity_meetings`
INNER JOIN `activities` ON `activity_meetings`.`activity_id`=`activities`.`id`;