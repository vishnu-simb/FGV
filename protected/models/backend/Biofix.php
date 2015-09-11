<?php

Yii::import('application.models._common.CommonBiofix');

class Biofix extends CommonBiofix
{
	public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}
}