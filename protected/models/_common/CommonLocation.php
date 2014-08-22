<?php

Yii::import('application.models._base.BaseLocation');
Yii::import('application.extensions.BOM.BOM');

class CommonLocation extends BaseLocation
{
    protected $observation;
	protected $forcast;
    
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    public function relations()
    {
		return array(
			'properties' => array(self::HAS_MANY, 'Property', 'location_id'),
            'weathers' => array(self::HAS_MANY, 'Weather', 'location_id'),
		);
	}
    
    public function getBOM()
    {
        $observation = $this->observation;
		if($observation{0} == '*')
			$observation = null;
		
		$forcast = $this->forcast;
		if($forcast{0} == '*')
			$forcast = null;
		return new BOM($observation, $forcast);
    }
}