<?php

Yii::import('application.models._common.CommonProperty');

class Property extends CommonProperty
{
	public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}
	function getBlocks(){
		return Block::model()->findAll('property_id='.$this->id);
	}
	function getGrower(){
		return Grower::model()->findAll('id='.$this->property_id);
	}
}