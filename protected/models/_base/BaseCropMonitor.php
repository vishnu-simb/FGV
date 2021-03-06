<?php

/**
 * This is the model base class for the table "{{crop_monitor}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "CropMonitor".
 *
 * Columns in table "{{crop_monitor}}" available as properties of the model,
 * followed by relations of table "{{crop_monitor}}" available as properties of the model.
 *
 * @property string $id
 * @property integer $block_id
 * @property integer $pest_id
 * @property integer $trap_id
 * @property string $date
 * @property string $time
 * @property double $value
 * @property string $duration
 * @property string $comment
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
 * @property Trap $trap
 */
abstract class BaseCropMonitor extends SimbActiveRecord{
	
	public $date_range;
	
    public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}

	public function tableName()
    {
		return '{{crop_monitor}}';
	}

	public static function representingColumn()
    {
		return 'date';
	}

	public function rules()
    {
		return array(
			array('block_id, pest_id, date, time', 'required','except' => 'search'),
			array('block_id, trap_id, ordering, status, is_deleted', 'numerical', 'integerOnly'=>true),
            array('pest_id, duration', 'length', 'max'=>10),
			array('value', 'numerical'),
			array('creator_id', 'length', 'max'=>20),
			array('comment, created_at, updated_at, params', 'safe'),
			array('value, comment, creator_id, ordering, created_at, updated_at, status, is_deleted, params', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, pest_id, block_id, trap, date, time, block, property, grower, value, comment, creator_id, ordering, created_at, updated_at, status, is_deleted, params, rowsPerPage, date_range','safe', 'on'=>'search'),
		);
	}

	public function relations()
    {
		return array(
            'block' => array(self::BELONGS_TO, 'Block', 'block_id'),
            'pest' => array(self::BELONGS_TO, 'CropPest', 'pest_id'),
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
            'pest_id' => Yii::t('app', 'Crop Pest'),
            'block_id' => Yii::t('app', 'Block'),
			'trap_id' => Yii::t('app', 'Trap'),
			'date' => Yii::t('app', 'Date'),
            'time' => Yii::t('app', 'Time'),
			'value' => Yii::t('app', 'Value'),
            'duration' => Yii::t('app', 'Duration'),
			'comment' => Yii::t('app', 'Comment'),
			'creator_id' => Yii::t('app', 'Creator'),
			'ordering' => Yii::t('app', 'Ordering'),
			'created_at' => Yii::t('app', 'Created At'),
			'updated_at' => Yii::t('app', 'Updated At'),
			'status' => Yii::t('app', 'Status'),
			'is_deleted' => Yii::t('app', 'Is Deleted'),
			'params' => Yii::t('app', 'Params'),
			'date_range' => Yii::t('app', 'Date Range'),
		);
	}

	public function search()
    {
		$criteria = new CDbCriteria;
		
		$criteria->with=array('block','property','grower');
		$criteria->compare('id', $this->id, true);
        $criteria->compare('pest_id', $this->pest_id);
        $criteria->compare('block_id', $this->block_id);
		$criteria->compare('trap_id', $this->trap_id);
		$criteria->compare('property.id', $this->property);
		$criteria->compare('grower.id', $this->grower);
		$criteria->compare('date', $this->date, true);
		
		switch ($this->date_range){
				
			case 1:	$criteria->addCondition('date BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 MONTH) AND NOW()');
				break;
			case 2: $criteria->addCondition('date BETWEEN DATE_SUB(CURDATE(), INTERVAL 3 MONTH) AND NOW()');
				break;
			case 3:	$criteria->addCondition('date BETWEEN DATE_SUB(CURDATE(), INTERVAL 6 MONTH) AND NOW()');
				break;
			case 4: 
				break;
			default : $criteria->addCondition('date BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 MONTH) AND NOW()');
				break;
		};
		
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