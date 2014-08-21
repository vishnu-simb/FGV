<?php

Yii::import('application.models._base.BaseMite');

class CommonMite extends BaseMite
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}