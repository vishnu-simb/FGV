<?php

Yii::import('application.models._base.BaseUserUserRoleMap');

class CommonUserUserRoleMap extends BaseUserUserRoleMap
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}