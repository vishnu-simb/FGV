<?php

Yii::import('application.models._common.CommonUsers');

class Users extends CommonUsers
{
	public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}
	
	/**
	 * User Type Value "Admin"
	 */
	const USER_TYPE_ADMIN='admin';
	
	/**
	 * User Type Value "Grower"
	 */
	const USER_TYPE_GROWER='grower';
	
	/**
	 * User Type Value "SCOUT"
	 */
	const USER_TYPE_SCOUT='scout';
	
}