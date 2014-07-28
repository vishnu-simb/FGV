<?php

Yii::import('application.models._base.BasePest');

class CommonPest extends BasePest
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}