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
		$modelCrop = $this->loadModel($id);
		$this->pageTitle = sprintf(Yii::t('app', 'View %s ID: #%s'), 'Crop Monitor record', $modelCrop->id);
		$this->render('view', array(
			'modelCrop' => $modelCrop,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$this->pageTitle = sprintf(Yii::t('app', 'Create %s'), 'Crop Monitor record');
		$modelCrop = new CropMonitor();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($modelCrop);

		if (isset($_POST['CropMonitor'])) {
			$modelCrop->attributes = $_POST['CropMonitor'];
			try{
				if ($modelCrop->save()) {
					$this->redirect(array('view', 'id' => $modelCrop->id));
				}
			}catch(Exception $e) {
				$modelCrop->addError(null, Yii::t('app', 'Record has already been taken same block'));
			}
		}

		$this->render('create', array(
			'modelCrop' => $modelCrop,
		));
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
					$this->redirect(array('view', 'id' => $modelCrop->id));
				}
			}catch(Exception $e) {
				$modelCrop->addError(null, Yii::t('app', 'Record has already been taken same block'));
			}
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
                'Crop Monitors'
            ) : Yii::t('app', 'Invalid request. Please do not repeat this request again.');
			throw new CHttpException(400, $errorText);
		}
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$this->pageTitle = sprintf(Yii::t('app', 'Manage %s'), 'Crop Monitors');
		$modelCrop = new CropMonitor('search');
		$modelCrop->unsetAttributes();  // clear any default values
		if (isset($_GET['CropMonitor'])) {
			$criteria = $_GET['CropMonitor'];
			Yii::app()->session['CropMonitor'] = $criteria;
		}
		$modelCrop->attributes = Yii::app()->session['CropMonitor'];
		$this->render('index', array(
			'modelCrop' => $modelCrop,
		));
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
                'Crop Monitors'
            ) : Yii::t('app', 'The requested page does not exist.');
			throw new CHttpException(404, $errorText);
		}
		return $modelCrop;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Crop $modelCrop the model to be validated
	 */
	protected function performAjaxValidation($modelCrop)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'crop-monitoring') {
			echo CActiveForm::validate($modelCrop);
			Yii::app()->end();
		}
	}
}