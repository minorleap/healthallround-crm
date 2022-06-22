DROP VIEW IF EXISTS view_counselling_blocks;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `harcrm`.`view_counselling_blocks` AS 
SELECT `counselling_blocks`.`id`,
`clients`.`id` AS 'client_id',
concat(`clients`.`first_name`, ' ', `clients`.`last_name`) AS 'client',
`counselling_blocks`.`counsellor_user_id` AS 'counsellor_user_id',
concat(`users`.`first_name`, ' ', `users`.`last_name`) AS 'counsellor',
`counselling_blocks`.`start_date` AS 'start_date',
`counselling_blocks`.`end_date` AS 'end_date',
`counselling_blocks`.`evaluation_date` AS 'evaluation_date',
`counselling_blocks`.`history_general` AS 'history_general',
`counselling_blocks`.`history_selfharm` AS 'history_selfharm',
concat('<button type="button" class="btn btn-primary contact_table" onclick="edit_counselling_block(',`harcrm`.`counselling_blocks`.`id`,')"><i class="fas fa-edit"></i> Edit</button>') AS `action`
FROM `counselling_blocks`
INNER JOIN `clients` ON `counselling_blocks`.`client_id`=`clients`.`id`
INNER JOIN `users` ON `counselling_blocks`.`counsellor_user_id`=`users`.`id`
ORDER BY `counselling_blocks`.`start_date` DESC;