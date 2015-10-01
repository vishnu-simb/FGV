<?php

class GraphController extends SimbApiController {

	protected $block;
    protected $location;
    protected $location_names = '';
	
	private $Pest_CLID = array();
    private $pointInterval = 86400000; // 1 days
    private $maxZoom = 1209600000; // 14 days
	
	function __construct(){
	    if (isset($_GET['block']))
        {
            $this->block = Block::model()->findByPk($_GET['block']);
    		if ($this->block === null) {
    			return $this->actionError();
    		}
        }
        else if(isset($_POST['location']))
        {
            $this->location = $_POST['location'];
            
            if (empty($this->location)) {
                return $this->actionError();
            }
            if (is_array($this->location))
            {
                foreach($this->location as $location_id)
                {
                    $l = Location::model()->findByPk($location_id);
                    if ($l)
                    {
                        $this->location_names[] = $l->name;
                    }
                }
                if (count($this->location) == 1)
                    $this->location = $this->location[0];
            }
        }
	}

    /**
     * Displays a particular model.
     * @param integer $block the ID of the model to be displayed
     */
    public function actionHTML()
    {
    	$this->layout = 'main';
  		$arrResult = array();
  		$data = $this->getSprayData();
  		$VAR = array();
  		$VAR['spray_data'] = $data;
  		$VAR['hasFollowYear'] = isset($_GET['year'])?$_GET['year']:false;// Set default report
  		$inverse = array();
  		foreach($data as $pest=>$vv){
  			foreach($vv as $spray=>$date){
  				$inverse[$spray][$pest] = $date;
  			}
  		}
  		$VAR['spray_inverse'] = $inverse;
  		$VAR['block'] = $this->block;
  		
  		$VAR['pests'] = array();
  		foreach(Pest::model()->findAll() as $pest){
  			$VAR['pests'][$pest->name] = $pest;
  		}
  		
  		$this->render(
  				'spray',
  				array(
  						'VAR' => $VAR,
  				)
  		);

    }
    
    private function getSprayData(){
    	$grower = $this->block->property->grower;
    	$max_spray_count = 0;
    	foreach(Pest::model()->findAll() as $pest){
    		if($pest->calculate == 'yes'){
    			$max_spray_count = max($max_spray_count,$pest->getSprayCount($grower->id));
    		}
    	}
    
    	$sprayDates = array();
    	foreach(Pest::model()->findAll() as $pest){
    		if($pest->calculate == 'yes'){
    			for($i=1,$f=$pest->getSprayCount($grower->id);$i<=$f;++$i){
    				$spray = $pest->getSpray($i,$grower->id);
    				$sprayDates[$pest->name][$i] = $spray;
    			}
    			for($f++;$f<=$max_spray_count;++$f){
    				$sprayDates[$pest->name][$f] = null;
    			}
    		}
    	}
    	return $sprayDates;
    }
    
    private function _get_filter_dates($year = '')
    {
        /* From August to July */
        $dates = array(
            'date_from' => ($year-1).'-08-01',
            'date_to' => $year.'-07-31'
        );
        return $dates;
    }
	

