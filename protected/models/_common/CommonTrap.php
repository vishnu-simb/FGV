<?php

Yii::import('application.models._base.BaseTrap');

class CommonTrap extends BaseTrap
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}