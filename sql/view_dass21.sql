DROP VIEW IF EXISTS view_dass21;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `harcrm`.`view_dass21` AS 
SELECT `id`, `client_id`,
`assessment_date` AS 'assessment_date',
`q1`,`q2`,`q3`,`q4`,`q5`,`q6`,`q7`,`q8`,`q9`,`q10`,`q11`,`q12`,`q13`,`q14`,`q15`,`q16`,`q17`,`q18`,`q19`,`q20`,`q21`,

ifnull(q1, 0) + ifnull(q2, 0) + ifnull(q3, 0) + ifnull(q4, 0) + ifnull(q5, 0) + ifnull(q6, 0) + ifnull(q7, 0) + ifnull(q8, 0) + ifnull(q9, 0) + ifnull(q10, 0) + ifnull(q11, 0) + ifnull(q12, 0) + ifnull(q13, 0) + ifnull(q14, 0) + ifnull(q15, 0) + ifnull(q16, 0) + ifnull(q17, 0) + ifnull(q18, 0) + ifnull(q19, 0) + ifnull(q20, 0) + ifnull(q21, 0) as 'total_score',

concat('<button type="button" class="btn btn-primary contact_table" onclick="edit_dass21(',`harcrm`.`dass21`.`id`,')"><i class="fas fa-edit"></i> Edit</button>') AS `action`
FROM `dass21`
ORDER BY `assessment_date` DESC;