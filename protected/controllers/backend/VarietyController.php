<?php

class VarietyController extends SimbController
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
		$modelVariety = $this->loadModel($id);
		$this->pageTitle = sprintf(Yii::t('app', 'View %s ID: #%s'), 'Variety', $modelVariety->id);
		$this->render('view', array(
			'modelVariety' => $modelVariety,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$this->pageTitle = sprintf(Yii::t('app', 'Create %s'), 'Variety');
		$modelVariety = new Variety;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($modelVariety);

		if (isset($_POST['Variety'])) {
			$modelVariety->attributes = $_POST['Variety'];
			if ($modelVariety->save()) {
				$this->redirect(array('view', 'id' => $modelVariety->id));
			}
		}

		$this->render('create', array(
			'modelVariety' => $modelVariety,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$modelVariety = $this->loadModel($id);
		$this->pageTitle = sprintf(Yii::t('app', 'Update %s ID: #%s'), 'Variety', $modelVariety->id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($modelVariety);

		if (isset($_POST['Variety'])) {
			$modelVariety->attributes=$_POST['Variety'];
			if ($modelVariety->save()) {
				$this->redirect(array('view', 'id' => $modelVariety->id));
			}
		}

		$this->render('update', array(
			'modelVariety' => $modelVariety,
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
                'Variety'
            ) : Yii::t('app', 'Invalid request. Please do not repeat this request again.');
			throw new CHttpException(400, $errorText);
		}
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$this->pageTitle = sprintf(Yii::t('app', 'Manage %s'), 'Varieties');
		$modelVariety = new Variety('search');
		$modelVariety->unsetAttributes();  // clear any default values
		if (isset($_GET['Variety'])) {
			$modelVariety->attributes = $_GET['Variety'];
		}

		$this->render('index', array(
			'modelVariety' => $modelVariety,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Variety the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$modelVariety = Variety::model()->findByPk($id);
		if ($modelVariety === null) {
            $errorText = YII_DEBUG ? sprintf(
                Yii::t('app', 'The ID %s does not exist in %s.'),
                $id,
                'Variety'
            ) : Yii::t('app', 'The requested page does not exist.');
			throw new CHttpException(404, $errorText);
		}
		return $modelVariety;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Variety $modelVariety the model to be validated
	 */
	protected function performAjaxValidation($modelVariety)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'variety-form') {
			echo CActiveForm::validate($modelVariety);
			Yii::app()->end();
		}
	}
}