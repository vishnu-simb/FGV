<?php

/**
 * This is the model base class for the table "{{biofix}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Biofix".
 *
 * Columns in table "{{biofix}}" available as properties of the model,
 * followed by relations of table "{{biofix}}" available as properties of the model.
 *
 * @property string $pest_id
 * @property integer $block_id
 * @property string $second_cohort
 * @property string $date
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
 */
abstract class BaseBiofix extends SimbActiveRecord{
	
    public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}

	public function tableName()
    {
		return '{{biofix}}';
	}

	public static function representingColumn()
    {
		return 'second_cohort';
	}

	public function rules()
    {
		return array(
			array('pest_id, block_id', 'required'),
			array('block_id, ordering, status, is_deleted', 'numerical', 'integerOnly'=>true),
			array('pest_id', 'length', 'max'=>10),
			array('second_cohort', 'length', 'max'=>3),
			array('creator_id', 'length', 'max'=>20),
			array('date, created_at, updated_at, params', 'safe'),
			array('second_cohort, date, creator_id, ordering, created_at, updated_at, status, is_deleted, params', 'default', 'setOnEmpty' => true, 'value' => null),
			array('pest_id, block_id, second_cohort, date, creator_id, ordering, created_at, updated_at, status, is_deleted, params, rowsPerPage', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
    {
		return array(
			'block' => array(self::BELONGS_TO, 'Block', 'block_id'),
			'pest' => array(self::BELONGS_TO, 'Pest', 'pest_id'),
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
			'pest_id' => Yii::t('app', 'Pest Id'),
			'block_id' => Yii::t('app', 'Block Id'),
			'pest.name' => Yii::t('app', 'Pest'),
			'block.name' => Yii::t('app', 'Block'),
			'second_cohort' => Yii::t('app', 'Second Cohort?'),
			'block.property_id' => Yii::t('app', 'Property'),
			'date' => Yii::t('app', 'Biofix Date'),
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

		$criteria->compare('pest_id', $this->pest_id);
		$criteria->compare('block_id', $this->block_id);
		$criteria->compare('block.name', '');
		$criteria->compare('pest.name', '');
		$criteria->compare('second_cohort', $this->second_cohort, true);
		$criteria->compare('date', $this->date, true);
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