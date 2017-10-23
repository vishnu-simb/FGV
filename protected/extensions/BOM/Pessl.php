<?php
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Fetch.php');
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Services_JSON.php');

class Pessl {
	private $username;
	private $password;
	private $station;//00001840
	private $ch;
	
	function __construct($username,$password,$station,$ch='18_506'){
		$this->username = $username;
		$this->password = $password;
		$this->station = $station;
		$this->ch = $ch;
	}
	
	function getData($days){
		$start_date = strtotime('-'.$days.' days',time());
		$url = 'http://www.fieldclimate.com/';
		$http = new Fetch($url);
		$http->curl[CURLOPT_FOLLOWLOCATION] = true;
		$http->curl[CURLOPT_AUTOREFERER] = true;
		$http->curl[CURLOPT_HEADER] = true;
		$http->setUserAgent('Mozilla Firefox');
		$http->get();
		$http->setUrl('http://www.fieldclimate.com/index_new.php');
		$post = http_build_query(array('B1'=>'login',
				'username'=>$this->username,
				'password'=>$this->password,
				'remember_me'=>1,
				'f_language'=>'en'));
		$ret = $http->post($post);
		$url = 'http://www.fieldclimate.com/pikernel/content.php?sid=s_station_show_data_frame&station_name='.$this->station.'&profile=profiles_all_sensors&num_row=100';
		$post = array('show_data'=>1,
						'mode'=>'',
						'num_row_last'=>100,
						'last_date'=>date("Y-m-d H:i:s"),
						'start_date'=>date("Y-m-d H:i:s",$start_date),
						'num_period'=>$days,
						'row_type'=>'d',
						'avr'=>'2');
		
		$http->setUrl($url);
		$ret = (string)$http->post($post);
		//debug data file_put_contents(Yii::app()->basePath.'/data/data.txt',$ret);
		if(preg_match('/data:([^]]+)/', $ret, $data)){
			$j = new Services_JSON();
			$data = $j->decode($data[1]."]");
			$ret = array();
			foreach($data as $v){
				$min = "sens_min_".$this->ch;
				$max = "sens_max_".$this->ch;
				$ret[$v->date] = array($v->$min,$v->$max);
			}
			return $ret;
		}
	}
}