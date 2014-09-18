<?php

class BomCronDailyCommand extends SimbConsoleCommand{
            
			function __construct(){
			
			}
			function getName(){
				return 'BomCron';
			}
			function getInterval(){
				return 'daily';
			}
			public function run($args)
            {
            	echo "Fetching....... \n";
            	
            	foreach(Location::model()->findAll() as $key=>$location){
		            	try {
						$extended = false;
						if(count($location->getWeather())<300){
							$extended = true;
						}
						$bom = $location->getBOM();
						$data = $bom->getData();
						
						if($location->isSpecial()){
							if(!is_array($data))
								$data = array();
							
							$data = array_merge($data,$location->getSpecialData());
						}
						
						if(!is_array($data)){
							throw new \Exception("BOM error ('.$data.'): ".$location->id);
						}
						
						Sleep(10);
						
						if($extended){
							$it = $now = time();
							$end = strtotime('-12 months',$now);
							do{
								Sleep(3);
								$dt = $bom->_longRange($it);
								if(is_array($dt))
									$data = array_merge($data,$dt);
								$it = strtotime('-1 month',$it);
							}while($it >= $end);
						}

						foreach($data as $t=>$d){
							$data = array('date'=>date('Y-m-d',strtotime($t)));
							$data['location_id'] = $location->id;
							$weather = new CommonWeather;
							if($dd = $weather->findByAttributes($data)){
								$dd->min = $d[0];
								$dd->max = $d[1];
								$dd->updated_at = date('Y-m-d H:i:s',time());
								$dd->save();
							}else{
								$data['min'] = $d[0];
								$data['max'] = $d[1];
								$data['created_at'] = date('Y-m-d H:i:s',time());
								$data['updated_at'] = date('Y-m-d H:i:s',time());
								foreach($data as $k => $v)
									$weather->$k = $v;
								$weather->save();
							}
						}
					}catch(\Exception $ex){
						echo $ex->getMessage(),"\r\n";
					}
				
            	}
   				
        }
  }