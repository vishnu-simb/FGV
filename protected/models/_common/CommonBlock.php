<?php

Yii::import('application.models._base.BaseBlock');

class CommonBlock extends BaseBlock
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    /**
     * scope of yii
     * @return array
     * @see scope of yii
     */
    public function scopes(){
    	return array(
    			'alias'=>'block',
    			'condition'=>'block.is_deleted=0',
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
    			'grower'=>array(
						self::BELONGS_TO,'Grower',array('grower_id'=>'id'),'through'=>'property'
			 ),
    	)
    	);
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