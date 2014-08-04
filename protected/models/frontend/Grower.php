<?php

Yii::import('application.models._common.CommonGrower');

class Grower extends CommonGrower
{
	public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}
	function getProperties(){
		return Property::model()->findAll('grower_id='.$this->id);
	}
}