    public function actionGetBlockTrap(){
    	$VAR = array();
        $year = $_GET['year'];
        $dates = $this->_get_filter_dates($year);
        $filter = $dates;
        $filter['block_id'] = $this->block->id;
        
    	$model = new TrapCheck('search');
    	$model->unsetAttributes();
    	$dataProvider = $model->getTrapCheckInRange($filter);
    	$data = $dataProvider->getData();
        $pest = Pest::model()->findAll();
        $keys_arr = $pests = array();
		foreach($pest as $v){
			$keys_arr[] = $v->name;
            $pests[$v->name] = $v;
		}
    	$serial = array();
    	if(!empty($keys_arr)){
            $m = strtotime($dates['date_from']);
    		$e = strtotime($dates['date_to']);
    		foreach($keys_arr as $r){
    			$mm = $m;
    			$sedat = array();
    			while($mm < $e)
    			{
    				if(date($mm) < date(time())){
	    				$dd = 0;
	    				foreach($data as $val){
	    					
	    					if($val["tc_date"]==date("Y-m-d", $mm) && $val["pest_name"]==$r){
	    						$dd += intval($val["tc_value"]);
	    					}
	    				}
                        $sedat[] = $dd;
    				}
    				$mm = strtotime('+1 day', $mm); // increment for loop
    			}
    			$serial[] = array('name'=>$r,'data'=>$sedat,'color'=>Pest::PestColor($r),'pointInterval'=> $this->pointInterval);
    		}
    
    	}
    	if(!empty($serial)){
    		$VAR['chart'] = array('renderTo'=>'yw0','type'=>'spline','zoomType'=>'x');
    		$VAR['title'] = array('text'=>'Trapping : '.$this->block->name.' between '.date("d/m/Y", $m).' and '.date("d/m/Y", $e));
    		$VAR['subtitle'] = array('text'=>'Click and drag in the plot area to zoom in');
            $VAR['tooltip'] = array('shared'=>true,'crosshairs'=>true);
    		//$VAR['plotOptions'] = array('series'=>array('connectNulls'=> true),'spline'=>array('lineWidth'=>4,'states'=>array('hover'=>array('lineWidth'=> 5)),'marker'=>array('enabled' =>true)));
    		$VAR['plotOptions'] = array('spline'=>array('lineWidth'=>4,'states'=>array('hover'=>array('lineWidth'=> 5)),'marker'=>array('enabled' =>false)));
            $VAR['xAxis'] = array('type'=>'datetime','maxZoom'=> $this->maxZoom, 'max' => strtotime($dates['date_to'])*1000);
    		$VAR['yAxis'] = array('title'=>array('text'=>''),'startOnTick'=>0,'showFirstLabel'=>0,'floor'=> 0,'allowDecimals'=>false,'minRange' => 0.1);
    		$VAR['series'] = $serial;
            $VAR['pointStart'] = array('year'=>date('Y',$m), 'month'=>date('n',$m)-1, 'day'=>date('d',$m) );
            
            $inverse = array();
            $data = $this->getSprayData();
      		foreach($data as $pest=>$vv){
      			foreach($vv as $spray=>$date){
      				$inverse[$spray][$pest] = $date;
      			}
      		}
            $pm = $spraydates =array();
            foreach($inverse as $sprayNo=>$vv){
        		if($vv){
        			$number_ordinal = Number::Ordinal($sprayNo);
        			
        			foreach($vv as $pest=>$spray){
        				
        				if($spray){
        					$date = $spray->getDate($this->block,false,$year);
        					$ds = strtotime($date);
        					if($ds >= time() && !isset($pm[$pest])){
        						$pm[$pest] = true;
        					}
        					if ($ds >= $m && $ds <= $e)
                                $spraydates["$pest $number_ordinal"] = $ds*1000;
        					
        					if($pests[$pest]->hasSecondCohort($this->block->id)){
        						$date = $spray->getDate($this->block,true,$year);
        						$ds = strtotime($date);
        						if($ds >= time() && !isset($pm[$pest.'|2'])){
        							$pm[$pest.'|2'] = true;
        						}
        						if ($ds >= $m && $ds <= $e)
                                    $spraydates["$pest $number_ordinal<br/>(2nd Cohort)"] = $ds*1000;
        					}
        				}
        			}foreach($vv as $pest=>$spray){
        				if($spray){
                            $ds = strtotime($spray->getCoverRequired($this->block,false,$year));
                            if ($ds >= $m && $ds <= $e)
                                $spraydates["$pest $number_ordinal End"] = $ds*1000;
        					if($pests[$pest]->hasSecondCohort($this->block->id)){
        						$ds = strtotime($spray->getCoverRequired($this->block,true,$year));
        						if ($ds >= $m && $ds <= $e)
                                    $spraydates["$pest $number_ordinal<br/>(2nd Cohort) End"] = $ds*1000;
        					}
        				}
        			}
        		}
        	}
            $VAR['spraydates'] = $spraydates;
            
            /*
            $spraydates = Spray::model()->findAllByAttributes(array('block_id'=>$this->block->id));
            $VAR['spraydates'] = array();
            if (!empty($spraydates))
            {
                $existed = array();
                foreach($spraydates as $index => $spray){
                    $chemical = $spray->chemical->name;
                    if (!isset($existed[$spray->date]))
                    {
                        $existed[$spray->date] = $index;
                    }
                    else
                    {
                        $chemical = $VAR['spraydates'][$existed[$spray->date]]['chemical']. "<br/>". $spray->chemical->name;
                    } 
                    $VAR['spraydates'][$existed[$spray->date]] = array('date'=>$spray->date, 'chemical'=>$chemical);
                }
            }
            */
    	}else{
    		$VAR['chart']= $serial;
    	}
    	echo CJSON::encode($VAR);
    	Yii::app()->end();
    
    }
    
    
    
