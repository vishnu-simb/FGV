<?php

Yii::import('application.models._common.CommonBlock');

class Block extends CommonBlock
{
	public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}
	function getTraps(){
		return Trap::model()->findAll('block_id='.$this->id);
	}
}