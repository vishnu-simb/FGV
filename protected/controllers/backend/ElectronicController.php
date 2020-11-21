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
		$modelElectronic = $this->loadModel($id);
		$this->pageTitle = sprintf(Yii::t('app', 'View %s ID: #%s'), 'Electronic Monitor record', $modelElectronic->id);
		$this->render('view', array(
			'modelElectronic' => $modelElectronic,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$this->pageTitle = sprintf(Yii::t('app', 'Create %s'), 'Electronic Monitor record');
		$modelElectronic = new ElectronicMonitor();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($modelElectronic);

		if (isset($_POST['ElectronicMonitor'])) {
			$modelElectronic->attributes = $_POST['ElectronicMonitor'];
			try{
				if ($modelElectronic->save()) {
					$this->redirect(array('view', 'id' => $modelElectronic->id));
				}
			}catch(Exception $e) {
				$modelElectronic->addError(null, Yii::t('app', 'Record has already been taken same block'));
			}
		}

		$this->render('create', array(
			'modelElectronic' => $modelElectronic,
		));
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
					$this->redirect(array('view', 'id' => $modelElectronic->id));
				}
			}catch(Exception $e) {
				$modelElectronic->addError(null, Yii::t('app', 'Record has already been taken same block'));
			}
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
                'Electronic Monitors'
            ) : Yii::t('app', 'Invalid request. Please do not repeat this request again.');
			throw new CHttpException(400, $errorText);
		}
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$this->pageTitle = sprintf(Yii::t('app', 'Manage %s'), 'Electronic Monitors');
		$modelElectronic = new ElectronicMonitor('search');
		$modelElectronic->unsetAttributes();  // clear any default values
		if (isset($_GET['ElectronicMonitor'])) {
			$criteria = $_GET['ElectronicMonitor'];
			Yii::app()->session['ElectronicMonitor'] = $criteria;
		}
		$modelElectronic->attributes = Yii::app()->session['ElectronicMonitor'];
		$this->render('index', array(
			'modelElectronic' => $modelElectronic,
		));
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
                'Electronic Monitors'
            ) : Yii::t('app', 'The requested page does not exist.');
			throw new CHttpException(404, $errorText);
		}
		return $modelElectronic;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Electronic $modelElectronic the model to be validated
	 */
	protected function performAjaxValidation($modelElectronic)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'electronic-monitoring') {
			echo CActiveForm::validate($modelElectronic);
			Yii::app()->end();
		}
	}
}