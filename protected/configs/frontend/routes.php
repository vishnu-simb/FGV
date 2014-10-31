<?php
/**
 * Author: trac.nguyen (npbtrac@yahoo.com)
 * Date: 7/24/14
 * Time: 11:53 AM
 *
 * {comments for the file here}
 */

return array(
    // Default rules
	'report/grower/<id:\w+>/<year:\w+>' => 'report/grower',
    '<controller:\w+>/<id:\d+>' => '<controller>/view',
    '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
	'webshell'=>'webshell',
	'webshell/<controller:\w+>'=>'webshell/<controller>',
	'webshell/<controller:\w+>/<action:\w+>'=>'webshell/<controller>/<action>',
);