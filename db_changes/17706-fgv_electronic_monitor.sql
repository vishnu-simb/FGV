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

ALTER TABLE `fgv_crop_pest` ADD `fruit_type_id` INT(10) NOT NULL DEFAULT '1' AFTER `color`;
ALTER TABLE `fgv2`.`fgv_crop_pest` DROP INDEX `pest_name_UNIQUE`, ADD UNIQUE `pest_name_UNIQUE` (`name`, `fruit_type_id`) USING BTREE;

INSERT INTO `fgv_fruit_type` (`id`, `name`, `creator_id`, `ordering`, `created_at`, `updated_at`, `status`, `is_deleted`, `params`) VALUES (NULL, 'Cherry', NULL, NULL, NULL, NULL, '1', '0', NULL);

INSERT INTO `fgv_crop_pest` (`id`, `name`, `calculate`, `color`, `fruit_type_id`, `creator_id`, `ordering`, `created_at`, `updated_at`, `status`, `is_deleted`, `params`) VALUES
(NULL, 'Med Fly', 'no', '#ff0000', 3, NULL, NULL, NULL, NULL, 1, 0, NULL),
(NULL, 'QFF', 'no', '#70ff00', 3, NULL, NULL, NULL, NULL, 1, 0, NULL),
(NULL, 'Lesser QFF', 'no', '#030000', 3, NULL, NULL, NULL, NULL, 1, 0, NULL),
(NULL, 'Jarvis Fly', 'no', '#00e0ff',3, NULL, NULL, NULL, NULL, 1, 0, NULL),
(NULL, 'LBAM', 'no', '#00ff85', 3, NULL, NULL, NULL, NULL, 1, 0, NULL),
(NULL, 'Black Plague thrips', 'no', '#3300ff', 3, NULL, NULL, NULL, NULL, 1, 0, NULL),
(NULL, 'Fullers Rose Weevil', 'no', '#db00ff', 3, NULL, NULL, NULL, NULL, 1, 0, NULL),
(NULL, 'Black Peach Aphid', 'no', '#ff9900', 3, NULL, NULL, NULL, NULL, 1, 0, NULL),
(NULL, 'Pear Scale', 'no', '#faff00', 3, NULL, NULL, NULL, NULL, 1, 0, NULL),
(NULL, 'Garden Weevil', 'no', '#803d45', 3, NULL, NULL, NULL, NULL, 1, 0, NULL),
(NULL, 'Plague thrips', 'no', '#4f706c', 3, NULL, NULL, NULL, NULL, 1, 0, NULL),
(NULL, 'Carob Moth', 'no', '#b2b8ed', 3, NULL, NULL, NULL, NULL, 1, 0, NULL),
(NULL, 'Codling Moth', 'no', '#d6b8c8', 3, NULL, NULL, NULL, NULL, 1, 0, NULL),
(NULL, 'Brown Rot', 'no', '#d6b8c8', 3, NULL, NULL, NULL, NULL, 1, 0, NULL),
(NULL, 'Crown Rot', 'no', '#d6b8c8', 3, NULL, NULL, NULL, NULL, 1, 0, NULL),
(NULL, 'Ringspot Virus', 'no', '#d6b8c8', 3, NULL, NULL, NULL, NULL, 1, 0, NULL);

INSERT INTO `fgv_crop_pest` (`id`, `name`, `calculate`, `color`, `fruit_type_id`, `creator_id`, `ordering`, `created_at`, `updated_at`, `status`, `is_deleted`, `params`) VALUES
(NULL, 'LLBAM/LBAM', 'no', '#ff0000', 4, NULL, NULL, NULL, NULL, 1, 0, NULL),
(NULL, 'Aphids', 'no', '#70ff00', 4, NULL, NULL, NULL, NULL, 1, 0, NULL),
(NULL, 'Weevils', 'no', '#030000', 4, NULL, NULL, NULL, NULL, 1, 0, NULL),
(NULL, 'Mealybug', 'no', '#00e0ff',4, NULL, NULL, NULL, NULL, 1, 0, NULL),
(NULL, 'Scale', 'no', '#00ff85', 4, NULL, NULL, NULL, NULL, 1, 0, NULL),
(NULL, 'Thrips', 'no', '#3300ff', 4, NULL, NULL, NULL, NULL, 1, 0, NULL),
(NULL, 'Native budworm', 'no', '#db00ff', 4, NULL, NULL, NULL, NULL, 1, 0, NULL),
(NULL, 'Carpophilus beetle', 'no', '#ff9900', 4, NULL, NULL, NULL, NULL, 1, 0, NULL),
(NULL, 'Plague soldier beetle', 'no', '#faff00', 4, NULL, NULL, NULL, NULL, 1, 0, NULL),
(NULL, 'Cherry Slug', 'no', '#803d45', 4, NULL, NULL, NULL, NULL, 1, 0, NULL),
(NULL, 'Earwig', 'no', '#4f706c', 4, NULL, NULL, NULL, NULL, 1, 0, NULL),
(NULL, 'Two spotted mite', 'no', '#b2b8ed', 4, NULL, NULL, NULL, NULL, 1, 0, NULL),
(NULL, 'Brobia mite', 'no', '#d6b8c8', 4, NULL, NULL, NULL, NULL, 1, 0, NULL),
(NULL, 'Bacterial Canker', 'no', '#d6b8c8', 4, NULL, NULL, NULL, NULL, 1, 0, NULL),
(NULL, 'Brown Rot', 'no', '#d6b8c8', 4, NULL, NULL, NULL, NULL, 1, 0, NULL),
(NULL, 'Twig Blight', 'no', '#d6b8c8', 4, NULL, NULL, NULL, NULL, 1, 0, NULL),
(NULL, 'Shothole', 'no', '#d6b8c8', 4, NULL, NULL, NULL, NULL, 1, 0, NULL),
(NULL, 'PNRSV', 'no', '#d6b8c8', 4, NULL, NULL, NULL, NULL, 1, 0, NULL);
