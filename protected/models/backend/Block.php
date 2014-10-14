<?php

Yii::import('application.models._common.CommonBlock');

class Block extends CommonBlock
{
	public static function model($className=__CLASS__)
    {
		return parent::model($className);
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
			return $this->model()->findAllByAttributes(array('property_id'=>$this->property_id),array('order'=>'name'));
		}elseif(isset($this->grower) && !empty($this->grower)){
			$properties = $this->getPropertyByGrower();
			$prop = array();
			foreach($properties as $property){
				$prop[] = $property->id;
			}
			return $this->model()->findAllByAttributes(array('property_id'=>$prop),array('order'=>'name'));
		}else{
			return $this->model()->findAll();
		}
	}
}