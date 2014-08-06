<?php

Yii::import('application.models._common.CommonChemical');

class Chemical extends CommonChemical
{
	public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}
}