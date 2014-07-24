<?php

/**
 * Author: trac.nguyen (npbtrac@yahoo.com)
 * Date: 6/18/14
 * Time: 2:49 PM
 *
 * controller for common actions
 */
class SiteController extends SimbControllerConsole
{
    public function actionIndex()
    {
        echo "action index of console ready";
        $tmpArr = Yii::app()->preload;
        print_r($tmpArr);
        $tmpArr = Yii::app()->params;
        print_r($tmpArr);
    }
}