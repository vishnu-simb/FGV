<?php

Yii::import('application.models._common.CommonCropPest');

class CropPest extends CommonCropPest
{
	public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}
}