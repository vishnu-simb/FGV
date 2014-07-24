<?php

/**
 * Author: trac.nguyen (npbtrac@yahoo.com)
 * Date: 6/18/14
 * Time: 5:37 PM
 *
 * a test file contain testing actions
 */
class TestCommand extends SimbConsoleCommand
{
    public function actionIndex($type, $limit = 5)
    {
        echo "index result: \n";
        echo "type: $type \n";
        echo "limit: $limit \n";
    }

    public function actionInit()
    {
        echo "index result: \n";
        echo "sdaf: \n";
    }
}