<?php
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Curl.php');
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'CookieManager.php');
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Simple_HTML_DOM.php');

class Fetch {	
	public $curl;
	private $headers = array();
	
	function __construct($url = false, $output = false){
		$this->curl = new Curl($url);
		$this->curl[CURLOPT_RETURNTRANSFER] = $output?0:1;
		$this->setTimeout(300);
		$this->setConnectTimeout(10);
		
		$this->curl->cookieManager = CookieManager::Create();
	}
	function setUrl($url){
		$this->curl[CURLOPT_URL] = $url;
		return $this;
	}
	function setUserAgent($ua){
		$this->curl[CURLOPT_USERAGENT] = $ua;
		return $this;
	}
    function setInterface($interface){
            $this->curl[CURLOPT_INTERFACE] = $interface;
    }
    //TODO; setRanges($array) array having X and Y, or  having arrays of Xs and Ys
	function setHeader($name,$value){
		$this->headers[$name] = $value;
		$r = array();
		foreach($this->headers as $k=>$v){
			$r[] = $k.': '.$v;
		}
		$this->curl[CURLOPT_HTTPHEADER] = $r;
	}
	function setReferer($url){
		$this->curl[CURLOPT_REFERER] = $url;
		return $this;
	}
	function followLocation($bool, $max = null){
                $this->curl[CURLOPT_FOLLOWLOCATION] = $bool;
                if($max)
                    $this->curl[CURLOPT_MAXREDIRS] = $amx;
                return $this;
	}
	function setTimeout($time){
		$this->curl[CURLOPT_TIMEOUT] = $time;
		return $this;
	}
        function setBinary($bool){
		$this->curl[CURLOPT_BINARYTRANSFER] = $bool;
		return $this;
	}
        function setBufferSize($size){
		$this->curl[CURLOPT_BUFFERSIZE] = $size;
		return $this;
	}
    function setLowSpeed($speed, $time = null){
	$this->curl[CURLOPT_LOW_SPEED_LIMIT] = $speed;
            if($time)
                $this->curl[CURLOPT_LOW_SPEED_TIME] = $time;
	return $this;
	}
    function setMaxSpeed($down = null, $up = null){
            if($down)
                $this->curl[CURLOPT_MAX_RECV_SPEED_LARGE] = $down;
            if($up)
                $this->curl[CURLOPT_MAX_SEND_SPEED_LARGE] = $up;
	return $this;
	}
	function setConnectTimeout($time){
		$this->curl[CURLOPT_CONNECTTIMEOUT] = $time;
		return $this;
	}
	function getTimeout(){
		if(isset($this->curl[CURLOPT_TIMEOUT])){
			return $this->curl[CURLOPT_TIMEOUT];
		}
	}
	
        //gets an array having arrays of X and Y
        //if one range is passed, it should be passed in a simple array
    protected function _formatRanges(array $ranges){
        if (count($ranges) == 2 && is_int($ranges[0]) && is_int($ranges[1]))
            return implode('-', $ranges);          
        else{
        	foreach($ranges as $key=>$value){
        		if(!is_array($value)) { throw new Exception('invalid range format'); return null; }
        		else $ranges[$key] = implode('-', $value);
        	}
        	return implode(',', $ranges);
        }
	}
        
    function setRanges($ranges){
         $this->curl[CURLOPT_RANGE] = $this->_formatRanges($ranges);
    }
                
	function post($post_data){
		//Store previous post state
		$post = $data = null;
		if(isset($this->curl[CURLOPT_POST])){
			$post = $this->curl[CURLOPT_POST];
		}
		if(isset($this->curl[CURLOPT_POSTFIELDS])){
			$data = $this->curl[CURLOPT_POSTFIELDS];
		}
		
		//Setup Post
		$this->curl[CURLOPT_POST] = true;
		$this->curl[CURLOPT_POSTFIELDS] = $post_data;
		//Execute
		$ret = $this->Execute();
		
		//Reset
		if($post === null){
			unset($this->curl[CURLOPT_POST]);
		}else{
			$this->curl[CURLOPT_POST] = $post;
		}
		if($data === null){
			unset($this->curl[CURLOPT_POSTFIELDS]);
		}else{
			$this->curl[CURLOPT_POSTFIELDS] = $data;
		}
		
		return $ret;
	}
	
	function get(){
		//Store previous post state
		$post = $data = null;
		if(isset($this->curl[CURLOPT_POST])){
			$post = $this->curl[CURLOPT_POST];
		}
		if(isset($this->curl[CURLOPT_POSTFIELDS])){
			$data = $this->curl[CURLOPT_POSTFIELDS];
		}
		
		//Setup Get
		$this->curl[CURLOPT_POST] = false;
		$this->curl[CURLOPT_POSTFIELDS] = array();
		
		//Execute
		$ret = $this->Execute();
		
		//Reset
		if($post === null){
			unset($this->curl[CURLOPT_POST]);
		}else{
			$this->curl[CURLOPT_POST] = $post;
		}
		if($data === null){
			unset($this->curl[CURLOPT_POSTFIELDS]);
		}else{
			$this->curl[CURLOPT_POSTFIELDS] = $data;
		}
		
		//Return
		return $ret;
	}
	
	function cH(){
		$ch = $this->curl->CH();
		return $ch;
	}
    
	function execute($data = null){
		return $this->curl->Execute($data);
	}
}