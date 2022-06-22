DROP VIEW IF EXISTS view_measurements;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `harcrm`.`view_measurements` AS
SELECT id, client_id, 'Core 10' as 'type', assessment_date, total_score, questions_completed, mean_score, clinical_score,
concat('<button type="button" class="btn btn-primary contact_table" onclick="edit_core10(',`id`,')"><i class="fas fa-edit"></i> Edit</button>') AS `action`
FROM view_core10

UNION ALL

SELECT id, client_id, 'DASS 21' as 'type', assessment_date, total_score, NULL as 'questions_completed', NULL as 'mean_score', NULL as 'clinical_score',
concat('<button type="button" class="btn btn-primary contact_table" onclick="edit_dass21(',`id`,')"><i class="fas fa-edit"></i> Edit</button>') AS `action`
FROM view_dass21

UNION ALL

SELECT id, client_id, 'GAD 07' as 'type', assessment_date, total_score, NULL as 'questions_completed', NULL as 'mean_score', NULL as 'clinical_score',
concat('<button type="button" class="btn btn-primary contact_table" onclick="edit_gad07(',`id`,')"><i class="fas fa-edit"></i> Edit</button>') AS `action`
FROM view_gad07

UNION ALL

SELECT id, client_id, 'PHQ 09' as 'type', assessment_date, total_score, NULL as 'questions_completed', NULL as 'mean_score', NULL as 'clinical_score',
concat('<button type="button" class="btn btn-primary contact_table" onclick="edit_phq09(',`id`,')"><i class="fas fa-edit"></i> Edit</button>') AS `action`
FROM view_phq09;