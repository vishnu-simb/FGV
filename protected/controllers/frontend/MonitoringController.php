<?php

class MonitoringController extends SimbController
{
	
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
						'allow',
						'actions' => array('import'),
						'expression' => 'Yii::app()->user->isAdmin()',
				),
				array(
						'deny',
						'actions' => array('index', 'logout'),
						'users' => array('*'),
						'deniedCallback' => array($this, 'redirectLoginNeeded'),
				),
	           array(
						'deny',
						'actions' => array('import'),
						'users' => array('*'),
						'deniedCallback' => array($this, 'redirectPermissionNeeded'),
				),
		);
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$modelMonitor = $this->loadModel($id);
		$this->pageTitle = sprintf(Yii::t('app', 'Update %s ID: #%s'), 'Mite Monitoring', $modelMonitor->id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($modelTrapCheck);

		if (isset($_POST['MiteMonitor'])) {
			$modelMonitor->attributes=$_POST['MiteMonitor'];
			try{
				if ($modelMonitor->save()) {
					Yii::app()->session->open();
					Yii::app()->user->setFlash('success', Yii::t('app', 'The system has saved your data successfully'));
					$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
				}
			}catch(Exception $e) {
				$modelMonitor->addError(null, Yii::t('app', 'Mite Monitor has already been taken same block'));
			}
		}

		$this->render('update', array(
			'modelMonitor' => $modelMonitor,
		));
	}
	
	
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
	
		if (Yii::app()->request->getParam('get','delete')) {
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();
	
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax'])) {
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
			}
		} else {
			$errorText = YII_DEBUG ? sprintf(
					Yii::t('app', 'The Delete Request for ID %s in %s is not working correctly.'),
					$id,
					'Spray'
			) : Yii::t('app', 'Invalid request. Please do not repeat this request again.');
			throw new CHttpException(400, $errorText);
		}
	}
	
	
	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$this->pageTitle = sprintf(Yii::t('app', 'Mite Monitoring %s'), '');
		$modelMonitor = new MiteMonitor();
		$modelGrower = new Grower();
		$modelGrower->unsetAttributes();  // clear any default values
		$search = false;
		if (isset($_GET['Grower'])) {
			$modelGrower->attributes = $_GET['Grower'];
			$search = true;
		}
		if(isset($_POST['PercentLi']) && isset($_POST['NoDays'])){
			try{
				foreach ($_POST['PercentLi'] as $key => $value){ // save multiple records
					if($value != ""){
						if($_POST['NoDays'][$key] != ""){
							$saveMonitor = new MiteMonitor();
							$data = explode(',',$key);
							$save = array('percent_li'=>$value,'no_days'=>$_POST['NoDays'][$key],'block_id'=>$data[0],'mite_id'=>$data[1],'date'=>gmdate('Y-m-d'));
							$saveMonitor->attributes = $save;
							if($saveMonitor->save()){
								Yii::app()->session->open();
								Yii::app()->user->setFlash('success', Yii::t('app', 'Mite Monitor added successfully !'));
							}
						}
					}
				}
			}catch (Exception $e) {
					Yii::app()->session->open();
					Yii::app()->user->setFlash('error', Yii::t('app', 'Mite Monitor has already been taken same block !'));
	    	}
	    	// reinit session to store flash
	    	
	    		
		}
		$this->render('index', array(
				'modelMonitor' => $modelMonitor,
				'dataProvider' => $modelMonitor->SearchRecentMontoring(),
				'modelGrower' => $modelGrower,
				'search' => $search,
		));
	}
    
    /**
	 * Import a csv file for mite monitoring.
	 */
	public function actionImport()
	{
		$this->pageTitle = sprintf(Yii::t('app', 'Mite Monitoring %s'), ' - Import');
        if(!empty($_FILES['import_file']) && !empty($_FILES['import_file']['name']))
        {
            $filename = $_FILES['import_file']['name'];
            $type = $_FILES['import_file']['type'];
            $name_without_ext = pathinfo($filename, PATHINFO_FILENAME);
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if ($ext == 'csv')
            {
                if ($_FILES["import_file"]["error"] > 0)
                {
                    Yii::app()->session->open();
					Yii::app()->user->setFlash('error', Yii::t('app', $_FILES["file"]["error"]));
                }
                else
                {
                    $import_path = Yii::app()->basePath.'/../uploads/import/';
                    if (!file_exists($import_path))
                    {
                        mkdir($import_path);
                        chmod($import_path, 777);
                    }
                    //save import file
                    $new_fn = $name_without_ext.date('_Ymd_His').'.csv';
                    $file_path = $import_path. $new_fn;
                    move_uploaded_file($_FILES["import_file"]["tmp_name"], $file_path);
                    if (!file_exists($file_path))
                    {
                        Yii::app()->session->open();
					    Yii::app()->user->setFlash('error', Yii::t('app', 'File cannot be uploaded! Please try again.'));
                    }
                    
                    
                    $f = fopen($file_path, "r");
                    $row = -1;
                    $current_property_name = $current_block_name = $current_mite_name = '';
                    $property_id = $block_id = $mite_id = '';
                    $success = 1;
                    while(($filedata = fgetcsv($f)) !== FALSE) 
                    {
                        $row ++;
                        if ($row == 0) // skip the header
                            continue;
                        
                        //Get property name
                        if (!empty($filedata[0]) && $filedata[0] != $current_property_name)
                        {
                            $current_property_name = $filedata[0];
                            $property = Property::model()->getByName($current_property_name);
                            
                            if (!$property)
                            {
                                $success = 0;
                                Yii::app()->session->open();
					            Yii::app()->user->setFlash('error', Yii::t('app', "Invalid property name at line: ".$row));
                                break;
                            }
                            else
                            {
                                $property_id = $property->id;
                            }
                        }
                        
                        //Get block name
                        if (!empty($filedata[1]) && $filedata[1] != $current_block_name && $property_id)
                        {
                            $current_block_name = $filedata[1];
                            $block = Block::model()->getByNameLike($current_block_name, $property_id);
                            if (!$block)
                            {
                                $success = 0;
                                Yii::app()->session->open();
					            Yii::app()->user->setFlash('error', Yii::t('app', "Invalid block name at line: ".$row));
                                break;
                            }
                            else
                            {
                                $block_id = $block->id;
                            }
                        }
                        
                        //Get mite name
                        if (!empty($filedata[2]) && $filedata[2] != $current_mite_name)
                        {
                            $current_mite_name = $filedata[2];
                            $mite = Mite::model()->getByNameLike($current_mite_name);
                            if (!$mite)
                            {
                                $success = 0;
                                Yii::app()->session->open();
					            Yii::app()->user->setFlash('error', Yii::t('app', "Invalid mite name at line: ".$row));
                                break;
                            }
                            else
                            {
                                $mite_id = $mite->id;
                            }
                        }
                        
                       
                        if ($block_id && $mite_id)
                        {
                            $date = date('Y-m-d', strtotime($filedata[3]));
                            $modelMonitor = new MiteMonitor();
                            $monitor = MiteMonitor::model()->findByAttributes(array('mite_id'=>$mite_id,'block_id'=>$block_id,'date'=>$date));
                            if ($monitor) //update existed record
                              	$modelMonitor = $this->loadModel($monitor->id);
	                            $modelMonitor->mite_id = $mite_id;
	                            $modelMonitor->block_id = $block_id;
	                            $modelMonitor->date = $date;
	                            $modelMonitor->percent_li = $filedata[4];
	                            $modelMonitor->no_days = $filedata[5];
                            if (!$modelMonitor->save())
                            {
                                $success = 0;
                                Yii::app()->session->open();
					            Yii::app()->user->setFlash('error', Yii::t('app', "Cannot save data at line: ".$row));
                                break;
                            }
                        }
                    }
                    
                    if ($success)
                    {
                        Yii::app()->session->open();
					    Yii::app()->user->setFlash('success', Yii::t('app', 'Data is imported successfully.'));
                    }
                }
            }
        }
		$this->render('import');
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TrapCheck the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$modelMonitor = MiteMonitor::model()->findByPk($id);
		if ($modelMonitor === null) {
			$errorText = YII_DEBUG ? sprintf(
					Yii::t('app', 'The ID %s does not exist in %s.'),
					$id,
					'TrapCheck'
			) : Yii::t('app', 'The requested page does not exist.');
			throw new CHttpException(404, $errorText);
		}
		return $modelMonitor;
	}
	
	/**
	 * Performs the AJAX validation.
	 * @param TrapCheck $modelTrapCheck the model to be validated
	 */
	protected function performAjaxValidation($modelMonitor)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'mite-monitor-form') {
			echo CActiveForm::validate($modelMonitor);
			Yii::app()->end();
		}
	}
	
}