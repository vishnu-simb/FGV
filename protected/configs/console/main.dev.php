<?php
/**
 * Yii configurations for Console
 */
return array(
    'name' => 'Growfruit - Console',
	'timeZone' => 'Australia/Melbourne',
    'basePath' => dirname(__FILE__) . DS . '..' . DS . '..',
	// path aliases
		'aliases' => array(
				// change this if necessary
				'bootstrap' => realpath(__DIR__ . DS . '..' . DS . '..' . DS . 'extensions' . DS . 'bootstrap'),
	),
	// autoloading model and component classes
	'import' => array(
				'application.extensions.giix-components.*',
				'application.models.backend.*',
				'application.models.frontend.*',
				'application.models.service.*',
				'application.components.*',
				'application.helpers.*',
				'ext.yii-mail.YiiMailMessage',
				'ext.yii-pdf.EYiiPdf',
		),
		
    'preload' => array(
        'log',
    ),
    'components' => CMap::mergeArray(
            require(dirname(__FILE__) . DS . '..' . DS . 'db_connect.php'),
            array(
                // Logging system
                'log' => array(
                    'class' => 'CLogRouter',
                    'routes' => array(
                        // Log the issues of crawling tournament software api
                        /*
                        'customLog' => array(
                            'class'=>'CFileLogRoute',
                            'logFile'=>'custom.log',
                            'categories'=>'custom',
                            'maxFileSize'=>16384, // 16mb
                            'maxLogFiles'=>99,
                        ),
                        */
                        array(
                            'class' => 'CFileLogRoute',
                            'levels' => 'error, warning, info, trace',
                            'maxFileSize' => 16384, // 16mb
                            'maxLogFiles' => 99,
                        ),
                        array(
                            'class' => 'ext.db_profiler.DbProfileLogRoute',
                            'countLimit' => 1,
                            // How many times the same query should be executed to be considered inefficient
                            'slowQueryMin' => 1.00,
                            // Minimum time for the query to be slow
                        ),
                    ),
                ),
                'ePdf' => array(
                		'class' =>'ext.yii-pdf.EYiiPdf',
                		'params' => array(
                				'mpdf' => array(
                						'librarySourcePath' => 'application.vendors.mpdf.*',
                						'constants'         => array(
                								'_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
                						),
                						'class'=>'mpdf', // the literal class filename to be loaded from the vendors folder
                						/*'defaultParams'     => array( // More info: http://mpdf1.com/manual/index.php?tid=184
                						 'mode'              => '', //  This parameter specifies the mode of the new document.
                								'format'            => 'A4', // format A4, A5, ...
                								'default_font_size' => 0, // Sets the default document font size in points (pt)
                								'default_font'      => '', // Sets the default font-family for the new document.
                								'mgl'               => 15, // margin_left. Sets the page margins for the new document.
                								'mgr'               => 15, // margin_right
                								'mgt'               => 16, // margin_top
                								'mgb'               => 16, // margin_bottom
                								'mgh'               => 9, // margin_header
                								'mgf'               => 9, // margin_footer
                								'orientation'       => 'P', // landscape or portrait orientation
                						)*/
                				),
                'HTML2PDF' => array(
                					'librarySourcePath' => 'application.vendors.html2pdf.*',
                					'classFile'         => 'html2pdf.class.php', // For adding to Yii::$classMap
                					'defaultParams'     => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
                						 'orientation' => 'P', // landscape or portrait orientation
                								'format'      => 'A4', // format A4, A5, ...
                								'language'    => 'en', // language: fr, en, it ...
                								'unicode'     => true, // TRUE means clustering the input text IS unicode (default = true)
                								'encoding'    => 'UTF-8', // charset encoding; Default is UTF-8
                								'marges'      => array(10,10,10,10), // margins by default, in order (left, top, right, bottom)
                					)
                				)
                		),
                ),
                'request' => array(
                		'baseUrl' => 'http://fruitgrowersvictory.simb',
                ),
                'mail' => array(
                		'class' => 'ext.yii-mail.YiiMail',
                		'transportType' => 'php',
                		/*
                		 'transportType' => 'smtp',
                		'transportOptions'=>array(
                		'host'=>'mail.host',
                		'username'=>'',
                		'password'=>'',
                		'port'=>'26',
                		),*/
                		'viewPath' => 'application.views.mail',
                		'logging' => true,
                		'dryRun' => false,
                ),
                'fileCache' => array(
                    'class' => 'CFileCache'
                ),
                // Init bootstrap
                'bootstrap' => array(
                    'class' => 'bootstrap.components.TbApi',

                ),
            )
        ),
    'commandMap' => array(
        'migrate' => array(
            'class' => 'system.cli.commands.MigrateCommand',
            'migrationPath' => 'application.migrations',
            'migrationTable' => 'fgv_migrations',
            'connectionID' => 'db',
        ),
    ),
    // array of params for the whole app
    'params' => CMap::mergeArray(
            require(dirname(__FILE__) . DS . '..' . DS . 'params.php'),
            // Extra params
            array()
    ),
);