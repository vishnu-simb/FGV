<?php

class TrappingController extends SimbController
{
	public $foundGrowerIDs = '';
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
    
    public function actionImport()
	{
	    if (Yii::app()->user->getState('role') !== Users::USER_TYPE_GROWER)
        {
             $this->redirect('/trapping');
        }
        
		$this->pageTitle = sprintf(Yii::t('app', 'Import %s'), 'Trapping');
		$modelTrapCheck = new TrapCheck('import');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($modelTrapCheck);

		if (isset($_POST['TrapCheck'])) {
				$filename = $_FILES['TrapCheck']['name']['import_file'];
				$type = $_FILES['TrapCheck']['type']['import_file'];
				$name_without_ext = pathinfo($filename, PATHINFO_FILENAME);
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				if ($ext == 'csv' && ($type='text/csv' || $type='application/csv'))
				{
					if ($_FILES['TrapCheck']['error']['import_file'] > 0)
					{
						Yii::app()->session->open();
						Yii::app()->user->setFlash('error', Yii::t('app', $_FILES['TrapCheck']['error']['import_file']));
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
						move_uploaded_file($_FILES['TrapCheck']['tmp_name']['import_file'], $file_path);
						if (!file_exists($file_path))
						{
							Yii::app()->session->open();
							Yii::app()->user->setFlash('error', Yii::t('app', 'File cannot be uploaded! Please try again.'));
						}
			
			
						$f = fopen($file_path, "r");
						$row = -1;
						$current_property_name = $current_block_name = $current_trap_name = '';
						$property_id = $block_id  = $trap_id = '';
                        $grower_id = Yii::app()->user->id;
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
							if (!empty($filedata[1]) && $filedata[1] != $current_block_name && $property_id)
							{
								$current_block_name = $filedata[1];
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
			
							//Get trap name
							if (!empty($filedata[2]) && $filedata[2] != $current_trap_name)
							{
								$current_trap_name = $filedata[2];
								$trap = Trap::model()->find('block_id = :Block_id AND LOWER(name) LIKE :Name', array('Block_id' => $block_id, 'Name' => strtotime($current_trap_name).'%'));
								if (!$trap)
								{
									$success = 0;
									Yii::app()->session->open();
									Yii::app()->user->setFlash('error', Yii::t('app', "Invalid trap name at line: ".$row));
									break;
								}
								else
								{
									$trap_id = $trap->id;
								}
							}
			
							 
							if ($trap_id)
							{
								$date = date('Y-m-d', strtotime($filedata[3]));
								$trapcheck = new TrapCheck();
								$found = TrapCheck::model()->findByAttributes(array('trap_id'=>$trap_id,'date'=>$date));
								if ($found) //update existed record
									$trapcheck = $this->loadModel($found->id);
								$trapcheck->trap_id = $trap_id;
								$trapcheck->date = $date;
								$trapcheck->value = $filedata[4];
								$trapcheck->comment = $filedata[5];
								if (!$trapcheck->save())
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
			'modelTrapCheck' => $modelTrapCheck,
		));
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$modelTrapCheck = $this->loadModel($id);
		$this->pageTitle = sprintf(Yii::t('app', 'Update %s ID: #%s'), 'TrapCheck', $modelTrapCheck->id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($modelTrapCheck);

		if (isset($_POST['TrapCheck'])) {
			$modelTrapCheck->attributes=$_POST['TrapCheck'];
			try{
				if ($modelTrapCheck->save()) {
					Yii::app()->session->open();
					Yii::app()->user->setFlash('success', Yii::t('app', 'The system has saved your data successfully !'));
					$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
				}
			}catch(Exception $e) {
				$modelTrapCheck->addError(null, Yii::t('app', 'Trap has already been taken same block'));
			}
		}
        if (Yii::app()->user->getState('role') === Users::USER_TYPE_GROWER)
        {
            $modelTrapCheck->grower = Yii::app()->user->id;
        }
		$this->render('update', array(
			'modelTrapCheck' => $modelTrapCheck,
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
		$this->pageTitle = sprintf(Yii::t('app', 'Trapping %s'), '');
		$modelTrapCheck = new TrapCheck();
		$modelGrower = new Grower();
		$modelGrower->unsetAttributes();  // clear any default values
        $search = false;
        if (Yii::app()->user->getState('role') === Users::USER_TYPE_GROWER)
        {
            $modelGrower->id = Yii::app()->user->id;
			$search = true;
            $this->foundGrowerIDs = Yii::app()->user->id;
        }else if (isset($_GET['Grower'])) {
			$modelGrower->attributes = $_GET['Grower'];
            $search = true;
            $ids = array();
            foreach($modelGrower->search()->getData() as $grower){
                $ids[] = $grower->id;
            }
            $this->foundGrowerIDs = implode($ids,",");
		}
		if(isset($_POST['Traps'])){
			try{
				foreach ($_POST['Traps'] as $key => $value){ // save multiple records
					if($value != ""){
						$saveTrapCheck = new TrapCheck();
						$save = array('value'=>$value,'trap_id'=>$key,'date'=>!empty($_POST['date'])?$_POST['date']:gmdate('Y-m-d'));
						$saveTrapCheck->attributes = $save;
						if($saveTrapCheck->save()){
							Yii::app()->session->open();
							Yii::app()->user->setFlash('success', Yii::t('app', 'Trap added successfully !'));
						}
					}
				}
			}catch (Exception $e) {
					Yii::app()->session->open();
					Yii::app()->user->setFlash('error', Yii::t('app', 'Trap has already been taken same block !'));
	    	}
	    	// reinit session to store flash
	    	
	    		
		}
		$this->render('index', array(
				'modelTrapCheck' => $modelTrapCheck,
				'dataProvider' => $modelTrapCheck->SearchRecentTrapings(),
				'modelGrower' => $modelGrower,
				'search' => $search,
		));
	}

    public function actionXls()
    {
        $growerIDs = explode(',', $_GET['ids']);
        if(!empty($growerIDs)){
            $columns = array(' ', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'X', 'Y', 'Z');
            spl_autoload_unregister(array('YiiBase', 'autoload'));
            require_once Yii::app()->basePath . '/vendors/PHPExcel/PHPExcel.php';
            spl_autoload_register(array('YiiBase', 'autoload'));
            $objPHPExcel = new PHPExcel();
            // Set document properties
            $objPHPExcel->getProperties()->setCreator("Fruit Growers Victoria")
                ->setLastModifiedBy("Fruit Growers Victoria")
                ->setTitle("Trapping Export Document")
                ->setSubject("Trapping Export Document")
                ->setDescription("Trapping export document")
                ->setKeywords("office 2007 openxml php customer export")
                ->setCategory("Trapping export");

            $header_text = array('Grower','Property','Block','Pest','Trap','Date','Value');
            $number_of_columns = count($header_text);

            for($col_index = 1; $col_index <= $number_of_columns; $col_index++)
                $objPHPExcel->getActiveSheet()->getColumnDimension($columns[$col_index])->setAutoSize(true);

            $col_index = 1;
            foreach($header_text as $header)
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++].'1', $header);


            $row_index = 2;
            $modelTrapCheck = new TrapCheck();
            foreach($growerIDs as $growerId){
                $recentTrappings = $modelTrapCheck->getRecentTrappings($growerId);
                foreach($recentTrappings->getData() as $record){
                    $col_index = 1;
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++].$row_index, $record['grower_name']);
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++].$row_index, $record['property_name']);
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++].$row_index, $record['block_name']);
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++].$row_index, $record['pest_name']);
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++].$row_index, $record['trap_name']);
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++].$row_index, $record['date']);
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columns[$col_index++].$row_index++, $record['trap_check_number']);
                    //echo implode(", ", $record).'<br/>';
                }
            }

            // Rename worksheet
            $objPHPExcel->getActiveSheet()->setTitle('Trapping export - '. date('Ymd'));


            // Set active sheet index to the first sheet, so Excel opens this as the first sheet
            $objPHPExcel->setActiveSheetIndex(0);

            $filename = "TrappingExport_". date('Ymd');
            $this->_export($objPHPExcel, $filename);
        }

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
		$modelTrapCheck = TrapCheck::model()->findByPk($id);
		if ($modelTrapCheck === null) {
			$errorText = YII_DEBUG ? sprintf(
					Yii::t('app', 'The ID %s does not exist in %s.'),
					$id,
					'TrapCheck'
			) : Yii::t('app', 'The requested page does not exist.');
			throw new CHttpException(404, $errorText);
		}
		return $modelTrapCheck;
	}
	
	/**
	 * Performs the AJAX validation.
	 * @param TrapCheck $modelTrapCheck the model to be validated
	 */
	protected function performAjaxValidation($modelTrapCheck)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'trap-check-form') {
			echo CActiveForm::validate($modelTrapCheck);
			Yii::app()->end();
		}
	}
	
	public function actions()
	{
		return array(
				'order' => array(
						'class' => 'ext.yii-ordering-column.actionBlock', // sort by group block_id
						'modelClass' => 'Trap',
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