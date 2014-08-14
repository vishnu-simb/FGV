<?php

/**
 * This is the model base class for the table "{{trap_check}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "TrapCheck".
 *
 * Columns in table "{{trap_check}}" available as properties of the model,
 * followed by relations of table "{{trap_check}}" available as properties of the model.
 *
 * @property string $id
 * @property integer $trap_id
 * @property string $date
 * @property double $value
 * @property string $comment
 * @property string $creator_id
 * @property integer $ordering
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 * @property integer $is_deleted
 * @property string $params
 *
 * @property Trap $trap
 */
abstract class BaseTrapCheck extends SimbActiveRecord{
    public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}

	public function tableName()
    {
		return '{{trap_check}}';
	}

	public static function representingColumn()
    {
		return 'date';
	}

	public function rules()
    {
		return array(
			array('trap_id, date', 'required','except' => 'search'),
			array('trap_id, ordering, status, is_deleted', 'numerical', 'integerOnly'=>true),
			array('value', 'numerical'),
			array('creator_id', 'length', 'max'=>20),
			array('comment, created_at, updated_at, params', 'safe'),
			array('value, comment, creator_id, ordering, created_at, updated_at, status, is_deleted, params', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, trap_id, date, block, property, grower, value, comment, creator_id, ordering, created_at, updated_at, status, is_deleted, params, rowsPerPage', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
    {
		return array(
			'trap' => array(self::BELONGS_TO, 'Trap', 'trap_id'),
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
			'trap_id' => Yii::t('app', 'Trap'),
			'date' => Yii::t('app', 'Date'),
			'value' => Yii::t('app', 'Value'),
			'comment' => Yii::t('app', 'Comment'),
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
		
		$criteria->with=array('block','property','grower');
		$criteria->compare('id', $this->id, true);
		$criteria->compare('trap_id', $this->trap_id);
		$criteria->compare('block.id', $this->block);
		$criteria->compare('property.id', $this->property);
		$criteria->compare('grower.id', $this->grower);
		$criteria->compare('date', $this->date, true);
		$criteria->compare('value', $this->value);
		$criteria->compare('comment', $this->comment, true);
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