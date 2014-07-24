<?php

Yii::import('application.models._common.CommonUserRole');

class UserRole extends CommonUserRole
{
	public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}
}