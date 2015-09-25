<?php

Yii::import('application.models._base.BaseMiteMonitor');

class CommonMiteMonitor extends BaseMiteMonitor
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    /**
     * default scope
     * @return array
     * @see defaultScope
     */
    public function defaultScope(){
    
    	return array(
    			'alias'=>'mite_monitor',
    			'condition'=> 'mite_monitor.is_deleted=0',
    			'order'=>'mite_monitor.id DESC'
    	);
    }
    
    
    /**
     * scope of yii
     * @return array
     * @see scope of yii
     */
    public function scopes(){
    	return array(
    			'alias'=>'mite_monitor',
    			'condition'=>'mite_monitor.is_deleted=0',
    	);
    
    }
    /**
     * @return array
     */
    public function relations()
    {
    	// NOTE: you may need to adjust the relation name and the related
    	// class name for the relations automatically generated below.
    	$oldValue = parent::relations();
    	
    	return CMap::mergeArray($oldValue,array(
    			'property' => array(self::BELONGS_TO,'Property',array('property_id'=>'id'),'through'=> 'block'),
    			'grower'=>array(self::BELONGS_TO,'Grower',array('grower_id'=>'id'),'through'=> 'property'),
    		)
    	);
    }
    
    /**
     * @return Mite[]
     */
    public function getMite(){
    	$criteria = new CDbCriteria();
    	$criteria->condition = 'is_deleted=:is_deleted';
    	$criteria->params = array(':is_deleted'=>'0');
    	$criteria->order = 'name';
    	return Mite::model()->findAll($criteria);
    }
    
    /**
     * @return Block[]
     */
    public function getGrowerBlock(){
    	$sql="SELECT b.id as id,b.name as name,CONCAT (g.name,' - ',p.name,' - ',b.name) AS block_name
		FROM ".Block::model()->tableName()." b
    			INNER JOIN ".Property::model()->tableName()." p ON b.property_id = p.id
    			INNER JOIN ".Grower::model()->tableName()." g ON p.grower_id = g.id
    	ORDER BY g.name";
    	return new CSqlDataProvider($sql, array(
    			'pagination'=>false,
    	));
    }
    
    /**
     * @return Block[]
     */
    public function getBlock(){
    	$criteria = new CDbCriteria();
    	$criteria->condition = 'is_deleted=:is_deleted';
    	$criteria->params = array(':is_deleted'=>'0');
    	$criteria->order = 'name';
    	return Block::model()->findAll($criteria);
    }
    
    /**
     * @return Grower[]
     */
    public function getGrower(){
    	$criteria = new CDbCriteria();
    	$criteria->condition = 'is_deleted=:is_deleted';
    	$criteria->params = array(':is_deleted'=>'0');
    	$criteria->order = 'name';
    	return Grower::model()->findAll($criteria);
    }
    
    
    /**
     * @return Property[]
     */
    public function getProperty(){
    	$criteria = new CDbCriteria();
    	$criteria->condition = 'is_deleted=:is_deleted';
    	$criteria->params = array(':is_deleted'=>'0');
    	$criteria->order = 'name';
    	return Property::model()->findAll($criteria);
    }
    
    /**
     * This function is used to get data for Graphs
     * @static
     * @return CActiveDataProvider
     */
    public function getMiteMonitorInRange($filter){
    	$block_id = isset($filter['block_id'])?$filter['block_id']:'';
    	$date_from = isset($filter['date_from'])?$filter['date_from']:'';
    	$date_to = isset($filter['date_to'])?$filter['date_to']:'';
    
    	$condition = $block_id ? 'WHERE mm.block_id ='. $block_id : ' ';
    	if ($date_from && $date_to)
    		$condition .= " AND (mm.date BETWEEN '$date_from' AND '$date_to') ";
    	elseif ($date_from)
    	   $condition .= " AND mm.date >= '$date_from' ";
    	elseif ($date_to)
    	   $condition .= " AND mm.date <= '$date_to' ";
    
    	$sql="SELECT mm.date AS mm_date,mm.no_days AS mm_no_days,mm.percent_li ,mm.average_li ,m.name AS mite_name , p.location_id, mm.block_id,
			((SELECT pr.percent_li FROM ".$this->tableName()." pr WHERE pr.date < mm.date AND pr.mite_id = mm.mite_id AND pr.block_id = mm.block_id ORDER BY DATE DESC LIMIT 1) + mm.percent_li)/2 AS mm_average_li 
		FROM ".$this->tableName()." mm
		INNER JOIN ".Mite::model()->tableName()." m ON mm.mite_id = m.id
		INNER JOIN ".Block::model()->tableName()." b ON mm.block_id = b.id
        INNER JOIN ".Property::model()->tableName()." p ON b.property_id = p.id
		".$condition."
		ORDER BY mm.date DESC";
    	return new CSqlDataProvider($sql, array(
    			'pagination'=>false,
    	));
    }
    
    /**
     * This function is used to get data for Graphs
     * @static
     * @return CActiveDataProvider
     */
    public function getMiteMonitorInRangeByLocation($filter){
    	$location_id = isset($filter['location_id'])?$filter['location_id']:'';
    	$date_from = isset($filter['date_from'])?$filter['date_from']:'';
    	$date_to = isset($filter['date_to'])?$filter['date_to']:'';
    
    	$condition = "WHERE p.location_id = '$location_id'";
    	if ($date_from && $date_to)
    		$condition .= " AND (mm.date BETWEEN '$date_from' AND '$date_to') ";
    	elseif ($date_from)
    	   $condition .= " AND mm.date >= '$date_from' ";
    	elseif ($date_to)
    	   $condition .= " AND mm.date <= '$date_to' ";
    
    	$sql="SELECT mm.date AS mm_date,mm.no_days AS mm_no_days,mm.percent_li ,mm.average_li ,m.name AS mite_name , p.location_id, mm.block_id,
			((SELECT pr.percent_li FROM ".$this->tableName()." pr WHERE pr.date < mm.date AND pr.mite_id = mm.mite_id AND pr.block_id = mm.block_id ORDER BY DATE DESC LIMIT 1) + mm.percent_li)/2 AS mm_average_li 
		FROM ".$this->tableName()." mm
		INNER JOIN ".Mite::model()->tableName()." m ON mm.mite_id = m.id
		INNER JOIN ".Block::model()->tableName()." b ON mm.block_id = b.id
        INNER JOIN ".Property::model()->tableName()." p ON b.property_id = p.id
		".$condition."
		ORDER BY mm.date DESC";
    	return new CSqlDataProvider($sql, array(
    			'pagination'=>false,
    	));
    }        
}