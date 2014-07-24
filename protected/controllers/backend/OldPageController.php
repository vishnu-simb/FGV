<?php

class OldPageController extends SimbControllerBackend
{
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$modelOldPage = $this->loadModel($id);
		$this->pageTitle = sprintf(Yii::t('app', 'View %s ID: #%s'), 'OldPage', $modelOldPage->id);
		$this->render('view', array(
			'modelOldPage' => $modelOldPage,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$this->pageTitle = sprintf(Yii::t('app', 'Manage %s'), 'OldPages');
		$modelOldPage = new OldPage('search');
		$modelOldPage->unsetAttributes();  // clear any default values
		if (isset($_GET['OldPage'])) {
			$modelOldPage->attributes = $_GET['OldPage'];
		}

		$this->render('index', array(
			'modelOldPage' => $modelOldPage,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return OldPage the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$modelOldPage = OldPage::model()->findByPk($id);
		if ($modelOldPage === null) {
            $errorText = YII_DEBUG ? sprintf(
                Yii::t('app', 'The ID %s does not exist in %s.'),
                $id,
                'OldPage'
            ) : Yii::t('app', 'The requested page does not exist.');
			throw new CHttpException(404, $errorText);
		}
		return $modelOldPage;
	}

	/**
	 * Performs the AJAX validation.
	 * @param OldPage $modelOldPage the model to be validated
	 */
	protected function performAjaxValidation($modelOldPage)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'old-page-form') {
			echo CActiveForm::validate($modelOldPage);
			Yii::app()->end();
		}
	}
}