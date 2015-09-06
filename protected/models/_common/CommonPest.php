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

	function getSprayCount($grower_id = 0){
		if($this->sprayCount) return $this->sprayCount;
		$sql='SELECT COUNT(*) FROM '.PestSpray::model()->tableName().' WHERE pest_id='.$this->id.' AND grower_id='. $grower_id;
		$this->sprayCount = Yii::app()->db->createCommand($sql)->queryScalar();
        if ($grower_id && $this->sprayCount == 0)
        {
            $sql='SELECT COUNT(*) FROM '.PestSpray::model()->tableName().' WHERE pest_id='.$this->id.' AND grower_id=0';
		    $this->sprayCount = Yii::app()->db->createCommand($sql)->queryScalar();
        }
		return $this->sprayCount;
	}
	
	function getSpray($number,$grower_id){
	   /*
	    $pestspray = PestSpray::model()->findByAttributes(array('pest_id'=>$this->id,'number'=>$number,'grower_id'=>$grower_id));
		if ($pestspray)
            return $pestspray;
        */
        return PestSpray::model()->findByAttributes(array('pest_id'=>$this->id,'number'=>$number));
	}
    
    function getBiofix($block_id, $hasSecondCohort,$hasFollowYear = false){
        $_k = $block_id. '|'. $this->id. '|'. ($hasSecondCohort?'1':'0');
        if (isset(static::$_block[$_k]))
            return static::$_block[$_k];
        else
        	if($hasFollowYear){
    			return static::$_block[$_k] = Biofix::model()->findByAttributes(array('block_id'=>$block_id,'pest_id'=>$this->id,'second_cohort'=>$hasSecondCohort?'yes':'no'),array(
																			        'condition'=>(strlen($hasFollowYear) == 4)?'(YEAR(date)=:date OR YEAR(date)+1=:date)':'date=:date', 
																			        'params'=>array(':date'=>$hasFollowYear),
    																				'order'=>'date DESC'
																			    ));
        	}
            return static::$_block[$_k] = Biofix::model()->findByAttributes(array('block_id'=>$block_id,'pest_id'=>$this->id,'second_cohort'=>$hasSecondCohort?'yes':'no'),array('order'=>'date DESC'));
    }
}