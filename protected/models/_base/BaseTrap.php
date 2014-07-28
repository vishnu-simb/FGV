<?php

/**
 * This is the model base class for the table "{{trap}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Trap".
 *
 * Columns in table "{{trap}}" available as properties of the model,
 * followed by relations of table "{{trap}}" available as properties of the model.
 *
 * @property integer $id
 * @property string $pest_id
 * @property integer $block_id
 * @property string $name
 * @property string $creator_id
 * @property integer $ordering
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 * @property integer $is_deleted
 * @property string $params
 *
 * @property Block $block
 * @property Pest $pest
 * @property TrapCheck[] $trapChecks
 */
abstract class BaseTrap extends SimbActiveRecord{
    public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}

	public function tableName()
    {
		return '{{trap}}';
	}

	public static function representingColumn()
    {
		return 'name';
	}

	public function rules()
    {
		return array(
			array('pest_id, block_id', 'required'),
			array('block_id, ordering, status, is_deleted', 'numerical', 'integerOnly'=>true),
			array('pest_id', 'length', 'max'=>10),
			array('name', 'length', 'max'=>100),
			array('creator_id', 'length', 'max'=>20),
			array('created_at, updated_at, params', 'safe'),
			array('name, creator_id, ordering, created_at, updated_at, status, is_deleted, params', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, pest_id, block_id, name, creator_id, ordering, created_at, updated_at, status, is_deleted, params, rowsPerPage', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
    {
		return array(
			'block' => array(self::BELONGS_TO, 'Block', 'block_id'),
			'pest' => array(self::BELONGS_TO, 'Pest', 'pest_id'),
			'trapChecks' => array(self::HAS_MANY, 'TrapCheck', 'trap_id'),
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
			'pest_id' => Yii::t('app', 'Pest'),
			'block_id' => Yii::t('app', 'Block'),
			'name' => Yii::t('app', 'Name'),
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

		$criteria->compare('id', $this->id);
		$criteria->compare('pest_id', $this->pest_id);
		$criteria->compare('block_id', $this->block_id);
		$criteria->compare('name', $this->name, true);
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