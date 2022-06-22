DROP VIEW IF EXISTS view_gad07;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `harcrm`.`view_gad07` AS 
SELECT `id`, `client_id`,
`assessment_date` AS 'assessment_date',
`q1`,`q2`,`q3`,`q4`,`q5`,`q6`,`q7`,

ifnull(q1, 0) + ifnull(q2, 0) + ifnull(q3, 0) + ifnull(q4, 0) + ifnull(q5, 0) + ifnull(q6, 0) + ifnull(q7, 0) as 'total_score',

concat('<button type="button" class="btn btn-primary contact_table" onclick="edit_gad07(',`harcrm`.`gad07`.`id`,')"><i class="fas fa-edit"></i> Edit</button>') AS `action`
FROM `gad07`
ORDER BY `assessment_date` DESC;