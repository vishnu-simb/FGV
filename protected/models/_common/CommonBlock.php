<?php

Yii::import('application.models._base.BaseBlock');

class CommonBlock extends BaseBlock
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}