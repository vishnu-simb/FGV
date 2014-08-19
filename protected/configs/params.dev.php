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
		
	// application settings params
	'dbDateFormat'=>'Y-m-d H:i:s',
		
	// email
	'noreplyEmail'=>'noreply@fgv.com.au',
	'noreplyDisplayEmail'=>'FGV Team',
	'adminEmail'=>'admin@fgv.com.au',
	'contactEmail'=>'admin@fgv.com.au',
	'sendEmailWithSMTP'=>true,
	'userSMTP' => array( // using smtp gmail
				'host'=>'smtp.gmail.com',
				'username'=>'user',
				'password'=>'password',
				'encryption'=>'ssl',
				'port'=>'465',
	),
	'adminSMTP' => array(
				'host'=>'mail.host',
				'username'=>'user',
				'password'=>'password',
				'port'=>'26',
	),
	'emailSignature' => 'The FGV Team - Development',

);