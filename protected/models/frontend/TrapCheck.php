<?php

Yii::import('application.models._common.CommonTrapCheck');

class TrapCheck extends CommonTrapCheck
{
	public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}
	
	/**
	 * query for recent trapings
	 * @static
	 * @return CActiveDataProvider
	 */
	public function SearchRecentTrapings(){
	
		$pestTb=Pest::model()->tableName();
		$trapTb=Trap::model()->tableName();
		$blockTb=Block::model()->tableName();
		$propertyTb=Property::model()->tableName();
		$growerTb=Grower::model()->tableName();
	
		$sql="SELECT tc.id as trap_check_id,tc.date,tc.value as trap_check_number,CONCAT (g.name,' : ',pt.name,' - ',t.name) AS trap_check_name
		FROM fgv_trap_check tc
		INNER JOIN $trapTb t ON tc.trap_id = t.id
		INNER JOIN $pestTb pt ON t.pest_id = pt.id
		INNER JOIN $blockTb b ON t.block_id = b.id
		INNER JOIN $propertyTb p ON b.property_id = p.id
		INNER JOIN $growerTb g ON p.grower_id = g.id  ORDER BY tc.date DESC";
		return new CSqlDataProvider($sql, array(
	
		));
	
	}
}