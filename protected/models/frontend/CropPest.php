<?php

Yii::import('application.models._common.CommonCropPest');

class CropPest extends CommonCropPest
{
	public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}
	public static function CropPestColor($m){
		return CropPest::model()->findByAttributes(array('name'=>$m))->color;
	}
}