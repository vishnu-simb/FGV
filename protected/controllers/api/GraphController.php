<?php

class GraphController extends SimbApiController {

	protected $block;
	
	private $Pest_CLID = array();
	
	function __construct(){
		$this->block = Block::model()->findByPk($_GET['block']);
		if ($this->block === null) {
			return $this->actionError();
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
    			$max_spray_count = max($max_spray_count,$pest->getSprayCount());
    		}
    	}
    
    	$sprayDates = array();
    	foreach(Pest::model()->findAll() as $pest){
    		if($pest->calculate == 'yes'){
    			for($i=1,$f=$pest->getSprayCount();$i<=$f;++$i){
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
	

    public function actionGetBlockTrap(){
    	$VAR = array();
    	$m = $_GET['date'];
    	$m = strtotime('01-'.str_replace(',','-',$m));
    	$date= date('Y-m',$m);
    	$model = new TrapCheck('search');
    	$model->unsetAttributes();
    	$model->attributes = array('block_id'=>$this->block->id,'date'=>$date);
    	$dataProvider = $model->getSqlDataProvider();
    	$data = $dataProvider->getData();
    	$pest= array();
    	for($i = 0 ; $i < count($data)  ; $i++ )
    	{
    		$pest[$data[$i]['pest_name']] = $data[$i]['pest_name'];
    	}
    	$serial = array();
    	$keys_arr = array_keys($pest);
    	if(!empty($keys_arr)){
    
    		$e = strtotime('+1 month',$m);
    		foreach($keys_arr as $r){
    			$mm = $m;
    			$sedat = array();
    			while($mm < $e)
    			{
    				if(date($mm) < date(time())){
	    				$dd = null;
	    				foreach($data as $val){
	    					
	    					if($val["tc_date"]==date("Y-m-d", $mm) && $val["pest_name"]==$r){
	    						$dd = intval($val["tc_value"]);
	    					}
	    				}
	    				$sedat[] = $dd;
    				}
    				$mm = strtotime('+1 day', $mm); // increment for loop
    			}
    			$serial[] = array_merge(array('name'=>$r),array('data'=>$sedat),array('color'=>Pest::PestColor($r)));
    		}
    
    	}
    	if(!empty($serial)){
    		$VAR['chart'] = array('renderTo'=>'yw0','type'=>'spline');
    		$VAR['title'] = array('text'=>'Trapping : '.$this->block->name.' between '.date("Y-m-d", $m).' and '.date("Y-m-t", $m));
    		$VAR['tooltip'] = array('shared'=>true,'crosshairs'=>true);
    		$VAR['plotOptions'] = array('series'=>array('connectNulls'=> true),'spline'=>array('lineWidth'=>4,'states'=>array('hover'=>array('lineWidth'=> 5)),'marker'=>array('enabled' =>true)));
    		$VAR['xAxis'] = array('categories'=>array_keys($this->getxAxis($m)));
    		$VAR['yAxis'] = array('title'=>array('text'=>''),'floor'=> 0,'allowDecimals'=>false,'minRange' => 0.1);
    		$VAR['series'] = $serial;
    	}else{
    		$VAR['chart']= $serial;
    	}
    	echo CJSON::encode($VAR);
    	Yii::app()->end();
    
    }
    
    public function actionGetBlockMite(){
    	$VAR = array();
    	$m = $_GET['date'];
    	$m = strtotime('01-'.str_replace(',','-',$m));
    	$date= date('Y-m',$m);
    	$model = new MiteMonitor('search');
    	$model->unsetAttributes();
    	$model->attributes = array('block_id'=>$this->block->id,'date'=>$date);
    	$date_range = $model->getMiteRange();
    	$dataProvider = $model->getSqlDataProvider();
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
    				$this->Pest_CLID = array_merge(array('name'=>'Total Pests'),array('data'=>$merge),array('color'=>'#000000'));
    			}else{
    				$this->Pest_CLID =  $data;
    			}
    		}
    	};
    	$MITE = function($data,$date_range,$r){ // The method to calculate CLID data cumulative over the season 
    		$e = strtotime($date_range['date_initial']);
    		$mm = strtotime($date_range['date_start']);
    		$mite_data = array();
    		$dd['cumulative'] = 0;
    		while($mm < $e)
    		{
    			if(date($mm) < date(time())){
    				foreach($data as $val){
    					if($val["mite_name"]==$r){ // get cumulative data with pest
    						if($val["mm_date"]==date("Y-m-d", $mm)){
    							$dd['cumulative'] = ($val['mm_average_li']*$val['mm_no_days'])+$dd['cumulative'];
    						}
    						$dd['mite_name'] = $val['mite_name'];
    						$dd['date'] = date("Y-m-d", $mm);
    					}
    					
    				}
    				$mite_data[] = $dd;
    			}
    			$mm = strtotime('+1 day', $mm); // increment for loop
    		}
    		return $mite_data;
    	};
    	
    	$keys_arr = array();
    	foreach($mite as $v){
    		$keys_arr[] = $v->name;
    	}
    	$serial = array();
    	$e = strtotime('+1 month',$m);
    	$mite_data = array();
    	foreach($keys_arr as $r){
    		$mm = $m;
    		$sedat = array();
    		$dd = 0;
    		while($mm < $e)
    		{	
    			if(date($mm) < date(time())){
    				foreach($MITE($data,$date_range,$r) as $val){
    					if(isset($val["date"]) && $val["date"]==date("Y-m-d", $mm)){
    						$dd = $val['cumulative'];
    					}
    				}
    				$sedat[] = $dd;
    			}
    			$mm = strtotime('+1 day', $mm); // increment for loop
    		}
    		$PEST($sedat,$r); // Merge CLID data on PESTS
    		$serial[] = array_merge(array('name'=>$r),array('data'=>$sedat),array('color'=>Mite::MiteColor($r)));
    		
    	}
    	$serial[] = $this->Pest_CLID;
    	$VAR['chart'] = array('renderTo'=>'yw1','type'=>'spline');
    	$VAR['title'] = array('text'=>'Monitoring : '.$this->block->name.' between '.date("Y-m-d", $m).' and '.date("Y-m-t", $m));
    	$VAR['tooltip'] = array('shared'=>true,'crosshairs'=>true);
    	$VAR['plotOptions'] = array('spline'=>array('lineWidth'=>4,'states'=>array('hover'=>array('lineWidth'=> 5)),'marker'=>array('enabled' =>false)));
    	$VAR['xAxis'] = array('categories'=>array_keys($this->getxAxis($m)));
    	$VAR['yAxis'] = array('title'=>array('text'=>''),'floor'=> 0,'min'=> 0,'max' => 3500,'minorGridLineWidth'=> 0,'gridLineWidth'=> 0,'alternateGridColor'=> null,'plotBands'=>array(array('from'=>'1500','to'=>'1700','color'=>'#F5D3F5','label'=>array('text'=>'Williams pears (1500)','style'=>array('color'=>'#606060'))),array('from'=>'2500','to'=>'2700','color'=>'#F5D3F5','label'=>array('text'=>'Pakham pears (2500)','style'=>array('color'=>'#606060'))),array('from'=>'3500','to'=>'3700','color'=>'#F5D3F5','label'=>array('text'=>'Apples (3500)','style'=>array('color'=>'#606060')))));
    	$VAR['series'] = $serial;
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
    
    private function getxAxis($m){
    	$xAxis = array();
    	$e = strtotime('+1 month',$m);
    	while($m < $e)
    	{	if(date($m) < date(time())){
    			$xAxis[date("d", $m)] = array_merge(array(date("d", $m)),$xAxis);
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