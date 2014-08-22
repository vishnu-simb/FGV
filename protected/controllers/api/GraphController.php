<?php

class GraphController extends SimbApiController {

	protected $block;
	
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
    				$dd = 0;
    				foreach($data as $val){
    					if($val["tc_date"]==date("Y-m-d", $mm) && $val["pest_name"]==$r){
    						$dd = intval($val["tc_value"]);
    					}
    				}
    				$sedat[] = $dd;
    				$mm = strtotime('+1 day', $mm); // increment for loop
    			}
    			$serial[] = array_merge(array('name'=>$r),array('data'=>$sedat));
    		}
    
    	}
    	if(!empty($serial)){
    		$VAR['chart'] = array('renderTo'=>'yw0');
    		$VAR['title'] = array('text'=>'');
    		$VAR['tooltip'] = array('shared'=>true,'crosshairs'=>true);
    		$VAR['legend'] = array('layout'=>'vertical','align'=>'right','verticalAlign'=>'middle','borderWidth'=>'0');
    		$VAR['xAxis'] = array('categories'=>array_keys($this->getxAxis($m)));
    		$VAR['yAxis'] = array('title'=>array('text'=>'Trapping : '.$this->block->name.' between '.date("Y-m-d", $m).' and '.date("Y-m-t", $m)));
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
    	$model = new MonitorCheck('search');
    	$model->unsetAttributes();
    	$model->attributes = array('block_id'=>$this->block->id,'date'=>$date);
    	$dataProvider = $model->getSqlDataProvider();
    	$data = $dataProvider->getData();
    	$mite = Mite::model()->findAllByAttributes(array('type'=>'pest'));
    	$keys_arr = array();
    	foreach($mite as $v){
    		$keys_arr[] = $v->name;
    	}
    	$serial = array();
    	$e = strtotime('+1 month',$m);
    	foreach($keys_arr as $r){
    		$mm = $m;
    		$sedat = array();
    		while($mm < $e)
    		{
    			$dd = 0;
    			foreach($data as $val){
    				if($val["mc_date"]==date("Y-m-d", $mm) && $val["mite_name"]==$r){
    					$dd = intval($val["mc_average_number"]);
    				}
    			}
    			$sedat[] = $dd;
    			$mm = strtotime('+1 day', $mm); // increment for loop
    		}
    		$serial[] = array_merge(array('name'=>$r),array('data'=>$sedat));
    	}
    
    	$VAR['chart'] = array('renderTo'=>'yw1','type'=>'column');
    	$VAR['title'] = array('text'=>'');
    	$VAR['tooltip'] = array('shared'=>true,'crosshairs'=>true, 'pointFormat' =>'<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',);
    	$VAR['legend'] = array('layout'=>'vertical','align'=>'right','verticalAlign'=>'middle','borderWidth'=>'0');
    	$VAR['xAxis'] = array('categories'=>array_keys($this->getxAxis($m)));
    	$VAR['yAxis'] = array('title'=>array('text'=>'Monitoring : '.$this->block->name.' between '.date("Y-m-d", $m).' and '.date("Y-m-t", $m)));
    	$VAR['plotOptions'] = array('column'=>array('stacking'=>'percent'));
    	$VAR['series'] = $serial;
    	echo CJSON::encode($VAR);
    	Yii::app()->end();
    
    }
    
    public function actionGetGraphInRange(){
    	$VAR = array();
    	$min_date = $_GET['min_date'];
        $max_date = $_GET['max_date'];
        $index = $_GET['index'];
        $m = 'August,2014';
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
    				$dd = 0;
    				foreach($data as $val){
    					if($val["tc_date"]==date("Y-m-d", $mm) && $val["pest_name"]==$r){
    						$dd = intval($val["tc_value"]);
    					}
    				}
					$sedat[] = $dd;
    				$mm = strtotime('+1 day', $mm); // increment for loop
    			}
    			$serial[] = array_merge(array('name'=>$r),array('data'=>$sedat));
    		}
    		
    	}
		if(!empty($serial)){
			$VAR['chart'] = array('renderTo'=>'yw'.$index);
			$VAR['title'] = array('text'=>'');
			$VAR['tooltip'] = array('shared'=>true,'crosshairs'=>true);
			$VAR['legend'] = array('layout'=>'vertical','align'=>'right','verticalAlign'=>'middle','borderWidth'=>'0');
			$VAR['xAxis'] = array('categories'=>array_keys($this->getxAxis($m)));
			$VAR['yAxis'] = array('title'=>array('text'=>''));
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
    	{
    		$xAxis[date("d", $m)] = array_merge(array(date("d", $m)),$xAxis);
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