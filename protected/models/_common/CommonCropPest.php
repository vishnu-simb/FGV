<?php

Yii::import('application.models._base.BaseCropPest');

class CommonCropPest extends BaseCropPest
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return FruitType[]
     */
    public function getFruitType(){
        $criteria = new CDbCriteria();
        $criteria->condition = 'is_deleted=:is_deleted';
        $criteria->params = array(':is_deleted'=>'0');
        $criteria->order = 'name';
        return FruitType::model()->findAll($criteria);
    }
}