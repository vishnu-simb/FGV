<?php

Yii::import('application.models._base.BaseBiofix');

class CommonBiofix extends BaseBiofix
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}