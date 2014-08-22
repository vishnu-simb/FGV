<?php

Yii::import('application.models._base.BaseWeather');
Yii::import('application.models._common.CommonLocation');

class CommonWeather extends BaseWeather
{
    private static $ids= array();
	private static $locations = array();
    
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
    			'alias'=>'weather',
    			'condition'=>'weather.is_deleted=0',
    	);
    }
    
    function previousDay(){
		$date = new DateTime($this->date);
		$date = $date->sub(date_interval_create_from_date_string('1 day'));
		$p_date = $date->format('Y-m-d');
		return self::model()->findByAttributes(array('date' => $p_date, 'location_id' => $this->location_id));
	}
	
	function nextDay(){
        $date = new DateTime($this->date);
		$date = $date->add(date_interval_create_from_date_string('1 day'));
		$n_date = $date->format('Y-m-d');
		return self::model()->findByAttributes(array('date' => $n_date, 'location_id' => $this->location_id));
	}
    
    private static function _key($id){
		ksort($id);
		$ck = implode('|',$id);
		return $ck;
	}
    
    /**
     * @return Weather
     */
    public static function getWeatherAverage($id){
        $ck = self::_key($id);
		if(!isset(self::$locations[$id['location_id']])){
		    $criteria = new CDbCriteria();
        	$criteria->condition = 'location_id=:location_id';
        	$criteria->params = array(':location_id'=>$id['location_id']);
            $criteria->order = 'date DESC';
            $criteria->limit = '400';
        	$ret = self::model()->findAll($criteria); 
			//$ret = static::getAll(array('location_id'=>$id['location_id']));
			//$ret->sql->order_by('weather_date DESC')->Limit(400);
			foreach($ret as $row){
				$rck = self::_key(array('location_id'=>$row->location->id,'date'=>$row->date));
				self::$ids[$rck] = $row;
			}
			self::$locations[$id['location_id']] = true;
		}
		
		if(isset(self::$ids[$ck])){
			return self::$ids[$ck];
		}
		
		$ret = self::model()->findByAttributes($id);
		if($ret) return $ret;
		
		$date = $id['date'];

		//Attempt Lookup
        $loc = CommonLocation::model()->findByPk($id['location_id']);
		$bom = $loc->getBOM();
		$data = $bom->getSpecific($date);
		if($data){
			$id['min'] = $data[0];
			$id['max'] = $data[1];
			$weather = self::fromAVG($id);
			return $weather;
		}
		
		//Attempt multiple year average		
		unset($id['date']);
        
		$sql = "SELECT $date as date, location_id, AVG(min) as min, AVG(max) as max FROM ". Weather::model()->tableName();
		$where = '';
        foreach ($id as $k => $v)
        {
            if ($where) $where .= ' AND ';
            $where .= " $k = '$v' ";
        }
        if ($where)
            $sql .= " WHERE" . $where;
		$sql .= " AND MONTH('$date')=MONTH(date) AND DAY('$date')=DAY(date) HAVING location_id='{$id['location_id']}'";
		
		$res = Yii::app()->db->createCommand($sql)->query();
        $row = $res?$res->read():0;
        echo var_dump($row);die;
		if($row) {
			$weather = self::fromAVG($row);
			return $weather;
		}
		
		//Attempt last year / This year lookup
		$date_attempt = date('Y-'.date('m-d',strtotime($date)));
		if(strtotime($date_attempt) > time()){
			$date_attempt = (date('Y')-1).'-'.date('m-d',strtotime($date));
		}
		
		
		$data = $bom->getSpecific($date_attempt);
		if($data){
			$id['date'] = $date;//Next time it will average
			$id['min'] = $data[0];
			$id['max'] = $data[1];
			$weather = self::fromAVG($id);
			return $weather;
		}
		
		//die(var_dump($date,$date_attempt));
		
		return null;
    }
    static function fromAVG($row){
        $weather = new CommonWeather;
        foreach($row as $k => $v)
            $weather->$k = $v;
        $weather->save();
		return $weather;
	}        

}

