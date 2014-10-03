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
}