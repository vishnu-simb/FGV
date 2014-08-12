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
		echo CJSON::encode($VAR);
        Yii::app()->end();
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

    public function actionGetGraph(){
    	
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
    	
    	if(!empty(array_keys($pest))){
    		$rows = array();
    		$rows[] =array_merge(array(""),array_keys($pest));
    		$e = strtotime('+1 month',$m);
    		while($m < $e)
    		{	$value = array();
    			foreach(array_keys($pest) as $r)
    			{
    				$cell = array(0);
    				foreach($data as $val){
	    				if($val["tc_date"]==date("Y-m-d", $m) && $val["pest_name"]==$r){
	    					$cell = array($val["tc_value"]);
	    				}
	      			}
	      			$value = array_merge($value,$cell);
    			}
    			$rows[] = array_merge(array(date("d", $m)),$value);
    			$m = strtotime('+1 day', $m); // increment for loop
    		}
    		
    		$graph = $rows;
    		$VAR['status'] = "success";
    	}else{
    		$graph = array();
    		$VAR['status'] = "false";
    	}

    	$VAR['axis'] = array();
    	$VAR['graph'] = $graph;
    	echo CJSON::encode($VAR);
        Yii::app()->end();
    	
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