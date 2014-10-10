<?php

/**
 * @property Property $property
 * @property Grower $grower
 */

Yii::import('application.models._base.BaseBiofix');

class CommonBiofix extends BaseBiofix
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
    			'alias'=>'biofix',
    			'condition'=>'biofix.is_deleted=0',
    			'order'=>'biofix.date DESC'
    	);
    }
    
    /**
     * scope of yii
     * @return array
     * @see scope of yii
     */
    public function scopes(){
    	return array(
    			'latest'=>array(
    					'order'=>'biofix.created_at DESC'
    			),
    			'sort'=>array(
    					'order'=>'biofix.ordering ASC',
    			),
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
    
     /**
     * save the spraydate on biofix.
     */
    
    public function beforeSave(){
    	if (parent::beforeSave()) {
    		$this->updated_at = date('Y-m-d H:i:s',time());
    		return true;
    	} else {
    		return false;
    	}
    }
    
    public function afterSave(){
			$bb = Biofix::model()->findByPk($this->id);
    		$bb->params = CJSON::encode($this->getSprayDates());
    		$bb->save(false);
    		parent::afterSave();
    }
    
    private function getSprayDates(){
    	$spraydates = array();
    	$pestSpray = PestSpray::model()->findAllByAttributes(array('pest_id'=>$this->pest_id));
    	$block = Block::model()->findByAttributes(array('id'=>$this->block_id));
    	foreach($pestSpray as $key=>$vv){
    		$spraydates[$vv->id]= $vv->getDate($block,($this->second_cohort=='yes')?true:false,$this->date,true);
    	}
    	return $spraydates;
    }
    
    /**
     * @return Block[]
     */
    public function getBlock(){
    	$sql="SELECT b.id as id,b.name as name,CONCAT (g.name,' - ',p.name,' - ',b.name) AS block_name
		FROM ".Block::model()->tableName()." b
    			INNER JOIN ".Property::model()->tableName()." p ON b.property_id = p.id
    			INNER JOIN ".Grower::model()->tableName()." g ON p.grower_id = g.id  
    	ORDER BY g.name";
    	return new CSqlDataProvider($sql, array(
    			'pagination'=>false,
		));
    }
    
    /**
     * @return Pest[]
     */
    public function getPest(){
    	$criteria = new CDbCriteria();
    	$criteria->condition = 'is_deleted=:is_deleted';
    	$criteria->params = array(':is_deleted'=>'0');
    	$criteria->order = 'name';
    	return Pest::model()->findAll($criteria);
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
     * getter name for block
     * @return  mixed|string
     */
    
    public function displayColBiofixName(){
    	 return $this->grower->name ."". $this->property->name ."". $this->block->name;
    }
}