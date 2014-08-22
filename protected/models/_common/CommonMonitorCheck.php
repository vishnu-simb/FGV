<?php

/**
 * @property Block $block
 * @property Property $property
 * @property Grower $grower
 * @property Mite $mite
 */

Yii::import('application.models._base.BaseMonitorCheck');


class CommonMonitorCheck extends BaseMonitorCheck
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
    			'alias'=>'monitor_check',
    			'condition'=> 'monitor_check.is_deleted=0',
    			'order'=>'monitor_check.id DESC'
    	);
    }
    
    
    /**
     * scope of yii
     * @return array
     * @see scope of yii
     */
    public function scopes(){
    	return array(
    			'alias'=>'monitor_check',
    			'condition'=>'monitor_check.is_deleted=0',
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

				'block' => array(self::BELONGS_TO,'Block',array('block_id'=>'id'),'through'=> 'monitor'),
				'property' => array(self::BELONGS_TO,'Property',array('property_id'=>'id'),'through'=> 'block'),
				'grower'=>array(self::BELONGS_TO,'Grower',array('grower_id'=>'id'),'through'=> 'property'),
    			'mite' => array(self::BELONGS_TO,'Mite',array('mite_id'=>'id'),'through'=> 'monitor'),
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
    	return Mite::model()->findAll($criteria);
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
}