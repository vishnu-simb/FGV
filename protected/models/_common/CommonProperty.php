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
    	$criteria->order = 'name';
    	return Grower::model()->findAll($criteria);
    }
    
    /**
     * @return Location[]
     */
    public function getLocation(){
    	$criteria = new CDbCriteria();
    	$criteria->condition = 'is_deleted=:is_deleted';
    	$criteria->params = array(':is_deleted'=>'0');
    	$criteria->order = 'name';
    	return Location::model()->findAll($criteria);
    }
    
    function getBlocks(){
    	return Block::model()->findAll('property_id='.$this->id);
    }
    
    /**
     * @return Property[]
     */
    function getPropertyByGrower(){
		if(isset($this->grower_id) && !empty($this->grower_id)){
			return $this->findAllByAttributes(array('grower_id'=>$this->grower_id),array('order'=>'name'));
		}else{
			return $this->findAll();
		}
	}
 
}

