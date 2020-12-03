<?php

class ReportController extends SimbController
{
	private $Pest_CLID = array();
	
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
    
    private function getDateRange($year = ''){
        $data = array();
	    if (empty($year))
		    $year = date('Y');
        $data['date_from'] = strtotime(($year-1).'-07-01');
		if(time() < $data['date_from']){
			$data['date_from'] = strtotime('-1 year',$data['date_from']);
		}
		$data['date_to'] = strtotime('+8 months',$data['date_from']);
	    /*
		$short = false;
		if($data['date_to'] > time()){
			$data['date_to'] = time();
			$data['date_from'] = strtotime('-3 months',$data['date_to']);
			$short = true;
		}
		*/
		$data['date_from'] = date('Y-m-d',$data['date_from']);
		$data['date_to'] = date('Y-m-d',$data['date_to']);
        return $data;
    }
    
    private function getGraph($block, $grower, $year = ''){
        $data = $this->getDateRange($year);

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
    	$serial = array();
        $pest = Pest::model()->findAll();
        $keys_arr = array();
		foreach($pest as $v){
			$keys_arr[] = $v->name;
		}
        $min_time = strtotime($filter['date_from']);
   		$max_time = strtotime($filter['date_to']);
        $max_value = 0;
    	if(!empty($keys_arr)){
    		foreach($keys_arr as $r){
                $has_trap = 0;
    			$mm = $min_time;
    			$sedat = array();
    			while($mm <= $max_time)
    			{
    				$dd = 0;
                    $has_record = 0;
    				foreach($data as $val){
    					if($val["tc_date"]==date("Y-m-d", $mm) && $val["pest_name"]==$r){
                            $has_record = 1;
    						$dd += intval($val["tc_value"]);
                            if ($max_value < $dd)
                                $max_value = $dd;
    					}
    				}
                    if($has_record){
                        $sedat[] = array('y' => $dd, 'color' => darken_color(Pest::PestColor($r)));
                        $has_trap = 1;
                    }else{
                        $sedat[] = $dd;
                    }
    				$mm = strtotime('+1 day', $mm); // increment for loop
    			}
                if($has_trap)
    			    $serial[] = array_merge(array('name'=>$r,'pointInterval' => 24 * 3600 * 1000,'pointStart' => $min_time*1000),array('data'=>$sedat),array('color'=>Pest::PestColor($r)));
    		}
    		
    	}
		if(!empty($serial)){
			$VAR['chart'] = array('zoomType' => 'x','type'=>'spline');
			$VAR['title'] = array('text'=> $grower->name. ' between '. date('d M, Y', $min_time) . ' and '. date('d M, Y', $max_time));
			$VAR['subtitle'] = array('text' => 'Click and drag in the plot area to zoom in');
            $VAR['tooltip'] = array('shared'=>true,'crosshairs'=>true);
			$VAR['plotOptions'] = array('spline'=>array('lineWidth'=>4));
            $VAR['xAxis'] = array(
                'type' => 'datetime',
                'maxZoom' => 14 * 24 * 3600000, // fourteen days,
	            'tickInterval' =>   7 * 24 * 3600 * 1000,
	            'labels' => array(
					'format' =>  '{value:%d/%m/%y}',
		            'rotation' => 90,
		            'y' => 50,
		            'align' => 'center'
				),
	            'gridLineWidth' => 1,
	            'plotBands'=>
		            array(
			            array(
				            'from'=>$min_time,
				            'to'=>'2',
				            'color'=>'#F5D3F5',
				            'label'=>array(
					            'text'=>'Williams pears (1500)',
					            'style'=>array('color'=>'#606060')
				            )
			            )
		            )
            );
    		$VAR['yAxis'] = array(
    			'title'=>array('text'=>''),
			    'startOnTick'=>0,
			    'showFirstLabel'=>0,
			    'floor'=> 0,
			    'allowDecimals'=>false,
			    'minRange' => 0.1,
			    'max' => $max_value+1>4?$max_value+1:4,
			    'tickInterval' => $max_value>5?intval($max_value/5):1
		    );
    		$VAR['series'] = $serial;
		}
        return $VAR;
	}

