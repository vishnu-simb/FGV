<?php

class ElectronicController extends SimbController
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
						'deny',
						'actions' => array('index', 'logout'),
						'users' => array('*'),
						'deniedCallback' => array($this, 'redirectLoginNeeded'),
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
		$modelElectronic = $this->loadModel($id);
		$this->pageTitle = sprintf(Yii::t('app', 'Update %s ID: #%s'), 'Electronic Monitor record', $modelElectronic->id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($modelElectronic);

		if (isset($_POST['ElectronicMonitor'])) {
			$modelElectronic->attributes=$_POST['ElectronicMonitor'];
			try{
				if ($modelElectronic->save()) {
					Yii::app()->session->open();
					Yii::app()->user->setFlash('success', Yii::t('app', 'The system has saved your data successfully !'));
					$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
				}
			}catch(Exception $e) {
				$modelElectronic->addError(null, Yii::t('app', 'Record has already been taken same block'));
			}
		}
        if (Yii::app()->user->getState('role') === Users::USER_TYPE_GROWER)
        {
            $modelElectronic->grower = Yii::app()->user->id;
        }
		$this->render('update', array(
			'modelElectronic' => $modelElectronic,
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
					'Electronic Monitor records'
			) : Yii::t('app', 'Invalid request. Please do not repeat this request again.');
			throw new CHttpException(400, $errorText);
		}
	}
	
	
	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$this->pageTitle = sprintf(Yii::t('app', 'Electronic Monitors %s'), '');
		$modelElectronic = new ElectronicMonitor();
		$modelGrower = new Grower();
		$modelGrower->unsetAttributes();  // clear any default values
        $search = false;
        if (Yii::app()->user->getState('role') === Users::USER_TYPE_GROWER)
        {
            $modelGrower->id = Yii::app()->user->id;
			$search = true;
            $foundGrowerIDs = Yii::app()->user->id;
        }else if (isset($_GET['Grower'])) {
			$modelGrower->attributes = $_GET['Grower'];
            $search = true;
            $ids = array();
            foreach($modelGrower->search()->getData() as $grower){
                $ids[] = $grower->id;
            }
            $foundGrowerIDs = implode($ids,",");
		}
        if(isset($_POST['Pests'])){
            try{
                foreach ($_POST['Pests'] as $block_id => $data){ // save multiple records
                    if($data){

                        $success = false;
                        foreach ($data as $pest_id => $value) {
                            if ($value === '') continue;
                            $save = array(
                                'block_id' => $block_id,
                                'pest_id' => $pest_id,
                                'value' => $value,
                                'date' => !empty($_POST['date']) ? $_POST['date'] : gmdate('Y-m-d'),
                                'time' => !empty($_POST['time']) ? $_POST['time'].':00' : gmdate('H:i:00')
                            );
                            $saveElectronicMonitor = new ElectronicMonitor();
                            $saveElectronicMonitor->attributes = $save;
                            if($saveElectronicMonitor->save()){
                                $success = true;
                            }
                        }
                        if ($success) {
                            Yii::app()->session->open();
                            Yii::app()->user->setFlash('success', Yii::t('app', 'Electronic Monitor records are added successfully !'));
                        }
                    }
                }
            }catch (Exception $e) {
                Yii::app()->session->open();
                Yii::app()->user->setFlash('error', Yii::t('app', 'Electronic Monitor records have already been taken same block !'));
            }
            // reinit session to store flash


        }
		$this->render('index', array(
				'modelElectronic' => $modelElectronic,
				'dataProvider' => $modelElectronic->SearchRecentElectronicMonitors(),
				'modelGrower' => $modelGrower,
				'search' => $search,
                'foundGrowerIDs' => !empty($foundGrowerIDs)?$foundGrowerIDs:null
		));
	}

    public function actionXls()
    {
        $growerIDs = explode(',', $_POST['ids']);
        if(!empty($growerIDs)){
            $date_from = $date_to = '';
            $dates = explode(' - ', $_POST['dates']);
            if(!empty($dates) && !empty($dates[0])){
                $date_from = DateHelper::convertToIsoDate($dates[0], 'd/m/y');
                $date_to = DateHelper::convertToIsoDate($dates[1], 'd/m/y');
            }
            $columns = array(' ', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'X', 'Y', 'Z');
            spl_autoload_unregister(array('YiiBase', 'autoload'));
            require_once Yii::app()->basePath . '/vendors/PHPExcel/PHPExcel.php';
            spl_autoload_register(array('YiiBase', 'autoload'));
            $objPHPExcel = new PHPExcel();
            // Set document properties
            $objPHPExcel->getProperties()->setCreator("Fruit Growers Victoria")
                ->setLastModifiedBy("Fruit Growers Victoria")
                ->setTitle("Electronic Monitors Export Document")
                ->setSubject("Electronic Monitors Export Document")
                ->setDescription("Electronic Monitors export document")
                ->setKeywords("office 2007 openxml php customer export")
                ->setCategory("Electronic Monitors export");

            $header_text = array('Grower','Property','Block','Pest','Trap','Date','Value');
            $number_of_columns = count($header_text);

            for($col_index = 1; $col_index <= $number_of_columns; $col_index++)
                $objPHPExcel->getActiveSheet()->getColumnDimension($columns[$col_index])->setAutoSize(true);

            $col_index = 1;
            foreach($header_text as $header)
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++].'1', $header);

            $growerName = '';
            $row_index = 2;
            $modelElectronic = new ElectronicMonitor();
            foreach($growerIDs as $growerId){
                $recentTrappings = $modelElectronic->getRecentElectronicMonitors($growerId, $date_from, $date_to);
                foreach($recentTrappings as $record){
                    $col_index = 1;
                    $growerName = $record['grower_name'];
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++].$row_index, $record['grower_name']);
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++].$row_index, $record['property_name']);
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++].$row_index, $record['block_name']);
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++].$row_index, $record['pest_name']);
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++].$row_index, $record['trap_name']);
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++].$row_index, $record['date']);
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++].$row_index++, $record['monitoring_number']);
                    //echo implode(", ", $record).'<br/>';
                }
            }

            // Rename worksheet
            $objPHPExcel->getActiveSheet()->setTitle('Electronic Monitors export - '. date('Ymd'));


            // Set active sheet index to the first sheet, so Excel opens this as the first sheet
            $objPHPExcel->setActiveSheetIndex(0);
            if(count($growerIDs) == 1 && $growerName)
                $filename = "ElectronicMonitorsExport_".str_replace(' ', '_', $growerName)."_". date('Ymd');
            else
                $filename = "ElectronicMonitorsExport_". date('Ymd');
            $this->_export($objPHPExcel, $filename);
        }

    }
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ElectronicMonitor the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$modelElectronic = ElectronicMonitor::model()->findByPk($id);
		if ($modelElectronic === null) {
			$errorText = YII_DEBUG ? sprintf(
					Yii::t('app', 'The ID %s does not exist in %s.'),
					$id,
					'ElectronicMonitor'
			) : Yii::t('app', 'The requested page does not exist.');
			throw new CHttpException(404, $errorText);
		}
		return $modelElectronic;
	}
	
	/**
	 * Performs the AJAX validation.
	 * @param ElectronicMonitor $modelElectronic the model to be validated
	 */
	protected function performAjaxValidation($modelElectronic)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'electronic-monitoring-form') {
			echo CActiveForm::validate($modelElectronic);
			Yii::app()->end();
		}
	}
	
	public function actions()
	{
		return array(
				'order' => array(
						'class' => 'ext.yii-ordering-column.actionBlock', // sort by group block_id
						'modelClass' => 'ElectronicMonitor',
						'pkName'  => 'ordering',
				),
		);
	}

	protected function _export($objPHPExcel, $filename)
    {
        $folderPath = Yii::app()->basePath. '/export/';
        if (!is_dir($folderPath))
            mkdir($folderPath);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $filePath = $folderPath. $filename. '.xlsx';
        $objWriter->save($filePath);
        if (file_exists($filePath))
        {
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
            header('Cache-Control: max-age=0');
            // If you're serving to IE 9, then the following may be needed
            header('Cache-Control: max-age=1');

            // If you're serving to IE over SSL, then the following may be needed
            header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
            header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header ('Pragma: public'); // HTTP/1.0
            readfile($filePath);
            Yii::app()->end();
        }
    }
	
}