<?php

class CropController extends SimbController
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
		$modelCrop = $this->loadModel($id);
		$this->pageTitle = sprintf(Yii::t('app', 'Update %s ID: #%s'), 'Crop Monitor record', $modelCrop->id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($modelCrop);

		if (isset($_POST['CropMonitor'])) {
			$modelCrop->attributes=$_POST['CropMonitor'];
			try{
				if ($modelCrop->save()) {
					Yii::app()->session->open();
					Yii::app()->user->setFlash('success', Yii::t('app', 'The system has saved your data successfully !'));
					$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
				}
			}catch(Exception $e) {
				$modelCrop->addError(null, Yii::t('app', 'Record has already been taken same block'));
			}
		}
        if (Yii::app()->user->getState('role') === Users::USER_TYPE_GROWER)
        {
            $modelCrop->grower = Yii::app()->user->id;
        }
		$this->render('update', array(
			'modelCrop' => $modelCrop,
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
					'Crop Monitor records'
			) : Yii::t('app', 'Invalid request. Please do not repeat this request again.');
			throw new CHttpException(400, $errorText);
		}
	}
	
	
	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$this->pageTitle = sprintf(Yii::t('app', 'Crop Monitors %s'), '');
		$modelCrop = new CropMonitor();
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
        if(isset($_POST['CropPests'])){
            try{
                foreach ($_POST['CropPests'] as $block_id => $data){ // save multiple records
                    if($data){
                        $success = false;
                        foreach ($data as $pest_id => $value) {
                            if ($value === '') continue;
                            $save = array(
                                'block_id' => $block_id,
                                'pest_id' => $pest_id,
                                'value' => $value,
                                'date' => !empty($_POST['date']) ? $_POST['date'] : gmdate('Y-m-d'),
                                'time' => !empty($_POST['time']) ? $_POST['time'].':00' : gmdate('H:i:00'),
                                'comment' => !empty($_POST['Comments'][$block_id])?$_POST['Comments'][$block_id]:'',
                                'duration' => !empty($_POST['duration']) ? $_POST['duration'] : ''
                            );
                            $saveCropMonitor = new CropMonitor();
                            $saveCropMonitor->attributes = $save;
                            if($saveCropMonitor->save()){
                                $success = true;
                            }
                        }
                        if ($success) {
                            Yii::app()->session->open();
                            Yii::app()->user->setFlash('success', Yii::t('app', 'Crop Monitor records are added successfully !'));
                        }
                    }
                }
            }catch (Exception $e) {
                var_dump($e);die;
                Yii::app()->session->open();
                Yii::app()->user->setFlash('error', Yii::t('app', 'Crop Monitor records have already been taken same block !'));
            }
            // reinit session to store flash


        }
		$this->render('index', array(
				'modelCrop' => $modelCrop,
				'dataProvider' => $modelCrop->SearchRecentCropMonitors(),
				'modelGrower' => $modelGrower,
				'search' => $search,
                'foundGrowerIDs' => !empty($foundGrowerIDs)?$foundGrowerIDs:null
		));
	}

    public function actionXls()
    {
        $growerIDs = explode(',', $_POST['ids']);
        if(!empty($growerIDs)){
            $growerId = $growerIDs[0];
            $grower = Grower::model()->findByPk($growerId);
            if (!$grower)
                die('Invalid grower ID.');
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
                ->setTitle("Crop Monitors Export Document")
                ->setSubject("Crop Monitors Export Document")
                ->setDescription("Crop Monitors export document")
                ->setKeywords("office 2007 openxml php customer export")
                ->setCategory("Crop Monitors export");

            $objPHPExcel->getActiveSheet();
            $objPHPExcel->removeSheetByIndex(0);
            $modelCrop = new CropMonitor();

            $dataProvider = $grower->getBlockByGrower();
            $blocks = $dataProvider->getData();
            if ($blocks) {
                foreach ($blocks as $_block) {
                    $objWorkSheet = $objPHPExcel->createSheet();

                    $dateProvider = $grower->getPestsDataProvider($_block['fruit_type_id']?$_block['fruit_type_id']:Yii::app()->params['defaultFruitTypeId']);
                    $pest = $dateProvider->getData();

                    $pest_names = array();
                    $counter = 1;

                    $header1 = array('', '');
                    foreach($pest as $v){
                        $pest_names[$v['id']] = $v['name'];
                        $header1[] = $counter++;
                    }

                    $row_index = 1;
                    $objWorkSheet->setCellValue('A'.$row_index++, 'Grower: ' . $grower->name);
                    $objWorkSheet->setCellValue('A'.$row_index++, 'Block: ' . $_block['name']. ($_block['fruit_type']?' (Fruit: '.$_block['fruit_type']. ')':' (Fruit: Apple)'));

                    $recentRecords = $modelCrop->getRecentCropMonitors($_block['id'], $date_from, $date_to);
                    $date_pests = array();
                    foreach ($recentRecords as $record) {
                        $_key = strtotime($record['date']. ' '. $record['time']);
                        if (empty($date_pests[$_key]))
                            $date_pests[$_key] = array();
                        $date_pests[$_key][$record['pest_id']] = $record;
                    }

                    $header1 = array_merge($header1, array("Action\nRequired", 'Action Taken', 'Comment', 'Duration', 'Sign'));
                    $objWorkSheet->fromArray($header1, NULL, 'A'.$row_index++);

                    $col_index = 1;
                    $objWorkSheet->getColumnDimension($columns[$col_index])->setAutoSize(false);
                    $objWorkSheet->getColumnDimension($columns[$col_index])->setWidth("12");
                    $objWorkSheet->setCellValue($columns[$col_index++].$row_index, 'Date');

                    $objWorkSheet->setCellValue($columns[$col_index++].$row_index, 'Time');
                    foreach($pest_names as $pest_name) {
                        $objWorkSheet->setCellValue($columns[$col_index].$row_index, $pest_name);
                        $objWorkSheet->getStyle($columns[$col_index].$row_index)->getAlignment()->setTextRotation(90);
                        $objWorkSheet->getColumnDimension($columns[$col_index])->setAutoSize(false);
                        $objWorkSheet->getColumnDimension($columns[$col_index])->setWidth("5");
                        $col_index++;
                    }

                    $objWorkSheet->getStyle($columns[$col_index].($row_index-1))->getAlignment()->setWrapText(true);
                    $objWorkSheet->setCellValue($columns[$col_index++].$row_index, 'Yes/No'); /* Action Required */

                    $objWorkSheet->getColumnDimension($columns[$col_index])->setAutoSize(false);
                    $objWorkSheet->getColumnDimension($columns[$col_index])->setWidth("12");
                    $objWorkSheet->setCellValue($columns[$col_index++].$row_index, ''); /* Action Taken */

                    $objWorkSheet->getColumnDimension($columns[$col_index])->setAutoSize(false);
                    $objWorkSheet->getColumnDimension($columns[$col_index])->setWidth("20");
                    $objWorkSheet->setCellValue($columns[$col_index].$row_index, "If pests are seen, seek\nto indentify and then\ncheck if they are a pest\n,of convern for export\nIf not, mark"); /* Comment */
                    $objWorkSheet->getStyle($columns[$col_index++].$row_index)->getAlignment()->setWrapText(true);

                    $objWorkSheet->getColumnDimension($columns[$col_index])->setAutoSize(false);
                    $objWorkSheet->getColumnDimension($columns[$col_index])->setWidth("12");
                    $objWorkSheet->setCellValue($columns[$col_index++].$row_index, ''); /* Duration */

                    $objWorkSheet->setCellValue($columns[$col_index].$row_index, ''); /* Sign */

                    $objWorkSheet->getStyle("A3:".$columns[$col_index].$row_index)->applyFromArray(array(
                        'alignment' => array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        )
                    ));

                    ksort($date_pests);

                    foreach ($date_pests as $dtm => $value_array) {
                        $_record = reset($value_array);
                        $row_index++;
                        $col_index = 1;
                        $objWorkSheet->setCellValue($columns[$col_index++] . $row_index, date('d/m/Y', $dtm));
                        $objWorkSheet->setCellValue($columns[$col_index++] . $row_index, date('H:i', $dtm));
                        foreach ($pest_names as $pest_id => $pest_name) {
                            $objWorkSheet->setCellValue($columns[$col_index++] . $row_index, !empty($value_array[$pest_id]) ? number_format($value_array[$pest_id]['monitoring_number']) : 0);
                        }
                        $objWorkSheet->setCellValue($columns[$col_index++].$row_index, ''); /* Action Required */
                        $objWorkSheet->setCellValue($columns[$col_index++].$row_index, ''); /* Action Taken */
                        $objWorkSheet->setCellValue($columns[$col_index++].$row_index, trim($_record['comment'])); /* Comment on same line with block name */
                        $objWorkSheet->setCellValue($columns[$col_index++].$row_index, $_record['duration']?$_record['duration']. ' minutes':''); /* Same duration for each date time */
                    }

                    $objWorkSheet->getStyle("A3:".$columns[count($header1)].$row_index)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    $objWorkSheet->setTitle(substr($_block['name'], 0, 30));
                }
            }
            $objPHPExcel->setActiveSheetIndex(0);
            $filename = "CropMonitorsExport_".str_replace(' ', '_', $grower->name)."_". date('Ymd');
            $this->_export($objPHPExcel, $filename);
        }

    }
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return CropMonitor the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$modelCrop = CropMonitor::model()->findByPk($id);
		if ($modelCrop === null) {
			$errorText = YII_DEBUG ? sprintf(
					Yii::t('app', 'The ID %s does not exist in %s.'),
					$id,
					'CropMonitor'
			) : Yii::t('app', 'The requested page does not exist.');
			throw new CHttpException(404, $errorText);
		}
		return $modelCrop;
	}
	
	/**
	 * Performs the AJAX validation.
	 * @param CropMonitor $modelCrop the model to be validated
	 */
	protected function performAjaxValidation($modelCrop)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'crop-monitoring-form') {
			echo CActiveForm::validate($modelCrop);
			Yii::app()->end();
		}
	}
	
	public function actions()
	{
		return array(
				'order' => array(
						'class' => 'ext.yii-ordering-column.actionBlock', // sort by group block_id
						'modelClass' => 'CropMonitor',
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