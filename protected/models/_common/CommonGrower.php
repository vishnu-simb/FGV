<?php

Yii::import('application.models._base.BaseGrower');

class CommonGrower extends BaseGrower
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}