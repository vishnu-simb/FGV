<?php

Yii::import('application.models._base.BaseTrapCheck');

class CommonTrapCheck extends BaseTrapCheck
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}