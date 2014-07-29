<?php

Yii::import('application.models._common.CommonUsers');

class Users extends CommonUsers
{
	public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}
}