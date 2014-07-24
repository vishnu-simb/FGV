<?php

class OrganizationPersonController extends SimbControllerBackend
{
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$modelOrganizationPerson = $this->loadModel($id);
		$this->pageTitle = sprintf(Yii::t('app', 'View %s ID: #%s'), 'OrganizationPerson', $modelOrganizationPerson->id);
		$this->render('view', array(
			'modelOrganizationPerson' => $modelOrganizationPerson,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$this->pageTitle = sprintf(Yii::t('app', 'Create %s'), 'OrganizationPerson');
		$modelOrganizationPerson = new OrganizationPerson;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($modelOrganizationPerson);

		if (isset($_POST['OrganizationPerson'])) {
			$modelOrganizationPerson->attributes = $_POST['OrganizationPerson'];
			if ($modelOrganizationPerson->save()) {
				$this->redirect(array('view', 'id' => $modelOrganizationPerson->id));
			}
		}

		$this->render('create', array(
			'modelOrganizationPerson' => $modelOrganizationPerson,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$modelOrganizationPerson = $this->loadModel($id);
		$this->pageTitle = sprintf(Yii::t('app', 'Update %s ID: #%s'), 'OrganizationPerson', $modelOrganizationPerson->id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($modelOrganizationPerson);

		if (isset($_POST['OrganizationPerson'])) {
			$modelOrganizationPerson->attributes=$_POST['OrganizationPerson'];
			if ($modelOrganizationPerson->save()) {
				$this->redirect(array('view', 'id' => $modelOrganizationPerson->id));
			}
		}

		$this->render('update', array(
			'modelOrganizationPerson' => $modelOrganizationPerson,
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
                'OrganizationPerson'
            ) : Yii::t('app', 'Invalid request. Please do not repeat this request again.');
			throw new CHttpException(400, $errorText);
		}
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$this->pageTitle = sprintf(Yii::t('app', 'Manage %s'), 'OrganizationPeople');
		$modelOrganizationPerson = new OrganizationPerson('search');
		$modelOrganizationPerson->unsetAttributes();  // clear any default values
		if (isset($_GET['OrganizationPerson'])) {
			$modelOrganizationPerson->attributes = $_GET['OrganizationPerson'];
		}

		$this->render('index', array(
			'modelOrganizationPerson' => $modelOrganizationPerson,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return OrganizationPerson the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$modelOrganizationPerson = OrganizationPerson::model()->findByPk($id);
		if ($modelOrganizationPerson === null) {
            $errorText = YII_DEBUG ? sprintf(
                Yii::t('app', 'The ID %s does not exist in %s.'),
                $id,
                'OrganizationPerson'
            ) : Yii::t('app', 'The requested page does not exist.');
			throw new CHttpException(404, $errorText);
		}
		return $modelOrganizationPerson;
	}

	/**
	 * Performs the AJAX validation.
	 * @param OrganizationPerson $modelOrganizationPerson the model to be validated
	 */
	protected function performAjaxValidation($modelOrganizationPerson)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'organization-person-form') {
			echo CActiveForm::validate($modelOrganizationPerson);
			Yii::app()->end();
		}
	}
}