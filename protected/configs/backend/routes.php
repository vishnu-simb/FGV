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
	'<controller:\w+>/<id:\d+>' => '<controller>/view',
    '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
	'<controller:\w+>/<action:\w+>/<id:\w+>' => '<controller>/<action>',
    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
);