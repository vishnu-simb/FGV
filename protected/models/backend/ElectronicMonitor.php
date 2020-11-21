<?php

Yii::import('application.models._common.CommonElectronicMonitor');

class ElectronicMonitor extends CommonElectronicMonitor
{
	public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}
}