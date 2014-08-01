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
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$this->pageTitle = sprintf(Yii::t('app', '%s'), 'Spraying');
		$modelSpray = new Spray('search');
		$modelSpray->unsetAttributes();  // clear any default values
		if (isset($_GET['Spray'])) {
			$modelSpray->attributes = $_GET['Spray'];
		}
		if (isset($_POST['Spray'])) {
			$modelSpray->attributes = $_POST['Spray'];
			if ($modelSpray->save()) {
				
			}
		}
		$this->render('index', array(
			'modelSpray' => $modelSpray,
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