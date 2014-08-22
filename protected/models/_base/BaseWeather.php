<?php

/**
 * @property date $date
 * @property string $location_id
 * @property float $min
 * @property float $max
 * @property interger $creator_id
 * @property integer $ordering
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 * @property integer $is_deleted
 * @property string $params
 *
 * @property Location $location
 */
abstract class BaseWeather extends SimbActiveRecord{
    public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}

	public function tableName()
    {
		return '{{weather}}';
	}

	public static function representingColumn()
    {
		return 'id';
	}

	public function rules()
    {
		return array(
			array('date, location_id', 'required','except' => 'search'),
			array('ordering, status, is_deleted', 'numerical', 'integerOnly'=>true),
            array('min, max', 'numerical', 'integerOnly'=>false),
			array('creator_id', 'length', 'max'=>20),
			array('created_at, updated_at, params', 'safe'),
			array('creator_id, ordering, created_at, updated_at, status, is_deleted, params', 'default', 'setOnEmpty' => true, 'value' => null),
			array('creator_id, ordering, created_at, updated_at, status, is_deleted, params, rowsPerPage', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
    {
		return array(
			'location' => array(self::BELONGS_TO, 'Location', 'location_id'),
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
			'date' => Yii::t('app', 'Date'),
			'location_id' => Yii::t('app', 'Location ID'),
			'min' => Yii::t('app', 'Min'),
			'max' => Yii::t('app', 'Max'),
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

		$criteria->compare('date', $this->date, true);
		$criteria->compare('location_id', $this->location_id, true);
		$criteria->compare('min', $this->min, true);
		$criteria->compare('max', $this->max, true);
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