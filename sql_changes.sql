-- #10198 My Account area
ALTER TABLE `fgv_grower` 
ADD `contact_name` VARCHAR(100) NULL AFTER `salt`, 
ADD `address` VARCHAR(255) NULL AFTER `contact_name`, 
ADD `suburb` VARCHAR(50) AFTER `address`, 
ADD `postcode` VARCHAR(5) AFTER `suburb`, 
ADD `state` ENUM('ACT','NSW','NT','QLD','SA','TAS','VIC','WA') AFTER `postcode`, 
ADD `phone` VARCHAR(20) AFTER `state`, 
ADD `mobile` VARCHAR(20) AFTER `phone`;

