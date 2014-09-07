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
 * @property string $name
 * @property string $username
 * @property string $password
 * @property string $salt
 * @property string $resetpassword_key
 * @property string $email
 * @property string $enabled
 * @property string $reporting
 * @property string $weekly_interval
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
	
	public $_addProperty = 'yes';
	
	public $_repassword ;
	
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
		return 'name';
	}

	public function rules()
    {
		return array(
    		array('ordering, status, is_deleted, postcode', 'numerical', 'integerOnly'=>true),
    		array('name, contact_name', 'length', 'max'=>100),
    		array('salt', 'length', 'max'=>8),
    		array('enabled', 'length', 'max'=>3),
    		array('reporting', 'length', 'max'=>7),
    		array('address', 'length', 'max'=>255),
            array('suburb', 'length', 'max'=>50),
			array('creator_id, phone, mobile', 'length', 'max'=>20),
    		array('created_at, updated_at, params', 'safe'),
            array('avatar', 'file','types'=>'jpg, gif, png', 'allowEmpty'=>true, 'on'=>'update'),
    		array('enabled, reporting, weekly_interval, contact_name, address, suburb, postcode, state, phone, mobile, creator_id, ordering, created_at, updated_at, status, is_deleted, params', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, name, username, weekly_interval, password, email, enabled, reporting, creator_id, ordering, created_at, updated_at, status, is_deleted, params, rowsPerPage', 'safe', 'on'=>'search'),
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
			'name' => Yii::t('app', 'Name'),
			'username' => Yii::t('app', 'Username'),
			'password' => Yii::t('app', 'Password'),
			'email' => Yii::t('app', 'Email'),
			'enabled' => Yii::t('app', 'Grower Enabled'),
			'reporting' => Yii::t('app', 'Reporting Interval'),
			'weekly_interval' => Yii::t('app', 'Day Reporting Interval'),
            'contact_name' => Yii::t('app', 'Contact Name'),
            'address' => Yii::t('app', 'Address'),
            'suburb' => Yii::t('app', 'Suburb'),
            'postcode' => Yii::t('app', 'Postcode'),
            'state' => Yii::t('app', 'State'),
            'phone' => Yii::t('app', 'Phone Number'),
            'mobile' => Yii::t('app', 'Mobile Number'),
			'creator_id' => Yii::t('app', 'Creator'),
			'ordering' => Yii::t('app', 'Ordering'),
			'created_at' => Yii::t('app', 'Created At'),
			'updated_at' => Yii::t('app', 'Updated At'),
			'status' => Yii::t('app', 'Status'),
			'is_deleted' => Yii::t('app', 'Is Deleted'),
			'params' => Yii::t('app', 'Params'),
			'_addProperty' => Yii::t('app', 'Wish To Add Property'),
            'avatar' => Yii::t('app', 'Avatar'),
			'_repassword' => Yii::t('app','Password Repeat')
		);
	}

	public function search()
    {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('username', $this->username);
		$criteria->compare('password', $this->password, true);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('enabled', $this->enabled, true);
		$criteria->compare('reporting', $this->reporting, true);
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