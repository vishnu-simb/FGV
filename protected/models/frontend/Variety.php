<?php

Yii::import('application.models._common.CommonVariety');

class Variety extends CommonVariety
{
	public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}
}