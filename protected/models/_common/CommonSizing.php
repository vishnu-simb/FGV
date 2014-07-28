<?php

Yii::import('application.models._base.BaseSizing');

class CommonSizing extends BaseSizing
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}