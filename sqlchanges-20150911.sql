/*
	14273 - Fruit Type And Variety Groupings
*/
CREATE TABLE `fgv_fruit_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `creator_id` bigint(20) DEFAULT NULL COMMENT 'id of user who create this item',
  `ordering` int(11) DEFAULT NULL COMMENT 'sorting weight',
  `created_at` datetime DEFAULT NULL COMMENT 'date, time that the record created',
  `updated_at` datetime DEFAULT NULL COMMENT 'date, time that the record created',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'item status (published, draft, in-trash...)',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'item is deleted or not',
  `params` text COMMENT 'json string, to store some needed values for this item',
  PRIMARY KEY (`id`),
  UNIQUE KEY `variety_name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
INSERT INTO `fgv_fruit_type`(`id`,`name`) VALUES('1','Apple'),('2','Pears'),('3','Stone Fruit');


ALTER TABLE `fgv_variety` ADD `fruit_type_id` INT(10) AFTER `name`;
UPDATE `fgv_variety` SET `fruit_type_id` = 1 WHERE id <= 13;
UPDATE `fgv_variety` SET `fruit_type_id` = 2 WHERE id > 13;
INSERT INTO `fgv_variety`(`name`,`fruit_type_id`) VALUES('Apricots',3),('Plums',3),('Nectarines',3),('Peaches',3);