<?php

class SizingController extends SimbController
{
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$modelSizing = $this->loadModel($id);
		$this->pageTitle = sprintf(Yii::t('app', 'View %s ID: #%s'), 'Sizing', $modelSizing->id);
		$this->render('view', array(
			'modelSizing' => $modelSizing,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$this->pageTitle = sprintf(Yii::t('app', 'Create %s'), 'Sizing');
		$modelSizing = new Sizing;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($modelSizing);

		if (isset($_POST['Sizing'])) {
			$modelSizing->attributes = $_POST['Sizing'];
			if ($modelSizing->save()) {
				$this->redirect(array('view', 'id' => $modelSizing->id));
			}
		}

		$this->render('create', array(
			'modelSizing' => $modelSizing,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$modelSizing = $this->loadModel($id);
		$this->pageTitle = sprintf(Yii::t('app', 'Update %s ID: #%s'), 'Sizing', $modelSizing->id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($modelSizing);

		if (isset($_POST['Sizing'])) {
			$modelSizing->attributes=$_POST['Sizing'];
			if ($modelSizing->save()) {
				$this->redirect(array('view', 'id' => $modelSizing->id));
			}
		}

		$this->render('update', array(
			'modelSizing' => $modelSizing,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if (Yii::app()->request->getParam('get','delete')){
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
                'Sizing'
            ) : Yii::t('app', 'Invalid request. Please do not repeat this request again.');
			throw new CHttpException(400, $errorText);
		}
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$this->pageTitle = sprintf(Yii::t('app', 'Manage %s'), 'Sizings');
		$modelSizing = new Sizing('search');
		$modelSizing->unsetAttributes();  // clear any default values
		if (isset($_GET['Sizing'])) {
			$modelSizing->attributes = $_GET['Sizing'];
		}

		$this->render('index', array(
			'modelSizing' => $modelSizing,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Sizing the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$modelSizing = Sizing::model()->findByPk($id);
		if ($modelSizing === null) {
            $errorText = YII_DEBUG ? sprintf(
                Yii::t('app', 'The ID %s does not exist in %s.'),
                $id,
                'Sizing'
            ) : Yii::t('app', 'The requested page does not exist.');
			throw new CHttpException(404, $errorText);
		}
		return $modelSizing;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Sizing $modelSizing the model to be validated
	 */
	protected function performAjaxValidation($modelSizing)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'sizing-form') {
			echo CActiveForm::validate($modelSizing);
			Yii::app()->end();
		}
	}
}