<?php

Yii::import('application.models._base.BaseTrapCheck');

class CommonTrapCheck extends BaseTrapCheck
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
     * @return Trap[]
     */
    public function getTrap(){
    	$criteria = new CDbCriteria();
    	$criteria->condition = 'is_deleted=:is_deleted';
    	$criteria->params = array(':is_deleted'=>'0');
    	return Trap::model()->findAll($criteria);
    }
}