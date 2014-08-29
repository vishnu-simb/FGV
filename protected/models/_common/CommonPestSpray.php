<?php

Yii::import('application.models._base.BasePestSpray');
Yii::import('application.models._common.CommonWeather');
Yii::import('application.models._common.CommonDegreeDay');

class CommonPestSpray extends BasePestSpray
{
    private $_date = null;
    protected static $_location = array();
	private $isLowPop = false;
    
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    /**
     * default scope
     * @return array
     * @see defaultScope
     */
    public function defaultScope(){
    	return array(
    			'alias'=>'pest_spray',
    			'condition'=>'pest_spray.is_deleted=0',
    			//'order'=>'artwork.sort ASC'
    	);
    }
    /**
     * scope of yii
     * @return array
     * @see scope of yii
     */
    public function scopes(){
    	return array(
    			'alias'=>'pest_spray',
    			'condition'=>'pest_spray.is_deleted=0',
    	);
    
    }
    
    /**
     * @return Grower[]
     */
    public function getGrower(){
    	$criteria = new CDbCriteria();
    	$criteria->condition = 'is_deleted=:is_deleted';
    	$criteria->params = array(':is_deleted'=>'0');
    	return Grower::model()->findAll($criteria);
    }
    
    /**
     * @return Pest[]
     */
    public function getPest(){
    	$criteria = new CDbCriteria();
    	$criteria->condition = 'is_deleted=:is_deleted';
    	$criteria->params = array(':is_deleted'=>'0');
    	return Pest::model()->findAll($criteria);
    }
    
    function haslowpopulation(){
		return ($this->lowpop_dd !== null);
	}
    
    /**
	 * @return the $isLowPop
	 */
	public function isLowPop() {
		return $this->isLowPop;
	}
    
    function __clone()
	{
		$this->_date = null;
	}
    
    function getDate($block, $secondCohort = false){
		$k = $block->id.'|'.(int)$secondCohort;
		if(isset($this->_date[$k])){
			return $this->_date[$k];
		}
        $pest = $this->pest;
		$biofix = $pest->getBiofix($block->id, $secondCohort);
		if($biofix){
			//Pre Setup
			$biofix_date = $biofix->date;
			
			$location = $block->property->location;
			$locationId = $location->id;
			
            $_k = $locationId.'|'.$biofix_date;
			if(!isset(static::$_location[$_k])){
			    $criteria = new CDbCriteria();
            	$criteria->condition = 'location_id=:location_id AND date >= :weather_date';
            	$criteria->params = array(':location_id'=>$locationId,':weather_date'=>$biofix_date);
                $criteria->order = 'date ASC';
                $criteria->limit = '400';
            	$all = CommonWeather::model()->findAll($criteria); 
				//$all = WeatherAverage::getAll(new Where('location_id='.\DB::E($locationId).' AND weather_date>='.\DB::E($biofix_date).' ORDER BY weather_date ASC LIMIT 400'));
				
				if(!count($all)){
					//throw new \Exception('No weather data (all)');
					return null;
				}
				
				//Build location weather cache
				$a = array();
				foreach($all as $v){
					$a[strtotime($v->date)] = $v;
				}
				static::$_location[$_k] = $a;
			}
			$all = static::$_location[$_k];
			
			//Start
			$lastDD = $lastBio = $DDsinceBiofix = 0;
            
            $weather = CommonWeather::getWeatherAverage(array('location_id'=>$locationId,'date'=>$biofix_date));
			//$weather = WeatherAverage::fromId(array('location_id'=>$locationId,'weather_date'=>$biofix_date));
			//Loop until one is found
			$i = 0;
			while($weather){
				
				//Get DD
				$DD = CommonDegreeDay::cachedCreate($weather, $pest);
				$DDsinceBiofix = $DD->SinceBiofix($block, $secondCohort, $lastBio);
				//echo $weather->date,': '.$weather->min.','.$weather->max.' = <b>',$DDsinceBiofix,'</b><br />';
				
				if($lastDD === 0){
					//set LastDD early
					$lastBio = $DDsinceBiofix;
					$lastDD = $DD;
				}
				//Check
				//$this->dd > $lastBio &&
				if($this->dd < $DDsinceBiofix) { //Is $lastDD < NUMBER < $DDsinceBiofix
					//exit;
					return $this->_date[$k] = $lastDD->getDate();
				}
				
				//increment and sanity check
				++$i;
				if($i>=365){
					//throw new \Exception('1000 days: '.$DDsinceBiofix.' < '.$this->dd.' (change: '.($DDsinceBiofix - $lastBio).')');
					return null;
				}
				
				//set LastDD
				$lastBio = $DDsinceBiofix;
				$lastDD = $DD;
				
				//Get next day
				$nextDate = strtotime('+1 day',strtotime($weather->date));
				if(isset($all[$nextDate])){
					$weather = $all[$nextDate];//In memory
				}else{
					$weather = $weather->nextDay();//Or from DB
				}
				
				if($weather == null){
					//throw new \Exception('Next day null');
					return null;
				}
			}
			
			return null;
		}
	}
    
    function getCoverRequired($block, $secondCohort = false){
		$date = $this->getDate($block, $secondCohort);
		if(!$date){
			return;
		}
		
		$date = new DateTime($date);
		$date = $date->add(date_interval_create_from_date_string($this->every.' day'));
		$result = $date->format('Y-m-d');
		
		return $result;
	}
    
    function swapPopulationValues(){
		$a = $this->dd;
		$this->dd = $this->lowpop_dd;
		$this->lowpop_dd = $a;
		$a = $this->every;
		$this->every = $this->lowpop_every;
		$this->lowpop_every = $a;
		$this->isLowPop = !$this->isLowPop;
	}
}
