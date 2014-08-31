<?php

/**
 * @property Property $property
 * @property Grower $grower
 */

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
    
    
    /**
     * @return array
     */
    public function relations()
    {
    	// NOTE: you may need to adjust the relation name and the related
    	// class name for the relations automatically generated below.
    	$oldValue = parent::relations();
    	return CMap::mergeArray($oldValue,array(
    			'property' => array(self::BELONGS_TO,'Property',array('property_id'=>'id'),'through'=> 'block'),
    			'grower'=>array(self::BELONGS_TO,'Grower',array('grower_id'=>'id'),'through'=> 'property'),
    	)
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
    	$criteria->order = 'name';
    	return Block::model()->findAll($criteria);
    }
    
    /**
     * @return Block[]
     */
    public function getBlockByAttributes($grower_id){
    	return Block::model()->with(array('property'=>array('condition'=>'property.grower_id='.$grower_id)))->findAll();
    }
    
    
    /**
     * @return Chemical[]
     */
    public function getChemical(){
    	$criteria = new CDbCriteria();
    	$criteria->condition = 'is_deleted=:is_deleted';
    	$criteria->params = array(':is_deleted'=>'0');
    	$criteria->order = 'name';
    	return Chemical::model()->findAll($criteria);
    }
    
    /**
     * @return Property[]
     */
    public function getProperty(){
    	$criteria = new CDbCriteria();
    	$criteria->condition = 'is_deleted=:is_deleted';
    	$criteria->params = array(':is_deleted'=>'0');
    	$criteria->order = 'name';
    	return Property::model()->findAll($criteria);
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
    
}