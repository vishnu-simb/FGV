<?php

class MiteController extends SimbController
{
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$modelMite = $this->loadModel($id);
		$this->pageTitle = sprintf(Yii::t('app', 'View %s ID: #%s'), 'Mite', $modelMite->id);
		$this->render('view', array(
			'modelMite' => $modelMite,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$this->pageTitle = sprintf(Yii::t('app', 'Create %s'), 'Mite');
		$modelMite = new Mite;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($modelMite);

		if (isset($_POST['Mite'])) {
			$modelMite->attributes = $_POST['Mite'];
			if ($modelMite->save()) {
				$this->redirect(array('view', 'id' => $modelMite->id));
			}
		}

		$this->render('create', array(
			'modelMite' => $modelMite,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$modelMite = $this->loadModel($id);
		$this->pageTitle = sprintf(Yii::t('app', 'Update %s ID: #%s'), 'Mite', $modelMite->id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($modelMite);

		if (isset($_POST['Mite'])) {
			$modelMite->attributes=$_POST['Mite'];
			if ($modelMite->save()) {
				$this->redirect(array('view', 'id' => $modelMite->id));
			}
		}

		$this->render('update', array(
			'modelMite' => $modelMite,
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
                'Mite'
            ) : Yii::t('app', 'Invalid request. Please do not repeat this request again.');
			throw new CHttpException(400, $errorText);
		}
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$this->pageTitle = sprintf(Yii::t('app', 'Manage %s'), 'Mites');
		$modelMite = new Mite('search');
		$modelMite->unsetAttributes();  // clear any default values
		if (isset($_GET['Mite'])) {
			$criteria = $_GET['Mite'];
			Yii::app()->session['Mite'] = $criteria;
		}
		$modelMite->attributes = Yii::app()->session['Mite'];
		$this->render('index', array(
			'modelMite' => $modelMite,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Mite the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$modelMite = Mite::model()->findByPk($id);
		if ($modelMite === null) {
            $errorText = YII_DEBUG ? sprintf(
                Yii::t('app', 'The ID %s does not exist in %s.'),
                $id,
                'Mite'
            ) : Yii::t('app', 'The requested page does not exist.');
			throw new CHttpException(404, $errorText);
		}
		return $modelMite;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Mite $modelMite the model to be validated
	 */
	protected function performAjaxValidation($modelMite)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'mite-form') {
			echo CActiveForm::validate($modelMite);
			Yii::app()->end();
		}
	}
}