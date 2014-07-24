<?php

Yii::import('application.models._base.BaseUser');

class CommonUser extends BaseUser
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}