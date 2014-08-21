<?php

Yii::import('application.models._base.BaseMiteMonitor');

class CommonMiteMonitor extends BaseMiteMonitor
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}