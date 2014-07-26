<?php

class GrowerController extends SimbController
{
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$modelGrower = $this->loadModel($id);
		$this->pageTitle = sprintf(Yii::t('app', 'View %s ID: #%s'), 'Grower', $modelGrower->id);
		$this->render('view', array(
			'modelGrower' => $modelGrower,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$this->pageTitle = sprintf(Yii::t('app', 'Create %s'), 'Grower');
		$modelGrower = new Grower;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($modelGrower);

		if (isset($_POST['Grower'])) {
			$modelGrower->attributes = $_POST['Grower'];
			if ($modelGrower->save()) {
				$this->redirect(array('view', 'id' => $modelGrower->id));
			}
		}

		$this->render('create', array(
			'modelGrower' => $modelGrower,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$modelGrower = $this->loadModel($id);
		$this->pageTitle = sprintf(Yii::t('app', 'Update %s ID: #%s'), 'Grower', $modelGrower->id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($modelGrower);

		if (isset($_POST['Grower'])) {
			$modelGrower->attributes=$_POST['Grower'];
			if ($modelGrower->save()) {
				$this->redirect(array('view', 'id' => $modelGrower->id));
			}
		}

		$this->render('update', array(
			'modelGrower' => $modelGrower,
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
                'Grower'
            ) : Yii::t('app', 'Invalid request. Please do not repeat this request again.');
			throw new CHttpException(400, $errorText);
		}
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$this->pageTitle = sprintf(Yii::t('app', 'Manage %s'), 'Growers');
		$modelGrower = new Grower('search');
		$modelGrower->unsetAttributes();  // clear any default values
		if (isset($_GET['Grower'])) {
			$modelGrower->attributes = $_GET['Grower'];
		}

		$this->render('index', array(
			'modelGrower' => $modelGrower,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Grower the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$modelGrower = Grower::model()->findByPk($id);
		if ($modelGrower === null) {
            $errorText = YII_DEBUG ? sprintf(
                Yii::t('app', 'The ID %s does not exist in %s.'),
                $id,
                'Grower'
            ) : Yii::t('app', 'The requested page does not exist.');
			throw new CHttpException(404, $errorText);
		}
		return $modelGrower;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Grower $modelGrower the model to be validated
	 */
	protected function performAjaxValidation($modelGrower)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'grower-form') {
			echo CActiveForm::validate($modelGrower);
			Yii::app()->end();
		}
	}
}