    private function getAverageMite($dates, $location_id = ''){
        $model = new MiteMonitor('search');
        $dataProvider = $model->getMiteMonitorInRange($dates);
    	$data = $dataProvider->getData();
        $mite = Mite::model()->findAll();
        $keys_arr = array();
		foreach($mite as $v){
			$keys_arr[] = $v->name;
		}
		$min_time = strtotime($dates['date_from']);
		$max_time = strtotime($dates['date_to']);
        $grower_blocks = Block::model()->findAllAttributes(array('is_deleted' => 0));
        if ($location_id)
            $location_blocks = Block::model()->with(array('property'=>array('condition'=>"property.location_id='$location_id'")))->findAll();
        $grower_total_mites = $grower_avg_mites = $location_total_mites = $location_avg_mites = array();
		foreach($keys_arr as $r){
			$mm = $min_time;
			$sedat = array();
            $index = 0;
            $grower_dd = $location_dd = 0;
			while($mm < $max_time)
			{
				if(date($mm) < date(time())){
			
					foreach($data as $val){
						if($val["mm_date"]==date("Y-m-d", $mm) && $val["mite_name"]==$r){
						    $value = $val['mm_average_li']*$val['mm_no_days'];
							$grower_dd += $value;
                            if ($location_id && $val['location_id'] == $location_id)
                                $location_dd += $value;
						}
					}
                    if (!isset($grower_total_mites[$index]))
                        $grower_total_mites[$index] = $grower_dd;
                    else
					    $grower_total_mites[$index] += $grower_dd;
                        
                    if (!isset($location_total_mites[$index]))
                        $location_total_mites[$index] = $location_dd;
                    else
					    $location_total_mites[$index] += $location_dd;
				}
				$mm = strtotime('+1 day', $mm); // increment for loop
                $index++;
			}
		}
        $length = count($grower_total_mites);
        $number_of_grower_blocks = empty($grower_blocks)?1:count($grower_blocks);;
        $number_of_location_blocks = empty($location_blocks)?1:count($location_blocks);
        for($i = 0; $i < $length; $i++)
        {
            $grower_avg_mites[$i] = round($grower_total_mites[$i]/$number_of_grower_blocks, 2);
            $location_avg_mites[$i] = round($location_total_mites[$i]/$number_of_location_blocks, 2);
        }
        return array('grower_avg' => $grower_avg_mites, 'location_avg' => $location_avg_mites);
    }
    
