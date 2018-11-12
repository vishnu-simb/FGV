<?php
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Fetch.php');

class BOM {
	private $data;
	private $observation;
	private $forcast;
    private $subregions;
	
	function __construct($observation, $forcast = null){
		$this->observation = $observation;
		$this->forcast = $forcast;
	}
	
    private static $_forcastCache = array();
    
	function _parseForcast(){
		$url = 'http://www.bom.gov.au/vic/forecasts/'.$this->forcast.'.shtml';  
        $k = $this->forcast.'|'.date('Ymd');
        if(!isset(self::$_forcastCache[$k])){
			$http = new Fetch($url);
			self::$_forcastCache[$k] = $data = $http->Get();
		}else{
			$data = self::$_forcastCache[$k];
		}
		
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
		if(!is_numeric($time)) 
			$time = strtotime($time);
		$date = date('c',$time);
		
        //The forcast will only get data in 7 next days
        if (strtotime('+7 days') < strtotime($date))
            $data = $this->getData();
            
		//Check recent
		if(isset($data[$date])){
			return $data[$date];
		}
		if ($this->observation)
        {
            //Check long range
    		$data = $this->_longRange($time);
    		if($data === null) return null;
    		if(isset($data[$date])){
    			return $data[$date];
    		}
        }
		return null;
	}
    
    function getObservation($location, $findSubRegion = 0){
        if (empty($location))
            return null;
        $observation = null;
        $location = strtolower($location);
        $first_char = $location{0};
        $targets = array(
            'a' => 'IDCJDW0301',
            'b' => 'IDCJDW0301',
            'c' => 'IDCJDW0302',
            'd' => 'IDCJDW0302',
            'e' => 'IDCJDW0303',
            'f' => 'IDCJDW0303',
            'g' => 'IDCJDW0303',
            'h' => 'IDCJDW0304',
            'i' => 'IDCJDW0304',
            'j' => 'IDCJDW0304',
            'k' => 'IDCJDW0304',
            'l' => 'IDCJDW0305',
            'm' => 'IDCJDW0305',
            'n' => 'IDCJDW0306',
            'o' => 'IDCJDW0306',
            'p' => 'IDCJDW0306',
            'q' => 'IDCJDW0306',
            'r' => 'IDCJDW0306',
            's' => 'IDCJDW0307',
            't' => 'IDCJDW0307',
            'u' => 'IDCJDW0307',
            'v' => 'IDCJDW0307',
            'w' => 'IDCJDW0308',
            'x' => 'IDCJDW0308',
            'y' => 'IDCJDW0308',
            'z' => 'IDCJDW0308'
        );
        
        if (isset($targets[$first_char]))
        {
            $url = 'http://www.bom.gov.au/climate/dwo/'. $targets[$first_char] .'.shtml';
            $http = new Fetch($url);
    		$data = $http->Get();
            if($data->getCode() != 200){
    			throw new Exception('Invalid Location: '.$location);
    		}
            $data = $data->getResponse();
    		$dom = str_get_dom($data);
            
            $container = $dom->find('#container', 0);
            
            foreach($container->find('.content table.links tbody tr th a') as $link){
                $inner_text = strtolower($link->innertext());
                if (strstr($location,$inner_text) || $inner_text == $location || strstr($location, $inner_text))
                {
                    $href = $link->getAttribute('href');
                    $observation = basename($href, ".latest.shtml");
                    break;
                }
    		}
        }
        
        if ($observation == null && $findSubRegion)
        {
            $sub_regions = $this->findSubRegions($location);
            if ($sub_regions)
            {
                foreach($sub_regions as $sub_region)
                {
                    $observation = $this->getObservation($sub_region);
                    if ($observation)
                        break;
                }
            }
        }
        return $observation;        
    }
    
    function findSubRegions($location)
    {
        if (!empty($this->subregions))
            return $this->subregions;
        $sub_regions = array();
        if (!empty($location))
        {
            $url = "https://postcodez.com.au/postcodes.cgi?". http_build_query(array(
                    'search_suburb' => $location,
                    'search_state' => 'vic',
                    'type' => 'search'
                ));

            // create curl resource
            $ch = curl_init();
            // set url
            curl_setopt($ch, CURLOPT_URL, $url);
            //return the transfer as a string
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            // $output contains the output string
            $data = curl_exec($ch);

            /*
            $http = new Fetch($url);
            $data = $http->get();

            if($data->getCode() != 200){
    			throw new Exception('Invalid Location: '.$location);
    		}
            $data = $data->getResponse();
            */
    		$dom = str_get_dom($data);
            $results = $dom->find('#content .results div.result');

            if (!empty($results))
            {
                foreach($results as $result){
                    $sub_region_item = $result->find('p', 2);
                    $sub_region_text = $sub_region_item->find('a', 0)->innertext();
                    if (!in_array($sub_region_text, $sub_regions))
                    {
                        $sub_regions[] = $sub_region_text;
                    }
        		}
            }
        }
        $this->subregions =  empty($sub_regions)?null:$sub_regions;
        return $this->subregions;
    }
    
    function getForcast($location, $findSubRegion = 0)
    {
        if (empty($location))
            return null;
        $forcast = null;
        $location = strtolower($location);
        $url = 'http://www.bom.gov.au/vic/forecasts/towns.shtml';
        $http = new Fetch($url);
		$data = $http->Get();
        if($data->getCode() != 200){
			throw new Exception('Invalid Forcast Station: '.$this->forcast);
		}
        $data = $data->getResponse();
		$dom = str_get_dom($data);
        
        $container = $dom->find('#container', 0);
        
        foreach($container->find('#content .locations tbody tr td a') as $link){
            $inner_text = strtolower($link->innertext());
            if (strstr($inner_text, $location) || $inner_text == $location || strstr($location, $inner_text))
            {
                $href = $link->getAttribute('href');
                $forcast = basename($href, ".shtml");
                break;
            }
		}
        if ($forcast == null && $findSubRegion)
        {
            $sub_regions = $this->findSubRegions($location);
            if ($sub_regions)
            {
                foreach($sub_regions as $sub_region)
                {
                    $forcast = $this->getForcast($sub_region);
                    if ($forcast)
                        break;
                }
            }
        }
        return $forcast;
    }
	
}