<?php

Yii::import('application.models._common.CommonPest');

class Pest extends CommonPest
{
	public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}
	
	public static function PestColor($m){
		return Pest::model()->findByAttributes(array('name'=>$m))->color;
	}
}