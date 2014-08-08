<?php

Yii::import('application.models._common.CommonTrapCheck');

class TrapCheck extends CommonTrapCheck
{
	
	public $block_id;
	public $date;
	
	public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}
	
	public function rules()
	{
		return array(
				array('block_id,date','safe','on'=>'search')
		);
	}
	
	/**
	 * @static
	 * @return CActiveDataProvider
	 */
	public function getSqlDataProvider(){
		
		$condition = !empty($this->block_id) ? 'WHERE t.block_id ='. $this->block_id : ' ';
		$condition .= !empty($this->date) ? ' AND (tc.date BETWEEN "'. $this->date .'-01" AND "'. $this->date.'-30")' : '';
		$sql="SELECT tc.date AS tc_date,tc.value as tc_value,pt.name AS pest_name
		FROM ".$this->tableName()." tc
		INNER JOIN ".Trap::model()->tableName()." t ON tc.trap_id = t.id
		INNER JOIN ".Pest::model()->tableName()." pt ON t.pest_id = pt.id
		INNER JOIN ".Block::model()->tableName()." b ON t.block_id = b.id
		".$condition." 
		ORDER BY tc.date DESC";
		return new CSqlDataProvider($sql, array(
			'pagination'=>false,
		));
	
	}
}