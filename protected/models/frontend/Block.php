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
	function getTrapsGrower(){
		$sql="SELECT t.id,t.block_id, t.ordering AS ordering,CONCAT (t.name,' : ',pt.name) AS trap_name
		FROM ".Trap::model()->tableName()." t
				INNER JOIN ".Pest::model()->tableName()." pt ON t.pest_id = pt.id 
				INNER JOIN ".$this->tableName()." b ON t.block_id = b.id WHERE t.block_id =".$this->id." ORDER BY t.ordering";
		return new CSqlDataProvider($sql, array());
	}
	function getMites(){
		return Mite::model()->findAll();
	}
	
	public function getBlockByGrowerId($grower_id){
		return Block::model()->with(array('property'=>array('condition'=>'property.grower_id='.$grower_id)))->findAll();
	}
	
	function getSprays($year = null){
	    if(empty($year))
            $year = date('Y');
		return Spray::model()->with(array('property'=>array('condition'=>'block_id = '.$this->id.' AND ((YEAR(date) = '.$year.' AND MONTH(date) < 6) OR (YEAR(date) = '.($year-1).' AND MONTH(date) >= 6))')))->findAll();
	}
}