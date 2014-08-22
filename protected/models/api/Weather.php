<?php

Yii::import('application.models._common.CommonWeather');

class Weather extends CommonWeather
{
	public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}
}