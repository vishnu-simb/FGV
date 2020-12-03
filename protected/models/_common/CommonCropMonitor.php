<?php

/**
 * @property Block $block
 * @property Property $property
 * @property Grower $grower
 */

Yii::import('application.models._base.BaseCropMonitor');

class CommonCropMonitor extends BaseCropMonitor
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);

    }

    /**
     * default scope
     * @return array
     * @see defaultScope
     */
    public function defaultScope()
    {

        return array(
            'alias' => 'crop_monitor',
            'condition' => 'crop_monitor.is_deleted=0',
            'order' => 'crop_monitor.id DESC'
        );
    }


    /**
     * scope of yii
     * @return array
     * @see scope of yii
     */
    public function scopes()
    {
        return array(
            'alias' => 'crop_monitor',
            'condition' => 'crop_monitor.is_deleted=0',
        );

    }

    public function attributeLabels()
    {
        $oldValue = parent::attributeLabels();
        return CMap::mergeArray($oldValue, array(
            'block.name' => Yii::t('app', 'Block'),
            'pest.name' => Yii::t('app', 'Crop Pest'),
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
        return CMap::mergeArray($oldValue, array(
                'property' => array(self::BELONGS_TO, 'Property', array('property_id' => 'id'), 'through' => 'block'),
                'grower' => array(self::BELONGS_TO, 'Grower', array('grower_id' => 'id'), 'through' => 'property'),
            )
        );
    }

    /**
     * @return Trap[]
     */
    public function getTrap()
    {
        $sql = "SELECT t.id as id,t.name as name,CONCAT (g.name,' - ',p.name,' - ',b.name,' - ',t.name)AS trap_name
		FROM " . Trap::model()->tableName() . " t
				INNER JOIN " . Block::model()->tableName() . " b ON t.block_id = b.id
    			INNER JOIN " . Property::model()->tableName() . " p ON b.property_id = p.id
    			INNER JOIN " . Grower::model()->tableName() . " g ON p.grower_id = g.id
    	ORDER BY g.name";
        return new CSqlDataProvider($sql, array(
            'pagination' => false,
        ));
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
     * @return Grower[]
     */
    public function getGrower()
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'is_deleted=:is_deleted';
        $criteria->params = array(':is_deleted' => '0');
        $criteria->order = 'name';
        return Grower::model()->findAll($criteria);
    }


    /**
     * @return Property[]
     */
    public function getProperty()
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'is_deleted=:is_deleted';
        $criteria->params = array(':is_deleted' => '0');
        $criteria->order = 'name';
        return Property::model()->findAll($criteria);
    }

    /**
     * @return Pest[]
     */
    public function getPest(){
        $criteria = new CDbCriteria();
        $criteria->condition = 'is_deleted=:is_deleted';
        $criteria->params = array(':is_deleted'=>'0');
        $criteria->order = 'name';
        return CropPest::model()->findAll($criteria);
    }

    /**
     * This function is used to get data for Graphs
     * @static
     * @return CActiveDataProvider
     */
    public function getCropMonitorInRange($filter)
    {
        $block_id = isset($filter['block_id']) ? $filter['block_id'] : '';
        $date_from = isset($filter['date_from']) ? $filter['date_from'] : '';
        $date_to = isset($filter['date_to']) ? $filter['date_to'] : '';

        $condition = $block_id ? 'WHERE em.block_id =' . $block_id : ' ';
        if ($date_from && $date_to)
            $condition .= " AND (em.date BETWEEN '$date_from' AND '$date_to') ";
        elseif ($date_from)
            $condition .= " AND em.date >= '$date_from' ";
        elseif ($date_to)
            $condition .= " AND em.date <= '$date_to' ";

        $sql = "SELECT em.date AS em_date,em.value as em_value,pt.name AS pest_name
		FROM " . $this->tableName() . " em
		INNER JOIN " . CropPest::model()->tableName() . " pt ON em.pest_id = pt.id
		INNER JOIN " . Block::model()->tableName() . " b ON em.block_id = b.id
		" . $condition . " 
		ORDER BY em.date DESC";
        return new CSqlDataProvider($sql, array(
            'pagination' => false,
        ));
    }

    /**
     * This function is used to get data for Graphs
     * @static
     * @return CActiveDataProvider
     */
    public function getCropMonitorInRangeByLocation($filter)
    {
        $location_id = isset($filter['location_id']) ? $filter['location_id'] : '';
        $date_from = isset($filter['date_from']) ? $filter['date_from'] : '';
        $date_to = isset($filter['date_to']) ? $filter['date_to'] : '';

        if (is_array($location_id))
            $condition = "WHERE p.location_id IN ('" . implode("','", $location_id) . "')";
        else
            $condition = "WHERE p.location_id = '$location_id'";
        if ($date_from && $date_to)
            $condition .= " AND (em.date BETWEEN '$date_from' AND '$date_to') ";
        elseif ($date_from)
            $condition .= " AND em.date >= '$date_from' ";
        elseif ($date_to)
            $condition .= " AND em.date <= '$date_to' ";

        $sql = "SELECT em.date AS em_date,SUM(em.value) as em_value,pt.name AS pest_name
		FROM " . $this->tableName() . " em
		INNER JOIN " . CropPest::model()->tableName() . " pt ON em.pest_id = pt.id
		INNER JOIN " . Block::model()->tableName() . " b ON em.block_id = b.id
        INNER JOIN " . Property::model()->tableName() . " p ON b.property_id = p.id
		" . $condition . " 
        GROUP BY pt.name,em.date
		ORDER BY em.date DESC";
        return new CSqlDataProvider($sql, array(
            'pagination' => false,
        ));
    }

    function getTrapByBlock()
    {

        if (isset($this->block) && !empty($this->block)) {
            return Trap::model()->findAllByAttributes(array('block_id' => $this->block), array('order' => 'name'));
        } else {
            if (isset($this->grower) && !empty($this->grower)) {
                $blocks = $this->getBlockByProperty();
                $block = array();
                foreach ($blocks as $b) {
                    $block[] = $b->id;
                }
                return Trap::model()->findAllByAttributes(array('block_id' => $block), array('order' => 'name'));
            } else {
                return $this->getTrap()->getData();
            }
        }
    }

    function getTrapByGrower()
    {

        if (isset($this->grower) && !empty($this->grower)) {
            $properties = $this->getPropertyByGrower();
            $prop = array();
            foreach ($properties as $property) {
                $prop[] = $property->id;
            }
            $blocks = Block::model()->findAllByAttributes(array('property_id' => $prop), array('order' => 'name'));
            $block = array();
            foreach ($blocks as $b) {
                $block[] = $b->id;
            }

            return Trap::model()->findAllByAttributes(array('block_id' => $block), array('order' => 'name'));
        } else {
            return $this->getTrap()->getData();
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

    function getPropertyByGrower()
    {
        if (isset($this->grower) && !empty($this->grower)) {
            return Property::model()->findAllByAttributes(array('grower_id' => $this->grower), array('order' => 'name'));
        } else {
            return $this->getProperty();
        }
    }

    function getBlockByProperty()
    {
        if (isset($this->property) && !empty($this->property)) {
            return Block::model()->findAllByAttributes(array('property_id' => $this->property), array('order' => 'name'));
        } elseif (isset($this->grower) && !empty($this->grower)) {
            $properties = $this->getPropertyByGrower();
            $prop = array();
            foreach ($properties as $property) {
                $prop[] = $property->id;
            }
            return Block::model()->findAllByAttributes(array('property_id' => $prop), array('order' => 'name'));
        } else {
            return $this->getBlock();
        }
    }
}