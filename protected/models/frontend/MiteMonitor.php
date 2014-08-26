<?php

Yii::import('application.models._common.CommonMiteMonitor');

class MiteMonitor extends CommonMiteMonitor
{
	public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}
	

	/**
	 * query for recent monitoring
	 * @static
	 * @return CActiveDataProvider
	 */
	public function SearchRecentMontoring(){

		$miteTb=Mite::model()->tableName();
		$blockTb=Block::model()->tableName();
		$propertyTb=Property::model()->tableName();
		$growerTb=Grower::model()->tableName();
		$condition="";
		if( Yii::app()->user->getState('role') == Users::USER_TYPE_GROWER){
			$condition = "WHERE g.id =".Yii::app()->user->id."";
		}
		$sql="SELECT mm.id as monitoring_id,mm.date,mm.percent_li,mm.average_li,CONCAT (g.name,' : ',b.name,' - ',m.name) AS monitoring_name
		FROM ".$this->tableName()." mm
			INNER JOIN $miteTb m ON mm.mite_id = m.id
			INNER JOIN $blockTb b ON mm.block_id = b.id
			INNER JOIN $propertyTb p ON b.property_id = p.id
			INNER JOIN $growerTb g ON p.grower_id = g.id  $condition ORDER BY mm.id DESC";
		return new CSqlDataProvider($sql, array(
	
		));
	
	}
}