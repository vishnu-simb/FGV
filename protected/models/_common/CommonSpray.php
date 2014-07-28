<?php

Yii::import('application.models._base.BaseSpray');

class CommonSpray extends BaseSpray
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}