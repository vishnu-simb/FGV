DROP TABLE IF EXISTS `fgv_electronic_monitor`;
CREATE TABLE IF NOT EXISTS `fgv_electronic_monitor` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `block_id` int(11) NOT NULL,
  `pest_id` int(11) NOT NULL,
  `trap_id` int(11) NULL,
  `date` date NOT NULL,
  `time` TIME NOT NULL DEFAULT '00:00:00',
  `value` float UNSIGNED DEFAULT NULL,
  `comment` text,
  `creator_id` bigint(20) DEFAULT NULL COMMENT 'id of user who create this item',
  `ordering` int(11) DEFAULT NULL COMMENT 'sorting weight',
  `created_at` datetime DEFAULT NULL COMMENT 'date, time that the record created',
  `updated_at` datetime DEFAULT NULL COMMENT 'date, time that the record created',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'item status (published, draft, in-trash...)',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'item is deleted or not',
  `params` text COMMENT 'json string, to store some needed values for this item',
  PRIMARY KEY (`id`),
  UNIQUE KEY `electronic_id` (`block_id`, `pest_id`, `date`, `time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;