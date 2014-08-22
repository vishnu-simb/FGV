<?php
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Response.php');
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'CollectionObject.php');

class Curl extends CollectionObject{
	private $ch;
    protected $data = array();
	public $cookieManager;
	
	function __construct($url = null){
		$this->ch = curl_init();
		if($url){
			$this->setUrl($url);
		}
	}
    
    function setUrl($url){
		$this->data[CURLOPT_URL] = $url;
	}
	
	function CH(){
		$ret = curl_setopt_array($this->ch, $this->data);
		if(!$ret){
			throw new Exception('Could not set all curl options');
		}
		if($this->cookieManager){
			$this->cookieManager->CH($this->ch);
		}else{
			$this->data[CURLOPT_COOKIEJAR] = null;
			$this->data[CURLOPT_COOKIEFILE] = null;
		}
		return $this->ch;
	}
	
	function Execute($data = null){
		$ch = $this->CH();
		if($data === null){
			$ret = curl_exec($ch);
		}else{
			$ret = $data;
		}
		if($ret === false){
			throw new Exception($this->Error(),$this);
		}
		return new Response($this->ch, $ret);
	}
	
	function Error(){
		return curl_error($this->ch);
	}
}