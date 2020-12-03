DROP TABLE IF EXISTS `fgv_crop_monitor`;
CREATE TABLE IF NOT EXISTS `fgv_crop_monitor` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `block_id` int(11) NOT NULL,
  `pest_id` int(11) NOT NULL,
  `trap_id` int(11) NULL,
  `date` date NOT NULL,
  `time` TIME NOT NULL DEFAULT '00:00:00',
  `value` float UNSIGNED DEFAULT NULL,
  `duration` varchar(10) NULL,
  `comment` text NULL,
  `creator_id` bigint(20) DEFAULT NULL COMMENT 'id of user who create this item',
  `ordering` int(11) DEFAULT NULL COMMENT 'sorting weight',
  `created_at` datetime DEFAULT NULL COMMENT 'date, time that the record created',
  `updated_at` datetime DEFAULT NULL COMMENT 'date, time that the record created',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'item status (published, draft, in-trash...)',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'item is deleted or not',
  `params` text COMMENT 'json string, to store some needed values for this item',
  PRIMARY KEY (`id`),
  UNIQUE KEY `crop_id` (`block_id`, `pest_id`, `date`, `time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `fgv_crop_pest`;
CREATE TABLE IF NOT EXISTS `fgv_crop_pest` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `calculate` enum('yes','no') NOT NULL DEFAULT 'no',
  `color` varchar(100) DEFAULT NULL COMMENT 'color of pest mites and predators mites',
  `creator_id` bigint(20) DEFAULT NULL COMMENT 'id of user who create this item',
  `ordering` int(11) DEFAULT NULL COMMENT 'sorting weight',
  `created_at` datetime DEFAULT NULL COMMENT 'date, time that the record created',
  `updated_at` datetime DEFAULT NULL COMMENT 'date, time that the record created',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'item status (published, draft, in-trash...)',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'item is deleted or not',
  `params` text COMMENT 'json string, to store some needed values for this item',
  PRIMARY KEY (`id`),
  UNIQUE KEY `pest_name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;