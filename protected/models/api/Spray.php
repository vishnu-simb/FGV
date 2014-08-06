<?php

Yii::import('application.models._common.CommonSpray');

class Spray extends CommonSpray
{
	public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}
	

	/**
	 * query for latest spray
	 * @static
	 * @return CActiveDataProvider
	 */
	public function SearchLatestSpray(){
	
		$chemicalTb=Chemical::model()->tableName();
		$blockTb=Block::model()->tableName();
		$propertyTb=Property::model()->tableName();
		$growerTb=Grower::model()->tableName();
	
		$sql="SELECT *,t.id as praying_id,t.date as praying_date,CONCAT (g.name,' : ',b.name,' - ',c.name) AS praying_name
		FROM fgv_spray t
		INNER JOIN $chemicalTb c ON t.chemical_id = c.id
		INNER JOIN $blockTb b ON t.block_id = b.id
		INNER JOIN $propertyTb p ON b.property_id = p.id
		INNER JOIN $growerTb g ON p.grower_id = g.id ORDER BY t.id DESC";
		return new CSqlDataProvider($sql, array(
		
		));
	
	}
}