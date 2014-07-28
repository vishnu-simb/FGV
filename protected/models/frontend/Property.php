<?php

Yii::import('application.models._common.CommonProperty');

class Property extends CommonProperty
{
	public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}
}