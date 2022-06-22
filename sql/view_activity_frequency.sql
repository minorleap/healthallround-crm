SELECT
`unicorn`.`activity_frequency`.`id` AS `id`,
`unicorn`.`activity_frequency`.`description` AS `description`,
`unicorn`.`activity_frequency`.`is_enabled` AS `is_enabled`,
concat('<button type="button" class="btn btn-sm btn-primary contact_table" onclick="edit_frequency(',`unicorn`.`activity_frequency`.`id`,')"><i class="fas fa-pencil"></i></button>') AS `action`
FROM `unicorn`.`activity_frequency`;