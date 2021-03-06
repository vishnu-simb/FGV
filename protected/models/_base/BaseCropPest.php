<?php

/**
 * This is the model base class for the table "{{crop_pest}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "CropPest".
 *
 * Columns in table "{{crop_pest}}" available as properties of the model,
 * followed by relations of table "{{crop_pest}}" available as properties of the model.
 *
 * @property string $id
 * @property string $name
 * @property string $calculate
 * @property string $color
 * @property integer $fruit_type_id
 * @property string $creator_id
 * @property integer $ordering
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 * @property integer $is_deleted
 * @property string $params
 *
 * @property Biofix[] $biofixes
 * @property Trap[] $traps
 */
abstract class BaseCropPest extends SimbActiveRecord{
    public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}

	public function tableName()
    {
		return '{{crop_pest}}';
	}

	public static function representingColumn()
    {
		return 'name';
	}

	public function rules()
    {
		return array(
			array('name, calculate, fruit_type_id, color', 'required','except' => 'search'),
			array('ordering, status, is_deleted, fruit_type_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>100),
			array('calculate', 'length', 'max'=>3),
			array('creator_id', 'length', 'max'=>20),
			array('created_at, updated_at, params', 'safe'),
			array('creator_id, ordering, created_at, updated_at, status, is_deleted, params', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, name, calculate, creator_id, ordering, created_at, updated_at, status, is_deleted, params, rowsPerPage', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
    {
		return array(
			'biofixes' => array(self::HAS_MANY, 'Biofix', 'id'),
			'traps' => array(self::HAS_MANY, 'Trap', 'pest_id'),
            'fruit_type' => array(self::BELONGS_TO, 'FruitType', 'fruit_type_id'),
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
			'name' => Yii::t('app', 'Name'),
			'calculate' => Yii::t('app', 'Enable Calculations'),
			'color' => Yii::t('app', 'Color'),
            'fruit_type_id' => Yii::t('app', 'Fruit Type'),
			'creator_id' => Yii::t('app', 'Creator'),
			'ordering' => Yii::t('app', 'Ordering'),
			'created_at' => Yii::t('app', 'Created At'),
			'updated_at' => Yii::t('app', 'Updated At'),
			'status' => Yii::t('app', 'Status'),
			'is_deleted' => Yii::t('app', 'Is Deleted'),
			'params' => Yii::t('app', 'Params'),
		);
	}

	public function search()
    {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id, true);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('calculate', $this->calculate, true);
        $criteria->compare('fruit_type_id', $this->fruit_type_id, true);
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