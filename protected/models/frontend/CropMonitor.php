<?php

Yii::import('application.models._common.CommonCropMonitor');

class CropMonitor extends CommonCropMonitor
{
	public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}
	
	/**
	 * query for recent records
	 * @static
	 * @return CActiveDataProvider
	 */
	public function SearchRecentCropMonitors(){
		$condition="";
		if( Yii::app()->user->getState('role') == Users::USER_TYPE_GROWER){
				$condition = "WHERE g.id =".Yii::app()->user->id."";
		}
		$sql="SELECT em.id as monitoring_id, em.date, em.time, em.value as monitoring_number,CONCAT (g.name,' - ',b.name,' : ',pt.name) AS monitoring_name, t.name as trap_name
		FROM ".$this->tableName()." em
		INNER JOIN ".CropPest::model()->tableName()." pt ON em.pest_id = pt.id
		INNER JOIN ".Block::model()->tableName()." b ON em.block_id = b.id
		INNER JOIN ".Property::model()->tableName()." p ON b.property_id = p.id
		INNER JOIN ".Grower::model()->tableName()." g ON p.grower_id = g.id  
		LEFT JOIN ".Trap::model()->tableName()." t ON em.trap_id = t.id 
		$condition ORDER BY em.date DESC, em.time DESC";
		return new CSqlDataProvider($sql, array(
	
		));
	
	}

	public function getRecentCropMonitors($growerId, $dateFrom = '', $dateTo = ''){
        $whereStr = '';
	    if($dateFrom && $dateTo){
	        $whereStr = " AND em.date >= '$dateFrom' AND em.date <= '$dateTo' ";
        }elseif($dateFrom){
            $whereStr = " AND em.date >= '$dateFrom' ";
        }elseif($dateTo){
            $whereStr = " AND em.date <= '$dateTo' ";
        }
        $sql="SELECT em.*, g.name as grower_name, p.name as property_name, b.name as block_name, pt.name as pest_name, t.name as trap_name, em.value as monitoring_number 
		FROM ".$this->tableName()." em
		INNER JOIN ".CropPest::model()->tableName()." pt ON em.pest_id = pt.id
		INNER JOIN ".Block::model()->tableName()." b ON em.block_id = b.id
		INNER JOIN ".Property::model()->tableName()." p ON b.property_id = p.id
		INNER JOIN ".Grower::model()->tableName()." g ON p.grower_id = g.id 
		LEFT JOIN ".Trap::model()->tableName()." t ON em.trap_id = t.id 
		WHERE g.id = $growerId $whereStr
		ORDER BY g.name, p.name, b.name, pt.name ASC, em.date DESC";
        return Yii::app()->db->createCommand($sql)->queryAll();
        //return new CSqlDataProvider($sql);
    }
}