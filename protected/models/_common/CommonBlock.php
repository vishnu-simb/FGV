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
     * @return Property[]
     */
    public function getProperty(){
    	$criteria = new CDbCriteria();
    	$criteria->condition = 'is_deleted=:is_deleted';
    	$criteria->params = array(':is_deleted'=>'0');
    	return Property::model()->findAll($criteria);
    }
}