    private function getCropGraph($block, $grower, $year = ''){
        $data = $this->getDateRange($year);

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
        $serial = array();
        $pest = Pest::model()->findAll();
        $keys_arr = array();
        foreach($pest as $v){
            $keys_arr[] = $v->name;
        }
        $min_time = strtotime($filter['date_from']);
        $max_time = strtotime($filter['date_to']);
        $max_value = 0;
        if(!empty($keys_arr)){
            foreach($keys_arr as $r){
                $has_trap = 0;
                $mm = $min_time;
                $sedat = array();
                while($mm <= $max_time)
                {
                    $dd = 0;
                    $has_record = 0;
                    foreach($data as $val){
                        if($val["em_date"]==date("Y-m-d", $mm) && $val["pest_name"]==$r){
                            $has_record = 1;
                            $dd += intval($val["tc_value"]);
                            if ($max_value < $dd)
                                $max_value = $dd;
                        }
                    }
                    if($has_record){
                        $sedat[] = array('y' => $dd, 'color' => darken_color(Pest::PestColor($r)));
                        $has_trap = 1;
                    }else{
                        $sedat[] = $dd;
                    }
                    $mm = strtotime('+1 day', $mm); // increment for loop
                }
                if($has_trap)
                    $serial[] = array_merge(array('name'=>$r,'pointInterval' => 24 * 3600 * 1000,'pointStart' => $min_time*1000),array('data'=>$sedat),array('color'=>Pest::PestColor($r)));
            }

        }
        if(!empty($serial)){
            $VAR['chart'] = array('zoomType' => 'x','type'=>'spline');
            $VAR['title'] = array('text'=> $grower->name. ' between '. date('d M, Y', $min_time) . ' and '. date('d M, Y', $max_time));
            $VAR['subtitle'] = array('text' => 'Click and drag in the plot area to zoom in');
            $VAR['tooltip'] = array('shared'=>true,'crosshairs'=>true);
            $VAR['plotOptions'] = array('spline'=>array('lineWidth'=>4));
            $VAR['xAxis'] = array(
                'type' => 'datetime',
                'maxZoom' => 14 * 24 * 3600000, // fourteen days,
                'tickInterval' =>   7 * 24 * 3600 * 1000,
                'labels' => array(
                    'format' =>  '{value:%d/%m/%y}',
                    'rotation' => 90,
                    'y' => 50,
                    'align' => 'center'
                ),
                'gridLineWidth' => 1,
                'plotBands'=>
                    array(
                        array(
                            'from'=>$min_time,
                            'to'=>'2',
                            'color'=>'#F5D3F5',
                            'label'=>array(
                                'text'=>'Williams pears (1500)',
                                'style'=>array('color'=>'#606060')
                            )
                        )
                    )
            );
            $VAR['yAxis'] = array(
                'title'=>array('text'=>''),
                'startOnTick'=>0,
                'showFirstLabel'=>0,
                'floor'=> 0,
                'allowDecimals'=>false,
                'minRange' => 0.1,
                'max' => $max_value+1>4?$max_value+1:4,
                'tickInterval' => $max_value>5?intval($max_value/5):1
            );
            $VAR['series'] = $serial;
        }
        return $VAR;
    }
	
