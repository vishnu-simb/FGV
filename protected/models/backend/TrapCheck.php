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
	
	function getPropertyByGrower(){
		if(isset($this->grower) && !empty($this->grower)){
			return Property::model()->findAllByAttributes(array('grower_id'=>$this->grower),array('order'=>'name'));
		}else{
			return $this->getProperty();
		}
	}
	function getBlockByProperty(){
		if(isset($this->property) && !empty($this->property)){
			return Block::model()->findAllByAttributes(array('property_id'=>$this->property),array('order'=>'name'));
		}elseif(isset($this->grower) && !empty($this->grower)){
			$properties = $this->getPropertyByGrower();
			$prop = array();
			foreach($properties as $property){
				$prop[] = $property->id;
			}
			return Block::model()->findAllByAttributes(array('property_id'=>$prop),array('order'=>'name'));
		}else{
			return $this->getBlock();
		}
	}
}