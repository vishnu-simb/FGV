<?php

Yii::import('application.models._common.CommonPest');

class Pest extends CommonPest
{
	public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}
}