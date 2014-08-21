<?php

Yii::import('application.models._common.CommonMonitorCheck');

class MonitorCheck extends CommonMonitorCheck
{
	public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}
}