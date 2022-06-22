DROP VIEW IF EXISTS view_activity_meetings;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `harcrm`.`view_activity_meetings` AS 
SELECT 
`activity_meetings`.`id`, 
`activity_meetings`.`activity_id`,
concat('<a href="/attendance.php?id=', `activity_meetings`.`id`, '">', `activities`.`name`, '</a>') AS 'activity',
`activity_meetings`.`meeting_date` AS 'date',
date_format(`activity_meetings`.`meeting_time`,'%H:%i') as 'time',
concat('<button type="button" class="btn btn-sm btn-primary contact_table" onclick="edit_meeting(',`activity_meetings`.`id`,')"><i class="fas fa-edit"></i> Edit</button> <button type="button" class="btn btn-sm btn-primary contact_table" onclick="edit_attendance(',`activity_meetings`.`id`,')"><i class="fas fa-clock"></i> Attendance</button>') AS `action`
FROM `activity_meetings`
INNER JOIN `activities` ON `activity_meetings`.`activity_id`=`activities`.`id`;