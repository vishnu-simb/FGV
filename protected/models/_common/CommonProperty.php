<?php

Yii::import('application.models._base.BaseProperty');

class CommonProperty extends BaseProperty
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
    			'alias'=>'property',
    			'condition'=>'property.is_deleted=0',
    	);
    
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
     * @return Location[]
     */
    public function getLocation(){
    	$criteria = new CDbCriteria();
    	$criteria->condition = 'is_deleted=:is_deleted';
    	$criteria->params = array(':is_deleted'=>'0');
    	return Location::model()->findAll($criteria);
    }

}