	private function getMite($block, $grower, $year = ''){
		$data = $this->getDateRange($year);
		$VAR = array();
		$filter = array(
				'block_id' => $block->id,
				'date_from' => $data['date_from'],
				'date_to' => $data['date_to']
		);
		$model = new MiteMonitor('search');
    	$model->unsetAttributes();
		$dataProvider = $model->getMiteMonitorInRange($filter);
		$data = $dataProvider->getData();
		$mite = Mite::model()->findAll();
		$serial = array();
		$PEST = function($sedat,$mite,$min_time){ // The method to calculate PEST CLID data
			if(in_array($mite,Mite::model()->findAllByAttributes(array('type'=>'Pest')))){ // Merge value only with Type = Pest
				$data = array_merge(array('name'=>'Total Pests'),array('data'=>$sedat),array('color'=>'#000000'));
				$pest = $this->Pest_CLID;
				if(!empty($pest)){
					$merge = array();
					foreach($data['data'] as $key=>&$val){ // Loop though current pest
						$pp = $pest['data'][$key]; // Get the values from the last Pest_CLID data
						$merge[$key]= $pp+$val;
					}
					$this->Pest_CLID = array_merge(array('name'=>'Total Pests','pointInterval' => 24 * 3600 * 1000,'pointStart' =>$min_time*1000),array('data'=>$merge),array('color'=>'#000000'));
				}else{
					$this->Pest_CLID =  $data;
				}
			}
		};
		$keys_arr = array();
		foreach($mite as $v){
			$keys_arr[] = $v->name;
		}
		$min_time = strtotime($filter['date_from']);
		$max_time = strtotime($filter['date_to']);
		$max_value = 0;
		foreach($keys_arr as $r){
			$mm = $min_time;
			$sedat = array();
			$dd = 0;
			while($mm < $max_time)
			{
				if(date($mm) < date(time())){
					foreach($data as $val){
						if($val["mm_date"]==date("Y-m-d", $mm) && $val["mite_name"]==$r){
							$dd = ($val['mm_average_li']*$val['mm_no_days'])+$dd;
						}
					}
				}
                $sedat[] = $dd;
				$mm = strtotime('+1 day', $mm); // increment for loop
			}
			$PEST($sedat,$r,$min_time); // Merge CLID data on PESTS
			$serial[] = array_merge(array(
				'name'=>$r,
				'pointInterval' => 24 * 3600 * 1000,
				'pointStart' => $min_time*1000,
				'clickable' => false
			),array('data'=>$sedat),array('color'=>Mite::MiteColor($r)));
		
		}
		$serial[] = $this->Pest_CLID;
        $max_value = max(max($this->Pest_CLID));
        if ($max_value < 3500)
            $max_value = 3500;
        
		$VAR['chart'] = array('type'=>'spline');
		$VAR['title'] = array('text'=> $grower->name. ' between '. date('d M, Y', $min_time) . ' and '. date('d M, Y', $max_time));
		$VAR['subtitle'] = array('text' => 'Click and drag in the plot area to zoom in');
		$VAR['tooltip'] = array('shared'=>true,'crosshairs'=>true);
		$VAR['plotOptions'] = array(
			'spline'=>array(
				'lineWidth'=>4,
				'states'=>array(
					'hover'=>array('lineWidth'=> 5)
				),
				'marker'=>array('enabled' =>false)
			)
		);
		$VAR['xAxis'] =  array(
			'type' => 'datetime',
			'minRange' => 14 * 24 * 3600000,
			'tickInterval' =>   7 * 24 * 3600 * 1000,
			'labels' => array(
				'format' =>  '{value:%d/%m/%y}',
				'rotation' => 90,
				'y' => 50,
				'align' => 'center'
			),
		); // fourteen days
		$VAR['yAxis'] = array(
			'title'=>array('text'=>''),
			'floor'=> 0,
			'min'=> 0,
			'max' => $max_value,
			'minorGridLineWidth'=> 0,
			'gridLineWidth'=> 0,
			'alternateGridColor'=> null,
			'plotBands'=>
				array(
					array(
						'from'=>'1500',
						'to'=>'1700',
						'color'=>'#F5D3F5',
						'label'=>array(
							'text'=>'Williams pears (1500)',
							'style'=>array('color'=>'#606060')
						)
					),
					array(
						'from'=>'2500',
						'to'=>'2700',
						'color'=>'#F5D3F5',
						'label'=>array(
							'text'=>'Pakham pears (2500)',
							'style'=>array('color'=>'#606060')
						)
					),
					array(
						'from'=>'3500',
						'to'=>'3700',
						'color'=>'#F5D3F5',
						'label'=>array(
							'text'=>'Apples (3500)',
							'style'=>array('color'=>'#606060')
						)
					)
				)
		);
		$VAR['series'] = $serial;
		return $VAR;
	}
		
