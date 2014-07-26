<?php

Yii::import('application.models._common.CommonLocation');

class Location extends CommonLocation
{
	public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}
}