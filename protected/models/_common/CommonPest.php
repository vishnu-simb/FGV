<?php

Yii::import('application.models._base.BasePest');

class CommonPest extends BasePest
{
    protected static $_block;
    private $sprayCount;
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    private $hasSecondCohort;
    
    function hasSecondCohort($block_id){
    	if($this->hasSecondCohort === null)
    		$this->hasSecondCohort = Biofix::model()->findByAttributes(array('block_id'=>$block_id,'pest_id'=>$this->id,'second_cohort'=>'yes'));
    	return $this->hasSecondCohort;
    }

	function getSprayCount(){
		if($this->sprayCount) return $this->sprayCount;
		$sql='SELECT COUNT(*) FROM '.PestSpray::model()->tableName().' WHERE pest_id='.$this->id.' AND grower_id=0';
		$this->sprayCount = Yii::app()->db->createCommand($sql)->queryScalar();
		return $this->sprayCount;
	}
	
	function getSpray($number,$grower_id){
		return PestSpray::model()->findByAttributes(array('pest_id'=>$this->id,'number'=>$number));
	}
    
    function getBiofix($block_id, $hasSecondCohort){
        $_k = $block_id. '|'. $this->id. '|'. ($hasSecondCohort?'1':'0');
        if (isset(static::$_block[$_k]))
            return static::$_block[$_k];
        else
            return static::$_block[$_k] = Biofix::model()->findByAttributes(array('block_id'=>$block_id,'pest_id'=>$this->id,'second_cohort'=>$hasSecondCohort?'yes':'no'));
    }
}