<?php

class ReportController extends SimbController
{
    public function beforeRender($view){
        $this->layout = '//layouts/report';
        return true;
    }
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
				'accessControl', // perform access control for CRUD operations
		);
	}
	
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
				array(
						'allow',
						'actions' => array('index', 'logout'),
						'users' => array('@'),
				),
				array(
						'deny',
						'actions' => array('index', 'logout'),
						'users' => array('*'),
						'deniedCallback' => array($this, 'redirectLoginNeeded'),
				),
	
		);
	}
    
    private function getDateRange(){
        $data = array();
        $data['date_from'] = strtotime(date('Y').'-08-01');
		if(time() < $data['date_from']){
			$data['date_from'] = strtotime('-1 year',$data['date_from']);
		}
		$data['date_to'] = strtotime('+9 months',$data['date_from']);
		
		$short = false;
		if($data['date_to'] > time()){
			$data['date_to'] = time();
			$data['date_from'] = strtotime('-3 months',$data['date_to']);
			$short = true;
		}
		
		$data['date_from'] = date('Y-m-d',$data['date_from']);
		$data['date_to'] = date('Y-m-d',$data['date_to']);
        return $data;
    }
    
    private function getGraph($block, $grower){
        $data = $this->getDateRange();
        $VAR = array();
        $filter = array(
                        'block_id' => $block->id,
                        'date_from' => $data['date_from'],
                        'date_to' => $data['date_to']
                    );
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
			$VAR['chart'] = array('zoomType' => 'x');
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
		}
        return $VAR;
	}
	
	/**
	 * Manages all models.
	 */
	public function actionGrower($id)
	{
        $grower = $this->loadModel($id);
		$this->pageTitle = sprintf(Yii::t('app', '%s'), 'Report for '. $grower->name);
        $VARS = array();
		$VARS['blocks'] = $VARS['sprayDates'] = $VAR['graphData'] = array();
		
		if(!($grower instanceof Grower)){
			throw new Exception('Invalid Request (Grower)');
		}

		$VARS['grower'] = $grower;
		$VARS['dateRange'] = $this->getDateRange();
        
        $max_spray_count = 0;
		foreach(Pest::model()->findAll() as $pest){
			$max_spray_count = max($max_spray_count,$pest->getSprayCount());
		}
        $sprayDates = $pests = array();
		foreach(Pest::model()->findAll() as $pest){
			$pests[$pest->name] = $pest;
			if($pest->calculate == 'yes'){
				for($i=1,$f=$pest->getSprayCount();$i<=$f;++$i){
					$spray = $pest->getSpray($i,$grower);
					$sprayDates[$pest->name][$i] = $spray;
					if($spray->hasLowPopulation()){
						$lowPop = clone $spray;
						$lowPop->swapPopulationValues();
						$sprayDates[$pest->name.'<br/>Low Population'][$i] = $lowPop;
					}
				}
				for($f++;$f<=$max_spray_count;++$f){
					$sprayDates[$pest->name][$f] = null;
					if($spray->hasLowPopulation()){
						$sprayDates[$pest->name.'<br/>Low Population'][$f] = null;
					}
				}
			}
		}
		$VARS['pests'] = $pests;
		$properties = $grower->getProperties();
		foreach($properties as $property){
			//Get Data
			$blocks = $property->getBlocks();

			foreach($blocks as $block){
				$VARS['blocks'][] = $block;
				//$VARS['sprayDates'][$block->getId()] = $sprayDates;
				
				$sprayData = array();
				$pp = null;
				foreach($sprayDates as $pest=>$sprays){
					$pd = new PestResult();
					$pd->pest = isset($pests[$pest])?$pests[$pest]:'';
					if($pd->pest){
						$pp = $pd->pest;
						$pd->biofix = $pd->pest->getBiofix($block->id,false);
						if($pd->biofix) $pd->biofix = $pd->biofix->date;
						$pd->secondCohortBiofix = $pd->pest->getBiofix($block->id,true);
						if($pd->secondCohortBiofix) $pd->secondCohortBiofix = $pd->secondCohortBiofix->date;
					}else{
						$pd->pest = $pp;
						$pd->isLowPop = true;
					}

					//&& $date->isLowPop()
                    $ss = (int)(!$pd->isLowPop && $pd->pest->hasSecondCohort($block->id));
					for($second=0;$second<=$ss;$second++){
						foreach($sprays as $k=>$spray){
							if($spray){
								$sd = new SprayResult();
								$secondBool = (bool)$second;
								$sd->sprayDate = $spray->getDate($block,$secondBool);
								$sd->coverUntil = $spray->getCoverRequired($block,$secondBool);
								if($secondBool){
									//die(var_dump($sd->sprayDate));
									$pd->secondCohortSprays[$k] = $sd;
								}else{
									$pd->sprays[$k] = $sd;
								}
							}else{
								$pd->sprays[$k] = null;
							}
						}
					}
					$sprayData[$pest] = $pd;
				}
				$VARS['sprayDates'][$block->id] = $sprayData;
				
                if (empty($VARS['graphData'][$block->id]))
				    $VARS['graphData'][$block->id] = $this->getGraph($block, $grower);
				
			}
		}
        //$VARS['email'] = $this->email;
        $VARS['link'] = Yii::app()->baseUrl. '/report/?grower='.$grower->id;
		$this->render('grower', array(
                'VARS' => $VARS
		));
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Grower the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$modelGrower = Grower::model()->findByPk($id);
		if ($modelGrower === null) {
            $errorText = YII_DEBUG ? sprintf(
                Yii::t('app', 'The ID %s does not exist in %s.'),
                $id,
                'My Account'
            ) : Yii::t('app', 'The requested page does not exist.');
			throw new CHttpException(404, $errorText);
		}
		return $modelGrower;
	}
}