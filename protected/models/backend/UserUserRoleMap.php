<?php

Yii::import('application.models._common.CommonUserUserRoleMap');

class UserUserRoleMap extends CommonUserUserRoleMap
{
	public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}
}