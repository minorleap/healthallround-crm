SELECT `totals`.`id` AS 'id',
`clients`.`first_name` AS 'first_name',
`clients`.`last_name` AS 'last_name',
`totals`.`number_of_times` AS 'number_of_times'  
FROM (
SELECT `id` AS 'id', COUNT(*) AS 'number_of_times'
FROM (  
  SELECT `clients`.`id` AS 'id'
  FROM `clients`
  INNER JOIN `enquiries` ON `clients`.`id` = `enquiries`.`client_id`
  WHERE DATE(`enquiries`.`enquiry_date`) >= DATE('2020-01-01') 
  AND DATE(`enquiries`.`enquiry_date`) <= DATE('2020-12-31')

  UNION ALL

  SELECT `clients`.`id` AS 'id'
  FROM `clients`
  INNER JOIN `activity_attendance` ON `clients`.`id` = `activity_attendance`.`client_id`
  INNER JOIN `activity_meetings` ON `activity_attendance`.`activity_meeting_id` = `activity_meetings`.`id`
  WHERE DATE(`activity_meetings`.`meeting_date`) >= DATE('2020-01-01')
  AND DATE(`activity_meetings`.`meeting_date`) <= DATE('2020-12-31')
) AS attendance_and_enquiries
GROUP BY `id`
) AS totals
INNER JOIN `clients` ON `clients`.`id` = `totals`.`id`