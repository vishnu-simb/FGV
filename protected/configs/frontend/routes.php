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
    'location/id/<id:\w+>' => 'location/view',
    'location/update/<id:\w+>' => 'location/update',
    'location/delete/<id:\w+>' => 'location/delete',
	'report/grower/<id:\w+>/<year:\w+>' => 'report/grower',
	'report/pdf/<id:\w+>/<year:\w+>' => 'report/pdf',
    '<controller:\w+>/<id:\d+>' => '<controller>/view',
    '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
	'webshell'=>'webshell',
	'webshell/<controller:\w+>'=>'webshell/<controller>',
	'webshell/<controller:\w+>/<action:\w+>'=>'webshell/<controller>/<action>',
);