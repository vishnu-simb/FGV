<?php

Yii::import('application.models._base.BaseMite');

class CommonMite extends BaseMite
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
    			'alias'=>'mite',
    			'condition'=> 'mite.is_deleted=0',
    			'order'=>'mite.id DESC'
    	);
    }
    
    
    /**
     * scope of yii
     * @return array
     * @see scope of yii
     */
    public function scopes(){
    	return array(
    			'alias'=>'mite',
    			'condition'=>'mite.is_deleted=0',
    	);
    
    }
    
    /**
     * @return Mite
     */
    public function getByNameLike($name){
    	return self::model()->find("LOWER(name) LIKE '". strtolower($name) ."%'");
    }
}