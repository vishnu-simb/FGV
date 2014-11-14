<?php
/**
 * Author: trac.nguyen (npbtrac@yahoo.com)
 * Date: 7/24/14
 * Time: 11:57 AM
 *
 * Yii params to use in the whole site
 */

return array(
    'uploadsFolder' => 'uploads',

    // url of the app, should be changed if environment changed
    'absUrl' => '',
    'absUrlApi' => '/api',
    'absUrlBackend' => '/backend',
    'absUrlStatic' => '/static',
	
	// email
	'noreplyEmail'=>'noreply@fgv.com.au',
	'noreplyDisplayEmail'=>'Growfruit',
	'adminEmail'=>'admin@fgv.com.au',
	'contactEmail'=>'admin@fgv.com.au',
	'sendEmailWithSMTP'=>false,
	'userSMTP' => array(
				'host'=>'',
				'username'=>'',
				'password'=>'',
				'port'=>'',
	),
	'adminSMTP' => array(
				'host'=>'',
				'username'=>'',
				'password'=>'',
				'port'=>'26',
	),
	'emailSignature' => 'Growfruit',
);