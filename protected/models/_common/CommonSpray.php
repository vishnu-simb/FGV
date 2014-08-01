<?php

Yii::import('application.models._base.BaseSpray');

class CommonSpray extends BaseSpray
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
    			'alias'=>'spray',
    			'condition'=>'spray.is_deleted=0',
    	);
    
    }
    
    public function attributeLabels(){
    	$oldValue = parent::attributeLabels();
    	return CMap::mergeArray($oldValue,array(
    			'block.name' => Yii::t('app', 'Block'),
    			'chemical.name' => Yii::t('app', 'Chemical'),
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
     * @return Chemical[]
     */
    public function getChemical(){
    	$criteria = new CDbCriteria();
    	$criteria->condition = 'is_deleted=:is_deleted';
    	$criteria->params = array(':is_deleted'=>'0');
    	return Chemical::model()->findAll($criteria);
    }
    

    
}