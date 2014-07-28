<?php

Yii::import('application.models._base.BaseChemical');

class CommonChemical extends BaseChemical
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}