<?php

class OldNewsController extends SimbControllerBackend
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
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$modelOldNews = $this->loadModel($id);
		$this->pageTitle = sprintf(Yii::t('app', 'View %s ID: #%s'), 'OldNews', $modelOldNews->id);
		$this->render('view', array(
			'modelOldNews' => $modelOldNews,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$this->pageTitle = sprintf(Yii::t('app', 'Manage %s'), 'OldNews');
		$modelOldNews = new OldNews('search');
		$modelOldNews->unsetAttributes();  // clear any default values
		if (isset($_GET['OldNews'])) {
			$modelOldNews->attributes = $_GET['OldNews'];
		}

		$this->render('index', array(
			'modelOldNews' => $modelOldNews,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return OldNews the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$modelOldNews = OldNews::model()->findByPk($id);
		if ($modelOldNews === null) {
            $errorText = YII_DEBUG ? sprintf(
                Yii::t('app', 'The ID %s does not exist in %s.'),
                $id,
                'OldNews'
            ) : Yii::t('app', 'The requested page does not exist.');
			throw new CHttpException(404, $errorText);
		}
		return $modelOldNews;
	}

	/**
	 * Performs the AJAX validation.
	 * @param OldNews $modelOldNews the model to be validated
	 */
	protected function performAjaxValidation($modelOldNews)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'old-news-form') {
			echo CActiveForm::validate($modelOldNews);
			Yii::app()->end();
		}
	}
}