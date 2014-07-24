<?php

Yii::import('application.models._base.BaseUserRole');

class CommonUserRole extends BaseUserRole
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}