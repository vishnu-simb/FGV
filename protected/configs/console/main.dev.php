<?php
/**
 * Yii configurations for Console
 */
return array(
    'name' => 'FGV - Console',
    'basePath' => dirname(__FILE__) . DS . '..' . DS . '..',
    // autoloading model and component classes
    'import' => array(
        'application.models.backend.*',
        'application.models.service.*',
        'application.components.*',
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