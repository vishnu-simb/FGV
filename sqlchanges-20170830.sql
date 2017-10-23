/*
	16650 - Ability for admin user to view growers password. Base64-encoded password will be stored
*/

ALTER TABLE `fgv_grower` ADD `b_password` text NULL AFTER `password`;