<?php

Yii::import('application.models._common.CommonPest');

class Pest extends CommonPest
{
	private $sprayCount;
	
	public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}

	function getSprayCount(){
		if($this->sprayCount) return $this->sprayCount;
		$sql='SELECT COUNT(*) FROM '.PestSpray::model()->tableName().' WHERE pest_id='.$this->id.' AND grower_id=0';
		$this->sprayCount = Yii::app()->db->createCommand($sql)->queryScalar();
		return $this->sprayCount;
	}
	
	function getSpray($number,$grower_id){
		return PestSpray::model()->findByAttributes(array('pest_id'=>$this->id,'number'=>$number,'grower_id'=>$grower_id));
	}
}