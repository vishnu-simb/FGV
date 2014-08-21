<?php

Yii::import('application.models._common.CommonMiteMonitor');

class MiteMonitor extends CommonMiteMonitor
{
	public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}
}