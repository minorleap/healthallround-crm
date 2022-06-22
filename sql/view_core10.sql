DROP VIEW IF EXISTS view_core10;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `harcrm`.`view_core10` AS 
SELECT `id`, `client_id`,
`assessment_date` AS 'assessment_date', 
`q1`,`q2`,`q3`,`q4`,`q5`,`q6`,`q7`,`q8`,`q9`,`q10`,
ifnull(q1, 0) + ifnull(q2, 0) + ifnull(q3, 0) + ifnull(q4, 0) + ifnull(q5, 0) + ifnull(q6, 0) + ifnull(q7, 0) + ifnull(q8, 0) + ifnull(q9, 0) + ifnull(q10, 0) as 'total_score',
if(isnull(q1),0, 1) + if(isnull(q2),0, 1) + if(isnull(q3),0, 1) + if(isnull(q4),0, 1) + if(isnull(q5),0, 1) + if(isnull(q6),0, 1) + if(isnull(q7),0, 1) + if(isnull(q8),0, 1) + if(isnull(q9),0, 1) + if(isnull(q10),0, 1) as 'questions_completed',
ROUND((ifnull(q1, 0) + ifnull(q2, 0) + ifnull(q3, 0) + ifnull(q4, 0) + ifnull(q4, 0) + ifnull(q5, 0) + ifnull(q6, 0) + ifnull(q7, 0) + ifnull(q8, 0) + ifnull(q9, 0) + ifnull(q10, 0)) / (if(isnull(q1),0, 1) + if(isnull(q2),0, 1) + if(isnull(q3),0, 1) + if(isnull(q4),0, 1) + if(isnull(q5),0, 1) + if(isnull(q6),0, 1) + if(isnull(q7),0, 1) + if(isnull(q8),0, 1) + if(isnull(q9),0, 1) + if(isnull(q10),0, 1)), 2) as 'mean_score',
ROUND(10*(ifnull(q1, 0) + ifnull(q2, 0) + ifnull(q3, 0) + ifnull(q4, 0) + ifnull(q4, 0) + ifnull(q5, 0) + ifnull(q6, 0) + ifnull(q7, 0) + ifnull(q8, 0) + ifnull(q9, 0) + ifnull(q10, 0)) / (if(isnull(q1),0, 1) + if(isnull(q2),0, 1) + if(isnull(q3),0, 1) + if(isnull(q4),0, 1) + if(isnull(q5),0, 1) + if(isnull(q6),0, 1) + if(isnull(q7),0, 1) + if(isnull(q8),0, 1) + if(isnull(q9),0, 1) + if(isnull(q10),0, 1)),0) as 'clinical_score',
concat('<button type="button" class="btn btn-primary contact_table" onclick="edit_core10(',`harcrm`.`core10`.`id`,')"><i class="fas fa-edit"></i> Edit</button>') AS `action`
FROM `core10`
ORDER BY `assessment_date` DESC;