    public function actionGetBlockMite(){
    	$VAR = array();
        $year = $_GET['year'];
        $dates = $this->_get_filter_dates($year);
        $filter = $dates;
        $filter['block_id'] = $this->block->id;
    	$model = new MiteMonitor('search');
    	$model->unsetAttributes();
    	//$model->attributes = array('block_id'=>$this->block->id,'date'=>$date);
    	//$date_range = $model->getMiteRange();
    	$dataProvider = $model->getMiteMonitorInRange($filter);
    	$data = $dataProvider->getData();
    	$mite = Mite::model()->findAll();
    	$PEST = function ($sedat,$mite){ // The method to calculate PEST CLID data
    		if(in_array($mite,Mite::model()->findAllByAttributes(array('type'=>'Pest')))){ // Merge value only with Type = Pest
    			$data = array_merge(array('name'=>'Total Pests'),array('data'=>$sedat),array('color'=>'#000000'));
    			$pest = $this->Pest_CLID;
    			if(!empty($pest)){
    				$merge = array();
    				foreach($data['data'] as $key=>&$val){ // Loop though current pest
    					$pp = $pest['data'][$key]; // Get the values from the last Pest_CLID data
    					$merge[$key]= $pp+$val;
    				}
    				$this->Pest_CLID = array('name'=>'Total Pests','data'=>$merge,'color'=>'#000000','pointInterval'=> $this->pointInterval);
    			}else{
    				$this->Pest_CLID =  $data;
    			}
    		}
    	};
    	$keys_arr = array();
    	foreach($mite as $v){
    		$keys_arr[] = $v->name;
    	}
    	$serial = array();
        $m = strtotime($dates['date_from']);
    	$e = strtotime($dates['date_to']);
    	$mite_data = array();
    	foreach($keys_arr as $r){
    		$mm = $m;
    		$sedat = array();
            $dd = 0;
    		while($mm < $e)
    		{	
    			if(date($mm) < date(time())){
                    foreach($data as $val){
    					if($val["mite_name"]==$r){ // get cumulative data with pest
    						if($val["mm_date"]==date("Y-m-d", $mm)){
    							$dd += ($val['mm_average_li']*$val['mm_no_days']);
    						}
    					}
    				}
    				$sedat[] = $dd;
    			}
    			$mm = strtotime('+1 day', $mm); // increment for loop
    		}
    		$PEST($sedat,$r); // Merge CLID data on PESTS
    		$serial[] = array('name'=>$r,'data'=>$sedat,'color'=>Mite::MiteColor($r),'pointInterval'=>$this->pointInterval);
    		
    	}
    	$serial[] = $this->Pest_CLID;
        $max_value = max(max($this->Pest_CLID));
        if ($max_value < 3500)
            $max_value = 3500;
        
        //Get average pest/mite
        $avg = $this->getAverageMite($dates, $this->block->property->location_id);        
        $serial[] = array('name'=>'AVG Pests in Location','data'=>$avg['location_avg'],'color'=>'#87CEFA','pointInterval'=> $this->pointInterval);
        
        $user_id = $_GET['user'];
        $is_admin = 0;
        $user = Users::model()->findByPk($user_id);
    	if(isset($user)){
    		$is_admin = $user->type == 'admin';
    	}
        if ($is_admin)
            $serial[] = array('name'=>'AVG Pests of all Grower','data'=>$avg['grower_avg'],'color'=>'#0000FF','pointInterval'=> $this->pointInterval);
        
    	$VAR['chart'] = array('renderTo'=>'yw1','type'=>'spline','zoomType'=>'x');
    	$VAR['title'] = array('text'=>'Monitoring : '.$this->block->name.' between '.date("d/m/Y", $m).' and '.date("d/m/Y", $e));
        $VAR['subtitle'] = array('text'=>'Click and drag in the plot area to zoom in');
    	$VAR['tooltip'] = array('shared'=>true,'crosshairs'=>true);
    	$VAR['plotOptions'] = array('spline'=>array('lineWidth'=>4,'states'=>array('hover'=>array('lineWidth'=> 5)),'marker'=>array('enabled' =>false)));
    	$VAR['xAxis'] = array('type'=>'datetime','maxZoom'=> $this->maxZoom);
    	$VAR['yAxis'] = array('title'=>array('text'=>''),'startOnTick'=>0,'showFirstLabel'=>0,'floor'=> 0,'min'=> 0,'max'=>$max_value,'minorGridLineWidth'=> 0,'gridLineWidth'=> 0,'alternateGridColor'=> null,'plotBands'=>array(array('from'=>'1500','to'=>'1700','color'=>'#F5D3F5','label'=>array('text'=>'Williams pears (1500)','style'=>array('color'=>'#606060'))),array('from'=>'2500','to'=>'2700','color'=>'#F5D3F5','label'=>array('text'=>'Pakham pears (2500)','style'=>array('color'=>'#606060'))),array('from'=>'3500','to'=>'3700','color'=>'#F5D3F5','label'=>array('text'=>'Apples (3500)','style'=>array('color'=>'#606060')))));
    	$VAR['series'] = $serial;
        $VAR['pointStart'] = array('year'=>date('Y',$m), 'month'=>date('n',$m)-1, 'day'=>date('d',$m) );
    	echo CJSON::encode($VAR);
    	Yii::app()->end();
    
    }
    
    
    public function actionGetLocationTrap(){
    	$VAR = array();
        $year = $_POST['year'];
        $dates = $this->_get_filter_dates($year);
        $filter = $dates;
        $filter['location_id'] = $this->location;
        
    	$model = new TrapCheck('search');
    	$model->unsetAttributes();
    	$dataProvider = $model->getTrapCheckInRangeByLocation($filter);
    	$data = $dataProvider->getData();
        $pest = Pest::model()->findAll();
        $keys_arr = $pests = array();
		foreach($pest as $v){
			$keys_arr[] = $v->name;
            $pests[$v->name] = $v;
		}
    	$serial = array();
    	if(!empty($keys_arr)){
            $m = strtotime($dates['date_from']);
    		$e = strtotime($dates['date_to']);;
    		foreach($keys_arr as $r){
    			$mm = $m;
    			$sedat = array();
    			while($mm < $e)
    			{
    				if(date($mm) < date(time())){
    				    $dd = 0;
	    				foreach($data as $val){
	    					
	    					if($val["tc_date"]==date("Y-m-d", $mm) && $val["pest_name"]==$r){
	    						$dd = intval($val["tc_value"]);
	    					}
	    				}
                        $sedat[] = $dd;
    				}
    				$mm = strtotime('+1 day', $mm); // increment for loop
    			}
    			$serial[] = array('name'=>$r,'data'=>$sedat,'color'=>Pest::PestColor($r),'pointInterval'=> $this->pointInterval);
    		}
    
    	}
    	if(!empty($serial)){
    		$VAR['chart'] = array('renderTo'=>'yw0','type'=>'spline','zoomType'=>'x');
    		$VAR['title'] = array('text'=>'Trapping: '. implode(',',$this->location_names) .' between '.date("d/m/Y", $m).' and '.date("d/m/Y", $e));
    		$VAR['subtitle'] = array('text'=>'Click and drag in the plot area to zoom in');
            $VAR['tooltip'] = array('shared'=>true,'crosshairs'=>true);
    		//$VAR['plotOptions'] = array('series'=>array('connectNulls'=> true),'spline'=>array('lineWidth'=>4,'states'=>array('hover'=>array('lineWidth'=> 5)),'marker'=>array('enabled' =>true)));
    		$VAR['plotOptions'] = array('spline'=>array('lineWidth'=>4,'states'=>array('hover'=>array('lineWidth'=> 5)),'marker'=>array('enabled' =>false)));
            $VAR['xAxis'] = array('type'=>'datetime','maxZoom'=> $this->maxZoom, 'max' => strtotime($dates['date_to'])*1000);
    		$VAR['yAxis'] = array('title'=>array('text'=>''),'startOnTick'=>0,'showFirstLabel'=>0,'floor'=> 0,'allowDecimals'=>false,'minRange' => 0.1);
    		$VAR['series'] = $serial;
            $VAR['pointStart'] = array('year'=>date('Y',$m), 'month'=>date('n',$m)-1, 'day'=>date('d',$m) );
    	}else{
    		$VAR['chart']= $serial;
    	}
    	echo CJSON::encode($VAR);
    	Yii::app()->end();
    
    }
    
