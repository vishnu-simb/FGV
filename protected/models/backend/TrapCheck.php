<?php

Yii::import('application.models._common.CommonTrapCheck');

class TrapCheck extends CommonTrapCheck
{
	public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}

	function getTrapByBlock(){
		
		if(isset($this->block) && !empty($this->block)){
			return Trap::model()->findAllByAttributes(array('block_id'=>$this->block),array('order'=>'name'));
		}else{
			return $this->getTrap()->getData();
		}
	}
}