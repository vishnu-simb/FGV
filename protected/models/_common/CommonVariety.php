<?php

Yii::import('application.models._base.BaseVariety');

class CommonVariety extends BaseVariety
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}