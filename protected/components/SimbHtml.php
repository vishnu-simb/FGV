<?php

class SimbHtml extends CHtml
{	

	public static function getEnumItem($model,$attribute) {
        $attr=$attribute;
        self::resolveName($model,$attr);
        preg_match('/\((.*)\)/',$model->tableSchema->columns[$attr]->dbType,$matches);
        foreach(explode("','", $matches[1]) as $value) {
                $value=str_replace("'",null,$value);
                $values[$value]=Yii::t('getEnumItem',$value);
        }
        return $values;
    } 

}