    public function actionGetLocationMite(){
    	$VAR = array();
        $year = $_POST['year'];
        $dates = $this->_get_filter_dates($year);
        $filter = $dates;
        $filter['location_id'] = $this->location;
    	$model = new MiteMonitor('search');
    	$model->unsetAttributes();
    	$dataProvider = $model->getMiteMonitorInRangeByLocation($filter);
    	$data = $dataProvider->getData();
    	$mite = Mite::model()->findAll();
    	$PEST = function ($sedat,$mite){ // The method to calculate PEST CLID data
    		if(in_array($mite,Mite::model()->findAllByAttributes(array('type'=>'Pest')))){ // Merge value only with Type = Pest
    			$data = array_merge(array('name'=>'Total Pests'),array('data'=>$sedat),array('color'=>'#000000'));
    			$pest = $this->Pest_CLID;
    			if(!empty($pest)){
    				$merge = array();
    				foreach($data['data'] as $key=>&$val){ // Loop though current pest
    					$pp = $pest['data'][$key]; // Get the values from the last Pest_CLID data
    					$merge[$key]= $pp+$val;
    				}
    				$this->Pest_CLID = array('name'=>'Total Pests','data'=>$merge,'color'=>'#000000','pointInterval'=> $this->pointInterval);
    			}else{
    				$this->Pest_CLID =  $data;
    			}
    		}
    	};
    	$keys_arr = array();
    	foreach($mite as $v){
    		$keys_arr[] = $v->name;
    	}
    	$serial = array();
        $m = strtotime($dates['date_from']);
    	$e = strtotime($dates['date_to']);
    	$mite_data = array();
    	foreach($keys_arr as $r){
    		$mm = $m;
    		$sedat = array();
            $dd = 0;
    		while($mm < $e)
    		{	
    			if(date($mm) < date(time())){
                    foreach($data as $val){
    					if($val["mite_name"]==$r){ // get cumulative data with pest
    						if($val["mm_date"]==date("Y-m-d", $mm)){
    							$dd += ($val['mm_average_li']*$val['mm_no_days']);
    						}
    					}
    				}
    				$sedat[] = $dd;
    			}
    			$mm = strtotime('+1 day', $mm); // increment for loop
    		}
    		$PEST($sedat,$r); // Merge CLID data on PESTS
    		$serial[] = array('name'=>$r,'data'=>$sedat,'color'=>Mite::MiteColor($r),'pointInterval'=>$this->pointInterval);
    		
    	}
    	$serial[] = $this->Pest_CLID;
        $max_value = max(max($this->Pest_CLID));
        if ($max_value < 3500)
            $max_value = 3500;
        
        //Get average pest/mite
        $avg = $this->getAverageMite($dates, is_array($this->location)?'':$this->location);     
        if (!is_array($this->location))   
            $serial[] = array('name'=>'AVG Pests in Location','data'=>$avg['location_avg'],'color'=>'#87CEFA','pointInterval'=> $this->pointInterval);
        $serial[] = array('name'=>'AVG Pests of all Grower','data'=>$avg['grower_avg'],'color'=>'#0000FF','pointInterval'=> $this->pointInterval);
        
            
    	$VAR['chart'] = array('renderTo'=>'yw1','type'=>'spline','zoomType'=>'x');
    	$VAR['title'] = array('text'=>'Monitoring: '. implode(',',$this->location_names) .' between '.date("d/m/Y", $m).' and '.date("d/m/Y", $e));
        $VAR['subtitle'] = array('text'=>'Click and drag in the plot area to zoom in');
    	$VAR['tooltip'] = array('shared'=>true,'crosshairs'=>true);
    	$VAR['plotOptions'] = array('spline'=>array('lineWidth'=>4,'states'=>array('hover'=>array('lineWidth'=> 5)),'marker'=>array('enabled' =>false)));
    	$VAR['xAxis'] = array('type'=>'datetime','maxZoom'=> $this->maxZoom);
    	$VAR['yAxis'] = array('title'=>array('text'=>''),'startOnTick'=>0,'showFirstLabel'=>0,'floor'=> 0,'min'=> 0,'max'=>$max_value,'minorGridLineWidth'=> 0,'gridLineWidth'=> 0,'alternateGridColor'=> null,'plotBands'=>array(array('from'=>'1500','to'=>'1700','color'=>'#F5D3F5','label'=>array('text'=>'Williams pears (1500)','style'=>array('color'=>'#606060'))),array('from'=>'2500','to'=>'2700','color'=>'#F5D3F5','label'=>array('text'=>'Pakham pears (2500)','style'=>array('color'=>'#606060'))),array('from'=>'3500','to'=>'3700','color'=>'#F5D3F5','label'=>array('text'=>'Apples (3500)','style'=>array('color'=>'#606060')))));
    	$VAR['series'] = $serial;
        $VAR['pointStart'] = array('year'=>date('Y',$m), 'month'=>date('n',$m)-1, 'day'=>date('d',$m) );
    	echo CJSON::encode($VAR);
    	Yii::app()->end();
    
    }
	
