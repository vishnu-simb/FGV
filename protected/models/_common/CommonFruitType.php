<?php

/**
 * @property Variety $variety
 */

Yii::import('application.models._base.BaseFruitType');

class CommonFruitType extends BaseFruitType
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
        
    }
}