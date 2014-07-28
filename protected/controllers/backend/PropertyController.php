<?php

class PropertyController extends SimbController
{
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$modelProperty = $this->loadModel($id);
		$this->pageTitle = sprintf(Yii::t('app', 'View %s ID: #%s'), 'Property', $modelProperty->id);
		$this->render('view', array(
			'modelProperty' => $modelProperty,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$this->pageTitle = sprintf(Yii::t('app', 'Create %s'), 'Property');
		$modelProperty = new Property;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($modelProperty);

		if (isset($_POST['Property'])) {
			$modelProperty->attributes = $_POST['Property'];
			if ($modelProperty->save()) {
				$this->redirect(array('view', 'id' => $modelProperty->id));
			}
		}

		$this->render('create', array(
			'modelProperty' => $modelProperty,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$modelProperty = $this->loadModel($id);
		$this->pageTitle = sprintf(Yii::t('app', 'Update %s ID: #%s'), 'Property', $modelProperty->id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($modelProperty);

		if (isset($_POST['Property'])) {
			$modelProperty->attributes=$_POST['Property'];
			if ($modelProperty->save()) {
				$this->redirect(array('view', 'id' => $modelProperty->id));
			}
		}

		$this->render('update', array(
			'modelProperty' => $modelProperty,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
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
                'Property'
            ) : Yii::t('app', 'Invalid request. Please do not repeat this request again.');
			throw new CHttpException(400, $errorText);
		}
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$this->pageTitle = sprintf(Yii::t('app', 'Manage %s'), 'Properties');
		$modelProperty = new Property('search');
		$modelProperty->unsetAttributes();  // clear any default values
		if (isset($_GET['Property'])) {
			$modelProperty->attributes = $_GET['Property'];
		}

		$this->render('index', array(
			'modelProperty' => $modelProperty,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Property the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$modelProperty = Property::model()->findByPk($id);
		if ($modelProperty === null) {
            $errorText = YII_DEBUG ? sprintf(
                Yii::t('app', 'The ID %s does not exist in %s.'),
                $id,
                'Property'
            ) : Yii::t('app', 'The requested page does not exist.');
			throw new CHttpException(404, $errorText);
		}
		return $modelProperty;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Property $modelProperty the model to be validated
	 */
	protected function performAjaxValidation($modelProperty)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'property-form') {
			echo CActiveForm::validate($modelProperty);
			Yii::app()->end();
		}
	}
}