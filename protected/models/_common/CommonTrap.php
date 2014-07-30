<?php

Yii::import('application.models._base.BaseTrap');

class CommonTrap extends BaseTrap
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
    			'alias'=>'trap',
    			'condition'=>'trap.is_deleted=0',
    	);
    
    }
    
    public function attributeLabels(){
    	$oldValue = parent::attributeLabels();
    	return CMap::mergeArray($oldValue,array(
    			'block.name' => Yii::t('app', 'Block'),
    			'pest.name' => Yii::t('app', 'Pest'),
    	));
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
}