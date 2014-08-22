<?php

abstract class BaseDegreeDay extends SimbActiveRecord{
    public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}

	public function tableName()
    {
		return '{{degree_day}}';
	}

	public static function representingColumn()
    {
		return 'dd_ratio';
	}

	public function rules()
    {
		return array(
            array('dd_ratio, dd_n', 'numerical', 'integerOnly'=>false),
			array('dd_n', 'default', 'setOnEmpty' => true, 'value' => null),
			array('dd_n', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
    {
		return array();
	}

	public function pivotModels()
    {
		return array(
		);
	}

	public function attributeLabels()
    {
		return array(
			'dd_ratio' => Yii::t('app', 'Degree Day Ratio'),
			'dd_n' => Yii::t('app', 'Degree Day N'),
		);
	}

	public function search()
    {
		$criteria = new CDbCriteria;

		$criteria->compare('dd_ratio', $this->dd_ratio, true);
		$criteria->compare('dd_n', $this->dd_n, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'pagination' => array(
				'pageSize' => $this->rowsPerPage,
			)
		));
	}
}