    public function actionGetGraphInRange(){
    	$VAR = array();
        
        $filter = array(
                        'block_id' => $_GET['block'],
                        'date_from' => $_GET['date_from'],
                        'date_to' => $_GET['date_to']
                    );
        $index = $_GET['index'];
        $grower_id = $_GET['grower'];
        $grower = Grower::model()->findByPk($grower_id);
        if (!$grower)
        {
            echo CJSON::encode(array('error' => 'Invalid grower ID.'));
	        Yii::app()->end();
            exit;
        }
    	$model = new TrapCheck('search');
    	$model->unsetAttributes();
    	$dataProvider = $model->getTrapCheckInRange($filter);
    	$data = $dataProvider->getData();
        $pest= array();
    	for($i = 0 ; $i < count($data)  ; $i++ )
    	{
    		$pest[$data[$i]['pest_name']] = $data[$i]['pest_name'];
    	}
    	$serial = array();
        $keys_arr = array_keys($pest);
        $min_time = strtotime($filter['date_from']);
   		$max_time = strtotime($filter['date_to']);
        $max_value = 0;
    	if(!empty($keys_arr)){
    		foreach($keys_arr as $r){
    			$mm = $min_time;
    			$sedat = array();
    			while($mm <= $max_time)
    			{
    				$dd = 0;
    				foreach($data as $val){
    					if($val["tc_date"]==date("Y-m-d", $mm) && $val["pest_name"]==$r){
    						$dd = intval($val["tc_value"]);
                            if ($max_value < $dd)
                                $max_value = $dd;
    					}
    				}
					$sedat[] = $dd;
    				$mm = strtotime('+1 day', $mm); // increment for loop
    			}
    			$serial[] = array_merge(array('name'=>$r,'pointInterval' => 24 * 3600 * 1000,'pointStart' => $min_time*1000),array('data'=>$sedat));
    		}
    		
    	}
		if(!empty($serial)){
		    $yAxis = array();
            for($i = 1; $i <= $max_value+1; $i++)
                $yAxis[] = $i;
			$VAR['chart'] = array('renderTo'=>'yw'.$index, 'zoomType' => 'x');
			$VAR['title'] = array('text'=> $grower->name. ' betweent '. date('d M, Y', $min_time) . ' and '. date('d M, Y', $max_time));
			$VAR['subtitle'] = array('text' => 'Click and drag in the plot area to zoom in');
            $VAR['tooltip'] = array('shared'=>true,'crosshairs'=>true);
			$VAR['legend'] = array('layout'=>'vertical','align'=>'right','verticalAlign'=>'middle','borderWidth'=>'0');
			$VAR['xAxis'] = array(
                                'type' => 'datetime',
                                'minRange' => 14 * 24 * 3600000 // fourteen days
                            );
			$VAR['yAxis'] = array('type' => 'category','title' => '');
			$VAR['series'] = $serial;
		}else{
			$VAR['chart']= 'failed';
		}
    	echo CJSON::encode($VAR);
    	Yii::app()->end();
    	 
    }
    
    private function getxAxis($m, $e = 0){
    	$xAxis = array();
        if (empty($e))
    	   $e = strtotime('+1 month',$m);
    	while($m < $e)
    	{	if(date($m) < date(time())){
    			$xAxis[date("d/m", $m)] = array_merge(array(date("d/m", $m)),$xAxis);
    		}
    		$m = strtotime('+1 day', $m); // increment for loop
    	
    	}
    	return $xAxis;
    }
  
    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
    	if ($error = Yii::app()->errorHandler->error) {
    		if (Yii::app()->request->isAjaxRequest)
    			echo $error['message'];
    		else
    			$this->renderPartial('error', $error);
    	}
    }

}