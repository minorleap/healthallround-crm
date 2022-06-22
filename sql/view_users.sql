DROP VIEW IF EXISTS view_users;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `harcrm`.`view_users` AS 
SELECT `users`.`id` AS `id`,
`users`.`username` AS `username`,
`users`.`first_name` AS `first_name`,
`users`.`last_name` AS `last_name`,
`users`.`is_enabled` AS `is_enabled`,
`users`.`is_counsellor` AS `is_counsellor`,
`users`.`is_admin` AS `is_admin`,
`users`.`is_super_admin` AS `is_super_admin`,
concat('<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit_modal" data-id="',`users`.`id`,'" data-username="',`users`.`username`,'" data-first_name="',`users`.`first_name`,'" data-last_name="',`users`.`last_name`,'"  data-is_enabled="',`users`.`is_enabled`,'" data-is_admin="',`users`.`is_admin`,'" data-is_super_admin="',`users`.`is_super_admin`,'"><i class="fas fa-user-edit"></i></button> <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#password_modal" data-id="',`users`.`id`,'"><i class="fas fa-lock"></i></button>') AS `action` from `users` order by `users`.`username`