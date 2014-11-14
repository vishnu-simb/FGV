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
						'expression'=>'Yii::app()->user->isAdmin()',
				),
				array(
						'deny',
						'actions' => array('index', 'logout'),
						'users' => array('*'),
						'deniedCallback' => array($this, 'redirectLoginNeeded'),
				),
	
		);
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$modelMiteMonitor = $this->loadModel($id);
		$this->pageTitle = sprintf(Yii::t('app', 'View %s ID: #%s'), 'MiteMonitor', $modelMiteMonitor->id);
		$this->render('view', array(
			'modelMiteMonitor' => $modelMiteMonitor,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionImport()
	{
		$this->pageTitle = sprintf(Yii::t('app', 'Import %s'), 'MiteMonitor');
		$modelMiteMonitor = new MiteMonitor('import');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($modelMiteMonitor);

		if (isset($_POST['MiteMonitor'])) {
				$filename = $_FILES['MiteMonitor']['name']['import_file'];
				$type = $_FILES['MiteMonitor']['type']['import_file'];
				$name_without_ext = pathinfo($filename, PATHINFO_FILENAME);
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				if ($ext == 'csv' && ($type='text/csv' || $type='application/csv'))
				{
					if ($_FILES['MiteMonitor']['error']['import_file'] > 0)
					{
						Yii::app()->session->open();
						Yii::app()->user->setFlash('error', Yii::t('app', $_FILES['MiteMonitor']['error']['import_file']));
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
						move_uploaded_file($_FILES['MiteMonitor']['tmp_name']['import_file'], $file_path);
						if (!file_exists($file_path))
						{
							Yii::app()->session->open();
							Yii::app()->user->setFlash('error', Yii::t('app', 'File cannot be uploaded! Please try again.'));
						}
			
			
						$f = fopen($file_path, "r");
						$row = -1;
						$current_grower_name = $current_property_name = $current_block_name = $current_mite_name = '';
						$grower_id = $property_id = $block_id = $mite_id = '';
						$success = 1;
						while(($filedata = fgetcsv($f)) !== FALSE)
						{
							$row ++;
							if ($row == 0) // skip the header
								continue;
			
							//Get grower name
							if (!empty($filedata[0]) && $filedata[0] != $current_grower_name)
							{
								$current_grower_name = $filedata[0];
								$grower = Grower::model()->getByName($current_grower_name);
									
								if (!$grower)
								{
									$success = 0;
									Yii::app()->session->open();
									Yii::app()->user->setFlash('error', Yii::t('app', "Invalid grower name at line: ".$row));
									break;
								}
								else
								{
									$grower_id = $grower->id;
								}
							}
								
							
							//Get property name
							if (!empty($filedata[1]) && $filedata[1] != $current_property_name)
							{
								$current_property_name = $filedata[1];
								$property = Property::model()->findByAttributes(array('grower_id'=>$grower_id,'name'=>$current_property_name));
			
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
							if (!empty($filedata[2]) && $filedata[2] != $current_block_name && $property_id)
							{
								$current_block_name = $filedata[2];
								$block = Block::model()->findByAttributes(array('name'=>$current_block_name,'property_id'=>$property_id));
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
							if (!empty($filedata[3]) && $filedata[3] != $current_mite_name)
							{
								$current_mite_name = $filedata[3];
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
								$date = date('Y-m-d', strtotime($filedata[4]));
								$modelMonitor = new MiteMonitor();
								$monitor = MiteMonitor::model()->findByAttributes(array('mite_id'=>$mite_id,'block_id'=>$block_id,'date'=>$date));
								if ($monitor) //update existed record
									$modelMonitor = $this->loadModel($monitor->id);
								$modelMonitor->mite_id = $mite_id;
								$modelMonitor->block_id = $block_id;
								$modelMonitor->date = $date;
								$modelMonitor->percent_li = $filedata[5];
								$modelMonitor->no_days = $filedata[6];
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
				}else{
					Yii::app()->session->open();
					Yii::app()->user->setFlash('error', Yii::t('app', "You can only send file of type 'CSV' to import data."));
				}
			
		}

		$this->render('import', array(
			'modelMiteMonitor' => $modelMiteMonitor,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$modelMiteMonitor = $this->loadModel($id);
		$this->pageTitle = sprintf(Yii::t('app', 'Update %s ID: #%s'), 'MiteMonitor', $modelMiteMonitor->id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($modelMiteMonitor);

		if (isset($_POST['MiteMonitor'])) {
			$modelMiteMonitor->attributes=$_POST['MiteMonitor'];
			if ($modelMiteMonitor->save()) {
				$this->redirect(array('view', 'id' => $modelMiteMonitor->id));
			}
		}

		$this->render('update', array(
			'modelMiteMonitor' => $modelMiteMonitor,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if (Yii::app()->request->isPostRequest) {
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
                'MiteMonitor'
            ) : Yii::t('app', 'Invalid request. Please do not repeat this request again.');
			throw new CHttpException(400, $errorText);
		}
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$this->pageTitle = sprintf(Yii::t('app', 'Manage %s'), 'MiteMonitors');
		$modelMiteMonitor = new MiteMonitor('search');
		$modelMiteMonitor->unsetAttributes();  // clear any default values
		if (isset($_GET['MiteMonitor'])) {
			$criteria = $_GET['MiteMonitor'];
			Yii::app()->session['MiteMonitor'] = $criteria;
		}
		$modelMiteMonitor->attributes = Yii::app()->session['MiteMonitor'];
		$this->render('index', array(
			'modelMiteMonitor' => $modelMiteMonitor,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return MiteMonitor the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$modelMiteMonitor = MiteMonitor::model()->findByPk($id);
		if ($modelMiteMonitor === null) {
            $errorText = YII_DEBUG ? sprintf(
                Yii::t('app', 'The ID %s does not exist in %s.'),
                $id,
                'MiteMonitor'
            ) : Yii::t('app', 'The requested page does not exist.');
			throw new CHttpException(404, $errorText);
		}
		return $modelMiteMonitor;
	}

	/**
	 * Performs the AJAX validation.
	 * @param MiteMonitor $modelMiteMonitor the model to be validated
	 */
	protected function performAjaxValidation($modelMiteMonitor)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'mite-monitor-form') {
			echo CActiveForm::validate($modelMiteMonitor);
			Yii::app()->end();
		}
	}
}