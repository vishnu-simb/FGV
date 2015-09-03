<?php

/**
 * @property Property $property
 * @property Grower $grower
 */

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
	
	function getTrapByBlock(){
	    if(isset($this->block->id)){
			return $this->findAllByAttributes(array('block_id'=>$this->block->id),array('order'=>'name'));
		}else{
            if(isset($this->grower) && !empty($this->grower)){
    			$blocks = $this->getBlockByGrower();
                $block = array();
                foreach($blocks as $b){
    				$block[] = $b->id;
    			}
                return $this->findAllByAttributes(array('block_id'=>$block),array('order'=>'name'));
            }else{
                return $this->findAll(array('order'=>'name'));
            }
		}
	    
		
	}
	function getPropertyByGrower(){
		if(isset($this->grower) && !empty($this->grower)){
			return Property::model()->findAllByAttributes(array('grower_id'=>$this->grower),array('order'=>'name'));
		}else{
			return $this->getProperty();
		}
	}
	function getBlockByProperty(){
		if(isset($this->property) && !empty($this->property)){
			return Block::model()->findAllByAttributes(array('property_id'=>$this->property),array('order'=>'name'));
		}elseif(isset($this->grower) && !empty($this->grower)){
			$properties = $this->getPropertyByGrower();
			$prop = array();
			foreach($properties as $property){
				$prop[] = $property->id;
			}
			return Block::model()->findAllByAttributes(array('property_id'=>$prop),array('order'=>'name'));
		}else{
			return $this->getBlock()->getData();
		}
	}
    function getBlockByGrower(){
        if(isset($this->grower) && !empty($this->grower)){
			$properties = Property::model()->findAllByAttributes(array('grower_id'=>$this->grower),array('order'=>'name'));
			$prop = array();
			foreach($properties as $property){
				$prop[] = $property->id;
			}
			return Block::model()->findAllByAttributes(array('property_id'=>$prop),array('order'=>'name'));
		}else{
			return $this->getBlock()->getData();
		}
    }
}