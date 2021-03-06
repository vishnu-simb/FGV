<?php

/**
 * This is the model base class for the table "{{location}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Location".
 *
 * Columns in table "{{location}}" available as properties of the model,
 * followed by relations of table "{{location}}" available as properties of the model.
 *
 * @property string $id
 * @property string $name
 * @property string $observation
 * @property string $forcast
 * @property string $creator_id
 * @property integer $ordering
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 * @property integer $is_deleted
 * @property string $params
 *
 * @property Property[] $properties
 */
abstract class BaseLocation extends SimbActiveRecord{
    public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}

	public function tableName()
    {
		return '{{location}}';
	}

	public static function representingColumn()
    {
		return 'id';
	}

	public function rules()
    {
		return array(
			array('id', 'required','except' => 'search'),
			array('ordering, status, is_deleted', 'numerical', 'integerOnly'=>true),
			array('id, name', 'length', 'max'=>100),
			array('observation, forcast', 'length', 'max'=>45),
			array('creator_id', 'length', 'max'=>20),
			array('created_at, updated_at, params', 'safe'),
			array('name, observation, forcast, creator_id, ordering, created_at, updated_at, status, is_deleted, params', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, name, observation, forcast, creator_id, ordering, created_at, updated_at, status, is_deleted, params, rowsPerPage', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
    {
		return array(
			'properties' => array(self::HAS_MANY, 'Property', 'location_id'),
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
			'observation' => Yii::t('app', 'Observation'),
			'forcast' => Yii::t('app', 'Forcast'),
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
		$criteria->compare('observation', $this->observation, true);
		$criteria->compare('forcast', $this->forcast, true);
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