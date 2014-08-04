<?php

class SprayingController extends SimbController
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
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
	
		$modelSpray = $this->loadModel($id);
		$this->pageTitle = sprintf(Yii::t('app', 'Update %s ID: #%s'), 'Spray', $modelSpray->id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($modelSpray);
		if (isset($_POST['Spray'])) {
			$modelSpray->attributes=$_POST['Spray'];
			if ($modelSpray->save()) {
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
			}
		}
		$this->render('update', array(
				'modelSpray' => $modelSpray,
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
		$this->pageTitle = sprintf(Yii::t('app', '%s'), 'Spraying');
		$modelSpray = new Spray();
		$modelSpray->unsetAttributes();  // clear any default values
		if (isset($_POST['Spray'])) {
			$modelSpray->attributes = $_POST['Spray'];
			if ($modelSpray->save()) {
	
			}
		}
		$this->render('index', array(
				'modelSpray' => $modelSpray,
				'dataProvider' => $modelSpray->SearchLatestSpray(),
		));
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Spray the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$modelSpray = Spray::model()->findByPk($id);
		if ($modelSpray === null) {
            $errorText = YII_DEBUG ? sprintf(
                Yii::t('app', 'The ID %s does not exist in %s.'),
                $id,
                'Spray'
            ) : Yii::t('app', 'The requested page does not exist.');
			throw new CHttpException(404, $errorText);
		}
		return $modelSpray;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Spray $modelSpray the model to be validated
	 */
	protected function performAjaxValidation($modelSpray)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'spray-form') {
			echo CActiveForm::validate($modelSpray);
			Yii::app()->end();
		}
	}
}