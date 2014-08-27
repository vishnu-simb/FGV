<?php

Yii::import('application.models._common.CommonMite');

class Mite extends CommonMite
{
	public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}
	

	public static function MiteColor($m){
		return Mite::model()->findByAttributes(array('name'=>$m))->color;
	}
}