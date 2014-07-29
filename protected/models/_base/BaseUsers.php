<?php

/**
 * This is the model base class for the table "{{users}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Users".
 *
 * Columns in table "{{users}}" available as properties of the model,
 * and there are no model relations.
 *
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $type
 * @property string $salt
 * @property string $creator_id
 * @property integer $ordering
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 * @property integer $is_deleted
 * @property string $params
 *
 */
abstract class BaseUsers extends SimbActiveRecord{
    public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}

	public function tableName()
    {
		return '{{users}}';
	}

	public static function representingColumn()
    {
		return 'username';
	}

	public function rules()
    {
		return array(
			array('username, password', 'required'),
			//Applies to 'update' scenario
			array('password', 'required' ,'except' => 'update'),
			array('ordering, status, is_deleted', 'numerical', 'integerOnly'=>true),
			array('username, password', 'length', 'max'=>45),
			array('type', 'length', 'max'=>5),
			array('salt', 'length', 'max'=>8),
			array('creator_id', 'length', 'max'=>20),
			array('created_at, updated_at, params', 'safe'),
			array('type, creator_id, ordering, created_at, updated_at, status, is_deleted, params', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, username, password, type, salt, creator_id, ordering, created_at, updated_at, status, is_deleted, params, rowsPerPage', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
    {
		return array(
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
			'username' => Yii::t('app', 'Username'),
			'password' => Yii::t('app', 'Password'),
			'type' => Yii::t('app', 'Type'),
			'salt' => Yii::t('app', 'Salt'),
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
		$criteria->compare('username', $this->username, true);
		$criteria->compare('password', $this->password, true);
		$criteria->compare('type', $this->type, true);
		$criteria->compare('salt', $this->salt, true);
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