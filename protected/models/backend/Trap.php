<?php

Yii::import('application.models._common.CommonTrap');

class Trap extends CommonTrap
{
	public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}
	
	function getTrapByBlock(){
		if(isset($this->block->id)){
			return $this->findAllByAttributes(array('block_id'=>$this->block->id),array('order'=>'ordering DESC'));
		}else{
			return $this->findAll(array('order'=>'ordering DESC'));
		}
	}
}