<?php

/**
 * @property Block $block
 * @property Property $property
 * @property Grower $grower
 */

Yii::import('application.models._base.BaseTrapCheck');

class CommonTrapCheck extends BaseTrapCheck
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
    			'alias'=>'trap_check',
    			'condition'=> 'trap_check.is_deleted=0',
    			'order'=>'trap_check.id DESC'
    	);
    }
    
    
    /**
     * scope of yii
     * @return array
     * @see scope of yii
     */
    public function scopes(){
    	return array(
    			'alias'=>'trap_check',
    			'condition'=>'trap_check.is_deleted=0',
    	);
    
    }
    
    public function attributeLabels(){
    	$oldValue = parent::attributeLabels();
    	return CMap::mergeArray($oldValue,array(
    			'trap.name' => Yii::t('app', 'Trap'),
    	));
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
    			'block' => array(self::BELONGS_TO,'Block',array('block_id'=>'id'),'through'=> 'trap'),
    			'property' => array(self::BELONGS_TO,'Property',array('property_id'=>'id'),'through'=> 'block'),
    			'grower'=>array(self::BELONGS_TO,'Grower',array('grower_id'=>'id'),'through'=> 'property'),
    	)
    	);
    }
    
    /**
     * @return Trap[]
     */
    public function getTrap(){
    	$criteria = new CDbCriteria();
    	$criteria->condition = 'is_deleted=:is_deleted';
    	$criteria->params = array(':is_deleted'=>'0');
    	return Trap::model()->findAll($criteria);
    }

    /**
     * @return Block[]
     */
    public function getBlock(){
    	$criteria = new CDbCriteria();
    	$criteria->condition = 'is_deleted=:is_deleted';
    	$criteria->params = array(':is_deleted'=>'0');
    	return Block::model()->findAll($criteria);
    }
    
    /**
     * @return Grower[]
     */
    public function getGrower(){
    	$criteria = new CDbCriteria();
    	$criteria->condition = 'is_deleted=:is_deleted';
    	$criteria->params = array(':is_deleted'=>'0');
    	return Grower::model()->findAll($criteria);
    }
    
    
    /**
     * @return Property[]
     */
    public function getProperty(){
    	$criteria = new CDbCriteria();
    	$criteria->condition = 'is_deleted=:is_deleted';
    	$criteria->params = array(':is_deleted'=>'0');
    	return Property::model()->findAll($criteria);
    }
    
    
    /**
     * This function is used to get data for Graphs
	 * @static
	 * @return CActiveDataProvider
	 */
    public function getTrapCheckInRange($filter){
        $block_id = isset($filter['block_id'])?$filter['block_id']:'';
        $date_from = isset($filter['date_from'])?$filter['date_from']:'';
        $date_to = isset($filter['date_to'])?$filter['date_to']:'';
        
        $condition = $block_id ? 'WHERE t.block_id ='. $block_id : ' ';
		if ($date_from && $date_to)
            $condition .= " AND (tc.date BETWEEN '$date_from' AND '$date_to') ";
        elseif ($date_from)
            $condition .= " AND tc.date >= '$date_from' ";
        elseif ($date_to)
            $condition .= " AND tc.date <= '$date_to' ";
            
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