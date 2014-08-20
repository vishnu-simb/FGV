<?php

Yii::import('application.models._base.BasePest');

class CommonPest extends BasePest
{
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
}