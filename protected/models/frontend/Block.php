<?php

Yii::import('application.models._common.CommonBlock');

class Block extends CommonBlock
{
	public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}
	
	function getTraps(){
		return Trap::model()->findAllByAttributes(array('block_id'=>$this->id),array('order'=>'name'));
	}
	function getMites(){
		return Mite::model()->findAll();
	}
	public function getBlockByGrowerId($grower_id){
		return Block::model()->with(array('property'=>array('condition'=>'property.grower_id='.$grower_id)))->findAll();
	}

}