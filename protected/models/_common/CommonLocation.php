<?php

Yii::import('application.models._base.BaseLocation');

class CommonLocation extends BaseLocation
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}