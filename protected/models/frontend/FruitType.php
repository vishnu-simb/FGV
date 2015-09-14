<?php

Yii::import('application.models._common.CommonFruitType');

class FruitType extends CommonFruitType
{
	public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}
}