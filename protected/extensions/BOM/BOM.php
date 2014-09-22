<?php
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Fetch.php');

class BOM {
	private $data;
	private $observation;
	private $forcast;
	
	function __construct($observation, $forcast = null){
		$this->observation = $observation;
		$this->forcast = $forcast;
	}
	
	function _parseObservation(){
		return $this->_longRange();
	}
	
	function _parseForcast(){
		$url = 'http://www.bom.gov.au/vic/forecasts/'.$this->forcast.'.shtml';
		$http = new Fetch($url);
		$data = $http->Get();
		
		if($data->getCode() != 200){
			throw new Exception('Invalid Forcast Station: '.$this->forcast);
		}
		$data = $data->getResponse();
		
		Simple_HTML_DOM::LoadS();
		$dom = str_get_dom($data);
		
		$data = array();
		
		foreach($dom->find('#content div.day') as $day){
			if($day->find('em.min',0)){
				$header = $day->find('h2',0);
				$time = self::parseTime($header->innertext);
		
				if($time){
					$min = (float)$day->find('em.min',0)->innertext;
					$max = (float)$day->find('em.max',0)->innertext;
					$data[$time] = array($min,$max);
				}
			}
		}
		
		//Overwrite data
		foreach($data as $k=>$v){
			$this->data[$k] = $v;
		}
		
		$dom->clear();
	}
	
	static function parseTime($time){
		$time = strtotime($time);
		if(!$time){
			return null;
		}
		$time = date('c',$time);
		return $time;
	}
	/**
	 * @return the $data
	 */
	public function getData() {
		if($this->data === null){
			$this->data = array();
			if($this->observation != null){
				$this->_parseObservation();
			}
			if($this->forcast != null){
				$this->_parseForcast();
			}
		}
		return $this->data;
	}
	
	private static $_longRangeCache = array();
	
	function _longRange($date = null){
		if($date === null) $date = time();
		
		if(strtotime('+13 months',$date)<time() || $date > time()) 
			return -1;//Out of range
		
		//Check long range
		$url = 'http://www.bom.gov.au/climate/dwo/'.date('Ym',$date).'/text/'.$this->observation.'.'.date('Ym',$date).'.csv';

		if(!isset(self::$_longRangeCache[$url])){
			$http = new Fetch($url);
			self::$_longRangeCache[$url] = $data = $http->Get();
		}else{
			$data = self::$_longRangeCache[$url];
		}
		
		if($data->getCode() != 200){
			return -2;
		}
		$string = $data->getResponse();
		
		$ret = array();
		$started = false;
		$array = explode("\n",$string);
		foreach($array as $row){
			$row = str_getcsv(trim($row));
			if($started){
				$ret[$this->parseTime($row[1])] = array((double)$row[2],(double)$row[3]);
			}
			if(count($row) > 2){
				$started = true;
			}
		}
		
		return $ret;
	}

	function getSpecific($time){
		$data = $this->getData();
		if(!is_numeric($time)) 
			$time = strtotime($time);
		$date = date('c',$time);
		
		//Check recent
		if(isset($data[$date])){
			return $data[$date];
		}
		
		//Check long range
		$data = $this->_longRange($time);
		if($data === null) return null;
		if(isset($data[$date])){
			return $data[$date];
		}
	}
	
}