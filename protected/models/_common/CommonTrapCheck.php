<?php

/**
 * @property Block $block
 * @property Property $property
 * @property Grower $grower
 */

Yii::import('application.models._base.BaseTrapCheck');

class CommonTrapCheck extends BaseTrapCheck
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
    			'alias'=>'trap_check',
    			'condition'=> 'trap_check.is_deleted=0',
    			'order'=>'trap_check.id DESC'
    	);
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
     * @return array
     */
    public function relations()
    {
    	// NOTE: you may need to adjust the relation name and the related
    	// class name for the relations automatically generated below.
    	$oldValue = parent::relations();
    	return CMap::mergeArray($oldValue,array(
    			'block' => array(self::BELONGS_TO,'Block',array('block_id'=>'id'),'through'=> 'trap'),
    			'property' => array(self::BELONGS_TO,'Property',array('property_id'=>'id'),'through'=> 'block'),
    			'grower'=>array(self::BELONGS_TO,'Grower',array('grower_id'=>'id'),'through'=> 'property'),
    	)
    	);
    }

    /**
     * @return Trap[]
     */
    public function getTrap(){
    	$sql="SELECT t.id as id,t.name as name,CONCAT (g.name,' - ',p.name,' - ',b.name,' - ',t.name)AS trap_name
		FROM ".Trap::model()->tableName()." t
				INNER JOIN ".Block::model()->tableName()." b ON t.block_id = b.id
    			INNER JOIN ".Property::model()->tableName()." p ON b.property_id = p.id
    			INNER JOIN ".Grower::model()->tableName()." g ON p.grower_id = g.id
    	ORDER BY g.name";
    	return new CSqlDataProvider($sql, array(
    			'pagination'=>false,
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
     * This function is used to get data for Graphs
	 * @static
	 * @return CActiveDataProvider
	 */
    public function getTrapCheckInRange($filter){
        $block_id = isset($filter['block_id'])?$filter['block_id']:'';
        $date_from = isset($filter['date_from'])?$filter['date_from']:'';
        $date_to = isset($filter['date_to'])?$filter['date_to']:'';
        
        $condition = $block_id ? 'WHERE t.block_id ='. $block_id : ' ';
		if ($date_from && $date_to)
            $condition .= " AND (tc.date BETWEEN '$date_from' AND '$date_to') ";
        elseif ($date_from)
            $condition .= " AND tc.date >= '$date_from' ";
        elseif ($date_to)
            $condition .= " AND tc.date <= '$date_to' ";
            
        $sql="SELECT tc.date AS tc_date,tc.value as tc_value,pt.name AS pest_name
		FROM ".$this->tableName()." tc
		INNER JOIN ".Trap::model()->tableName()." t ON tc.trap_id = t.id
		INNER JOIN ".Pest::model()->tableName()." pt ON t.pest_id = pt.id
		INNER JOIN ".Block::model()->tableName()." b ON t.block_id = b.id
		".$condition." 
		ORDER BY tc.date DESC";
		return new CSqlDataProvider($sql, array(
			'pagination'=>false,
		));
    }
    
    function getTrapByBlock(){
		
		if(isset($this->block) && !empty($this->block)){
			return Trap::model()->findAllByAttributes(array('block_id'=>$this->block),array('order'=>'name'));
		}else{
            if(isset($this->grower) && !empty($this->grower)){
    			$blocks = $this->getBlockByProperty();
                $block = array();
                foreach($blocks as $b){
    				$block[] = $b->id;
    			}
                return Trap::model()->findAllByAttributes(array('block_id'=>$block),array('order'=>'name'));
            }else{
                return $this->getTrap()->getData();
            }
		}
	}
    
    function getTrapByGrower(){
		
		if(isset($this->grower) && !empty($this->grower)){
            $properties = $this->getPropertyByGrower();                   
			$prop = array();
			foreach($properties as $property){
				$prop[] = $property->id;
			}
			$blocks = Block::model()->findAllByAttributes(array('property_id'=>$prop),array('order'=>'name'));
            $block = array();
            foreach($blocks as $b){
				$block[] = $b->id;
			}
                                    
            return Trap::model()->findAllByAttributes(array('block_id'=>$block),array('order'=>'name'));
        }else{
            return $this->getTrap()->getData();
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
			return $this->getBlock();
		}
	}
}