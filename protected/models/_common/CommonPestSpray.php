<?php

Yii::import('application.models._base.BasePestSpray');

class CommonPestSpray extends BasePestSpray
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
    			'alias'=>'pest_spray',
    			'condition'=>'pest_spray.is_deleted=0',
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
    			'alias'=>'pest_spray',
    			'condition'=>'pest_spray.is_deleted=0',
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
     * @return Pest[]
     */
    public function getPest(){
    	$criteria = new CDbCriteria();
    	$criteria->condition = 'is_deleted=:is_deleted';
    	$criteria->params = array(':is_deleted'=>'0');
    	return Pest::model()->findAll($criteria);
    }
}
