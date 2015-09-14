<?php

/**
 * This is the model base class for the table "{{block}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Block".
 *
 * Columns in table "{{block}}" available as properties of the model,
 * followed by relations of table "{{block}}" available as properties of the model.
 *
 * @property integer $id
 * @property integer $property_id
 * @property string $name
 * @property string $tree_spacing
 * @property integer $tree_variety
 * @property double $row_width
 * @property string $creator_id
 * @property integer $ordering
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 * @property integer $is_deleted
 * @property string $params
 *
 * @property Property $property
 */
abstract class BaseBlock extends SimbActiveRecord{
	
	public $_addTrap ='yes';
	
    public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}

	public function tableName()
    {
		return '{{block}}';
	}

	public static function representingColumn()
    {
		return 'name';
	}

	public function rules()
    {
		return array(
			array('property_id, name', 'required','except' => 'search'),
			array('property_id, ordering, status, is_deleted', 'numerical', 'integerOnly'=>true),
			array('row_width', 'numerical'),
			array('name', 'length', 'max'=>45),
			array('tree_spacing', 'length', 'max'=>11),
			array('creator_id', 'length', 'max'=>20),
			array('created_at, updated_at, params', 'safe'),
			array('tree_spacing, tree_variety, row_width, creator_id, ordering, created_at, updated_at, status, is_deleted, params', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, grower,location, property_id, name, tree_spacing, tree_variety, row_width, creator_id, ordering, created_at, updated_at, status, is_deleted, params, rowsPerPage', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
    {
		return array(
			'property' => array(self::BELONGS_TO, 'Property', 'property_id'),
            'variety' => array(self::BELONGS_TO, 'Variety', 'tree_variety'),
            'fruit_type'=>array(self::BELONGS_TO,'FruitType',array('fruit_type_id'=>'id'),'through'=> 'variety'),
		);
	}

	public function pivotModels()
    {
		return array(
		);
	}

	public function attributeLabels()
    {
		return array(
			'id' => Yii::t('app', 'ID'),
			'property_id' => Yii::t('app', 'Property'),
			'name' => Yii::t('app', 'Block'),
			'tree_spacing' => Yii::t('app', 'Tree Spacing'),
			'tree_variety' => Yii::t('app', 'Tree Variety'),
			'row_width' => Yii::t('app', 'Row Width'),
			'creator_id' => Yii::t('app', 'Creator'),
			'ordering' => Yii::t('app', 'Ordering'),
			'created_at' => Yii::t('app', 'Created At'),
			'updated_at' => Yii::t('app', 'Updated At'),
			'status' => Yii::t('app', 'Status'),
			'is_deleted' => Yii::t('app', 'Is Deleted'),
			'params' => Yii::t('app', 'Params'),
			'_addTrap' => Yii::t('app', 'Wish To Add Trap'),
		);
	}

	public function search()
    {
		$criteria = new CDbCriteria;
		$criteria->with=array('property','grower');
		$criteria->compare('id', $this->id);
		$criteria->compare('property_id', $this->property_id);
		$criteria->compare('block.name', $this->name);
		$criteria->compare('property.location_id', $this->location);
		$criteria->compare('property.grower_id', $this->grower);
		$criteria->compare('tree_spacing', $this->tree_spacing, true);
		$criteria->compare('tree_variety', $this->tree_variety, true);
		$criteria->compare('row_width', $this->row_width);
		$criteria->compare('creator_id', $this->creator_id, true);
		$criteria->compare('ordering', $this->ordering);
		$criteria->compare('created_at', $this->created_at, true);
		$criteria->compare('updated_at', $this->updated_at, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('is_deleted', $this->is_deleted);
		$criteria->compare('params', $this->params, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'pagination' => array(
				'pageSize' => $this->rowsPerPage,
			)
		));
	}

}