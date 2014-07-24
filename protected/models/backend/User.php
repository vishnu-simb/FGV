<?php

Yii::import('application.models._common.CommonUser');

class User extends CommonUser
{
	public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}
}