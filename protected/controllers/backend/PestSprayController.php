<?php

class PestSprayController extends SimbController
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
		$modelPestSpray = $this->loadModel($id);
		$this->pageTitle = sprintf(Yii::t('app', 'View %s ID: #%s'), 'PestSpray', $modelPestSpray->id);
		$this->render('view', array(
			'modelPestSpray' => $modelPestSpray,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$this->pageTitle = sprintf(Yii::t('app', 'Create %s'), 'PestSpray');
		$modelPestSpray = new PestSpray;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($modelPestSpray);

		if (isset($_POST['PestSpray'])) {
			$modelPestSpray->attributes = $_POST['PestSpray'];
			if ($modelPestSpray->save()) {
				$this->redirect(array('view', 'id' => $modelPestSpray->id));
			}
		}

		$this->render('create', array(
			'modelPestSpray' => $modelPestSpray,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$modelPestSpray = $this->loadModel($id);
		$this->pageTitle = sprintf(Yii::t('app', 'Update %s ID: #%s'), 'PestSpray', $modelPestSpray->id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($modelPestSpray);

		if (isset($_POST['PestSpray'])) {
			$modelPestSpray->attributes=$_POST['PestSpray'];
			if ($modelPestSpray->save()) {
				$this->redirect(array('view', 'id' => $modelPestSpray->id));
			}
		}

		$this->render('update', array(
			'modelPestSpray' => $modelPestSpray,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
        $this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if (!isset($_GET['ajax'])) {
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
        /*
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
                'PestSpray'
            ) : Yii::t('app', 'Invalid request. Please do not repeat this request again.');
			throw new CHttpException(400, $errorText);
		}
        */
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$this->pageTitle = sprintf(Yii::t('app', 'Manage %s'), 'PestSprays');
		$modelPestSpray = new PestSpray('search');
		$modelPestSpray->unsetAttributes();  // clear any default values
		if (isset($_GET['PestSpray'])) {
			$criteria = $_GET['PestSpray'];
			Yii::app()->session['PestSpray'] = $criteria;
		}
		$modelPestSpray->attributes = Yii::app()->session['PestSpray'];
		$this->render('index', array(
			'modelPestSpray' => $modelPestSpray,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return PestSpray the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$modelPestSpray = PestSpray::model()->findByPk($id);
		if ($modelPestSpray === null) {
            $errorText = YII_DEBUG ? sprintf(
                Yii::t('app', 'The ID %s does not exist in %s.'),
                $id,
                'PestSpray'
            ) : Yii::t('app', 'The requested page does not exist.');
			throw new CHttpException(404, $errorText);
		}
		return $modelPestSpray;
	}

	/**
	 * Performs the AJAX validation.
	 * @param PestSpray $modelPestSpray the model to be validated
	 */
	protected function performAjaxValidation($modelPestSpray)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'pest-spray-form') {
			echo CActiveForm::validate($modelPestSpray);
			Yii::app()->end();
		}
	}
}