<?php
/**
 * Yii configurations for API
 */
return array(
    'name' => 'Fruit Growers Victoria API',
    'basePath' => dirname(__FILE__) . DS . '..' . DS . '..',
    // path aliases
    'aliases' => array(
        // change this if necessary
        'bootstrap' => realpath(__DIR__ . DS . '..' . DS . '..' . DS . 'extensions' . DS . 'bootstrap'),
    ),
    // autoloading model and component classes
    'import' => array(
        'application.models.api.*',
        'application.models.service.*',
        'application.components.*',
        // For bootstrap
        'bootstrap.helpers.*',
        'bootstrap.widgets.*',
        'bootstrap.behaviors.*',
    ),
    'preload' => array(
        'log',
    ),
    'behaviors' => array(
        // separate frontend and backend
        'runEnd' => array(
            'class' => 'application.components.SimbWebApplicationEndBehavior',
        ),
    ),
    'components' => CMap::mergeArray(
            require(dirname(__FILE__) . DS . '..' . DS . 'db_connect.php'),
            array(

                // Logging system
                'log' => array(
                    'class' => 'CLogRouter',
                    'routes' => array(
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
                // ClientScript
                'clientScript' => array(
                    'class' => 'ext.npMinScript.NpMinScript',
                    'combineScriptFiles' => false,
                    // By default this is set to true, change it to false to disable combining JS files
                    'combineCssFiles' => false,
                    // By default this is set to true, change it to false to disable combining CSS files
                    'optimizeScriptFiles' => false,
                    // @since: 1.1
                    'optimizeCssFiles' => false,
                    // @since: 1.1
                    'maxFileSize' => 200000,
                    'cacheObjectName' => 'fileCache',
                    'cacheTimeout' => 10800,
                    'jsPosEnd' => true,
                ),
                'fileCache' => array(
                    'class' => 'CFileCache'
                ),
                // Init bootstrap
                'bootstrap' => array(
                    'class' => 'bootstrap.components.TbApi',

                ),
                // Use session of the browser
                'session' => array(
                    'class' => 'CHttpSession',
                ),

                // Url Manager
                'urlManager' => array(
                    'class' => 'SimbUrlManagerAPI',
                    'urlFormat' => 'path',
                    'rules' => require(dirname(__FILE__) . DS . 'routes.php'),
                    'showScriptName' => false,
                    'appendParams' => false,
                ),
            )
        ),
    // array of params for the whole app
    'params' => CMap::mergeArray(
            require(dirname(__FILE__) . DS . '..' . DS . 'params.php'),
            // Extra params
            array()
        ),
);