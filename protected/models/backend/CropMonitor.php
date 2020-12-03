<?php

Yii::import('application.models._common.CommonCropMonitor');

class CropMonitor extends CommonCropMonitor
{
	public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}
}