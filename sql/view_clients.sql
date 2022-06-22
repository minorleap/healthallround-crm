DROP VIEW IF EXISTS view_clients;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `harcrm`.`view_clients` AS
SELECT 
`clients`.`id` AS `id`, 
`clients`.`first_name` AS `first_name`, 
`clients`.`last_name` AS `last_name`,
`clients`.`preferred_name` AS `preferred_name`,
CONCAT(`harcrm`.`clients`.`first_name`,' ',`harcrm`.`clients`.`last_name`) AS full_name,
REPLACE(CONCAT(`harcrm`.`clients`.`address_1`,'<br/>',`harcrm`.`clients`.`address_2`,'<br/>',`harcrm`.`clients`.`town_city`,'<br/>',`harcrm`.`clients`.`postcode`),"<br/><br/>", "<br/>") AS address,
`clients`.`telephone` AS `telephone`, 
`clients`.`address_1` AS `address_1`, 
`clients`.`address_2` AS `address_2`, 
`clients`.`town_city` AS `town_city`, 
`clients`.`postcode` AS `postcode`, 
`clients`.`mobile` AS `mobile`, 
`clients`.`email` AS `email`, 
`clients`.`date_of_birth` AS `date_of_birth`,
TIMESTAMPDIFF(YEAR, `clients`.`date_of_birth`, CURDATE()) AS 'age',
`clients`.`created_date` AS `created_date`,
concat('<button type="button" class="btn btn-primary contact_table" onclick="edit_client(', `clients`.`id`, ')"><i class="fas fa-search"></i> View</button>') AS action,
`age_group`.`id` AS `age_group_id`,
`age_group`.`description` AS `age_group_description`,
`transgender`.`id` AS `transgender_id`,
`transgender`.`description` AS `transgender_description`,
`gender`.`id` AS `gender_id`,
`gender`.`description` AS `gender_description`,
`sexual_orientation`.`id` AS `sexual_orientation_id`,
`sexual_orientation`.`description` AS `sexual_orientation_description`,
`employment_status`.`id` AS `employment_status_id`,
`employment_status`.`description` AS `employment_status_description`,
`disability`.`id` AS `disability_status_id`,
`disability`.`description` AS `disability_status_description`,
`ethnic_group`.`id` AS `ethnic_group_id`,
`ethnic_group`.`description` AS `ethnic_group_description`,
`clients`.`ethnic_group_other` AS `ethnic_group_other`,
`religion`.`id` AS `religion_id`,
`religion`.`description` AS `religion_description`,
`clients`.`receiving_benefits` AS `receiving_benefits`,
`clients`.`caring_none` AS `caring_none`,
`clients`.`caring_primary_under_18` AS `caring_primary_under_18`,
`clients`.`caring_primary_disabled_children` AS `caring_primary_disabled_children`,
`clients`.`caring_primary_disabled_over_18` AS `caring_primary_disabled_over_18`,
`clients`.`caring_primary_older_person` AS `caring_primary_older_person`,
`clients`.`caring_secondary` AS `caring_secondary`,
`clients`.`link_worker_sighthill` AS `link_worker_sighthill`,
`clients`.`link_worker_whinpark` AS `link_worker_whinpark`,
`clients`.`link_worker_springwell` AS `link_worker_springwell`,
`clients`.`link_worker_murrayfield` AS `link_worker_murrayfield`,
`clients`.`consent_data` AS 'consent_data',
`clients`.`consent_phone` AS 'consent_phone',
`clients`.`consent_mail` AS 'consent_mail',
`clients`.`consent_email` AS 'consent_email',
`clients`.`consent_phone_identification` AS 'consent_phone_identification',
`clients`.`consent_email_list` AS 'consent_email_list',
`clients`.`consent_marketing_photography` AS 'consent_marketing_photography',
`clients`.`emergency_contact_name` AS 'emergency_contact_name',
`clients`.`emergency_contact_phone` AS 'emergency_contact_phone',
`clients`.`gp_name` AS 'gp_name',
`clients`.`gp_surgery` AS 'gp_surgery',
`clients`.`has_existing_health_professional` AS 'has_existing_health_professional',
`clients`.`existing_health_professional_details` AS 'existing_health_professional_details',
`clients`.`preferred_contact_method` AS 'preferred_contact_method',
`clients`.`medical_details` AS 'medical_details',
`clients`.`services_desired` AS 'services_desired',
`clients`.`how_did_you_hear` AS 'how_did_you_hear',
`clients`.`prefers_previous_counsellor` AS 'prefers_previous_counsellor',
`clients`.`previous_counsellor_name` AS 'previous_counsellor_name',
`counsellor_gender`.`id` AS 'counsellor_gender_id',
`counsellor_gender`.`description` AS 'counsellor_gender_description',
`counselling_time`.`id` AS 'counselling_time_id',
`clients`.`counselling_time_other` AS 'counselling_time_other',
`counselling_time`.`description` AS 'counselling_time_description'
FROM `clients`
INNER JOIN `transgender` ON `clients`.`transgender_id`=`transgender`.`id`
INNER JOIN `gender` ON `clients`.`gender_id`=`gender`.`id`
INNER JOIN `ethnic_group` ON `clients`.`ethnic_group_id`=`ethnic_group`.`id` 
INNER JOIN `counsellor_gender` ON `clients`.`counsellor_gender_id`=`counsellor_gender`.`id`
INNER JOIN `counselling_time` ON `clients`.`counselling_time_id`=`counselling_time`.`id`
INNER JOIN `sexual_orientation` ON `clients`.`sexual_orientation_id`=`sexual_orientation`.`id`
INNER JOIN `employment_status` ON `clients`.`employment_status_id`=`employment_status`.`id`
INNER JOIN `disability` ON `clients`.`disability_status_id`=`disability`.`id`
INNER JOIN `religion` ON `clients`.`religion_id`=`religion`.`id`
INNER JOIN `age_group` ON `clients`.`age_group_id`=`age_group`.`id`
ORDER BY `clients`.`id`;