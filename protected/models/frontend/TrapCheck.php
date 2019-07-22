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
		$condition="";
		if( Yii::app()->user->getState('role') == Users::USER_TYPE_GROWER){
				$condition = "WHERE g.id =".Yii::app()->user->id."";
		}
		$sql="SELECT tc.id as trap_check_id,tc.date,tc.value as trap_check_number,CONCAT (g.name,' : ',pt.name,' - ',t.name) AS trap_check_name
		FROM ".$this->tableName()." tc
		INNER JOIN ".Trap::model()->tableName()." t ON tc.trap_id = t.id
		INNER JOIN ".Pest::model()->tableName()." pt ON t.pest_id = pt.id
		INNER JOIN ".Block::model()->tableName()." b ON t.block_id = b.id
		INNER JOIN ".Property::model()->tableName()." p ON b.property_id = p.id
		INNER JOIN ".Grower::model()->tableName()." g ON p.grower_id = g.id  $condition ORDER BY tc.id DESC";
		return new CSqlDataProvider($sql, array(
	
		));
	
	}

	public function getRecentTrappings($growerId){
        $sql="SELECT g.name as grower_name, p.name as property_name, b.name as block_name, pt.name as pest_name, t.name as trap_name, tc.date, tc.value as trap_check_number
		FROM ".$this->tableName()." tc
		INNER JOIN ".Trap::model()->tableName()." t ON tc.trap_id = t.id
		INNER JOIN ".Pest::model()->tableName()." pt ON t.pest_id = pt.id
		INNER JOIN ".Block::model()->tableName()." b ON t.block_id = b.id
		INNER JOIN ".Property::model()->tableName()." p ON b.property_id = p.id
		INNER JOIN ".Grower::model()->tableName()." g ON p.grower_id = g.id 
		WHERE g.id = $growerId 
		ORDER BY g.name, p.name, b.name, pt.name, t.name ASC, tc.date DESC";
        return new CSqlDataProvider($sql);
    }
}