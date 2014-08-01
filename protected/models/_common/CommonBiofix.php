<?php

Yii::import('application.models._base.BaseBiofix');

class CommonBiofix extends BaseBiofix
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
    			'alias'=>'biofix',
    			'condition'=>'biofix.is_deleted=0',
    			//'order'=>'artwork.sort ASC'
    	);
    }
    
    /**
     * scope of yii
     * @return array
     * @see scope of yii
     */
    public function scopes(){
    	return array(
    			'latest'=>array(
    					'order'=>'biofix.created_at DESC'
    			),
    			'sort'=>array(
    					'order'=>'biofix.ordering ASC',
    			)
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
    		
    				'property' => array(self::BELONGS_TO,'Property',array('property_id'=>'id'),'through'=>'block'),
					'grower'=>array(self::BELONGS_TO,'Grower',array('grower_id'=>'id'),'through'=> 'property'),
    	)
    	);
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
     * @return Pest[]
     */
    public function getPest(){
    	$criteria = new CDbCriteria();
    	$criteria->condition = 'is_deleted=:is_deleted';
    	$criteria->params = array(':is_deleted'=>'0');
    	return Pest::model()->findAll($criteria);
    }
    
    /**
     * getter name for block
     * @return  mixed|string
     */
    
    public function displayColBiofixName(){
    	 return $this->grower->name ."". $this->property->name ."". $this->block->name;
    }
    
}