<?php

/**
 * This is the model base class for the table "{{grower}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Grower".
 *
 * Columns in table "{{grower}}" available as properties of the model,
 * followed by relations of table "{{grower}}" available as properties of the model.
 *
 * @property integer $id
 * @property string $grower_name
 * @property string $grower_username
 * @property string $grower_password
 * @property string $grower_email
 * @property string $grower_enabled
 * @property string $grower_reporting
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
abstract class BaseGrower extends SimbActiveRecord{
    public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}

	public function tableName()
    {
		return '{{grower}}';
	}

	public static function representingColumn()
    {
		return 'grower_name';
	}

	public function rules()
    {
		return array(
			array('grower_name, grower_username, grower_password, grower_email', 'required'),
			array('ordering, status, is_deleted', 'numerical', 'integerOnly'=>true),
			array('grower_name', 'length', 'max'=>100),
			array('grower_username, grower_password', 'length', 'max'=>45),
			array('grower_enabled', 'length', 'max'=>3),
			array('grower_reporting', 'length', 'max'=>7),
			array('creator_id', 'length', 'max'=>20),
			array('created_at, updated_at, params', 'safe'),
			array('grower_enabled, grower_reporting, creator_id, ordering, created_at, updated_at, status, is_deleted, params', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, grower_name, grower_username, grower_password, grower_email, grower_enabled, grower_reporting, creator_id, ordering, created_at, updated_at, status, is_deleted, params, rowsPerPage', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
    {
		return array(
			'properties' => array(self::HAS_MANY, 'Property', 'grower_id'),
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
			'grower_name' => Yii::t('app', 'Grower Name'),
			'grower_username' => Yii::t('app', 'Grower Username'),
			'grower_password' => Yii::t('app', 'Grower Password'),
			'grower_email' => Yii::t('app', 'Grower Email'),
			'grower_enabled' => Yii::t('app', 'Grower Enabled'),
			'grower_reporting' => Yii::t('app', 'Grower Reporting'),
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
		$criteria->compare('grower_name', $this->grower_name, true);
		$criteria->compare('grower_username', $this->grower_username, true);
		$criteria->compare('grower_password', $this->grower_password, true);
		$criteria->compare('grower_email', $this->grower_email, true);
		$criteria->compare('grower_enabled', $this->grower_enabled, true);
		$criteria->compare('grower_reporting', $this->grower_reporting, true);
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