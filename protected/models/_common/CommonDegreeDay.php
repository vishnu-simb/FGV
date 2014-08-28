<?php
ini_set('xdebug.max_nesting_level','1000');

Yii::import('application.models._base.BaseDegreeDay');

class CommonDegreeDay extends BaseDegreeDay
{
    protected $weather;
	protected $pest;
    
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    /**
     * scope of yii
     * @return array
     * @see scope of yii
     */
    public function scopes(){
    	return array(
    			'alias'=>'degreeday',
    	);
    
    }
	
	/**
	 * @return the $weather
	 */
	public function getWeather() {
		return $this->weather;
	}

	/**
	 * @return the $pest
	 */
	public function getPest() {
		return $this->pest;
	}
	
	function getDate(){
		return $this->weather->date;
	}
	
	private static $_cache;
	static private function _key($weather, $pest){
		$key = array();
		$key[] = $weather->location->id;
		$key[] = $weather->date;
		$key[] = $pest->id;
		return implode('|',$key);
	}
	static function cachedCreate($weather, $pest){
		//Make key
		$key = static::_key($weather, $pest);
		
		//Check
		if(isset(static::$_cache[$key])){
			return static::$_cache[$key];
		}
		
		//New
		return new static($weather, $pest);
	}
	private static $ratio;
	function __construct($weather = '', $pest = ''){
	    if (!$weather || !$pest)
            return;
		$this->weather = $weather;
		$this->pest = $pest;
		
		//Cache
		$key = static::_key($weather, $pest);
		static::$_cache[$key] = $this;
		
		if(self::$ratio === null){
			self::$ratio = array();
			foreach(self::model()->findAll() as $dd){
				self::$ratio[(int)round($dd->dd_ratio*100,0)] = $dd->dd_n;
			}
		}
	}
	
	private $_value;
	function Calculate(){
		if(isset($this->_value)){
			return $this->_value;
		}
		
		//Read Max/Min, Base
		$max = $this->weather->max;
		$min = $this->weather->min;
		$base = (float)$this->pest->dd;
		
		if($min>$base){
			$result = ($max+$min)/2;
			$result -= $base;
		}else{
			$result = ($max-$min)/2;
			
			$lookup_value = 1;
			if($max>=$base){
				$lookup_value = ($base-$min)/($max-$min);
			}
			
			$rk = (int)round($lookup_value*100,0);
            $result *= self::$ratio[$rk];
		}
		//Round
		$this->_value = round($result,2);
		
		//Return
		return $this->_value;
	}
	
	private static $_sinceBio = array();
	function SinceBiofix($block, $secondCohort = false, $previousBio = 0){	
		
		
		$biofixDate = $this->pest->getBiofix($block->id, $secondCohort);
		if(!$biofixDate){
			//throw new Exception('no biofix date');
			return null;
		}
		$biofixDate = $biofixDate->date;
        $_k = $block->id.'|'.$this->weather->date.'|'.$this->weather->location_id.'|'.$biofixDate.(int)$secondCohort;
		if(isset(static::$_sinceBio[$_k])){
		    return static::$_sinceBio[$_k];
		}
		//date is less than biofix date
		if(strtotime($this->weather->date) < strtotime($biofixDate)){
			static::$_sinceBio[$_k] = 0;
			return 0;
		}
		
		$degreeDays = $this->Calculate();
		if($degreeDays < 0) {
			$degreeDays = 0;
		}
		
		//Calculate and Store
        if ($previousBio)
            $ret = $degreeDays + $previousBio;
        else
        {
    		$date = $this->weather->previousDay();
    		if($date === null){//We are lacking data
    			static::$_sinceBio[$_k] = null;
    			//throw new Exception('no data');
    			return null;
    		}
            //Get Previous Day
		    $previousDD = static::cachedCreate($date,$this->pest);
            $ret = $degreeDays + $previousDD->SinceBiofix($block,$secondCohort);
        }
            
		static::$_sinceBio[$_k] = $ret;
		//if( $this->weather->getDate() == '2010-11-26' ) die(var_dump($this->weather->getDate(),$degreeDays,$ret));
		return $ret;
	}    

}