	/**
	 * Manages all models.
	 */
	public function actionGrower($id, $year = '', $block_id = '')
	{
        $grower = $this->loadModel($id);
		$this->pageTitle = sprintf(Yii::t('app', '%s'), 'Report for '. $grower->name);
        $VARS = array();
		$VARS['blocks'] = $VARS['sprayDates'] = $VAR['graphData'] = array();
		
		if(!($grower instanceof Grower)){
			throw new Exception('Invalid Request (Grower)');
		}
		
		$VARS['grower'] = $grower;
		$VARS['dateRange'] = $this->getDateRange($year);
		$VARS['hasFollowYear'] = $year?$year-1:false;// Set default report
	    $max_spray_count = 0;
		foreach(Pest::model()->findAll() as $pest){
			$max_spray_count = max($max_spray_count,$pest->getSprayCount());
		}
        $sprayDates = $pests = array();
		foreach(Pest::model()->findAll() as $pest){
			$pests[$pest->name] = $pest;
			if($pest->calculate == 'yes'){
				for($i=1,$f=$pest->getSprayCount($id);$i<=$f;++$i){
					$spray = $pest->getSpray($i,$id);
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
			    if($block_id && $block->id != $block_id)
			        continue;
				$VARS['blocks'][] = $block;
				//$VARS['sprayDates'][$block->getId()] = $sprayDates;
				
				$sprayData = array();
				$pp = null;
				foreach($sprayDates as $pest=>$sprays){
					$pd = new PestResult();
					$pd->pest = isset($pests[$pest])?$pests[$pest]:'';
					if($pd->pest){
						$pp = $pd->pest;
						$pd->biofix = $pd->pest->getBiofix($block->id,false,$VARS['hasFollowYear']);
						if($pd->biofix) $pd->biofix = $pd->biofix->date;
						$pd->secondCohortBiofix = $pd->pest->getBiofix($block->id,true,$VARS['hasFollowYear']);
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
								$sd->sprayDate = $spray->getDate($block,$secondBool,$VARS['hasFollowYear']);
								$sd->coverUntil = $spray->getCoverRequired($block,$secondBool,$VARS['hasFollowYear']);
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
				    $VARS['graphData'][$block->id] = $this->getGraph($block, $grower, $year);

                /* 2019-07-22 CLIDS Graph
                if (empty($VARS['graphMiteData'][$block->id]))
                	$VARS['graphMiteData'][$block->id] = $this->getMite($block, $grower, $year);
                */
				
			}
		}
        //$VARS['email'] = $this->email;
        $VARS['link'] = Yii::app()->baseUrl. '/report/grower/'.$grower->id.($year?"/$year":'').($block_id?"/$block_id":'');
		$this->render('grower', array(
                'VARS' => $VARS
		));
	}
	
	/**
	 * Manages all models.
	 */
	public function actionPdf($id)
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
		$VARS['hasFollowYear'] = isset($_GET['year'])?$_GET['year']:false;// Set default report
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
						$pd->biofix = $pd->pest->getBiofix($block->id,false,$VARS['hasFollowYear']);
						if($pd->biofix) $pd->biofix = $pd->biofix->date;
						$pd->secondCohortBiofix = $pd->pest->getBiofix($block->id,true,$VARS['hasFollowYear']);
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
								$sd->sprayDate = $spray->getDate($block,$secondBool,$VARS['hasFollowYear']);
								$sd->coverUntil = $spray->getCoverRequired($block,$secondBool,$VARS['hasFollowYear']);
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

			}
		}
		//$VARS['email'] = $this->email;
		$VARS['link'] = Yii::app()->baseUrl. '/report/pdf/'.$grower->id;
		$this->render('pdf', array(
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
                'Grower'
            ) : Yii::t('app', 'The requested page does not exist.');
			throw new CHttpException(404, $errorText);
		}
		return $modelGrower;
	}
}