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
				$condition = " AND g.id =".Yii::app()->user->id."";
		}
		$sql="SELECT em.id as monitoring_id, em.date, em.time, em.value as monitoring_number,CONCAT (g.name,' - ',b.name,' : ',pt.name) AS monitoring_name, t.name as trap_name
		FROM ".$this->tableName()." em
		INNER JOIN ".CropPest::model()->tableName()." pt ON em.pest_id = pt.id
		INNER JOIN ".Block::model()->tableName()." b ON em.block_id = b.id
		INNER JOIN ".Property::model()->tableName()." p ON b.property_id = p.id
		INNER JOIN ".Grower::model()->tableName()." g ON p.grower_id = g.id  
		LEFT JOIN ".Trap::model()->tableName()." t ON em.trap_id = t.id 
		WHERE em.value > 0 $condition ORDER BY em.date DESC, em.time DESC";
		return new CSqlDataProvider($sql, array(
            'pagination' => array(
                'pageSize' => $this->rowsPerPage,
            )
		));
	
	}

	public function getRecentCropMonitors($blockId, $dateFrom = '', $dateTo = ''){
        $whereStr = '';
	    if($dateFrom && $dateTo){
	        $whereStr = " AND em.date >= '$dateFrom' AND em.date <= '$dateTo' ";
        }elseif($dateFrom){
            $whereStr = " AND em.date >= '$dateFrom' ";
        }elseif($dateTo){
            $whereStr = " AND em.date <= '$dateTo' ";
        }
        $sql="SELECT em.*, pt.name as pest_name, t.name as trap_name, em.value as monitoring_number 
		FROM ".$this->tableName()." em
		INNER JOIN ".CropPest::model()->tableName()." pt ON em.pest_id = pt.id
		LEFT JOIN ".Trap::model()->tableName()." t ON em.trap_id = t.id 
		WHERE em.block_id = $blockId $whereStr
		ORDER BY pt.name ASC, em.date DESC";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }
}