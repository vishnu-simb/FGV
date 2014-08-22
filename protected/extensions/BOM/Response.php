<?php

class Response {
	private $response;
	
	function __construct($ch,$data){
		$this->response = $data;
		if(is_resource($ch)){
			$data = curl_getinfo($ch);
		}elseif(is_array($ch)){
			$data = $ch;
		}else{
			throw new Exception('Invalid format for $ch. Not a curl handle, not an array');
		}
        foreach($data as $k=>$v){
			$this->$k = $v;
		}
	}
	
	function getCode(){
		return $this->http_code;
	}
	
	function getResponse(){
		return $this->response;
	}
	
	function __toString(){
		return $this->response;
	}
}