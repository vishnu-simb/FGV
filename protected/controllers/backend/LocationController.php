<?php

class LocationController extends SimbController
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
		$modelLocation = $this->loadModel($id);
		$this->pageTitle = sprintf(Yii::t('app', 'View %s ID: #%s'), 'Location', $modelLocation->id);
		$this->render('view', array(
			'modelLocation' => $modelLocation,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$this->pageTitle = sprintf(Yii::t('app', 'Create %s'), 'Location');
		$modelLocation = new Location;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($modelLocation);

		if (isset($_POST['Location'])) {
			$modelLocation->attributes = $_POST['Location'];
			if ($modelLocation->save()) {
				$this->redirect(array('view', 'id' => $modelLocation->id));
			}
		}

		$this->render('create', array(
			'modelLocation' => $modelLocation,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$modelLocation = $this->loadModel($id);
		$this->pageTitle = sprintf(Yii::t('app', 'Update %s ID: #%s'), 'Location', $modelLocation->id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($modelLocation);

		if (isset($_POST['Location'])) {
			$modelLocation->attributes=$_POST['Location'];
			if ($modelLocation->save()) {
				$this->redirect(array('view', 'id' => $modelLocation->id));
			}
		}

		$this->render('update', array(
			'modelLocation' => $modelLocation,
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
                'Location'
            ) : Yii::t('app', 'Invalid request. Please do not repeat this request again.');
			throw new CHttpException(400, $errorText);
		}
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$this->pageTitle = sprintf(Yii::t('app', 'Manage %s'), 'Locations');
		$modelLocation = new Location('search');
		$modelLocation->unsetAttributes();  // clear any default values
		if (isset($_GET['Location'])) {
			$criteria = $_GET['Location'];
			Yii::app()->session['Location'] = $criteria;
			;
		}
		$modelLocation->attributes = Yii::app()->session['Location'];
		$this->render('index', array(
			'modelLocation' => $modelLocation,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Location the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$modelLocation = Location::model()->findByPk($id);
		if ($modelLocation === null) {
            $errorText = YII_DEBUG ? sprintf(
                Yii::t('app', 'The ID %s does not exist in %s.'),
                $id,
                'Location'
            ) : Yii::t('app', 'The requested page does not exist.');
			throw new CHttpException(404, $errorText);
		}
		return $modelLocation;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Location $modelLocation the model to be validated
	 */
	protected function performAjaxValidation($modelLocation)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'location-form') {
			echo CActiveForm::validate($modelLocation);
			Yii::app()->end();
		}
	}
}