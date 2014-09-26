<?php

Yii::import('application.models._base.BaseLocation');
Yii::import('application.extensions.BOM.BOM');
Yii::import('application.extensions.BOM.Pessl');
class CommonLocation extends BaseLocation
{
    
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
		if($observation == '*')
			$observation = null;
		
		$forcast = $this->forcast;
		if($forcast == '*')
			$forcast = null;
		return new BOM($observation, $forcast);
    }
    
    function isSpecial(){
    	return ($this->observation == '*');
    }
    
    function getWeather($date = null){
    	if($date)
    		return Weather::model()->getWeatherAverage(array('location_id'=>$this->id,'weather_date'=>$date));
    
    	return Weather::model()->findAll('location_id="'.$this->id.'"');
    }
    
    function getSpecialData(){
    	$weather = new Pessl('Fankhauser Apples', 'Alvina', '00001840');
    	return $weather->getData(10);
    }
}