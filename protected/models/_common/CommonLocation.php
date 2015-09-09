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
            'creator' => array(self::BELONGS_TO, 'Grower', 'creator_id'),
		);
	}
    
    public function getCreator()
    {
        return $this->creator;
    }
    
    public function getBOM()
    {
        $observation = $this->observation;
		if(!empty($observation) && $observation{0} == '*')
			$observation = null;
		
		$forcast = $this->forcast;
		if(!empty($forcast) && $forcast{0} == '*')
			$forcast = null;
		return new BOM($observation, $forcast);
    }
    
    function getObservationAndForcast()
    {
        if ($this->observation && $this->forcast)
            return;
        $bom = new BOM('');
        if (empty($this->observation))
            $this->observation = $bom->getObservation($this->name, 1);
        if (empty($this->forcast))
            $this->forcast = $bom->getForcast($this->name);
    }
    
    function isSpecial(){
    	return (!empty($this->observation) && $this->observation{0} == '*');
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