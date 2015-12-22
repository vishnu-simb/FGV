/*
	14764 - FGV Upgrades - Growers can add new chemicals and add quantity, and status whether sprayed completly or only oneside
*/

ALTER TABLE `fgv_spray` ADD `spray_status` ENUM('completely','oneside') NOT NULL DEFAULT 'completely' AFTER `block_id`;