<?php

class CropPestController extends SimbController
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
		$modelCropPest = $this->loadModel($id);
		$this->pageTitle = sprintf(Yii::t('app', 'View %s ID: #%s'), 'CropPest', $modelCropPest->id);
		$this->render('view', array(
			'modelCropPest' => $modelCropPest,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$this->pageTitle = sprintf(Yii::t('app', 'Create %s'), 'CropPest');
		$modelCropPest = new CropPest;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($modelCropPest);

		if (isset($_POST['CropPest'])) {
			$modelCropPest->attributes = $_POST['CropPest'];
			if ($modelCropPest->save()) {
				$this->redirect(array('view', 'id' => $modelCropPest->id));
			}
		}

		$this->render('create', array(
			'modelCropPest' => $modelCropPest,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$modelCropPest = $this->loadModel($id);
		$this->pageTitle = sprintf(Yii::t('app', 'Update %s ID: #%s'), 'CropPest', $modelCropPest->id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($modelCropPest);

		if (isset($_POST['CropPest'])) {
			$modelCropPest->attributes=$_POST['CropPest'];
			if ($modelCropPest->save()) {
				$this->redirect(array('view', 'id' => $modelCropPest->id));
			}
		}

		$this->render('update', array(
			'modelCropPest' => $modelCropPest,
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
                'CropPest'
            ) : Yii::t('app', 'Invalid request. Please do not repeat this request again.');
			throw new CHttpException(400, $errorText);
		}
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$this->pageTitle = sprintf(Yii::t('app', 'Manage %s'), 'Crop Pests');
		$modelCropPest = new CropPest('search');
		$modelCropPest->unsetAttributes();  // clear any default values
		if (isset($_GET['CropPest'])) {
			$criteria = $_GET['CropPest'];
			Yii::app()->session['CropPest'] = $criteria;
		}
		$modelCropPest->attributes = Yii::app()->session['CropPest'];
		$this->render('index', array(
			'modelCropPest' => $modelCropPest,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return CropPest the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$modelCropPest = CropPest::model()->findByPk($id);
		if ($modelCropPest === null) {
            $errorText = YII_DEBUG ? sprintf(
                Yii::t('app', 'The ID %s does not exist in %s.'),
                $id,
                'CropPest'
            ) : Yii::t('app', 'The requested page does not exist.');
			throw new CHttpException(404, $errorText);
		}
		return $modelCropPest;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CropPest $modelCropPest the model to be validated
	 */
	protected function performAjaxValidation($modelCropPest)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'crop-pest-form') {
			echo CActiveForm::validate($modelCropPest);
			Yii::app()->end();
		}
	}
}